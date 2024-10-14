<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Exception;
use App\Models\Seo;
use App\Models\Admin;
use App\Models\Region;
use App\Models\Setting;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\MerchantRequestNotify;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class MerchantController extends Controller
{
    public function register()
    {
        $regions = Region::all();
        $seo = Seo::where('page_slug', 'merchant-register')->first();
        $meta_title = $seo->title;
        $meta_description = $seo->description;
        $meta_image = $seo->image;
        $page_content=PageContent::first();
        
        return view('merchant.auth.singup', compact('regions','meta_title','meta_description','meta_image','page_content'));
    }

    public function registerStore(Request $request)
    {


        $request->validate([
            "business_name" => 'required',
            "business_owner_name" => 'required',
            "business_owner_phone" => 'required|unique:admins,business_owner_phone',
            "business_email" => 'required|unique:admins,business_email',
            "business_email" => 'required|unique:admins,email',
            "address_line" => 'required',
            "street_address" => 'required',
            "city" => 'required',
            "state" => 'required',
            "zip_code" => 'required',
            "bank_name" => 'required',
            "bank_branch_name" => 'required',
            "account_type" => 'required',
            "account_holder_name" => 'required',
            "account_number" => 'required',
            "id_type" => 'required',
            "id_number" => 'required',
            "agree" => 'required',
            "id_font_image" => 'required',
            "id_back_image" => 'required',
            "profile_image" => 'required'
        ],[
            'business_email.unique' => 'The Business Email is unique',
        ]
    );

        try {

            DB::beginTransaction();


            if ($request->hasFile('id_font_image')) {
                $idFontImagePath = uploadImage($request->id_font_image[0], 'merchant/id_card');
            }
            if ($request->hasFile('id_back_image')) {
                $idBackImagePath = uploadImage($request->id_back_image[0], 'merchant/id_card');
            }
            if ($request->hasFile('profile_image')) {
                $profileImagePath = uploadImage($request->profile_image[0], 'merchant/prfile_pic');
            }

            $merchant = new Admin();
            
            $merchant->name     = $request->business_name;
            $merchant->email    = $request->business_email;
            $merchant->password = Hash::make(12345678);

            $merchant->business_name = $request->business_name;
            $merchant->business_owner_name = $request->business_owner_name;
            $merchant->business_owner_phone = $request->business_owner_phone;
            $merchant->business_email = $request->business_email;
            $merchant->address_line = $request->address_line;
            $merchant->street_address = $request->street_address;
            $merchant->city = $request->city;
            $merchant->state = $request->state;
            $merchant->zip_code = $request->zip_code;
            $merchant->bank_name = $request->bank_name;
            $merchant->bank_branch_name = $request->bank_branch_name;
            $merchant->account_type = $request->account_type;
            $merchant->account_holder_name = $request->account_holder_name;
            $merchant->account_number = $request->account_number;
            $merchant->id_type = $request->id_type;
            $merchant->id_number = $request->id_number;
            $merchant->agree = $request->agree == "on" ? true : false;
            $merchant->id_font_image = $idFontImagePath ?? "";
            $merchant->id_back_image = $idBackImagePath ?? "";
            $merchant->profile_pic = $profileImagePath ?? "";
            $merchant->status = 2;
            $merchant->is_merchant = true;
            

            $merchant->save();


            DB::commit();
            $mail = Setting::first()->support_email;

             Mail::to($mail)->send(new MerchantRequestNotify($merchant));
        } catch (Exception $th) {
            DB::rollBack();
            Toastr::error($th->getMessage());
            Toastr::error('Something Wrong');
            return redirect()->back()->withInput();
        }
        Toastr::success('Your request has been submitted Successfully, Please wait for the conformation mail');
        return redirect()->route('merchant.register.success');
    }

    public function registerSuccess()
    {
        return view('merchant.auth.success');
    }
}
