<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MerchantRequestApproved;
use App\Models\Admin;
use App\Models\Merchant;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class MerchantRequest extends Controller
{
    public function index()
    {
        $merchantRequests = Admin::where('is_merchant', true)
            ->where('status', '=', '2')
            ->orderBy('id', 'asc')
            ->whereNull('created_by')->get();
        return view('admin.merchant.index', compact('merchantRequests'));
    }

    public function show(Admin $merchant_request)
    {

        return view('admin.merchant-request.view', compact('merchant_request'));
    }

    public function approved(Admin $merchant_request)
    {

        try {
            DB::beginTransaction();

            $password = randomString(8);
            $lastUniqId = Admin::max('merchant_id');
            $uniqId = 100;
            if (isset($lastUniqId)) {
                $uniqId = $lastUniqId + 1;
            }

            $merchant_request->password = Hash::make($password);
            $merchant_request->image = $merchant_request->profile_pic;
            $merchant_request->is_merchant = true;
            $merchant_request->merchant_id = $uniqId;
            $merchant_request->status = true;
            $merchant_request->save();
            $merchant_request->assignRole("merchant");



             Mail::to($merchant_request->business_email)->send(new MerchantRequestApproved($merchant_request, $password));
            DB::commit();

            Toastr::success(trans('Merchant Approved Successfully'));
            return redirect()->route('admin.merchant-request.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            Toastr::error(trans('Something Wrong'));
            return redirect()->back();
        }
    }
}
