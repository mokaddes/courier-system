<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\PickupRequest;
use App\Models\Region;
use App\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DeliveryManController extends Controller
{
    public function index()
    {
        $users = Admin::where('is_deliveryman', 1)->where('status', 1)->latest()->get();

        return view('admin.deliveryman.index', compact('users'));
    }

    public function create(Request $request)
    {

        $roles = Role::where('id', 19)->pluck('name', 'name')->all();
        $regions = Region::all();

        return view('admin.deliveryman.create', compact('roles', 'regions'));
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
            "business_owner_phone" => 'required|unique:admins,business_owner_phone',
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
            "id_font_image" => 'required',
            "id_back_image" => 'required',
            "profile_image" => 'required'
        ]);

        DB::beginTransaction();
        try {

            $admin = new Admin();

            if ($request->hasFile('id_font_image')) {
                $idFontImagePath = uploadImage($request->id_font_image[0], 'deliveryman/id_card');
                $admin->id_font_image = $idFontImagePath;
            }
            if ($request->hasFile('id_back_image')) {
                $idBackImagePath = uploadImage($request->id_back_image[0], 'deliveryman/id_card');
                $admin->id_back_image = $idBackImagePath;
            }
            if ($request->hasFile('profile_image')) {
                $profileImagePath = uploadImage($request->profile_image[0], 'deliveryman/prfile_pic');
                $admin->image = $profileImagePath;
                $admin->profile_pic = $profileImagePath;
            }
            $lastUniqId = Admin::max('deliveryman_id');
            $uniqId = 1000;
            if (isset($lastUniqId)) {
                $uniqId = $lastUniqId + 1;
            }


            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->deliveryman_id = $uniqId;
            $admin->password = Hash::make($request->password);
            $admin->business_owner_phone = $request->business_owner_phone;
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
            $admin->status = 1;
            $admin->is_deliveryman = 1;
            $admin->created_by = Auth()->id();
            $admin->save();
            $admin->assignRole('deliveryman');
        } catch (\Exception $e) {
            DB::rollback();
            //            Toastr::error(trans('Merchant not created !'), 'Error', ["positionClass" => "toast-top-center"]);
            Toastr::error($e->getMessage(), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.deliveryman.create')->withInput();
        }
        DB::commit();
        Toastr::success(trans('Delivery man created Successfully !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.deliveryman.index');
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        $regions = Region::all();
        return view('admin.deliveryman.edit', compact('admin', 'regions'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);

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
        DB::beginTransaction();
        try {
            $idFontImagePath = $admin->id_font_image;
            $idBackImagePath = $admin->id_back_image;
            $profileImagePath = $admin->profile_pic;

            if ($request->hasFile('id_font_image')) {
                $idFontImagePath = uploadImage($request->id_font_image[0], 'deliveryman/id_card');
            }
            if ($request->hasFile('id_back_image')) {
                $idBackImagePath = uploadImage($request->id_back_image[0], 'deliveryman/id_card');
            }
            if ($request->hasFile('profile_image')) {
                $profileImagePath = uploadImage($request->profile_image[0], 'deliveryman/prfile_pic');
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
            //            if (isset($request->password)) {
            //                $admin->password = Hash::make($request->password);
            //            }
            $admin->save();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Toastr::error(trans('Delivery Man Not Updated !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
        DB::commit();
        Toastr::success(trans('Delivery Man Updated Successfully !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.deliveryman.index');
    }

    public function show($id)
    {
        $admin = Admin::with('hasState')->find($id);
        return view('admin.deliveryman.view', compact('admin'));
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $pickUpRequestCheck = PickupRequest::where('deliveryman_id', '=', $id)->first();
            if (isset($pickUpRequestCheck)) {
                Toastr::error(trans("Delivery Man has pickup request,can't be deleted !"), 'Error', ["positionClass" => "toast-top-center"]);
                return redirect()->back();
            } else {
                $admin = Admin::find($id);
                $admin->delete();
                DB::table("roles")->where('id', $id)->delete();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('Delivery Man not Deleted !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.deliveryman.index');
        }
        DB::commit();
        Toastr::success(trans('Delivery Man Successfully Deleted!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.deliveryman.index');
    }
}
