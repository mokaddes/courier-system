<?php

namespace App\Http\Controllers\DeliveryMan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeliveryManOrderController extends Controller
{
    public function allOrder()
    {

        $setting = Setting::first();
        $orders=Order::with(['user','orderProducts'])
        ->where('delivery_boy_id',Auth::guard('deliveryman')->id())
        ->where(function($q){
            $q->where('payment_status', true)
              ->orWhere('cash_on_delivery', true);
            })
        ->get();
        $pageTitle="All Order";
        return view('delivery_boy.show_order_list',compact('orders','setting','pageTitle'));
    }

    // public function allOrderMap(Request $request)
    // {
    //     $setting = Setting::first();
    //     $user = Auth::guard('deliveryman')->user();


    //     $orders = Order::with(['user','orderAddress',
    //     'shipingAddress'=>function($shipingAddressQuary){
    //         $shipingAddressQuary->select('latitude','longitude');
    //     },'orderProducts','seller'=>function($sellerQuary){

    //         $sellerQuary->select('latitude','longitude');
    //     }])
    //     ->where('delivery_boy_id',Auth::guard('deliveryman')->id())
    //     ->where('payment_status',true)->get();


    //     $response = [];
    //     $orders = Order::select('orders.id','orders.user_id','shipping_addresses.name as customer_name','shipping_addresses.latitude','shipping_addresses.longitude','shipping_addresses.address')
    //     ->where('orders.delivery_boy_id',$user->id)
    //     ->where(function($q){
    //         $q->where('orders.payment_status', true)
    //           ->orWhere('orders.cash_on_delivery', true);
    //         })
    //     ->leftJoin('shipping_addresses','shipping_addresses.user_id','orders.user_id')

    //     ->limit(1)->get();



    //     if($orders){
    //         foreach ($orders as $key => $value) {
    //             $response[$key]['lat'] = $value->latitude;
    //             $response[$key]['lng'] = $value->longitude;
    //         }
    //     }

    //     if($request->ajax()){
    //         return response()->json($orders);
    //     }




    //     return view('delivery_boy.order_map',compact('setting','response'));
    // }

    public function pendingOrder()
    {

        $setting = Setting::first();
        $orders=Order::with(['user','orderProducts'])
        ->where('delivery_boy_id',Auth::guard('deliveryman')->id())
        ->where('order_status',1)
        ->where(function($q){
            $q->where('payment_status', true)
              ->orWhere('cash_on_delivery', true);
            })
        ->get();
        $pageTitle="Pending Order";
        return view('delivery_boy.show_order_list',compact('orders','setting','pageTitle'));
    }


    public function confirmedOrder()
    {
        $setting = Setting::first();
        $orders=Order::with(['user','orderProducts'])
        ->where('delivery_boy_id',Auth::guard('deliveryman')->id())
        ->where('order_status',1)
        ->where(function($q){
            $q->where('payment_status', true)
              ->orWhere('cash_on_delivery', true);
            })
        ->get();
        $pageTitle="Confirmed Order";
        return view('delivery_boy.show_order_list',compact('orders','setting','pageTitle'));
    }




    public function pickupdOrder()
    {
        $setting = Setting::first();
        $orders=Order::with(['user','orderProducts'])
        ->where('delivery_boy_id',Auth::guard('deliveryman')->id())
        ->where('order_status',2)
        ->where(function($q){
            $q->where('payment_status', true)
              ->orWhere('cash_on_delivery', true);
            })
        ->get();
        $pageTitle="Pick Up Order";
        return view('delivery_boy.show_order_list',compact('orders','setting','pageTitle'));
    }


    public function onTheWayOrder()
    {
        $setting = Setting::first();
        $orders=Order::with(['user','orderProducts'])
        ->where('delivery_boy_id',Auth::guard('deliveryman')->id())
        ->where('order_status',3)
        ->where(function($q){
            $q->where('payment_status', true)
              ->orWhere('cash_on_delivery', true);
            })
        ->get();
        $pageTitle="On The Way Order";
        return view('delivery_boy.show_order_list',compact('orders','setting','pageTitle'));
    }


    public function deliveredOrder()
    {
        $setting = Setting::first();
        $orders=Order::with(['user','orderProducts'])
        ->where('delivery_boy_id',Auth::guard('deliveryman')->id())
        ->where('order_status',4)
        ->where(function($q){
            $q->where('payment_status', true)
              ->orWhere('cash_on_delivery', true);
            })
        ->get();
        $pageTitle="Delivered Order";
        return view('delivery_boy.show_order_list',compact('orders','setting','pageTitle'));
    }


    public function cancelOrder()
    {
        $setting = Setting::first();
        $orders=Order::with(['user','orderProducts'])
        ->where('delivery_boy_id',Auth::guard('deliveryman')->id())
        ->where('order_status',5)
        ->where(function($q){
            $q->where('payment_status', true)
              ->orWhere('cash_on_delivery', true);
            })
        ->get();
        $pageTitle="Delivered Order";
        return view('delivery_boy.show_order_list',compact('orders','setting','pageTitle'));
    }

    public function cashOnDelivery()
    {
        $setting = Setting::first();
        $orders=Order::with(['user','orderProducts'])
        ->where('delivery_boy_id',Auth::guard('deliveryman')->id())
        ->where('cash_on_delivery',true)->get();

        $sum=Order::where('delivery_boy_id',Auth::guard('deliveryman')->id())
        ->where('cash_on_delivery',true)
        ->where('order_status',4)
        ->sum('amount_real_currency');


        $pageTitle="Cash On Delivery";
        return view('delivery_boy.cash_on_delivery',compact('orders','setting','pageTitle','sum'));
    }


    public function view($id)
    {
        $setting = Setting::first();
        $order=Order::with('orderProducts','user')->find($id);
        return view('delivery_boy.view',compact('order','setting'));
    }

    public function updateOrderStatus(Request $request,$id)
    {

        $rules = [
            'order_status' => 'required',
        ];
        $this->validate($request, $rules);
        $order = Order::find($id);
        $auth_id = Auth::guard('deliveryman')->id();

        if($order->order_status != $request->order_status){
            DB::table('order_delivery_log')->insert([
                'order_id' => $id,
                'delivery_man_id' => $auth_id,
                'order_status' => $request->order_status,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $auth_id,
            ]);
        }

        if($request->order_status == 1){
            $order->order_status = 1;
            $order->order_picked_date = date('Y-m-d H:i:s');
            $order->save();
        }else if($request->order_status == 2){
            $order->order_status = 2;
            $order->order_picked_date = date('Y-m-d H:i:s');
            $order->save();
        }else if($request->order_status == 3){
            $order->order_status = 3;
            $order->save();
        }else if($request->order_status == 4){
            $order->order_status = 4;
            $order->order_completed_date = date('Y-m-d');
            $order->save();
        }else if($request->order_status == 5){
            $order->order_status = 5;
            $order->order_declined_date = date('Y-m-d');
            $order->save();
        }

        $notification = trans('admin_validation.Order Status Updated successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }



    public function codView($id)
    {
        $setting = Setting::first();
        $order=Order::with('orderProducts','user')->find($id);
        return view('delivery_boy.cod_order_view',compact('order','setting'));
    }

    public function codUpdateOrderStatus(Request $request,$id)
    {
        $rules = [
            'order_status' => 'required',
            'payment_status' => 'required',

        ];
        $this->validate($request, $rules);
        $order = Order::find($id);
        if($request->order_status == 3){
            $order->order_status = 3;
            $order->order_completed_date = date('Y-m-d');
            $order->save();
        }else if($request->order_status == 4){
            $order->order_status = 4;
            $order->order_declined_date = date('Y-m-d');
            $order->save();
        }else if($request->order_status == 5){
            $order->order_status = 5;
            $order->order_declined_date = date('Y-m-d');
            $order->save();
        }

        if($request->payment_status == 0){
            $order->payment_status = 0;
            $order->save();
        }elseif($request->payment_status == 1){
            $order->payment_status = 1;
            $order->payment_approval_date = date('Y-m-d');
            $order->save();
        }

        $notification = trans('admin_validation.Order Status Updated successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
