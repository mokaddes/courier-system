@extends('admin.layouts.master')

@section('settings_menu', 'menu-open')

@section('smpt', 'active')

@section('title')
    {{ __('Smpt') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Smpt') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Smpt') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="line-height: 36px;">{{ __('mail_settings') }}</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('admin.update.email.setting')}}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">{{ __('Mail Driver') }}</label>
                                <input disabled type="text" class="form-control @error('driver') is-invalid @enderror"
                                    id="driver" value="smtp" name="mail_driver">
                                @error('driver')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">{{ __('Mail Host') }}</label>
                                {{-- <x-forms.label name="{{ __('mail_host') }}" /> --}}
                                <input type="text" class="form-control @error('mail_host') is-invalid @enderror"
                                    id="mail_host" value="{{ config('mail.mailers.smtp.host') }}" name="mail_host">
                                @error('mail_host')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">{{ __('Mail Port') }}</label>
                                {{-- <x-forms.label name="{{ __('mail_port') }}" /> --}}
                                <input type="number" class="form-control @error('mail_port') is-invalid @enderror"
                                    id="mail_port" value="{{ config('mail.mailers.smtp.port') }}" name="mail_port">
                                @error('mail_port')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">{{ __('Mail Username') }}</label>
                                {{-- <x-forms.label name="{{ __('mail_username') }}" /> --}}
                                <input type="text" class="form-control @error('mail_username') is-invalid @enderror"
                                    id="mail_username" placeholder="{{ __('change_mail_username') }}" name="mail_username"
                                    value="{{ config('mail.mailers.smtp.username') }}">
                                @error('mail_username')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">{{ __('Mail Password') }}</label>
                                {{-- <x-forms.label name="{{ __('mail_password') }}" /> --}}
                                <input type="text" class="form-control @error('mail_password') is-invalid @enderror"
                                    id="mail_password" placeholder="{{ __('change_mail_password') }}" name="mail_password"
                                    value="{{ config('mail.mailers.smtp.password') }}">
                                @error('mail_password')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">{{ __('Mail Encryption') }}</label>
                                {{-- <x-forms.label name="{{ __('mail_encryption') }}" /> --}}
                                <select name="mail_encryption" id="mail_encryption"
                                    class="form-control @error('mail_encryption') is-invalid @enderror">
                                    <option {{ config('mail.mailers.smtp.encryption') == 'tls' ? 'selected' : '' }}
                                        value="tls">TLS</option>
                                    <option {{ config('mail.mailers.smtp.encryption') == 'ssl' ? 'selected' : '' }}
                                        value="ssl">SSL</option>
                                </select>
                                @error('mail_encryption')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">{{ __('Mail Form Address') }}</label>
                                {{-- <x-forms.label name="{{ __('mail_from_address') }}" /> --}}
                                <input type="email" class="form-control @error('mail_from_address') is-invalid @enderror"
                                    id="mail_from_address" value="{{ config('mail.from.address') }}"
                                    name="mail_address">
                                @error('mail_from_address')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">{{ __('Mail From Name') }}</label>
                                {{-- <x-forms.label name="{{ __('mail_from_name') }}" /> --}}
                                <input type="text" class="form-control @error('mail_from_name') is-invalid @enderror"
                                    id="mail_from_name" value="{{ config('mail.from.name') }}" name="mail_sender">
                                @error('mail_from_name')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- @if (userCan('setting.update')) --}}
                    <div class="mx-auto">
                        <div class="text-center">
                            <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                {{ __('update') }}</button>
                        </div>
                    </div>
                    {{-- @endif --}}
                </form>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h3 title="card-title">{{ __('send_test_mail') }}</h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <form method="POST" action="{{route('admin.test.email')}}">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">{{ __('Email Address') }}</label>
{{--                             <x-forms.label name="{{ __('email_address') }}" for="test_email" />--}}
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input name="test_email" type="email"
                                class="form-control  @error('test_email') is-invalid @enderror" id="test_email"
                                placeholder="{{ __('enter_email') }}" style="min-width: 400px">
                            @error('test_email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- @if (userCan('setting.update')) --}}
                        <button type="submit" class="btn btn-success mb-2"><i class="far fa-paper-plane"></i>
                            {{ __('send_mail') }}</button>
                        {{-- @endif --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
