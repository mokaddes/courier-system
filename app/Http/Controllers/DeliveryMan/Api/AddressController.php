<?php

namespace App\Http\Controllers\DeliveryMan\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{

    public $respond;
    function __construct() {
        $this->respond = new ResponseController();
    }


    public function country()
    {
        $country=Country::with('state')->get();
        return $this->respond->sendResponse(200,"All Country",$country);

    }



    public function stateByCountry(Request $request){

        $rules = [
            'country_id' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return $this->respond->sendResponse(200,"Required",$validator->errors()->first(),0);
        }





        $states = Region::with('city')->where(['status' => 1, 'country_id' => $request->country_id])->select(['id','name','slug'])->get();

        return $this->respond->sendResponse(200,"All Country",$states);
    }

    public function cityByState(Request $request){


        $rules = [
            'country_state_id' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return $this->respond->sendResponse(200,"Required",$validator->errors()->first(),0);
        }

        $cities = City::where(['status' => 1, 'region_id' => $request->country_state_id])->select(['id','name','slug'])->get();

        return $this->respond->sendResponse(200,"All Country",$cities);

    }
}
