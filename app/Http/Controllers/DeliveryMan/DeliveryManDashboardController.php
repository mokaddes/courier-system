<?php

namespace App\Http\Controllers\DeliveryMan;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeliveryManDashboardController extends Controller
{

    public function index()
    {

        // dd(Auth::guard('deliveryman')->check());

        $id = Auth::guard('deliveryman')->id();

        $orders['total']=Order::with(['user','orderProducts'])->where('delivery_boy_id',$id)->where('payment_status',true)->count();
        $data['pendingOrder']=Order::with(['user','orderProducts'])->where('delivery_boy_id',Auth::guard('deliveryman')->id())->where('order_status',0)->where('payment_status',true)->count();
        $data['confirmedOrder']=Order::with(['user','orderProducts'])->where('delivery_boy_id',Auth::guard('deliveryman')->id())->where('order_status',1)->where('payment_status',true)->count();
        $data['pickupdOrder']=Order::with(['user','orderProducts'])->where('delivery_boy_id',Auth::guard('deliveryman')->id())->where('order_status',2)->where('payment_status',true)->count();
        $data['onTheWayOrder']=Order::with(['user','orderProducts'])->where('delivery_boy_id',Auth::guard('deliveryman')->id())->where('order_status',3)->where('payment_status',true)->count();
        $data['deliveredOrder']=Order::with(['user','orderProducts'])->where('delivery_boy_id',Auth::guard('deliveryman')->id())->where('order_status',4)->where('payment_status',true)->count();
        $data['cancelOrder']=Order::with(['user','orderProducts'])->where('delivery_boy_id',Auth::guard('deliveryman')->id())->where('order_status',5)->where('payment_status',true)->count();
        $data['cashOnDelivery']=Order::with(['user','orderProducts'])->where('delivery_boy_id',Auth::guard('deliveryman')->id())->where('cash_on_delivery',true)->count();

        return view('delivery_boy.dashboard',compact('orders','data'));
    }
}
