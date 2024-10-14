@extends('frontend.layouts.app')

@section('title')
{{ __('Login') }}
@endsection
@php
$settings = App\Models\Setting::first();
@endphp

@section('content')
<div class="login-section  pb-5 pt-5">
    <div class="container">
        <div class="mx-auto" style="max-width: 30rem;">
            <div class="card card-lg">
                <div class="login-form card-body">
                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <input type="hidden" name="auth_type" value="merchant">
                        <div class="text-center">
                            <div class="heading mb-5">
                                <h1 class="title">{{ __('Sign in') }}</h1>
                                <p>{{ __('Become a') }}
                                    <a class="link" href="{{ route('merchant.register') }}">{{ __(' Merchant') }}</a>
                                </p>
                            </div>
                            {{-- @if (env('GOOGLE_LOGIN_ACTIVE'))
                            <div class="d-grid mb-4">
                                <a class="social-auth" href="{{ route('social.login', 'google') }}">
                                    <span class="d-flex justify-content-center align-items-center">
                                        <img class="avatar avatar-xss me-2"
                                            src="{{ asset('frontend/images/icons/google.svg') }}" alt="googel">
                                        {{ __('Sign in with Google') }}
                                    </span>
                                </a>
                            </div>
                            @endif
                            <span class="divider-center text-muted mb-4">{{ __('OR') }}</span> --}}
                        </div>
                        <div class="mb-4">
                            <label class="form-label">{{ __('Your Email') }}</label>
                            <input class="form-control @error('email') is-invalid @enderror" name="email" type="email"
                                value="{{ old('email') }}" autocomplete="off" placeholder="{{ __('Email address') }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label w-100">
                                <span class="d-flex justify-content-between align-items-center">
                                    <span>{{ __('Password') }}</span>
                                    <a class="form-label-link mb-0" href="{{ route('password.request') }}">{{ __('Forgot
                                        Password?') }}</a>
                                </span>
                            </label>
                            <input class="form-control @error('password') is-invalid @enderror" name="password"
                                type="password" autocomplete="off" placeholder="{{ __('Password') }}" required>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" id="termsCheckbox" type="checkbox">
                            <label class="form-check-label" for="termsCheckbox">
                                {{ __('Remember me') }}
                            </label>
                        </div>
                        @if ($settings->recaptcha_enable)
                        <div class="mb-4">
                            <div class="g-recaptcha" data-sitekey="{{ $settings->recapcha_site_key }}">
                            </div>
                            @error('g-recaptcha-response')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        @endif
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" type="submit">{{ __('Sign in as Merchant')
                                }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://www.google.com/recaptcha/api.js"></script>
@endpush
