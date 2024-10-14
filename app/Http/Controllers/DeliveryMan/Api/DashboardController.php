<?php

namespace App\Http\Controllers\DeliveryMan\Api;

use App\Http\Controllers\Controller;
use App\Models\PickupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public $respond;
    function __construct() {
        $this->respond = new ResponseController();
    }

    public function index()
    {
        try {
            $id = request()->user()->id;

            $sum=PickupRequest::where('deliveryman_id',$id)
            ->sum('cod_amount');



        $data['totalPickupRequest']=PickupRequest::where('deliveryman_id',$id)->count();
        $data['pendingPickupRequest']=PickupRequest::where('deliveryman_id',$id)->where('status',0)->count();
        $data['confirmedPickupRequest']=PickupRequest::where('deliveryman_id',$id)->where('status',1)->count();
        $data['pickupdPickupRequest']=PickupRequest::where('deliveryman_id',$id)->where('status',2)->count();
        $data['onTheWayPickupRequest']=PickupRequest::where('deliveryman_id',$id)->where('status',3)->count();
        $data['deliveredPickupRequest']=PickupRequest::where('deliveryman_id',$id)->where('status',4)->count();
        $data['cancelPickupRequest']=PickupRequest::where('deliveryman_id',$id)->where('status',5)->count();
        $data['balance']=$sum;
        return $this->respond->sendResponse(200,"All PickupRequest Count",$data,1,"All PickupRequests For This Delivery Man Dashboard");
            //code...
        } catch (\Throwable $th) {
            return $this->respond->sendResponse(200,"Token Expired",'',1,'');

        }


    }
}
