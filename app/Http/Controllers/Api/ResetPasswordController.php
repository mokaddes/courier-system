<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DeliveryMan\Api\ResponseController;
use App\Mail\ResetPasswordMail;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), ['email' => 'required']);

        if ($validator->fails()) {
            return ResponseController::sendError('Validation Error', $validator->errors()->first());
        }

        $admin = Admin::where('email', '=', $request->email)->first();
        $otp = null;
        if (isset($admin)) {
            $otp = rand(1000, 9999);
            $admin->password_otp = $otp;
            $admin->save();
            Mail::to($admin->email)->send(new ResetPasswordMail($admin, $otp));
            return ResponseController::sendResponse(200, 'Otp send', ['otp'=>$otp], true);
        } else {
            return ResponseController::sendError('Invalid Email', "Email Not Found");

        }
    }

    public function otpVerify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'otp' => 'required',
        ]);


        if ($validator->fails()) {
            return ResponseController::sendError('Validation Error', $validator->errors()->first());
        }

        $admin = Admin::where('email', '=', $request->email)->first();
        if ($admin->password_otp == $request->otp) {
            $admin->password_otp=null;
            $admin->save();
            return ResponseController::sendResponse(200, 'Otp verified');
        } else {
            return ResponseController::sendError('Invalid Otp', "Invalid Otp");
        }
        
    }

    public function resetPassword(Request $request)
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
            $userData = Admin::where('email',$request->email)->first();
            $userData->password = Hash::make($request->password);
            $userData->save();

        } catch (Exception $th) {
            return ResponseController::sendResponse(false, 'Unable to update password', $th);
        }
        return ResponseController::sendResponse(true, 'password successfully updated', $userData);
        
    }
    
}
