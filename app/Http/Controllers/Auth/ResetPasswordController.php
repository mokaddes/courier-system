<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */


    /**
     * Reset the given user's password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());


        if ($request->broker == 'users') {

            $this->guard('user');
        } else {
            $this->guard('admin');

        }

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
//        $response = $this->broker($request->broker)->reset(
//            $this->credentials($request), function ($user, $password) {
//            $this->resetPassword($user, $password);
//        });


        $user = DB::table($request->broker)->update(['password' => Hash::make($request->password)]);
        if($user > 0){
            $response=__('passwords.reset');
        }

        Toastr::success($response,'Success');

       return redirect()->route('login');
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker($broker = 'users')
    {
        return Password::broker($broker);
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return StatefulGuard
     */
    protected function guard($guard)
    {

        return Auth::guard($guard);
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    /**
     * Reset the given user's password.
     *
     * @param Request $request
     * @return Application|Factory|View
     */

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');
        $broker = $request->route()->parameter('broker');

        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email, 'broker' => $broker]
        );
    }

    protected $redirectTo = RouteServiceProvider::HOME;
    use ResetsPasswords;
}
