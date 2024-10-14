<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Admin;
use App\Models\Region;
use App\Models\Contact;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\PickupRequest;
use App\Models\RechargRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    //

    public $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function dashboard()
    {
        $data['title'] = 'Dashboard';

        $merchantQuary = Admin::where('is_merchant', true);

        $data['activemerchant'] = $merchantQuary->where('status', 1)->count();
        $data['inactivemerchant'] = $merchantQuary->where('status', 0)->count();
        $data['requestmerchant'] = $merchantQuary->where('status', 2)->count();
        $data['pendingPickupmerchant'] = PickupRequest::where('status', 0)->whereNotNull('merchant_id')->count();
        $data['pendingPickupGuest'] = PickupRequest::where('status', 0)->whereNull('merchant_id')->count();
        $data['totalPickup'] = PickupRequest::get()->count();
        $data['total_merchant']  =    Admin::where('is_merchant', 1)->get()->count();
        $data['pending_recharge_request']  = RechargRequest::where('status', 0)->count();
        $data['total_deliveryman'] = Admin::where('is_deliveryman', 1)->count();
        $data['total_merchantPickup_request'] = PickupRequest::where('merchant_id', Auth::user()->id)->get()->count();
        $data['total_deliverymanpickup_request'] = PickupRequest::where('deliveryman_id', Auth::user()->id)->get()->count();
        $data['total_current_ballance'] = Admin::where('id', Auth::user()->id)->first();
        
        return view('admin.dashboard', compact('data'));

    }

    public function cacheClear()
    {
        Artisan::call('route:clear');
        Artisan::call('optimize');
        Artisan::call('optimize:clear');
        // Artisan::call('view:clear');
        // Artisan::call('view:cache');
        Artisan::call('config:clear');
        Artisan::call('storage:link');
        Artisan::call('config:cache');
        Artisan::call('cache:forget spatie.permission.cache ');

        Toastr::success('Cache clear successfully done', 'Success');
        return 'DONE';
    }

    public function adminProfile()
    {
        $regions = Region::all();
        $admin = Admin::find(Auth::id());
        return view('admin.profile.index', compact('regions', 'admin'));
    }


    public function adminProfileUpdate(Request $request, $id)
    {



        $admin = Admin::find($id);
        if ($admin->is_merchant || $admin->is_deliveryman == 1) {

            if ($admin->is_merchant) {
                $request->validate([
                    'name' => 'required|max:100',
                    'email' => 'required|email|unique:admins,email,' . $id,
                    "business_name" => 'required',
                    "business_owner_name" => 'required',
                    "business_owner_phone" => 'required|unique:admins,business_owner_phone,' . $id,
                    "business_email" => 'required|unique:admins,business_email,' . $id,
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
                    "id_font_image" => 'sometimes',
                    "id_back_image" => 'sometimes',
                    "profile_image" => 'sometimes'
                ]);
            } else {
                $request->validate([
                    'name' => 'required|max:100',
                    'email' => 'required|email|unique:admins,email,' . $id,
                    "business_owner_phone" => 'required|unique:admins,business_owner_phone,' . $id,
                    "address_line" => 'required',
                    "street_address" => 'required',
                    "city" => 'required',
                    "state" => 'required',
                    "zip_code" => 'required',
                    "bank_name" => 'nullable',
                    "bank_branch_name" => 'nullable',
                    "account_type" => 'nullable',
                    "account_holder_name" => 'nullable',
                    "account_number" => 'nullable',
                    "id_type" => 'required',
                    "id_number" => 'required',
                    "id_font_image" => 'sometimes',
                    "id_back_image" => 'sometimes',
                    "profile_image" => 'sometimes'
                ]);
            }

            DB::beginTransaction();
            try {
                $idFontImagePath = $admin->id_font_image;
                $idBackImagePath = $admin->id_back_image;
                $profileImagePath = $admin->profile_pic;


                if ($request->hasFile('id_font_image')) {
                    $idFontImagePath = uploadImage($request->id_font_image[0], 'merchant/id_card');
                }
                if ($request->hasFile('id_back_image')) {
                    $idBackImagePath = uploadImage($request->id_back_image[0], 'merchant/id_card');
                }
                if ($request->hasFile('profile_image')) {
                    $profileImagePath = uploadImage($request->profile_image[0], 'merchant/prfile_pic');
                }

                $admin->name                    = $request->name;
                $admin->email                   = $request->email;
                $admin->image                   = $profileImagePath;
                $admin->business_name           = $request->business_name;
                $admin->business_owner_name     = $request->business_owner_name;
                $admin->business_owner_phone    = $request->business_owner_phone;
                $admin->business_email          = $request->business_email;
                $admin->address_line            = $request->address_line;
                $admin->street_address          = $request->street_address;
                $admin->city                    = $request->city;
                $admin->state                   = $request->state;
                $admin->zip_code                = $request->zip_code;
                $admin->bank_name               = $request->bank_name;
                $admin->bank_branch_name        = $request->bank_branch_name;
                $admin->account_type            = $request->account_type;
                $admin->account_holder_name     = $request->account_holder_name;
                $admin->account_number          = $request->account_number;
                $admin->id_type                 = $request->id_type;
                $admin->id_number               = $request->id_number;
                $admin->agree                   = true;
                if ($request->hasFile('id_font_image')) {
                    $admin->id_font_image           = $idFontImagePath;
                }
                if ($request->hasFile('id_back_image')) {
                    $admin->id_back_image           = $idBackImagePath;
                }
                if ($request->hasFile('profile_image')) {
                    $admin->profile_pic             = $profileImagePath;
                }

                $admin->save();
            } catch (\Exception $e) {
                dd($e);
                DB::rollback();
                Toastr::error(trans('Profile not Updated !'), 'Error', ["positionClass" => "toast-top-center"]);
                return redirect()->back();
            }
            DB::commit();
            Toastr::success(trans('Profile Updated Successfully !'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->back();
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|unique:admins,email,' . $id,
            ]);
            $update_admin = $this->admin->adminUpdate($request, $id);


            if (!$update_admin->status) {

                Toastr::info(trans($update_admin->msg));
                return redirect()->route($update_admin->redirect_to);
            }

            Toastr::success(trans($update_admin->msg));
            return redirect()->route($update_admin->redirect_to);
        }
    }


    public function adminPasswordUpdate(Request $request, $id)
    {

        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $admin_password = $this->admin->adminPasswordUpdate($request, $id);
        if (!$admin_password->status) {

            Toastr::info(trans($admin_password->msg));
            return redirect()->back();
        }

        Toastr::success(trans($admin_password->msg));
        return redirect()->back();
    }
}
