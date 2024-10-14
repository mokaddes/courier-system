<?php

namespace App\Http\Controllers\Api\DelivaryBoy;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DeliveryMan\Api\ResponseController;
use App\Models\PdeliveryRequest;
use App\Models\PickupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * @param Request $request
     * @return object
     */
    public function index(Request $request)
    {

        $description = "The status are  2 = Waiting for delivery man, 3 = Taken by delivery man, 4 = Delivered";

        $deliverymanId = $request->user()->id;
        $data = [];

        $result = PickupRequest::selectRaw('SUM(CASE WHEN payment_status = 0 THEN cod_amount + amount ELSE cod_amount END) AS total_amount')
            ->where('status', 4)
            ->where('deliveryman_id', $deliverymanId)
            ->where('cod_received_by_admin', 0)
            ->get();

        if ($result->isNotEmpty()) {
            $totalAmount = $result->sum('total_amount');
        } else {
            $totalAmount = 0;
        }

        $data['balance'] = $totalAmount;

        $data['waiting_list_count'] = PdeliveryRequest::with('pickupRequest')
            ->where('status', 0)
            ->where('deliveryman_id', $deliverymanId)
            ->orderBy('id', 'desc')->count();
        $data['picked_count'] = PickupRequest::with('hasMerchant', 'city', 'hasDeliveryman', 'hasPickupState', 'hasDeliveryState')->where('deliveryman_id', $deliverymanId)->where('status', '3')->count();
        $data['delivered_count'] = PickupRequest::with('hasMerchant', 'city', 'hasDeliveryman', 'hasPickupState', 'hasDeliveryState')->where('deliveryman_id', $deliverymanId)->where('status', '4')->count();

        $data['pick_up_request_list'] = PickupRequest::with('hasMerchant', 'city', 'hasDeliveryman', 'hasPickupState', 'hasDeliveryState')->orderBy('id', 'desc')->where('deliveryman_id', $deliverymanId)->get();
        return ResponseController::sendResponse(200, 'All Pickup Request', $data, 1, $description);
    }


    public function view(PickupRequest $pickupRequest)
    {
        $pickupRequest->load('hasMerchant', 'city', 'deliveryCity', 'hasDeliveryman', 'hasPickupState', 'hasDeliveryState');
        $description = 'Must be provide valid pickup request id';
        return ResponseController::sendResponse(200, 'Pickup Request Details', $pickupRequest, 1, $description);
    }


    public function status(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required']
        ]);
        $description = 'Must be provide valid pickup request id';

        if ($validator->fails()) {
            return ResponseController::sendResponse(200, "Required", $validator->errors()->first(), 0, $description);
        }
        $pickupRequest = PickupRequest::find($id);
        $pickupRequest->status = $request->status;
        if ($request->status == "4") {
            $pickupRequest->delivered_date = now();
        }
        $pickupRequest->save();
        return ResponseController::sendResponse(200, 'Pickup Request status change successfully', $pickupRequest, 1, $description);
    }

    /**
     * @param Request $request
     * @return object
     */
    public function waitingList(Request $request)
    {
        $deliveryman = $request->user();
        $data = PdeliveryRequest::with('pickupRequest')
            ->where('status', 0)
            ->where('deliveryman_id', $deliveryman->id)
            ->orderBy('id', 'desc')->get();
        return ResponseController::sendResponse(200, 'Waiting for Delivery-Man', $data);

    }


    public function approvedRequest(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validation->fails()) {
            return ResponseController::sendError('validation Error', $validation->errors()->first());
        }


        DB::beginTransaction();

        try {
            $auth_id = $request->user()->id;
            $dr = PdeliveryRequest::find($request->id);

            if ($dr->status == 0) {
                if ($dr->deliveryman_id != $auth_id) {
                    $message = 'You are not right person for this request.';
                    return ResponseController::sendError('Invalid User', $message);
                }
                $pdelivery_reqs = PdeliveryRequest::where('pickup_request_id', $dr->pickup_request_id)->where('deliveryman_id', '!=', $auth_id)->get();
                foreach ($pdelivery_reqs as $value) {
                    $value->status = 2;
                    $value->save();
                }

                $dr->status = 1;
                $dr->save();
                // need to update PickupRequest where id is $id
                PickupRequest::where('id', $dr->pickup_request_id)->update(['deliveryman_id' => $auth_id, 'status' => '3']);

            } else {
                $message = 'Other Deliveryman already accept this request.';
                return ResponseController::sendError('Invalid User', $message);

            }

        } catch (\Throwable $th) {
            DB::rollBack();
            $message = 'Status Not Successfully Approved!.';
            return ResponseController::sendError('Invalid User', $message);

        }

        DB::commit();
        $message = 'Status Successfully Approved!.';
        return ResponseController::sendResponse(200, $message);


    }
}
