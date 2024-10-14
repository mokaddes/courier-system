<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\Admin;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\BusinessCard;
use Illuminate\Http\Request;
use App\Models\BusinessField;
use App\Mail\SendEmailInvoice;
use App\Actions\User\UpdateUser;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    // All Users
    public function index(Request $request)
    {
        $users = Admin::SimplePaginate(10);

        return view('admin.users.index', compact('users'));
    }
}
