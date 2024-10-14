<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DeliveryMan\Api\ResponseController;
use App\Models\Admin;
use App\Models\ApiKey;
use App\Models\City;
use App\Models\DemoPickupRequest;
use App\Models\PickupRequest;
use App\Models\Pricing;
use App\Models\PricingGroup;
use App\Models\Region;
use App\Models\Weight;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PHPUnit\Exception;

class PickupRequestController extends Controller
{
    /**
     * @var ResponseController
     */
    public $respond;

    public function __construct()
    {
        $this->respond = new ResponseController();
    }

    public function serviceCities()
    {
        return City::pluck('name')->toArray();

    }

//    public function index(Request $request)
//    {
//        return view('admin.pickup-request.api.index');
//
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rules = [
            'merchant_id' => 'required',
            'public_key' => 'required',
            'secret_key' => 'required',
        ];
        $customMessages = [
            'merchant_id.required' => trans('Merchant ID is required'),
            'public_key.required' => trans('Public key is required'),
            'secret_key.required' => trans('Secret key is required'),
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return $this->respond->apiResponse(0, "Validation Error", $validator->errors()->first());
        }

        $merchant_id = $request->get('merchant_id');
        $public_key = $request->get('public_key');
        $api_key = ApiKey::where('merchant_id', $merchant_id)->where('public_key', $public_key)->where('public_key', $public_key)->first();
        if (!$api_key) {
            return $this->respond->apiResponse(0, "Error", 'Unauthorized');
        }
        $data['merchant'] = $api_key->merchant->name;
        if ($api_key->mode == 'live') {
            $data['pickup_request'] = PickupRequest::where('merchant_id', $merchant_id)->join('cities as pCity', 'pCity.id', 'pickup_requests.pickup_city')->join('cities as dCity', 'dCity.id', 'pickup_requests.delivery_city')
                ->join('weights', 'weights.weight', 'pickup_requests.weight')->join('pricing_group', 'pricing_group.id', 'pickup_requests.pricing_group_id')
                ->select('pickup_requests.traking_number', 'pickup_requests.pickup_name', 'pickup_requests.pickup_contact_name', 'pickup_requests.pickup_address', 'pCity.name as pickup_city', 'pickup_requests.pickup_zip', 'pickup_requests.pickup_mobile', 'pickup_requests.delivery_name', 'pickup_requests.delivery_contact_name', 'pickup_requests.delivery_address', 'dCity.name as delivery_city', 'pickup_requests.delivery_zip', 'pickup_requests.delivery_mobile', 'pickup_requests.product_name', 'pickup_requests.quantity', 'weights.weight as weight', 'pricing_group.name as delivery_method', 'pickup_requests.cod_amount', 'pickup_requests.unit_amount as unit_delivery_cost', 'pickup_requests.amount as total_delivery_cost', 'pickup_requests.payment_status', 'pickup_requests.description', 'pickup_requests.status')->get();

            return $this->respond->apiResponse(1, "Success", 'All pickup request', $data, 'live');
        } else {
            return $this->respond->apiResponse(1, "Success", 'You are in demo mode', [], 'demo');
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $api_key = ApiKey::find($id);
        if (!$api_key) {
            return $this->respond->apiResponse(0, "Error", 'Merchant not found');
        }
        $states = Region::all();
        $cities = City::orderBy('name', 'asc')->get();
        $weights = Weight::orderBy('order_id', 'asc')->get();
        $pricing_groups = PricingGroup::orderBy('order_id', 'asc')->get();


        return view('admin.pickup-request.api.create', compact('states', 'cities', 'api_key', 'weights', 'pricing_groups'))->render();

        return response()->json(['html' => $html]);

        return $this->respond->apiResponse(1, "Success", 'Merchant found', $request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
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
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->respond->apiResponse(0, "Validation Error", $validator->errors());
        }
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

            $key = ApiKey::find($request->api_key_id);
            if ($key->mode == 'live') {
                $data = new PickupRequest();
            } else {
                $data = new DemoPickupRequest();
            }
            $data->traking_number = randomString(8);
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
            $data->merchant_id = $key->merchant_id;
            $data->description = $request->description;
            $data->save();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput();
        }
        return redirect($request->redirect_url);
    }

    public function submit(Request $request)
    {
//        return $request->all();

        $max_weight = Weight::max('weight');
        $rules = [
            'api_keys.merchant_id' => ['required', 'int'],
            'api_keys.public_key' => ['required', 'string'],
            'api_keys.secret_key' => ['required', 'string'],

            'pickup_info.pickup_name' => ['required', 'string'],
            'pickup_info.pickup_contact_name' => ['required', 'string'],
            'pickup_info.pickup_address' => ['required', 'string'],
            'pickup_info.pickup_street_address' => ['required', 'string'],
            'pickup_info.pickup_mobile' => ['required', 'string'],
            'pickup_info.pickup_city' => ['required', 'string'],

            'delivery_info.delivery_name' => ['required', 'string'],
            'delivery_info.delivery_contact_name' => ['required', 'string'],
            'delivery_info.delivery_address' => ['required', 'string'],
            'delivery_info.delivery_mobile' => ['required', 'string'],
            'delivery_info.delivery_city' => ['required', 'string'],

            'product_info.product_name' => ['required', 'string'],
            'product_info.quantity' => ['required', 'int'],
            'product_info.weight' => ['required', 'int', 'max:' . $max_weight],
            'product_info.cod_amount' => ['nullable'],
            'product_info.delivery_method' => ['required'],
            'product_info.description' => ['required', 'string'],
        ];
        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return $this->respond->apiResponse(0, "ValidationError", $validator->errors()->first());
        }


        // Retrieve the request data
        $trackingNumber = randomString(8);;
        $apiKeys = $request->input('api_keys');
        $pickupInfo = $request->input('pickup_info');
        $deliveryInfo = $request->input('delivery_info');
        $productInfo = $request->input('product_info');

        $merchant_id = $apiKeys['merchant_id'];
        $public_key = $apiKeys['public_key'];
        $secret_key = $apiKeys['secret_key'];
        $redirect_url = $apiKeys['redirect_url'];
        $api_key = ApiKey::where('merchant_id', $merchant_id)
            ->where('public_key', $public_key)
            ->where('secret_key', $secret_key)->first();

        if (!$api_key) {
            return $this->respond->apiResponse(0, "Error", 'Unauthorized');
        }

        $pickup_city = City::where('name', $pickupInfo['pickup_city'])->first();
        if (!$pickup_city) {
            return $this->respond->apiResponse(0, "Error", 'Pickup city is out of service cities', [], $api_key->mode);
        }
        $delivery_city = City::where('name', $deliveryInfo['delivery_city'])->first();
        if (!$delivery_city) {
            return $this->respond->apiResponse(0, "Error", 'Delivery city is out of service cities', [], $api_key->mode);
        }
        $delivery_method = PricingGroup::where('code', $productInfo['delivery_method'])->first();
        if (!$delivery_method) {
            return $this->respond->apiResponse(0, "Error", 'Invalid delivery method', [], $api_key->mode);
        }
        $weight = Weight::where('weight', $productInfo['weight'])->first();
        if (!$weight) {
            return $this->respond->apiResponse(0, "Error", 'Invalid weight selected', [], $api_key->mode);
        }

        try {

            $price = Pricing::where('pricing_group_id', $delivery_method->id)
                ->where('weight_id', $weight->id)->first();

            if ($pickup_city->id == $delivery_city->id) {
                $amount = $price->inside_main_city_price;
            } else {
                $amount = $price->inter_city_price;
            }
            // Create a new instance of the PickupRequest model
            $pickupRequest = new PickupRequest();

            // Set the model attributes with the request data
            $pickupRequest->traking_number = $trackingNumber;
            $pickupRequest->merchant_id = $merchant_id;

            $pickupRequest->pickup_name = $pickupInfo['pickup_name'];
            $pickupRequest->pickup_contact_name = $pickupInfo['pickup_contact_name'];
            $pickupRequest->pickup_address = $pickupInfo['pickup_address'];
            $pickupRequest->pickup_street_address = $pickupInfo['pickup_street_address'];
            $pickupRequest->pickup_city = $pickup_city->id;
            $pickupRequest->pickup_zip = $pickupInfo['pickup_zip'];
            $pickupRequest->pickup_mobile = $pickupInfo['pickup_mobile'];
            $pickupRequest->pickup_email = $pickupInfo['pickup_email'];

            $pickupRequest->delivery_name = $deliveryInfo['delivery_name'];
            $pickupRequest->delivery_contact_name = $deliveryInfo['delivery_contact_name'];
            $pickupRequest->delivery_address = $deliveryInfo['delivery_address'];
            $pickupRequest->delivery_street_address = $deliveryInfo['delivery_street_address'];
            $pickupRequest->delivery_city = $delivery_city->id;
            $pickupRequest->delivery_zip = $deliveryInfo['delivery_zip'];
            $pickupRequest->delivery_mobile = $deliveryInfo['delivery_mobile'];

            $pickupRequest->quantity = $productInfo['quantity'];
            $pickupRequest->product_name = $productInfo['product_name'];
            $pickupRequest->weight = $weight->id;
            $pickupRequest->cod_amount = $productInfo['cod_amount'];
            $pickupRequest->unit_amount = $amount;
            $pickupRequest->amount = $amount * $productInfo['quantity'];
            $pickupRequest->pricing_group_id = $delivery_method->id;
            $pickupRequest->description = $productInfo['description'];
            $pickupRequest->status = 0;

            // Save the pickup request data
            if ($api_key->mode == 'live') {
                $pickupRequest->save();
            }
        } catch (Exception $e) {
            return $this->respond->apiResponse(0, "failed", $e->getMessage(), [], $api_key->mode);
        }


        if ($api_key->mode == 'live') {
            $data['merchant'] = $api_key->merchant->name;
            $data['pickup_request'] = PickupRequest::join('cities as pCity', 'pCity.id', 'pickup_requests.pickup_city')
                ->join('cities as dCity', 'dCity.id', 'pickup_requests.delivery_city')
                ->join('weights', 'weights.weight', 'pickup_requests.weight')
                ->join('pricing_group', 'pricing_group.id', 'pickup_requests.pricing_group_id')
                ->select('pickup_requests.traking_number', 'pickup_requests.pickup_name', 'pickup_requests.pickup_contact_name', 'pickup_requests.pickup_address', 'pCity.name as pickup_city', 'pickup_requests.pickup_zip', 'pickup_requests.pickup_mobile', 'pickup_requests.delivery_name', 'pickup_requests.delivery_contact_name', 'pickup_requests.delivery_address', 'dCity.name as delivery_city', 'pickup_requests.delivery_zip', 'pickup_requests.delivery_mobile', 'pickup_requests.product_name', 'pickup_requests.quantity', 'weights.weight as weight', 'pricing_group.name as delivery_method', 'pickup_requests.cod_amount', 'pickup_requests.unit_amount as unit_delivery_cost', 'pickup_requests.amount as total_delivery_cost', 'pickup_requests.payment_status', 'pickup_requests.description', 'pickup_requests.status')
                ->where('pickup_requests.id', $pickupRequest->id)
                ->first();
            return $this->respond->apiResponse(1, "success", 'Pickup request successfully added.', $data, 'live');
        } else {
            $data['pickup_request'] = [];
            $data['merchant'] = $api_key->merchant->name;
            return $this->respond->apiResponse(1, "success", 'Pickup request successfully added in demo.', $data, 'demo');
        }


    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
