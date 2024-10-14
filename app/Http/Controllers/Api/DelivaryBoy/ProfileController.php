<?php

namespace App\Http\Controllers\Api\DelivaryBoy;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DeliveryMan\Api\ResponseController;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $id = request()->user()->id;
        $profile = Admin::find($id);


        return ResponseController::sendResponse(200, "Delivery Man Profile", $profile);
    }

    public function update(Request $request)
    {
        $deliveryMan = $request->user();

        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:admins,email,' . $deliveryMan->id,
            "address_line" => 'required',
            "street_address" => 'required',
            "city" => 'required',
            "state" => 'required',
            "zip_code" => 'required',
            "id_type" => 'required',
            "id_number" => 'required',
            "id_font_image" => 'sometimes',
            "id_back_image" => 'sometimes',
            "profile_image" => 'sometimes'
        ];
        $customMessages = [
            'name.required' => trans('Name is required'),
            'email.required' => trans('Email is required'),
            'email.unique' => trans('Email already exist'),
            'phone.required' => trans('Phone number is required'),
            'phone.unique' => trans('Phone number already exist'),
            'address_line.required' => trans('Address is required'),
            'street_address.required' => trans('Street address is required'),
            'city.required' => trans('Select a City'),
            'state.required' => trans('Select a State'),
            'zip_code.required' => trans('Postal code is required'),
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return ResponseController::sendResponse(200, "Required", $validator->errors()->first(), 0);
        }

        $admin = Admin::find($deliveryMan->id);

        try {
            if ($request->hasFile('id_font_image')) {
                $idFontImagePath = uploadImage($request->id_font_image, 'merchant/id_card');
                $admin->id_font_image = $idFontImagePath;
            }
            if ($request->hasFile('id_back_image')) {
                $idBackImagePath = uploadImage($request->id_back_image, 'merchant/id_card');
                $admin->id_back_image = $idBackImagePath;
            }
            if ($request->hasFile('profile_image')) {
                $profileImagePath = uploadImage($request->profile_image, 'merchant/prfile_pic');
                $admin->profile_pic = $profileImagePath;
                $admin->image = $profileImagePath;
            }
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->address_line = $request->address_line;
            $admin->street_address = $request->street_address;
            $admin->city = $request->city;
            $admin->state = $request->state;
            $admin->zip_code = $request->zip_code;
            $admin->id_type = $request->id_type;
            $admin->id_number = $request->id_number;
            $admin->agree = true;

            $admin->save();
        } catch (Exception $e) {
            return ResponseController::sendResponse(200, "Error", $e);
        }


        return ResponseController::sendResponse(200, "Success", $admin);
    }

    public function passwordUpdate(Request $request)
    {
        $rules = [
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ];
        $customMessages = [
            'password.required' => trans('Password is required'),
            'confirm_password.required' => trans('Password confirmation is required'),
            'confirm_password.same' => trans('Password confirmation must be same to password.'),
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return ResponseController::sendError('Validation Error', $validator->errors()->first(), 200, 0);
        }
        try {
            $userData = $request->user();
            $userData->password = Hash::make($request->password);
            $userData->save();

        } catch (Exception $th) {
            return ResponseController::sendResponse(false, 'Unable to update password', $th);
        }
        return ResponseController::sendResponse(true, 'password successfully updated', $userData);
    }




    public function accountDelete(Request $request)
    {
        $validate=Validator::make($request->all(),['confirm'=>'required']);

        if ($validate->fails()){
            return ResponseController::sendError('Validation',$validate->errors()->first(),200,0);
        }

        if ($request->confirm !== "confirm"){
            return ResponseController::sendResponse(200,'Validation',"Please type 'confirm'  to delete your account");

        }


        $deliveryMan = $request->user();

        $customer = Admin::find($deliveryMan->id);
        $customer->email = "deleted_" . $customer->id . $customer->email;
        $customer->save();
        return ResponseController::sendResponse(true, 'Account Delete successfully');


    }
}
