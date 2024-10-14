<?php

namespace App\Http\Controllers\DeliveryMan;

use App\Http\Controllers\Controller;
use App\Models\BannerImage;
use App\Models\City;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\DeliveryMans;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DeliveryManProfileController extends Controller
{
    public function index(){
        $deliveryMan=DeliveryMans::find(Auth::guard('deliveryman')->id());
        $defaultProfile = BannerImage::whereId('15')->first();
        $countries = Country::all();
        $states= CountryState::where('country_id',$deliveryMan->country_id)->get();
        $citys= City::where('country_state_id',$deliveryMan->state_id)->get();
        return view('delivery_boy.profile',compact('deliveryMan','defaultProfile','countries','states','citys'));
    }

    public function update(Request $request){
        $deliveryMan=Auth::guard('deliveryman')->user();
        $rules = [
            'name'=>'required',
            'email'=>'required|unique:admins,email,'.$deliveryMan->id,
            'password'=>'confirmed',
            'country'=>'required',
            'state'=>'required',
            'city'=>'required',
            'address'=>'required',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'email.required' => trans('admin_validation.Email is required'),
            'email.unique' => trans('admin_validation.Email already exist'),
            'password.confirmed' => trans('admin_validation.Confirm password does not match'),
            'country.required' => trans('admin_validation.Country is required'),
            'state.required' => trans('admin_validation.State is required'),
            'city.required' => trans('admin_validation.Select a City'),
            'address.required' => trans('admin_validation.Address is required'),
        ];
        $validator=Validator::make($request->all(),$rules,$customMessages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $deliveryMan=DeliveryMans::find(Auth::guard('deliveryman')->id());

        // inset user profile image
        if($request->file('image')){
            $old_image=$deliveryMan->image;
            $user_image=$request->image;
            $extention=$user_image->getClientOriginalExtension();
            $image_name= Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/website-images/'.$image_name;

            Image::make($user_image)
                ->save(public_path().'/'.$image_name);

            $deliveryMan->image=$image_name;
            $deliveryMan->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->password){
            $deliveryMan->password=Hash::make($request->password);
        }
        $deliveryMan->name=$request->name;
        $deliveryMan->email=$request->email;
        $deliveryMan->country_id=$request->country;
        $deliveryMan->state_id=$request->state;
        $deliveryMan->city_id=$request->city;
        $deliveryMan->address=$request->address;
        $deliveryMan->save();

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('delivery-man.profile')->with($notification);


    }
}
