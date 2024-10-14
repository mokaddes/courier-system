<?php

namespace App\Http\Controllers\DeliveryMan\Api;

use App\Models\Order;
use App\Models\PickupRequest;
use App\Models\Setting;
use App\Models\OrderProduct;
use App\Traits\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public $respond;

    function __construct()
    {
        $this->respond = new ResponseController();
    }

    public function allOrder(Request $request)
    {

        $orders = PickupRequest::join('cities', 'pickup_requests.delivery_city', '=', 'cities.id')
            ->join('regions', 'cities.region_id', '=', 'regions.id')
            ->where('pickup_requests.deliveryman_id', request()->user()->id)
            ->select(
                'pickup_requests.traking_number as BOOKING_NO',
                'pickup_requests.id as F_BOOKING_NO',
                'pickup_requests.cod_amount as PAYMENT_AMOUNT',
                'pickup_requests.quantity as TOTAL_ITEM_QTY',
                'pickup_requests.status as BOOKING_STATUS',
//            'pickup_requests.order_completed_date as BOOKING_TIME',
                'pickup_requests.delivery_name as DELIVERY_NAME',
                'pickup_requests.delivery_mobile as DELIVERY_MOBILE',
                'cities.name as DELIVERY_CITY',
                'pickup_requests.delivery_zip as DELIVERY_POSTCODE',
                'regions.name as DELIVERY_STATE',
                'pickup_requests.delivery_address as DELIVERY_ADDRESS_LINE_1',
                'pickup_requests.payment_status as PAYMENT_STATUS',
//            'pickup_requests.payment_method as PAYMENT_METHOD',
                'pickup_requests.description as DESCRIPTION',
//            'pickup_requests.delivery_boy_assign_time as DELIVERY_DATE',
            )
            ->paginate(5);


        $discription = "The order filter by BOOKING_STATUS and the status are 0=Pending, 1=Active/Assigned, 2=Picked By Delivery Man, 3=Delivered,5=Returned";
        return $this->respond->sendResponse(200, "All Order", $orders, 1, $discription);
    }

    public function pendingOrder()
    {
        $setting = Setting::first();
        $orders = PickupRequest::where('deliveryman_id', request()->user()->id)
            ->where('status', 0)
            ->where('payment_status', true)->get();
        return $this->respond->sendResponse(200, "All Order", $orders, 1, "All Orders For This Delivery Man");


    }


    public function confirmedOrder()
    {
        $setting = Setting::first();
        $orders = PickupRequest::where('deliveryman_id', request()->user()->id)
            ->where('status', 1)->get();
        return $this->respond->sendResponse(200, "All active Order", $orders, 1, "All assigned Orders For This Delivery Man");
    }


    public function pickupdOrder()
    {
        $setting = Setting::first();
        $orders = PickupRequest::where('deliveryman_id', request()->user()->id)
            ->where('status', 2)->get();
        return $this->respond->sendResponse(200, "All picked up Order", $orders, 1, "All picked up Orders For This Delivery Man");

    }


    public function onTheWayOrder()
    {
        $setting = Setting::first();
        $orders = PickupRequest::with(['user', 'orderProducts'])
            ->where('delivery_boy_id', request()->user()->id)
            ->where('order_status', 3)
            ->where('payment_status', true)->get();
    }


    public function deliveredOrder()
    {
        $setting = Setting::first();
        $orders = PickupRequest::where('deliveryman_id', request()->user()->id)
            ->where('status', 3)->get();
        return $this->respond->sendResponse(200, "All delivered Order", $orders, 1, "All delivered Orders For This Delivery Man");

    }


    public function cancelOrder()
    {
        $setting = Setting::first();
        $orders = PickupRequest::where('deliveryman_id', request()->user()->id)
            ->where('status', 5)->get();
        return $this->respond->sendResponse(200, "All returns Order", $orders, 1, "All returns Orders For This Delivery Man");


    }

    public function cashOnDelivery()
    {

        $orders = PickupRequest::with(['user', 'orderProducts'])
            ->where('delivery_boy_id', request()->user()->id)
            ->where('cash_on_delivery', true)->get();
        return $this->respond->sendResponse(200, "All Order", $orders, 1, "All Orders For This Delivery Man");
    }


    public function view(Request $request)
    {

        $rules = [
            'order_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->respond->sendResponse(200, "Required", $validator->messages(), 0,);
        }

        $setting = Setting::first();

        $order = PickupRequest::join('cities', 'pickup_requests.delivery_city', '=', 'cities.id')
            ->join('regions', 'cities.region_id', '=', 'regions.id')
            ->join('cities as pickup_cities', 'pickup_requests.pickup_city', '=', 'cities.id')
            ->join('regions as pickup_regions', 'cities.region_id', '=', 'regions.id')
            ->where('pickup_requests.deliveryman_id', request()->user()->id)
            ->select(
                'pickup_requests.id',
//                'orders.order_id as BOOKING_NO',
//                'orders.id as F_BOOKING_NO',
//                'orders.amount_real_currency as PAYMENT_AMOUNT',
//                'orders.shipping_cost as POSTAGE_COST',
//                'orders.amount_real_currency as TOTAL_PRICE',
//                'orders.sub_total as SUB_TOTAL',
//                'orders.product_qty as TOTAL_ITEM_QTY',
//                'orders.order_status as BOOKING_STATUS',
//                'orders.cash_on_delivery as CASH_ON_DELIVERY',
//                'orders.order_completed_date as BOOKING_TIME',
//                'order_addresses.shipping_name as DELIVERY_NAME',
//                'order_addresses.shipping_phone as DELIVERY_MOBILE',
//                'order_addresses.shipping_city as DELIVERY_CITY',
//                'order_addresses.shipping_zip_code as DELIVERY_POSTCODE',
//                'order_addresses.shipping_state as DELIVERY_STATE',
//                'order_addresses.shipping_address as DELIVERY_ADDRESS_LINE_1',
//                'orders.payment_status as PAYMENT_STATUS',
//                'orders.payment_method as PAYMENT_METHOD',
//                'orders.delivery_boy_assign_time as DELIVERY_DATE',
                'pickup_requests.traking_number as BOOKING_NO',
                'pickup_requests.id as F_BOOKING_NO',
                'pickup_requests.cod_amount as PAYMENT_AMOUNT',
                'pickup_requests.quantity as TOTAL_ITEM_QTY',
                'pickup_requests.product_name as ITEM_NAME',
                'pickup_requests.weight as WEIGHT',
                'pickup_requests.unit_amount as UNIT_AMOUNT',
                'pickup_requests.amount as AMOUNT',
                'pickup_requests.status as BOOKING_STATUS',
//            'pickup_requests.order_completed_date as BOOKING_TIME',
                'pickup_requests.pickup_name as PICKUP_NAME',
                'pickup_requests.pickup_mobile as PICKUP_MOBILE',
                'pickup_cities.name as PICKUP_CITY',
                'pickup_requests.pickup_zip as PICKUP_POSTCODE',
                'pickup_regions.name as PICKUP_STATE',
                'pickup_requests.pickup_address as PICKUP_ADDRESS_LINE_1',
                'pickup_requests.delivery_name as DELIVERY_NAME',
                'pickup_requests.delivery_mobile as DELIVERY_MOBILE',
                'cities.name as DELIVERY_CITY',
                'pickup_requests.delivery_zip as DELIVERY_POSTCODE',
                'regions.name as DELIVERY_STATE',
                'pickup_requests.delivery_address as DELIVERY_ADDRESS_LINE_1',
                'pickup_requests.payment_status as PAYMENT_STATUS',
//            'pickup_requests.payment_method as PAYMENT_METHOD',
                'pickup_requests.description as DESCRIPTION',
//            'pickup_requests.delivery_boy_assign_time as DELIVERY_DATE',
            )
            ->first();

//        $order_products = OrderProduct::leftJoin('products', 'product_id', 'products.id')
//            ->leftJoin('order_product_variants', 'order_products.id', 'order_product_variants.order_product_id')
//            ->leftJoin('vendors', 'vendors.id', 'order_products.seller_id')
//            ->select(
//                'products.slug as URL_SLUG',
//                'order_products.product_name as VARIANT_NAME',
//                'order_products.unit_price as LINE_PRICE',
//                'order_products.qty as LINE_QTY',
//                'products.thumb_image as THUMB_PATH',
//                'order_product_variants.variant_value as VARIANT_VALUE',
//                'order_products.order_id as F_BOOKING_NO',
//                'products.id as F_BOOKING_DETAILS_NO',
//                'vendors.latitude as SHOP_LATITUDE ',
//                'vendors.longitude as SHOP_LONGITUDE',
//            )
//            ->where('order_products.order_id', $request->order_id)->get();
//
//        $shiping_address = PickupRequest::where('delivery_boy_id', $request->user()->id)
//            ->where('orders.id', $request->order_id)->leftJoin('shipping_addresses', 'shipping_addresses.user_id', 'orders.user_id')->select(['latitude', 'longitude'])->first();
//
        $data['order'] = $order;
//        $data['order_products'] = $order_products;
        $data['user'] = $request->user()->id;
        $data['order_id'] = $request->order_id;
//        $data['shiping_address'] = $shiping_address;
        $data['admin'] = $setting;


        return $this->respond->sendResponse(200, "Order View with Product", $data, 1, '');


    }

    public function updateOrderStatus(Request $request)
    {

        $rules = [
            'pickup_request_id' => 'required|integer',
            'status' => 'required|integer',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->respond->sendResponse(200, "Required", $validator->messages(), 0,);
        }

        try {
            $order = PickupRequest::find($request->pickup_request_id);
            $status = $request->get('status');
            $order->status = $status;
            if ($status == 0) {
                $order->deliveryman_id = null;
            }
            $order->save();

        } catch (\Throwable $th) {
            return $this->respond->sendResponse(false, 'Unable to update status', [], 0, $th);
        }
        $notification = trans('Pickup request Status Updated successfully');


        return $this->respond->sendResponse(200, $notification, $order, 1, "");


    }
}
