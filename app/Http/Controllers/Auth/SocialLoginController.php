<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(string $provider)
    {
        $data = Socialite::driver($provider)->user();
        $check_deactive = User::where('email', $data->email)->where('status', 0)->first();
        if (!empty($check_deactive)) {
            Toastr::error(trans('oops! your account has been deactivated! please contact website administrator'), 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->route('login');
        }
        try {
            if (!empty($data->email)) {
                $isExist  = User::where(['email' => $data->email])->first();
            } else {
                Toastr::error(trans('Login failed. Please try again'), 'Error', ["positionClass" => "toast-top-right"]);
                return redirect()->route('login');
                // $isExist  = User::where('provider', $provider)->where('social_id', $data->id)->first();
            }
            if (!empty($isExist)) {
                $isExist->update([
                    'image'            => $data->avatar,
                    'provider'          => $provider,
                    'provider_id'         => $data->id
                ]);
                Auth::login($isExist);
            } else {
                $user              = new User;
                $user->name        = $data->name;
                $user->email       = $data->email;
                $user->password    = uniqid();
                $user->image       = $data->avatar ?? NULL;
                $user->provider    = $provider;
                $user->provider_id = $data->id;
                $user->status      = 1;
                $user->created_at  = Carbon::now();

                $user->save();
                Auth::login($user);
                if ($user->email) {
                    // Mail::to($user->email)->send(new WelcomeMail($user));
                }
            }
        } catch (\Exception $e) {
            dd($e->getmessage());
            Toastr::error(trans('Login failed. Please try again'), 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->route('login');
        }
        return redirect()->route('user.dashboard');
    }
}
