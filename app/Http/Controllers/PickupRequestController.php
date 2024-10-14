<?php

namespace App\Http\Controllers;

use App\Helpers\NotificationSend;
use App\Mail\MerchantPickUpRequestNotify;
use App\Mail\OrderAccepetedNotifyAdmin;
use App\Mail\OrderAccepetedNotifyMarchant;
use App\Mail\OrderDeliveredNotifyAdmin;
use App\Mail\OrderDeliveredNotifyMerchant;
use App\Mail\WaitingListDeliveryBoyNotify;
use App\Models\Admin;
use App\Models\City;
use App\Models\PdeliveryRequest;
use App\Models\PickupRequest;
use App\Models\PickupRequestToDeliveryman;
use App\Models\Pricing;
use App\Models\PricingGroup;
use App\Models\Region;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\Weight;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PickupRequestController extends Controller
{
    public function index(Request $request)
    {
        // dd(Auth::user());
        $query = PickupRequest::with('hasMerchant')->orderBy('pickup_requests.id', 'desc');

        if ($request->status == 'pending' && $request->type == "merchant") {
            $query->where('pickup_requests.status', 0)->whereNotNull('pickup_requests.merchant_id');
        }

        if ($request->status == 'pending' && $request->type == "guest") {
            $query->where('pickup_requests.status', 0)->whereNull('pickup_requests.merchant_id');
        }

        if (Auth::user()->is_merchant == 1) {
            $query->where('pickup_requests.merchant_id', Auth::guard('admin')->id());

        }
        if (Auth::user()->is_deliveryman == 1) {
            $query->where('pickup_requests.deliveryman_id', Auth::id())->where('status', '=', 3);
        }
        if ($request->has('merchant_id')) {
            $merchant_id = $request->get('merchant_id');
            $query->whereHas('hasMerchant', function ($q) use ($merchant_id) {
                $q->where('merchant_id', $merchant_id);
            });
        }
        if ($request->has('deliveryman_id')) {
            $deliveryman_id = $request->get('deliveryman_id');
            $query->whereHas('hasDeliveryman', function ($q) use ($deliveryman_id) {
                $q->where('deliveryman_id', $deliveryman_id);
            });

        }

        $rows = $query->get();
        $deliveryman = Admin::where('is_deliveryman', 1)->where('status', 1)->get();

        // dd($pickup_requests);

        return view('admin.pickup-request.index', compact('rows', 'deliveryman'));
    }

    public function create(Request $request)
    {

        $merchants = null;
        $states = Region::all();
        $cities = City::orderBy('name', 'asc')->get();
        $weights = Weight::orderBy('order_id', 'asc')->get();
        $pricing_groups = PricingGroup::orderBy('order_id', 'asc')->get();

        if (Auth::user()->is_merchant == '1') {
            $merchants = Admin::where('id', Auth::id())->get();
        } elseif ($request->for == 'merchant') {
            $merchants = Admin::where('is_merchant', 1)->orderBy('id', 'desc')->get();
        }

        return view('admin.pickup-request.create', compact('states', 'cities', 'merchants', 'weights', 'pricing_groups'));
    }

    public function store(Request $request)
    {


        $this->validate($request, [
            'pickup_name' => 'nullable',
            'pickup_contact_name' => 'required',
            'pickup_address' => 'required',
            'pickup_street_address' => 'required',
            'pickup_mobile' => 'required',
            'delivery_name' => 'required',
            'delivery_contact_name' => 'required',
            'delivery_address' => 'required',
            'delivery_mobile' => 'required',
            'product_name' => 'required',
            'quantity' => 'required',

            'weight' => 'required',
            'cod_amount' => 'required',
            'pricing_group_id' => 'required',
            'pickup_city' => 'required',
            'delivery_city' => 'required',
            'description' => 'required',


        ]);
        DB::beginTransaction();
        try {

            $price = Pricing::where('pricing_group_id', $request->pricing_group_id)
                ->where('weight_id', $request->weight)->first();
            $amount = 0;
            if ($request->pickup_city == $request->delivery_city) {
                $amount = $price->inside_main_city_price;
            } else {
                $amount = $price->inter_city_price;
            }

            $data = new PickupRequest();
            $data->traking_number = randomString(8);
            $data->pickup_name = $request->pickup_name ?? $request->pickup_contact_name;
            $data->pickup_contact_name = $request->pickup_contact_name;
            $data->pickup_address = $request->pickup_address;
            $data->pickup_street_address = $request->pickup_street_address;
            $data->pickup_city = $request->pickup_city;
            $data->pickup_zip = $request->pickup_zip;
            $data->pickup_mobile = $request->pickup_mobile;
            $data->pickup_email = $request->pickup_email;
            $data->delivery_name = $request->delivery_name;
            $data->delivery_contact_name = $request->delivery_contact_name;
            $data->delivery_address = $request->delivery_address;
            $data->delivery_street_address = $request->delivery_street_address;
            $data->delivery_city = $request->delivery_city;
            $data->delivery_zip = $request->delivery_zip;
            $data->delivery_mobile = $request->delivery_mobile;
            $data->quantity = $request->quantity;
            $data->product_name = $request->product_name;
            $data->weight = $request->weight;
            $data->cod_amount = $request->cod_amount;
            $data->unit_amount = $amount;
            $data->amount = $amount * $request->quantity;
            $data->pricing_group_id = $request->pricing_group_id;
            $data->status = 0;
            $data->merchant_id = $request->merchant_id;
            $data->description = $request->description;
            $data->save();
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            Toastr::error('Pick up Request is Not Submitted!.');

            return redirect()->route('admin.pickup-request.create')->with('error', 'Pick up Request is Not Submitted!')->withInput();
        }

        DB::commit();

        if (auth()->guard('admin')->user()->topup_blance > 0) {
            $paymentStatus = $this->paymet($data->id);
        }
        $mail = Setting::first()->support_email;

        Mail::to($mail)->send(new MerchantPickUpRequestNotify($data, $paymentStatus ?? false));
        Toastr::success('Pick up Request Successfully is Submitted!.');
        return redirect()->route('admin.pickup-request.index')->with('message', 'Pick up Request Successfully is Submitted!');
    }

    public function edit($id)
    {


        $pickup_request = PickupRequest::find($id);
        $merchants = Admin::where('is_merchant', 1)->orderBy('id', 'desc')->get();
        $states = Region::all();

        $cities = City::orderBy('name', 'asc')->get();
        $weights = Weight::orderBy('order_id', 'asc')->get();
        $pricing_groups = PricingGroup::orderBy('order_id', 'asc')->get();

        return view('admin.pickup-request.edit', compact('pickup_request', 'states', 'cities', 'weights', 'pricing_groups', 'merchants'));
    }

    public function update(Request $request, $id)
    {
        $data = PickupRequest::find($id);

        $this->validate($request, [
            'pickup_name' => 'nullable',
            'pickup_contact_name' => 'required',
            'pickup_address' => 'required',
            'pickup_street_address' => 'required',
            'pickup_mobile' => 'required',
            'delivery_name' => 'required',
            'delivery_contact_name' => 'required',
            'delivery_address' => 'required',
            'delivery_mobile' => 'required',
            'product_name' => 'required',
            'quantity' => 'required',
            'cod_amount' => 'required',
            'description' => 'required',
            'pickup_city' => $data->payment_status ? 'nullable' : 'required',
            'pricing_group_id' => $data->payment_status ? 'nullable' : 'required',
            'weight' => $data->payment_status ? 'nullable' : 'required',
            // 'merchant_id' => 'nullable',

        ]);
        DB::beginTransaction();
        try {
            $data->pickup_name = $request->pickup_name;
            $data->pickup_contact_name = $request->pickup_contact_name;
            $data->pickup_address = $request->pickup_address;
            $data->pickup_street_address = $request->pickup_street_address;
            $data->pickup_city = $request->pickup_city;
            $data->pickup_zip = $request->pickup_zip;
            $data->pickup_mobile = $request->pickup_mobile;
            $data->pickup_email = $request->pickup_email;
            $data->delivery_name = $request->delivery_name;
            $data->delivery_contact_name = $request->delivery_contact_name;
            $data->delivery_address = $request->delivery_address;

            if ($request->has('delivery_street_address')) {
                $data->delivery_street_address = $request->delivery_street_address;
            }
            if ($request->has('delivery_city')) {
                $data->delivery_city = $request->delivery_city;
            }
            if ($request->has('delivery_zip')) {
                $data->delivery_zip = $request->delivery_zip;
            }

            $data->delivery_mobile = $request->delivery_mobile;
            $data->product_name = $request->product_name;

            if ($request->has('quantity')) {
                $data->quantity = $request->quantity;
            }
            if ($request->has('weight')) {
                $data->weight = $request->weight;
            }
            if ($request->has('cod_amount')) {
                $data->cod_amount = $request->cod_amount;
            }
            if ($request->has('pricing_group_id')) {
                $data->pricing_group_id = $request->pricing_group_id;
            }

            if ($request->has('merchant_id')) {
                $data->merchant_id = $request->merchant_id;
            }
            $data->description = $request->description;
            $data->save();
        } catch (Exception $e) {
//            dd($e);
            DB::rollback();
            Toastr::error('Pick up Request is Not Submitted!.');
            return redirect()->back()->with('error', 'Pick up Request is Not Updated!');
        }
        DB::commit();
        Toastr::success('Pick up Request is Successfully Updated!.');
        return redirect()->route('admin.pickup-request.index')->with('message', 'Pick up Request is Successfully Updated!');
    }

    public function view($id)
    {
        $pickup_request = PickupRequest::with('hasPickupState', 'hasDeliveryState')->find($id);
        $data['pickup_request'] = $pickup_request;
        $due = $pickup_request->cod_amount;
        $paid = 0;
        if ($pickup_request->payment_status == 0) {
            $due += $pickup_request->amount;
        } else {
            $paid = $pickup_request->amount;
        }
        $data['due'] = $due;
        $data['paid'] = $paid;
        $data['total'] = $pickup_request->cod_amount + $pickup_request->amount;


        return view('admin.pickup-request.view', $data);
    }

    public function active($id): RedirectResponse
    {

        PickupRequest::find($id)->update(['status' => 1]);
        Toastr::success('Pick up Request Status Active.');
        return redirect()->route('admin.pickup-request.index')->with('message', 'Pick up Request Status is Active!');
    }

    public function changeStatus($id, $status): RedirectResponse
    {

        $pickup = PickupRequest::find($id);
        if ($status == "4") {
            $pickup->delivered_date = now();
        }
        $pickup->status = $status;
        if ($status == 0) {
            $pickup->deliveryman_id = null;
        }
        $pickup->save();

        $adminMail = Setting::first()->support_email;
        Mail::to($adminMail)->send(new OrderDeliveredNotifyAdmin($pickup));


        $merchant = Admin::find($pickup->merchant_id);
        if (isset($merchant)) {
            Mail::to($merchant->email)->send(new OrderDeliveredNotifyMerchant($pickup, $merchant));

        }


        Toastr::success('Pick up Request Status updated.');
        return redirect()->route('admin.pickup-request.index')->with('error', 'Pick up Request Status is Inactive');
    }

    public function delete($id): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $pickup_request = PickupRequest::find($id);
            if ($pickup_request->payment_status == 1) {
                $max_id = Transaction::max('id') + 1;
                $transaction_id = Str::random(10) . $max_id;
                $transaction = new Transaction();
                $transaction->txn_type = 'IN';
                $transaction->transaction_id = $transaction_id;
                $transaction->txn_purpose = 'Cancelled Pickup request';
                $transaction->amount = $pickup_request->amount;
                $transaction->user_id = $pickup_request->merchant_id;
                $transaction->created_at = now();
                $transaction->updated_at = now();
                $transaction->created_by = Auth::user()->id;
                $transaction->updated_by = Auth::user()->id;
                $transaction->save();
            }

            $pickup_request->delete();
            PdeliveryRequest::where('pickup_request_id', $id)->delete();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::success('Pick up Request is Not Deleted!.');
            return redirect()->route('admin.pickup-request.index')->with('error', 'Pick up Request is Not Deleted!');
        }
        //          OrderDeliveredNotifyAdmin
        //          OrderDeliveredNotifyMerchant
        DB::commit();
        Toastr::success('Pick up Request is Deleted Successfully!.');
        return redirect()->route('admin.pickup-request.index')->with('message', 'Pick up Request is Deleted Successfully!');
    }

    public function assignDeliveryman(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $id = $request->pickup_request_id;
            $deliveryman_ids = $request->deliveryman_id;
            foreach ($deliveryman_ids as $value) {
                $pdelivery_req = new PdeliveryRequest();
                $pdelivery_req->deliveryman_id = $value;
                $pdelivery_req->pickup_request_id = $id;
                $pdelivery_req->status = 0;
                $pdelivery_req->save();
            }

            $fcmTokens = Admin::whereIn('id', $request->deliveryman_id)->pluck('fcm_token')->toArray();

            PickupRequest::find($id)->update(['status' => 2]);


        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::error('Deliveryman not assigned Successfully!.');
            return redirect()->back();
        }

        NotificationSend::sendNotification("New order", "You have a new order in waiting list.", $fcmTokens);
        DB::commit();

        $pickupRequest = PickupRequest::with(['hasMerchant', 'city', 'hasPickupState', 'hasPriceGroup', 'deliveryCity', 'hasDeliveryState'])->find($id);
        $deliveryBoys = Admin::whereIn('id', $request->deliveryman_id)->get();
        foreach ($deliveryBoys as $delivaryBoy) {
            Mail::to($delivaryBoy->email)->send(new WaitingListDeliveryBoyNotify($delivaryBoy, $pickupRequest));

        }

        Toastr::success('Deliveryman assigned Successfully!.');
        return redirect()->back();

    }

    public function pendingRequest()
    {
        $data = PdeliveryRequest::with('pickupRequest')->where('status', 0)->orderBy('id', 'desc');

        if (Auth::user()->is_deliveryman == 1) {
            $data = $data->where('deliveryman_id', Auth::user()->id);
        }

        $pdelivery_reqs = $data->get();
//        dd($pdelivery_reqs);

        return view('admin.pickup-request.pdelivery-request', compact('pdelivery_reqs'));
    }

    public function totalRequest()
    {
        $pickup_requests = PickupRequest::where('pickup_requests.deliveryman_id', Auth::id())->where('status', '=', '4')->get();
        return view('admin.pickup-request.total-request', compact('pickup_requests'));
    }

    public function approvePendingReq($id)
    {

        DB::beginTransaction();

        try {
            $auth_id = Auth::id();
            $dr = PdeliveryRequest::find($id);

            if ($dr->status == 0) {
                if ($dr->deliveryman_id != $auth_id) {
                    Toastr::eroor('You are not right persion for this request.');
                    return redirect()->back();
                }
                $pdelivery_reqs = PdeliveryRequest::where('pickup_request_id', $dr->pickup_request_id)->where('deliveryman_id', '!=', $auth_id)->get();

                foreach ($pdelivery_reqs as $value) {
                    $value->status = 2;
                    $value->pick_up_date = now();
                    $value->save();
                }

                $dr->status = 1;
                $dr->save();
                // need to update PickupRequest where id is $id
                PickupRequest::where('id', $dr->pickup_request_id)->update(['deliveryman_id' => $auth_id, 'status' => '3']);

            } else {
                Toastr::info('Other Deliveryman already accept this request.');
                return redirect()->back();
            }

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            Toastr::eroor('Status Not Successfully Approved!.');
            return redirect()->back();
        }


        $deliveryBoy = Admin::find($auth_id);
        $pickupRequest = PickupRequest::where('id', $dr->pickup_request_id)->first();


        $mail = Setting::first()->support_email;
        Mail::to($mail)->send(new OrderAccepetedNotifyAdmin($deliveryBoy, $pickupRequest));

        $merchant = Admin::find($pickupRequest->merchant_id);
        if (isset($merchant)) {
            Mail::to($merchant->email)->send(new OrderAccepetedNotifyMarchant($merchant, $deliveryBoy, $pickupRequest));
        }

        DB::commit();


        Toastr::success('Status Successfully Approved!.');
        return redirect()->back();


    }

    public function pdeliveryReqDelete($id)
    {
        $pdelivery_reqs = PdeliveryRequest::find($id);
        $pdelivery_reqs->delete();
        Toastr::success('Pending Delivery Request Deleted Successfully!.');
        return redirect()->back()->with('Pending Delivery Request Deleted Successfully!');
    }

    public function pDeliveryView($id)
    {
        $pdelivery_reqs = PdeliveryRequest::find($id);
        return view('admin.pickup-request.pdelivery-request-view', compact('pdelivery_reqs'));
    }

    public function merchantPayment($id): RedirectResponse
    {
        $this->paymet($id);
        Toastr::success('Payment  successfully done!.');
        return redirect()->back()->with('message', 'Payment  successfully done!');

    }

    private function paymet($id)
    {
        $pickup_request = PickupRequest::find($id);
        if (Auth::user()->is_merchant == 1) {

            $max_id = Transaction::max('id') + 1;
            $transaction_id = Str::random(10) . $max_id;
            $transaction = new Transaction();
            $transaction->txn_type = 'OUT';
            $transaction->transaction_id = $transaction_id;
            $transaction->pickup_request_id = $id;
            $transaction->txn_purpose = 'Pickup request';
            $transaction->amount = $pickup_request->amount;
            $transaction->user_id = $pickup_request->merchant_id;
            $transaction->created_at = now();
            $transaction->updated_at = now();
            $transaction->created_by = Auth::user()->id;
            $transaction->updated_by = Auth::user()->id;
            $transaction->save();
        }


        $pickup_request->payment_status = 1;
        $pickup_request->save();
        return $pickup_request->payment_status;
    }
}
