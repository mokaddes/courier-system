<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('frontend.profile.index');
    }

    public function setting(){
        return view('frontend.profile.setting');
    }

    public function profileUpdate(Request $request)
    {

        $user = Auth::user();
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if($request->hasFile('image')){

            if(File::exists('frontend/images/profile/'.$user->image)){

                File::delete('frontend/images/profile/'.$user->image);
              }

            $image = $request->file('image');
            $img  = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('frontend/images/profile/'.$img);
            Image::make($image)->save($location);
            $user->image  = $img;
        }

        $user->save();
        Toastr::success('Profile Updated Successfully!.');
        return redirect()->back()->with('message', 'Profile Updated Successfully!');
    }

    public function passwordChange(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = User::where('id', auth('user')->user()->id)->first();

        if (Hash::check($request->old_password, $user->password)) {

            User::where('id', $user->id)->update([
                'password' => Hash::make($request->password),
            ]);

            Toastr::success('Your password is changed successfully!.');
        return redirect()->back()->with('message', 'Your password is changed successfully!');
        } else {
            Toastr::error('Old password not match!.');
        return redirect()->back()->with('Error', 'Old password not match!');
        }
    }
}
