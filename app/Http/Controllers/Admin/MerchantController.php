<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Merchant;
use App\Models\PickupRequest;
use App\Models\Region;
use App\Models\Role;
use App\Models\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MerchantController extends Controller
{
    public function index()
    {
        $users = Admin::where('is_merchant', 1)->where('status', 1)->latest()->get();
        $merchantRequests = Admin::where('is_merchant', true)
            ->where('status', '=', '2')
            ->whereNull('created_by')->get();

        return view('admin.merchant.index', compact('users','merchantRequests'));
    }

    public function create(Request $request)
    {

        $roles = Role::where('id', 19)->pluck('name', 'name')->all();
        $regions = Region::all();

        return view('admin.merchant.create', compact('roles', 'regions'));
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8',
            "business_name" => 'required',
            "business_owner_name" => 'required',
            "business_owner_phone" => 'required|unique:admins,business_owner_phone',
            "business_email" => 'required|unique:admins,business_email',
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
            "id_font_image" => 'required',
            "id_back_image" => 'required',
            "profile_image" => 'required'
        ]);


        DB::beginTransaction();
        try {

            $admin = new Admin();

            if ($request->hasFile('id_font_image')) {
                $idFontImagePath = uploadImage($request->id_font_image[0], 'merchant/id_card');
            }
            if ($request->hasFile('id_back_image')) {
                $idBackImagePath = uploadImage($request->id_back_image[0], 'merchant/id_card');
            }
            if ($request->hasFile('profile_image')) {
                $profileImagePath = uploadImage($request->profile_image[0], 'merchant/prfile_pic');
            }
            $lastUniqId = Admin::max('merchant_id');
            $uniqId = 100;
            if ($lastUniqId) {
                $uniqId = $lastUniqId + 1;
            }


            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->image = $profileImagePath;
            $admin->merchant_id = $uniqId;
            $admin->password = Hash::make($request->password);
            $admin->business_name = $request->business_name;
            $admin->business_owner_name = $request->business_owner_name;
            $admin->business_owner_phone = $request->business_owner_phone;
            $admin->business_email = $request->business_email;
            $admin->address_line = $request->address_line;
            $admin->street_address = $request->street_address;
            $admin->city = $request->city;
            $admin->state = $request->state;
            $admin->zip_code = $request->zip_code;
            $admin->bank_name = $request->bank_name;
            $admin->bank_branch_name = $request->bank_branch_name;
            $admin->account_type = $request->account_type;
            $admin->account_holder_name = $request->account_holder_name;
            $admin->account_number = $request->account_number;
            $admin->id_type = $request->id_type;
            $admin->id_number = $request->id_number;
            $admin->agree = $request->agree == "on" ? true : false;
            $admin->id_font_image = $idFontImagePath;
            $admin->id_back_image = $idBackImagePath;
            $admin->profile_pic = $profileImagePath;
            $admin->status = 1;
            $admin->is_merchant = true;
            $admin->created_by = Auth()->id();
            $admin->save();
            $admin->assignRole('merchant');
        } catch (\Exception $e) {
            DB::rollback();
            //            Toastr::error(trans('Merchant not created !'), 'Error', ["positionClass" => "toast-top-center"]);
            Toastr::error($e->getMessage(), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.merchant.create')->withInput();
        }
        DB::commit();
        Toastr::success(trans('Merchant created Successfully !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.merchant.index');
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        $regions = Region::all();
        return view('admin.merchant.edit', compact('admin', 'regions'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);

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

            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->image = $profileImagePath;
            $admin->password = Hash::make($request->password);
            $admin->business_name = $request->business_name;
            $admin->business_owner_name = $request->business_owner_name;
            $admin->business_owner_phone = $request->business_owner_phone;
            $admin->business_email = $request->business_email;
            $admin->address_line = $request->address_line;
            $admin->street_address = $request->street_address;
            $admin->city = $request->city;
            $admin->state = $request->state;
            $admin->zip_code = $request->zip_code;
            $admin->bank_name = $request->bank_name;
            $admin->bank_branch_name = $request->bank_branch_name;
            $admin->account_type = $request->account_type;
            $admin->account_holder_name = $request->account_holder_name;
            $admin->account_number = $request->account_number;
            $admin->id_type = $request->id_type;
            $admin->id_number = $request->id_number;
            $admin->agree = true;
            $admin->created_by = Auth()->id();

            if ($request->hasFile('id_font_image')) {
                $admin->id_font_image = $idFontImagePath;
            }
            if ($request->hasFile('id_back_image')) {
                $admin->id_back_image = $idBackImagePath;
            }
            if ($request->hasFile('profile_image')) {
                $admin->profile_pic = $profileImagePath;
            }
            $admin->status = 1;
            $admin->is_merchant = true;
            //            if (isset($request->password)) {
            //                $admin->password = Hash::make($request->password);
            //            }
            $admin->save();


            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $admin->assignRole('merchant');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Toastr::error(trans('Merchant not Updated !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
        DB::commit();
        Toastr::success(trans('Merchant Updated Successfully !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.merchant.index');
    }

    public function show($id)
    {
        $admin = Admin::with('hasState')->find($id);
        return view('admin.merchant.view', compact('admin'));
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $pickUpRequestCheck = PickupRequest::where('merchant_id', $id)->first();
            if (isset($pickUpRequestCheck)) {
                Toastr::error(trans("Merchant has pickup request,can't be deleted !"), 'Error', ["positionClass" => "toast-top-center"]);
                return redirect()->back();
            } else {
                $admin = Admin::find($id);
                $admin->delete();
                DB::table("roles")->where('id', $id)->delete();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('Merchant not Deleted !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.merchant.index');
        }
        DB::commit();
        Toastr::success(trans('Merchant Successfully Deleted!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.merchant.index');
    }

    public function bonus(Request $request)
    {
        $request->validate([
            'amount' => 'required'
        ]);
        $id = $request->get('merchant_id');
        $max_id =  Transaction::max('id') + 1;
        $transaction_id = Str::random(10) . $max_id;
        $transaction = new Transaction();
        $transaction->txn_type = 'IN';
        $transaction->transaction_id = $transaction_id;
        $transaction->txn_purpose = 'Bonus';
        $transaction->amount = $request->get('amount');
        $transaction->comments = $request->get('comments');
        $transaction->user_id = $id;
        $transaction->created_at = now();
        $transaction->updated_at = now();
        $transaction->created_by = Auth::user()->id;
        $transaction->updated_by = Auth::user()->id;
        $transaction->save();

        Toastr::success('Bonus is given to merchant successfully done!.');
        return redirect()->back()->with('message', 'Bonus is given to merchant successfully done!');
    }
}
