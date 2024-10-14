<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PickupRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountsController extends Controller
{
    public function deuAccounts(Request $request)
    {

        $auth = Auth::user();

        $rows = PickupRequest::orderBy('cod_received_by_admin', 'asc')
            ->orderBy('id', 'desc');

        if ($auth->getRoleNames()[0] == 'deliveryman') {
            $rows = $rows->where('deliveryman_id', $auth->id);
        }


        $rows = $rows->where(
            function ($query) {
                return $query
//                    ->where('payment_status', 0)
                    ->orWhere('cod_amount', '>', 0);
            })
            ->where('status', 4)
            ->get();


        return view('delivery-man.accounts.due-account', compact('rows'));

    }

    public function dueReceive($id)
    {
        $auth = Auth::user();
        $row = PickupRequest::where('id', $id)->first();
        $due_amount = $row->cod_amount;
        if ($row->payment_status == 0) {
            $due_amount += $row->amount;
        }

        $due_amount = $row->payment_status;
        $row->cod_received_by_admin = '1';
        $row->payment_status = '1';
        $row->cod_received_amount = $due_amount;
        $row->cod_received_at = now();
        $row->cod_received_admin_id = $auth->id;
        $row->update();

        Toastr::success(trans('Admin COD payment received from deliveryman!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->back();


    }
}
