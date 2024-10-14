<?php

namespace App\Http\Controllers\Admin;

use App\Models\ApiKey;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MerchantApikeyController extends Controller
{

    public function live()
    {
        $data['title']     = 'Merchant Api Live';
        $data['liveApi']  = ApiKey::where('mode', 'live')->where('merchant_id', Auth::user()->merchant_id)->first();

        return view('admin.merchant_api.live', $data);
    }
    public function demo()
    {
        $data['title']     = 'Merchant Api Demo';

        $data['demoApi']  = ApiKey::where('mode', 'demo')->where('merchant_id', Auth::user()->merchant_id)->first();
        return view('admin.merchant_api.demo', $data);
    }

    public function store(Request $request)
    {
        $data =  new ApiKey();
        $data->merchant_id  = Auth::user()->merchant_id;
        $data->mode         = $request->mode;
        $data->public_key   = $request->mode . '_' . Str::random(20) . Auth::user()->merchant_id . Str::random(20);
        $data->secret_key   = $request->mode . '_' . Str::random(20) . Auth::user()->merchant_id . Str::random(20);
        $data->save();
        Toastr::success('Api Credentials Added Successfully');
        return redirect()->back();
    }
}
