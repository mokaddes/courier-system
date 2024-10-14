@extends('frontend.layouts.app')

@section('title')
    {{ __('Confirm Password') }}
@endsection

@section('content')
    <div class="login-section  pb-5 pt-5">
        <div class="container">
            <div class="mx-auto" style="max-width: 30rem;">
                <div class="card card-lg">
                    <div class="login-form card-body">
                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf
                            <div class="text-center">
                                <div class="heading mb-5">
                                    <h1 class="title">{{ __('Confirm Password') }}</h1>
                                    <p>
                                        {{ __('Please confirm your password before continuing.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label w-100">
                                    <span class="d-flex justify-content-between align-items-center">
                                        <span>{{ __('Password') }}</span>
                                        <a class="form-label-link mb-0" href="{{ route('password.request') }}">
                                            {{ __('Forgot Password?') }}
                                        </a>
                                    </span>
                                </label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off" placeholder="{{ __('Password') }}">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{ __('Confirm Password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
