@extends('frontend.layouts.app')

@section('title')
    {{ __('Reset Password') }}
@endsection

@section('content')
    <div class="login-section  pb-5 pt-5">
        <div class="container">
            <div class="mx-auto" style="max-width: 30rem;">
                <div class="card card-lg">
                    <div class="login-form card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="broker" value="{{ $broker }}">
                            <div class="text-center">
                                <div class="heading mb-5">
                                    <h1 class="title">{{ __('Reset Password') }}</h1>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">{{ __('Your email') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="off" placeholder="{{ __('Email address') }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label w-100">
                                    <span class="d-flex justify-content-between align-items-center">
                                        <span>{{ __('Password') }}</span>
                                    </span>
                                </label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off" placeholder="{{ __('Password') }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label w-100">
                                    <span class="d-flex justify-content-between align-items-center">
                                        <span>{{ __('Confirm Password') }}</span>
                                    </span>
                                </label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="off" placeholder="{{ __('Confirm Password') }}">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">{{ __('Reset Password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
