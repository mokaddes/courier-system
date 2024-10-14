<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {

        return view('admin.auth.login');
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            if ($request->get('auth_type') == 'merchant' && Auth::guard('admin')->user()->is_merchant == 1) {
                if (Auth::guard('admin')->user()->status == "1") {
                    return $this->sendLoginResponse($request);
                } else {
                    Auth::guard('admin')->logout();
                    Toastr::error(trans('Account Not Approved'));
                    return redirect()->route('login');
                }
            }else if ($request->get('auth_type') == 'deliveryman' && Auth::guard('admin')->user()->is_deliveryman == 1) {
                if (Auth::guard('admin')->user()->status == "1") {
                    return $this->sendLoginResponse($request);
                } else {
                    Auth::guard('admin')->logout();
                    Toastr::error(trans('Account Not Approved'));
                    return redirect()->route('login');
                }
            }else if ($request->get('auth_type') == 'admin') {
                if (Auth::guard('admin')->user()->status == "1") {
                    return $this->sendLoginResponse($request);
                } else {
                    Auth::guard('admin')->logout();
                    Toastr::error(trans('Account Not Approved'));
                    return redirect()->route('login');
                }
            }else{
                Auth::guard('admin')->logout();
                Toastr::error(trans("Credential doesn't match with ". $request->get('auth_type')));
                return redirect()->back();
            }



            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    protected function validateLogin(Request $request)
    {

        // dd('404');
        if (env('NOCAPTCHA_ACTIVE')) {
            $request->validate([
                $this->username() => 'required|string',
                'password' => 'required|string',
                'g-recaptcha-response' => 'required|captcha'
            ], [
                'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
                'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
            ]);
        } else {
            $request->validate([
                $this->username() => 'required|string',
                'password' => 'required|string',
            ]);
        }
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->route('admin.login');
    }
}
