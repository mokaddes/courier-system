<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DeliveryMan\Api\ResponseController;
use App\Models\PickupRequest;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    /**
     * @var ResponseController
     */
    public $respond;

    public function __construct()
    {
        $this->respond = new ResponseController();
    }

    public function deuAccounts(Request $request)
    {
        $auth = $request->user();
        $description = "The status are 0 = pending, 1 = Active, 2=Waiting for delivary man, 3=taked by delivary man, 4=Delivered, 5=Returned";
        $rows = PickupRequest::with(['city','hasPickupState','hasDeliveryState'])->orderBy('cod_received_by_admin')->orderBy('id','desc');

        if($auth->getRoleNames()[0] == 'deliveryman'){
            $rows = $rows->where('deliveryman_id', $auth->id);
        }




        $rows = $rows ->where(
            function($query) {
                return $query
                    ->where('payment_status', 0)
                    ->orWhere('cod_amount', '>', 0);
            })

            ->where('status', 4)
            ->get();
        return $this->respond->sendResponse(200,'Account Balance Details',$rows,true,$description);
    }
}
