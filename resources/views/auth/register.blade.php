@extends('frontend.layouts.app')

@section('title')
    {{ __('Login') }}
@endsection

@section('content')
    <div class="login-section pb-5 pt-5">
        <div class="container">
            <div class="mx-auto" style="max-width: 30rem;">
                <div class="card card-lg">
                    <div class="login-form card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="text-center">
                                <div class="heading mb-5">
                                    <h1 class="title">{{ __('Sign Up') }}</h1>
                                    <p>{{ __('Already have an account?') }}
                                        <a class="link" href="{{ route('login') }}">{{ __('Sign In') }}</a>
                                    </p>
                                </div>
                                @if (env('GOOGLE_LOGIN_ACTIVE'))
                                    <div class="d-grid mb-4">
                                        <a class="social-auth" href="{{ route('social.login', 'google') }}">
                                            <span class="d-flex justify-content-center align-items-center">
                                                <img class="avatar avatar-xss me-2"
                                                    src="{{ __('frontend/images/icons/google.svg') }}" alt="googel">
                                                {{ __('Sign in with Google') }}
                                            </span>
                                        </a>
                                    </div>
                                @endif
                                <span class="divider-center text-muted mb-4">{{ __('OR') }}</span>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">{{ __('Name') }}</label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    type="text" value="{{ old('name') }}" placeholder="{{ __('Name') }}">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">{{ __('Your email') }}</label>
                                <input class="form-control @error('email') is-invalid @enderror" name="email"
                                    type="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}">
                            </div>

                            <div class="mb-4">
                                <label class="form-label" tabindex="2">
                                    <span class="d-flex justify-content-between align-items-center">
                                        <span>{{ __('Password') }}</span>
                                    </span>
                                </label>
                                <input class="form-control @error('password') is-invalid @enderror" name="password"
                                    type="password" value="{{ old('password') }}" placeholder="{{ __('Password') }}">
                            </div>

                            <div class="mb-4">
                                <label class="form-label" tabindex="2">
                                    <span class="d-flex justify-content-between align-items-center">
                                        <span>{{ __('Confirm Password') }}</span>
                                    </span>
                                </label>
                                <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" type="password"
                                    placeholder="{{ __('Confirm Password') }}">
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" id="termsCheckbox" type="checkbox" value="">
                                <label class="form-check-label" for="termsCheckbox">
                                    {{ __('Remember me') }}
                                </label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg" type="submit">{{ __('Sign Up') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
