<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\User;
use App\Models\Admin;

use App\Models\Setting;
use App\Models\BusinessCard;

use Illuminate\Http\Request;
use App\Actions\User\UpdateUser;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
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
        $users = Admin::where('is_merchant', 0)->where('is_deliveryman', 0)->latest()->paginate(25);
        return view('admin.users.index', compact('users'));
    }


    public function create(Request $request)
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name'          => 'required|max:100',
            'email'     => 'required|email|unique:admins,email',
            'password'    => 'required|min:6',
        ]);

        DB::beginTransaction();
        try {


            $admin               = new Admin();
            $admin->name         = $request->name;
            $admin->email        = $request->email;
            $admin->password     = Hash::make($request->password);

            if ($request->file('image')) {

                $image_url = uploadImage($request->image, 'admin', 720, 480);
            } else {
                $image_url = $admin->image;
            }
            $admin->image = $image_url;

            $admin->save();
            $admin->assignRole($request->input('roles'));
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('Admin not created !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.user.create');
        }
        DB::commit();
        Toastr::success(trans('Admin created Successfully !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.user.index');
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        $roles = Role::pluck('name', 'name')->all();

        $userRole = $admin->roles->pluck('name', 'name')->all();
        return view('admin.users.edit', compact('admin', 'roles', 'userRole'));
    }


    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        $this->validate($request, [
            'name'          => 'required|max:100',
            'email'     => 'required|email|unique:admins,email,' . $admin->id,
        ]);

        DB::beginTransaction();
        try {

            $admin->name         = $request->name;
            $admin->email        = $request->email;
            if (isset($request->password)) {

                $admin->password     = Hash::make($request->password);
            }

            if ($request->file('image')) {

                if (file_exists($admin->image)) {
                    unlink($admin->image);
                }

                $image_url = uploadImage($request->image, 'admin', 720, 480);
            } else {
                $image_url = $admin->image;
            }
            $admin->image = $image_url;

            $admin->save();
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $admin->assignRole($request->input('roles'));
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('Admin not Updated !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.user.create');
        }
        DB::commit();
        Toastr::success(trans('Admin Updated Successfully !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.user.index');
    }

    public function show($id)
    {
        $admin = Admin::find($id);
        return view('admin.users.view', compact('admin'));
    }

    // View User
    public function viewUser(Request $request, $id)
    {
        // $user_details = Admin::where('id', $id)->first();
        // if ($user_details == null) {
        //     return view('errors.404');
        // } else {
        //     $user_cards = BusinessCard::where('user_id',$id)->where('status','!=',2)->orderBy('card_url','asc')->get();
        //     $settings = Setting::where('status', 1)->first();
        //     return view('admin.users.view-user', compact('user_details', 'user_cards', 'settings'));
        // }
    }

    // Edit User
    public function editUser(Request $request, $id)
    {
        // $user_details = Admin::where('id', $id)->first();
        // $settings = Setting::where('status', 1)->first();
        // if ($user_details == null) {
        //     return view('errors.404');
        // } else {
        //     return view('admin.users.edit-user', compact('user_details', 'settings'));
        // }
    }


    // Update User
    public function updateUser(Request $request)
    {
        //     DB::beginTransaction();
        //     try {
        //     $validator = Validator::make($request->all(), [
        //         'user_id' => 'required',
        //         'full_name' => 'required',
        //         'email' => 'required'
        //     ]);
        //     $user = Admin::where('id', $request->user_id)->first();
        //     $user->email = $request->email;
        //     $user->name = $request->full_name;
        //     if(!empty($request->password)){
        //         $user->password = Hash::make($request->password);
        //     }
        //     $user->plan_validity = $request->plan_validity;
        //     if(isset($request->no_of_vcards)){
        //         $plan_details = json_decode($user->plan_details);
        //         $plan_array = [];
        //         foreach ($plan_details as $key => $value) {
        //                 if($key=='no_of_vcards'){
        //                     $plan_array[$key] = $request->no_of_vcards;
        //                 }
        //                 else{
        //                     $plan_array[$key] = $value;
        //                 }
        //         }
        //         $user->plan_details = json_encode($plan_array);
        //     }
        //     $user->billing_address = $request->billing_address;
        //     $user->billing_city = $request->billing_city;
        //     $user->billing_state = $request->billing_state;
        //     $user->billing_zipcode = $request->billing_zipcode;
        //     $user->billing_country = $request->billing_country;
        //     $user->phone = $request->phone;
        //     $user->designation = $request->designation;
        //     $user->company_name = $request->company_name;
        //     $user->company_websitelink = $request->company_websitelink;
        //     $user->status = $request->status;
        //     $user->user_type = $request->user_type;
        //     $user->update();

        // } catch (\Exception $e) {
        //     dd($e->getMessage());
        //     DB::rollback();
        //     Toastr::error(trans('User not updated!'), 'Error', ["positionClass" => "toast-top-center"]);
        //     return redirect()->route('admin.users');
        // }
        //     DB::commit();
        //     Toastr::success(trans('User updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        //     return redirect()->route('admin.users');
    }

    // Change user plan
    public function ChangeUserPlan(Request $request, $id)
    {
        // $user_details = Admin::where('id', $id)->first();
        // $plans = Plan::where('status', 1)->get();
        // $settings = Setting::where('status', 1)->first();
        // $config = DB::table('config')->get();
        // if ($plans == null) {
        //     return view('errors.404');
        // } else {
        //     return view('admin.users.change-plan', compact('user_details', 'plans', 'settings', 'config'));
        // }
    }



    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $admin = Admin::find($id);
            $admin->delete();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('Admin not Deleted !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.user.index');
        }
        DB::commit();
        Toastr::success(trans('Admin Successfully Updated!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.user.index');
    }
}
