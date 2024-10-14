<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DeliveryMan\Api\ResponseController;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $currency_symbol = DB::table('config')->where('config_key', 'currency')->first();
        $currency = DB::table('currencies')->where('iso_code', $currency_symbol->config_value)->first();

        $setting['currency']=$currency->symbol;

        return ResponseController::sendResponse(200,'Setting Details',$setting);
        
    }
}
