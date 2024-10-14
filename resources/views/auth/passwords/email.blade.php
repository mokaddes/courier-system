@extends('frontend.layouts.app')

@section('title')
    {{ __('Reset Password') }}
@endsection

@section('content')
    <div class="login-section pb-5 pt-5">
        <div class="container">
            <div class="mx-auto" style="max-width: 30rem;">
                <div class="card card-lg">
                    <div class="login-form card-body">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="text-center">
                                <div class="heading mb-5">
                                    <h1 class="title">{{ __('Forgot password?') }}</h1>
                                    <p>
                                        {{ __('Enter the email address you used when you joined and we will send you instructions to reset your password.') }}
                                    </p>

                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="email">{{ __('Your email') }}</label>
                                <input class="form-control @error('email') is-invalid @enderror" name="email"
                                       type="email" id="email" placeholder="Enter your email address" required="">
                            </div>

                            <div class="mb-4">

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="broker" checked id="user" value="users">
                                    <label class="form-check-label" for="user">User</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="broker" id="merchant" value="admins">
                                    <label class="form-check-label" for="merchant">Merchant</label>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg" type="submit">{{ __('Submit') }}</button>
                                <div class="back-login text-center">
                                    <a class="btn-link" href="{{ route('login') }}">
                                        <i class="fa fa-chevron-left"></i>
                                        {{ __('Back to Sign in') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
