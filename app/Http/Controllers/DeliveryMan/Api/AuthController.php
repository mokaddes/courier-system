<?php

namespace App\Http\Controllers\DeliveryMan\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\DeliveryMan\Api\ResponseController;
use App\Models\Admin;

class AuthController extends Controller
{

    public $respond;

    function __construct()
    {
        $this->respond = new ResponseController();
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respond->sendResponse(200, "Required", $validator->errors()->first(), 0, "");
        }

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Admin::find(Auth::guard('admin')->id());
            if ($authUser->status) {
                $data['token'] = $authUser->createToken(Auth::guard('admin')->user()->name)->plainTextToken;
                $data['user'] = $authUser;
                if (!empty($request->fcm_token)) {
                    $authUser->fcm_token = $request->fcm_token;
                    $authUser->save();
                }
                return $this->respond->sendResponse(200, "Login Successful", $data, 1,);
            } else {

                return $this->respond->sendResponse(200, "Delivery Mans Suspended", null, 0,);
            }
        } else {
            return $this->respond->sendResponse(200, "Login fail", null, 0,);
        }
    }

    public function user(Request $request)
    {
        $authUser = Auth::guard('admin')->user();
        $data['user'] = $authUser;

        if ($authUser) {
            return $this->respond->sendResponse(200, "User found successfully", $data, 1,);
        } else {
            return $this->respond->sendResponse(404, "User is not logged in", $data, 0,);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->user()->tokens()->delete();

        return $this->respond->sendResponse(200, "Logout Successful", '', 1,);
    }
}
