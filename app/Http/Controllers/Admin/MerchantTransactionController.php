<?php

namespace App\Http\Controllers\Admin;

use App\Mail\RchargeRequestApproved;
use App\Mail\RchargeRequestNotify;
use App\Models\Admin;
use App\Models\Setting;
use Carbon\Carbon;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\RechargRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class MerchantTransactionController extends Controller
{
    public function index(){
        $query = Transaction::orderBy('id', 'desc');
        if(Auth::user()->is_merchant == 1){
            $query->where('user_id', Auth::user()->id);
        }
        if(Auth::user()->is_deliveryman == 1){
            $query->where('user_id', Auth::user()->id);
        }

        $transactions = $query->get();

        return view('admin.merchant-transaction.index', compact('transactions'));
    }

    public function create(){
        return view('admin.merchant-transaction.create');
    }

    public function store(Request $request){

        $this->validate($request, [
            'amount'            => 'required',
            'proof_image'       => 'required',
            'payment_note'      => 'required|max:250',
            // 'slip_number'       => 'required',
            'payment_date'      => 'required',

        ],[
            'amount.required'       => 'The Amount is required',
            'proof_image.required'  => 'The Proof Image is required',
            // 'payment_note.required' => 'The payment note is required',
            // 'slip_number.required'  => 'The Slip number is required',
            'payment_date.required' => 'The Payment date is required',
        ]);
        DB::beginTransaction();
        try {

            $recharge_request                           = new RechargRequest();
            $recharge_request->merchant_id              = auth()->id();
            $recharge_request->amount                   = $request->amount;
            $recharge_request->payment_note             = $request->payment_note;
            $recharge_request->slip_number              = $request->slip_number;
            $recharge_request->status                   = 0;
            $recharge_request->payment_date             = Carbon::parse($request->payment_date);
            $recharge_request->created_by               =  auth()->id();

            if ($request->file('proof_image')) {

                $image_url = uploadImage($request->proof_image, 'admin', 720, 480);
            } else {
                $image_url = $recharge_request->proof_image;
            }
            $recharge_request->proof_image = $image_url;
            $recharge_request->save();


        } catch (Exception $e) {
            DB::rollback();
            Toastr::error(trans('Recharge Not Created!'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.merchant.transaction.create');
        }

        $settings=Setting::first();
        Mail::to($settings->email)->send(new RchargeRequestNotify($recharge_request));

        DB::commit();
        Toastr::success(trans('Recharge Created Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.merchant.recharge.request');

    }

    public function edit($id){
        $recharge_request = RechargRequest::find($id);
        return view('admin.merchant-transaction.edit', compact('recharge_request'));
    }

    public function update(Request $request, $id){

        DB::beginTransaction();
        $this->validate($request, [
            'amount'            => 'required',
            // 'proof_image'       => 'required',
            'payment_note'      => 'required|max:250',
            // 'slip_number'       => 'required',
            'payment_date'      => 'required',

        ],[
            'amount.required'       => 'The Amount is required',
            // 'proof_image.required'  => 'The Proof Image is required',
            'payment_note.required' => 'The payment note is required',
            // 'slip_number.required'  => 'The Slip number is required',
            'payment_date.required' => 'The Payment date is required',
        ]);
        try {

            $recharge_request                           = RechargRequest::find($id);
            $recharge_request->merchant_id              = auth()->id();
            $recharge_request->amount                   = $request->amount;
            $recharge_request->payment_note             = $request->payment_note;
            $recharge_request->slip_number              = $request->slip_number;
        //  $recharge_request->status                   = 0;
            $recharge_request->payment_date             = Carbon::parse($request->payment_date);
            $recharge_request->updated_by               =  auth()->id();


            if ($request->file('proof_image')) {

                $image_url = uploadImage($request->proof_image, 'admin', 720, 480);
            } else {
                $image_url = $recharge_request->proof_image;
            }
            $recharge_request->proof_image = $image_url;

            $recharge_request->save();

        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('Recharge Not Updated!'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.merchant.transaction.create');
        }
        DB::commit();
        Toastr::success(trans('Recharge Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.merchant.recharge.request');
    }

    public function delete($id){
        $recharge_request = RechargRequest::find($id);
        $recharge_request->delete();
        Toastr::success(trans('Recharge Deleted Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }
    public function rechargeRequest(Request $request){

        if(Auth::user()->is_merchant == 1){
            if($request->status == 'pending') {
                $recharge_requests   = RechargRequest::where('merchant_id', Auth::user()->id)->where('status', 0)->orderBy('id', 'desc')->get();
            }else {
                $recharge_requests   = RechargRequest::where('merchant_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            }
        }else{
            if($request->status == 'pending') {
                $recharge_requests   = RechargRequest::orderBy('id', 'desc')->where('status', 0)->get();
            }else {
                $recharge_requests   = RechargRequest::orderBy('id', 'desc')->get();
            }
        }

        return view('admin.merchant-transaction.recharge-request', compact('recharge_requests'));
    }

    public function status($id){

        try {

        DB::beginTransaction();
        $recharge_request = RechargRequest::find($id);

        if($recharge_request->status == 0){
            $recharge_request->status = 1;
        }
        $recharge_request->save();


        $random_id = Str::random(10);
        $tx_id = Transaction::max('id') + 1;


        $transaction = new Transaction();
        $transaction->txn_type = "IN";
        $transaction->transaction_id = $random_id . $tx_id;
        $transaction->recharge_request_id = $id;
        $transaction->user_id = $recharge_request->merchant_id;
        $transaction->payment_provider = "cash";
        $transaction->amount = $recharge_request->amount;
        $transaction->txn_purpose = "Recharge request";
        $transaction->created_at = now();
        $transaction->updated_at = now();
        $transaction->created_by = Auth::user()->id;
        $transaction->updated_by = Auth::user()->id;
        $transaction->save();

        }catch (Exception $exception){
            DB::rollBack();
            Toastr::error(trans('Something Wrong'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
        $merchant=Admin::find($recharge_request->merchant_id);
        Mail::to($merchant->email)->send(new RchargeRequestApproved($merchant));
        DB::commit();

        Toastr::success(trans('Status Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->back();

    }


    public function transactionDelete($id){
        $transaction = Transaction::find($id);
        $transaction->delete();
        Toastr::success(trans('Data Deleted Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }
}
