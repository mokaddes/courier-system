<?php

namespace App\Http\Controllers\Api\DelivaryBoy;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DeliveryMan\Api\ResponseController;
use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse|object
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $description = 'Email should be Delivery-boy email,Password should be string';
        if ($validator->fails()) {
            return ResponseController::sendError('Validation Error', $validator->errors()->first());
        }

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

            $authUser = Admin::where('id', Auth::guard('admin')->id())->where('is_deliveryman', true)->first();
            if (isset($authUser)) {
                if ($authUser->status) {
                    $data['token'] = $authUser->createToken(Auth::guard('admin')->user()->name)->plainTextToken;
                    $data['user'] = $authUser;
                    if (!empty($request->fcm_token)) {
                        $authUser->fcm_token = $request->fcm_token;
                        $authUser->save();
                    }
                    return ResponseController::sendResponse(200, "Login Successful", $data,true, $description);
                } else {
                    return ResponseController::sendError("Invalid User", "Delivery Mans Suspended", 401);
                }
            } else {
                return ResponseController::sendError("Authentication Error", "Invalid Credential", 401);
            }
        } else {
            return ResponseController::sendError("Authentication Error", "Invalid Credential",401);
        }

    }
}
