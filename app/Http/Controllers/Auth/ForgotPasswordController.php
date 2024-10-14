<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Notifications\PasswordResetMarchant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

//    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }


    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        if ($request->broker == 'admins') {
            $user = Admin::where('email', $request->email)->first();
            if (!$user) {

                return back()->withErrors(['email' => 'We could not find a user with that email address.']);
            }
        }
        if ($request->broker == 'users') {

            $user = User::where('email', $request->email)->first();
            if (!$user) {

                return back()->withErrors(['email' => 'We could not find a user with that email address.']);
            }
        }

        // Generate the password reset token and save it to the user
        $token = Str::random(64);
        $user->forceFill([
            'remember_token' => $token,
        ])->save();

        // Send the password reset email with the additional parameter
        $user->notify(new PasswordResetMarchant($token, $request));


        return back()->with('status', 'We have emailed your password reset link!');
    }

//    public function sendResetLinkEmail(Request $request)
//    {
//        $this->validateEmail($request);
//        $broker='user';
//        if ($request->has('broker')) {
//            $broker = $request->broker;
//        }
//
//        // We will send the password reset link to this user. Once we have attempted
//        // to send the link, we will examine the response then see the message we
//        // need to show to the user. Finally, we'll send out a proper response.
//        $response = $this->broker($broker)->sendResetLink(
//            $this->credentials($request)
//        );
//
//        return $response == Password::RESET_LINK_SENT
//            ? $this->sendResetLinkResponse($request, $response)
//            : $this->sendResetLinkFailedResponse($request, $response);
//    }

    /**
     * Validate the email for the given request.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }

    /**
     * Get the needed authentication credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only(['email']);
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return $request->wantsJson()
            ? new JsonResponse(['message' => trans($response)], 200)
            : back()->with('status', trans($response));
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'email' => [trans($response)],
            ]);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    public function broker($broker = 'users')
    {
        return Password::broker($broker);
    }

}
