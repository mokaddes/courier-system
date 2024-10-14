<?php

namespace App\Http\Controllers\DeliveryMan;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMans;
use App\Models\Setting;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DeliveryManAuth extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::DELIVERYMAN;

    public function __construct()
    {
        $this->middleware('guest:deliveryman')->except('deliveryManLogout');
    }

        public function deliveryManLoginPage()
        {
            $setting = Setting::first();
            return view('delivery_boy.auth.login',compact('setting'));
        }


        public function deliveryManLogin(Request $request)
        {
            $rules = [
                'email'=>'required|email',
                'password'=>'required',
            ];

            $customMessages = [
                'email.required' => trans('admin_validation.Email is required'),
                'password.required' => trans('admin_validation.Password is required'),
            ];
            $this->validate($request, $rules,$customMessages);

            $credential=[
                'email'=> $request->email,
                'password'=> $request->password
            ];

            $isAdmin=DeliveryMans::where('email',$request->email)->first();
            if($isAdmin){
                if($isAdmin->status==1){
                    if(Hash::check($request->password,$isAdmin->password)){
                        if(Auth::guard('deliveryman')->attempt($credential,$request->remember)){
                            $notification= trans('admin_validation.Login Successfully');
                            return response()->json(['success'=>$notification]);
                        }
                    }else{
                        $notification= trans('admin_validation.Invalid Password');
                        return response()->json(['error'=>$notification]);
                    }
                }else{
                    $notification= trans('admin_validation.Inactive account');
                    return response()->json(['error'=>$notification]);
                }
            }else{
                $notification= trans('admin_validation.Invalid Email');
                return response()->json(['error'=>$notification]);
            }
        }

        public function deliveryManLogout()
        {
            Auth::guard('deliveryman')->logout();
            $notification= trans('admin_validation.Logout Successfully');
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('delivery-man.login')->with($notification);
        }


}
