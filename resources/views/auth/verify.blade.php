@extends('frontend.layouts.app')

@section('title')
    {{ __('Verify Your Email Address') }}
@endsection

@section('content')
    <div class="login-section  pb-5 pt-5">
        <div class="container">
            <div class="mx-auto" style="max-width: 30rem;">
                <div class="card card-lg">
                    <div class="login-form card-body">
                        <form method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <div class="text-center">
                                <div class="heading mb-5">
                                    <h1 class="title">{{ __('Verify Your Email Address') }}</h1>
                                    <p>
                                        {{ __('Don not have an account yet?') }}
                                    </p>
                                    <p>
                                        {{ __('Before proceeding, please check your email for a verification link.') }}
                                    </p>
                                    <p>
                                        {{ __('If you did not receive the email') }},
                                    </p>
                                </div>
                            </div>
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{ __('Click here to request another') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
