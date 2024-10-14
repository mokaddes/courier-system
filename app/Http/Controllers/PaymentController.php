<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\OrderResponse;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function edahabPay(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'edahab_phone' => 'required|integer|digits:9',
            'amount' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['status' => false , 'message' => $validate->errors()->first()]);
        }

        $setting = Setting::first();
        $apikey = $setting->edahab_api_key ?? '7vAb1YbtaU9XDE8CFF1uxf6Zjm19GalcD63F7ZZqW';
        $edahabNumber = $request->edahab_phone ?? '657166178';
        $amount = $request->amount;
        $agentCode = $setting->edahab_agent_code ?? '721759';
        $returnUrl = route('admin.edahab.confirm');
        $request_param = [
            "apiKey" => $apikey,
            "edahabNumber" => $edahabNumber,
            "amount" => $amount,
            "agentCode" => $agentCode,
            "returnUrl" => $returnUrl
        ];
        /* Encode it into a JSON string. */
        $json = json_encode($request_param, JSON_UNESCAPED_SLASHES);
        $hashed = hash('SHA256', $json . "cd5GBclmmx7A4uj8ozZ481qChLk1CQiHIPeaNI");
        $url = "https://edahab.net/api/api/IssueInvoice?hash=" . $hashed;
        $curl = curl_init($url);
        // Tell cURL to send a POST request.
        curl_setopt($curl, CURLOPT_POST, TRUE);
        // Set the JSON object as the POST content.
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        // Set the JSON content-type: application/json.
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        // dd($json);
        // Set the return transfer option to true
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // Send the request.
        $result = curl_exec($curl);
        // curl_close($curl);
        // Get the InvoiceId from the API response and store it in your database.
        $response = json_decode($result);
//         dd($response);
        // Get the InvoiceId from the API response and store it in your database.
        if ($response->ValidationErrors && count($response->ValidationErrors) > 0) {
            return response()->json(['status' => false , 'message' => 'Your edahab phone is not valid.!', 'error' => $response->ValidationErrors ]);
        }
        $invoice = $response->InvoiceId;
        return response()->json(['status' => true , 'message' => 'Confirmation code sent successfully!', 'code' => $invoice]);
    }
    public function edahabConfirm(Request $request)
    {
        $request->validate([
            'confirm_code' => 'required'
        ]);
        try {
            $invoice = $request->confirm_code;
            $apikey = '7vAb1YbtaU9XDE8CFF1uxf6Zjm19GalcD63F7ZZqW';
            $request_param = array("apiKey" => $apikey, "invoiceId" => $invoice);

            /* Encode it into a JSON string. */
            $json = json_encode($request_param, JSON_UNESCAPED_SLASHES);

            $hashed = hash('SHA256', $json . "cd5GBclmmx7A4uj8ozZ481qChLk1CQiHIPeaNI");

            $url = "https://edahab.net/api/api/CheckInvoiceStatus?hash=" . $hashed;
            $curl = curl_init($url);
            // Tell cURL to send a POST request.
            curl_setopt($curl, CURLOPT_POST, TRUE);
            // Set the JSON object as the POST content.
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
            // Set the JSON content-type: application/json.
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // Send the request.
            $result = curl_exec($curl);
            $response = json_decode($result);
            

            if ($response->InvoiceStatus == 'Paid') {
                $max_id = Transaction::max('id') + 1;
                $transaction = new Transaction();
                $transaction->txn_type = "IN";
                $transaction->transaction_id = Str::random(10) . $max_id;
                $transaction->user_id = Auth::user()->id;
                $transaction->payment_provider = "edahab";
                $transaction->amount = $request->amount;
                $transaction->txn_purpose = "Recharge by edahab";
                $transaction->created_at = now();
                $transaction->updated_at = now();
                $transaction->created_by = Auth::user()->id;
                $transaction->updated_by = Auth::user()->id;
                $transaction->save();

                Toastr::success(trans('You have successfully recharged to you balance'), 'Success', ["positionClass" => "toast-top-center"]);
                return redirect()->route('admin.merchant.transaction.index');
            }else{
                Toastr::error(trans('Your recharge request is failed.'), 'Error', ["positionClass" => "toast-top-center"]);
                return back()->withInput();
            }
        } catch (\Throwable $th) {
            Toastr::error(trans('Your recharge request is failed.'), 'Error', ["positionClass" => "toast-top-center"]);
            return back();
        }

    }

    public function zaadPay(Request $request)
    {
        $request->validate([
            'zaad_phone' => 'required|integer|digits:9',
            'amount' => 'required',
        ]);

        $setting = Setting::first();

        $zaadNumber = '252' . $request->zaad_phone;
        $amount = $request->zaad_total;

        $testUrl = "https://sandbox.waafipay.net/asm";
        $prodUrl = "https://api.waafipay.net/asm";
        $schemaVersion = "1.0";
        $requestId = "7102205824";
        $timestamp = now();
        $channelName = "WEB";
        $referenceId = random_int(10000, 99999);
        $invoiceId = random_int(10000, 99999);

        $payerInfo = [
            'accountNo' => $zaadNumber,
            'accountType' => "MERCHANT",
        ];

        $transactionInfo = [
            'referenceId' => $referenceId,
            'invoiceId' => $invoiceId,
            'amount' => $amount ?? '0.10',
            'currency' => 'USD',
            'description' => $request->get("zaad_note") ?? '',
        ];

        $serviceParams = [
            'merchantUid' => $setting->zaad_merchant_uid ?? 'M0911164',
            'apiUserId' => $setting->zaad_user_id ?? '1002445',
            'apiKey' => $setting->zaad_api_key ?? 'API-204818092AHX',
            'paymentMethod' => 'MWALLET_ACCOUNT',
            'payerInfo' => $payerInfo,
            'transactionInfo' => $transactionInfo,
        ];

        $postData = [
            'schemaVersion' => $schemaVersion,
            'requestId' => $requestId,
            'timestamp' => $timestamp,
            'channelName' => $channelName,
            'serviceName' => 'API_PREAUTHORIZE',
            'serviceParams' => $serviceParams,
        ];

        $json = json_encode($postData, JSON_UNESCAPED_SLASHES);

//        $req->executeCurl($testUrl, $postData, 300, 500);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $prodUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $result = json_decode($response, true);
        if ($result['errorCode'] == '0') {
            $transactionId = $result['params']['transactionId'];
            $max_id = Transaction::max('id') + 1;
            $transaction = new Transaction();
            $transaction->txn_type = "IN";
            $transaction->transaction_id = $transactionId ?? Str::random(10) . $max_id;
            $transaction->user_id = Auth::user()->id;
            $transaction->payment_provider = "zaad";
            $transaction->amount = $request->amount;
            $transaction->txn_purpose = "Recharge by zaad";
            $transaction->created_at = now();
            $transaction->updated_at = now();
            $transaction->created_by = Auth::user()->id;
            $transaction->updated_by = Auth::user()->id;
            $transaction->save();
        } elseif ($result['errorCode'] == 'E10205') {
            Toastr::error(trans("You don't have sufficient balance."), 'Error', ["positionClass" => "toast-top-center"]);
            return back();
        }
        else{
            Toastr::error(trans('Your recharge request is failed.'), 'Error', ["positionClass" => "toast-top-center"]);
            return back();
        }

    }


}
