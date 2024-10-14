<?php

namespace App\Http\Controllers\DeliveryMan;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CountryState;


class AddressController extends Controller
{
    public function stateByCountry($id){
        $states = CountryState::where(['status' => 1, 'country_id' => $id])->get();
        $response='<option value="">'.trans('admin_validation.Select a State').'</option>';
        if($states->count() > 0){
            foreach($states as $state){
                $response .= "<option value=".$state->id.">".$state->name."</option>";
            }
        }
        return response()->json(['states'=>$response]);
    }

    public function cityByState($id){
        $cities = City::where(['status' => 1, 'country_state_id' => $id])->get();
        $response='<option value="">'.trans('admin_validation.Select a City').'</option>';
        if($cities->count() > 0){
            foreach($cities as $city){
                $response .= "<option value=".$city->id.">".$city->name."</option>";
            }
        }
        return response()->json(['cities'=>$response]);
    }

}
