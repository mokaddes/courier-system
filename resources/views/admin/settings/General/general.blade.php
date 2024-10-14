@extends('admin.layouts.master')

@section('settings_menu', 'menu-open')

@section('general', 'active')

@section('title') {{ __('Settings') }} @endsection

@push('style')
    <link href="{{ asset('backend/css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Settings') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ __('Settings') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="updateFrom" action="{{ route('admin.settings.general_store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="m-0">{{ __('Settings') }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Site Settings</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <img src="{{ asset($settings->site_logo) }}" height="50px" />
                                                            <div class="mb-3">
                                                                <div class="form-label">{{ __('Site Logo') }} <span
                                                                        class="text-danger">
                                                                        ({{ __('Recommended size : 180x60') }})</span>
                                                                </div>
                                                                <input class="form-control" name="site_logo" type="file"
                                                                    placeholder="{{ __('Site Logo') }}..."
                                                                    accept=".png,.jpg,.jpeg,.gif,.svg" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">

                                                            <img src="{{ asset($settings->seo_image) }}" height="50px" />

                                                            <div class="mb-3">
                                                                <div class="form-label">{{ __('SEO image') }} <span
                                                                        class="text-danger">
                                                                        ({{ __('Recommended size : 728x680') }})</span>
                                                                </div>
                                                                <input class="form-control" name="seo_image" type="file"
                                                                    placeholder="{{ __('SEO image') }}..."
                                                                    accept=".png,.jpg,.jpeg,.gif,.svg" />
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            @if ($settings->favicon)
                                                                <img src="{{ asset($settings->favicon) }}"
                                                                    height="50px" />
                                                            @endif
                                                            <div class="mb-3">
                                                                <div class="form-label">{{ __('Favicon') }} <span
                                                                        class="text-danger">
                                                                        ({{ __('Recommended size : 200x200') }})</span>
                                                                </div>
                                                                <input class="form-control" name="favi_icon" type="file"
                                                                    placeholder="{{ __('Favicon') }}..."
                                                                    accept=".png,.jpg,.jpeg,.gif,.svg" />
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">{{ __('App Name') }}</label>
                                                                <input class="form-control" name="app_name" type="text"
                                                                    value="{{ config('app.name') }}"
                                                                    placeholder="{{ __('App Name') }}..." readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label required">{{ __('Site Name') }}</label>
                                                                <input class="form-control" name="site_name" type="text"
                                                                    value="{{ $settings->site_name }}"
                                                                    placeholder="{{ __('Site Name') }}..." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label required">{{ __('SEO Meta Description') }}</label>
                                                                <textarea class="form-control" name="seo_meta_desc" style="height: 120px !important;" rows="3"
                                                                    placeholder="{{ __('SEO Meta Description') }}" required>{{ $settings->seo_meta_description }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">{{ __('SEO Keywords') }}</label>
                                                                <textarea class="form-control required" name="meta_keywords" style="height: 120px !important;" rows="3"
                                                                    placeholder="{{ __('SEO Keywords (Keyword 1, Keyword 2)') }}" required>{{ $settings->seo_keywords }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <div class="form-group">
                                                                    <label for="copyright_text" class="form-label">Copyright Text <span class="text-danger">*</span></label>
                                                                    <input type="text" value="{{old('copyright_text',$settings->copyright_text)}}" name="copyright_text" id="copyright_text" class="form-control @error('copyright_text') border-danger @enderror" placeholder="Field" required>
                                                                    @error('copyright_text')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">General Settings</h3>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label required"
                                                                    for="timezone">{{ __('Timezone') }}</label>
                                                                <select class="form-control" id="timezone"
                                                                    name="timezone" required>
                                                                    @foreach (timezone_identifiers_list() as $timezone)
                                                                        <option value="{{ $timezone }}"
                                                                            {{ $config[2]->config_value == $timezone ? ' selected' : '' }}>
                                                                            {{ $timezone }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('timezone')
                                                                    <span
                                                                        class="help-block text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label required"
                                                                    for="currency">{{ __('Currency') }}</label>
                                                                <select class="form-control" id="currency"
                                                                    name="currency" required>
                                                                    @foreach ($currencies as $currency)
                                                                        <option value="{{ $currency->iso_code }}"
                                                                            {{ $config[1]->config_value == $currency->iso_code ? ' selected' : '' }}>
                                                                            {{ $currency->name }}
                                                                            ({{ $currency->symbol }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('currency')
                                                                    <span
                                                                        class="help-block text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <div class="form-label">{{ __('Email') }}</div>
                                                                <input class="form-control" name="email" type="email"
                                                                    value="{{ $settings->email }}">
                                                                @error('email')
                                                                    <span
                                                                        class="help-block text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <div class="form-label">{{ __('Phone No') }}</div>
                                                                <input class="form-control" name="phone_no"
                                                                    type="phone_no" value="{{ $settings->phone_no }}">
                                                                @error('phone_no')
                                                                    <span
                                                                        class="help-block text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <div class="form-label">{{ __('Office Address') }}</div>
                                                                <input class="form-control" name="office_address"
                                                                    type="office_address"
                                                                    value="{{ $settings->office_address }}">
                                                                @error('office_address')
                                                                    <span
                                                                        class="help-block text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <div class="form-label">{{ __('Support Email') }}</div>
                                                                <input class="form-control" name="support_email"
                                                                    type="support_email"
                                                                    value="{{ $settings->support_email }}">
                                                                @error('support_email')
                                                                    <span
                                                                        class="help-block text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- email setting --}}
                                        {{-- <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Email Configuration Settings
                                                    </h3>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">{{ __('Mailer Type') }}</label>
                                                                <input class="form-control" name="mail_driver"
                                                                    type="text" value="{{ $settings->driver }}"
                                                                    placeholder="{{ __('Mailer Type') }}...">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">{{ __('Mailer Host') }}</label>
                                                                <input class="form-control" name="mail_host"
                                                                    type="text" value="{{ $settings->host }}"
                                                                    placeholder="{{ __('Mailer Host') }}...">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">{{ __('Mailer Port') }}</label>
                                                                <input class="form-control" name="mail_port"
                                                                    type="text" value="{{ $settings->port }}"
                                                                    placeholder="{{ __('Mailer Port') }}...">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label">{{ __('Mailer Encryption') }}</label>
                                                                <input class="form-control" name="mail_encryption"
                                                                    type="text" value="{{ $settings->encryption }}"
                                                                    placeholder="{{ __('Mailer Encryption') }}...">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label">{{ __('Mailer Username') }}</label>
                                                                <input class="form-control" name="mail_username"
                                                                    type="text" value="{{ $settings->username }}"
                                                                    placeholder="{{ __('Mailer Username') }}...">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label">{{ __('Mailer Password') }}</label>
                                                                <input class="form-control" name="mail_password"
                                                                    type="password" value="{{ $settings->password }}"
                                                                    placeholder="{{ __('Mailer Password') }}...">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- paypal setting --}}
                                        {{-- <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Paypal Settings</h3>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label required">{{ __('Mode') }}</label>
                                                                <select class="form-select form-control"
                                                                    id="select-tags-advanced" name="paypal_mode"
                                                                    type="text" placeholder="Select a payment mode"
                                                                    required>
                                                                    <option value="sandbox"
                                                                        {{ $config[3]->config_value == 'sandbox' ? 'selected' : '' }}>
                                                                        {{ __('Sandbox') }}</option>
                                                                    <option value="live"
                                                                        {{ $config[3]->config_value == 'live' ? 'selected' : '' }}>
                                                                        {{ __('Live') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label required">{{ __('Client Key') }}</label>
                                                                <input class="form-control" name="paypal_client_key"
                                                                    type="text" value="{{ $config[4]->config_value }}"
                                                                    placeholder="{{ __('Client Key') }}..." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    required>{{ __('Secret') }}</label>
                                                                <input class="form-control" name="paypal_secret"
                                                                    type="text" value="{{ $config[5]->config_value }}"
                                                                    placeholder="{{ __('Secret') }}..." required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- strip setting --}}

                                        {{-- <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Strip Settings</h3>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label required">{{ __('Mode') }}</label>
                                                                <select class="form-select form-control"
                                                                    id="select-tags-advanced" name="paypal_mode"
                                                                    type="text" placeholder="Select a payment mode"
                                                                    required>
                                                                    <option value="sandbox"
                                                                        {{ $config[3]->config_value == 'sandbox' ? 'selected' : '' }}>
                                                                        {{ __('Sandbox') }}</option>
                                                                    <option value="live"
                                                                        {{ $config[3]->config_value == 'live' ? 'selected' : '' }}>
                                                                        {{ __('Live') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label required">{{ __('Publishable Key') }}</label>
                                                                <input class="form-control" name="stripe_publishable_key"
                                                                    type="text" value="{{ $config[9]->config_value }}"
                                                                    placeholder="{{ __('Publishable Key') }}..." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label required">{{ __('Secret') }}</label>
                                                                <input class="form-control" name="stripe_secret"
                                                                    type="text"
                                                                    value="{{ $config[10]->config_value }}"
                                                                    placeholder="{{ __('Secret') }}..." required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        {{-- EDAHAB Setting --}}
                                        {{-- <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">EDAHAB Settings</h3>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label class="form-label ">{{ __('Edahab Api Key') }}</label>
                                                                <input class="form-control" name="edahab_api_key"
                                                                    type="text" value="{{ $setting->edahab_api_key }}"
                                                                    placeholder="{{ __('Edahab Api Key') }}..." >

                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label ">{{ __('Edahab Agent Code') }}</label>
                                                                <input class="form-control" name="edahab_agent_code"
                                                                    type="text" value="{{ $setting->edahab_agent_code }}"
                                                                    placeholder="{{ __('Edahab Agent Code') }}..." >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        {{-- ZAAD Setting --}}
                                        {{-- <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">ZAAD Settings</h3>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label class="form-label ">{{ __('Zaad Merchant UID') }}</label>
                                                                <input class="form-control" name="zaad_merchant_uid"
                                                                    type="text" value="{{ $setting->zaad_merchant_uid }}"
                                                                    placeholder="{{ __('Zaad Merchant UID') }}..." >

                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label ">{{ __('Zaad User ID') }}</label>
                                                                <input class="form-control" name="zaad_user_id"
                                                                    type="text" value="{{ $setting->zaad_user_id }}"
                                                                    placeholder="{{ __('Zaad User ID') }}..." >
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label class="form-label ">{{ __('Zaad API Key') }}</label>
                                                                <input class="form-control" name="zaad_api_key"
                                                                    type="text" value="{{ $setting->zaad_api_key }}"
                                                                    placeholder="{{ __('Zaad API Key') }}..." >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- Social --}}
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Social URL</h3>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">{{ __('Facebook URL') }}</label>
                                                                <input class="form-control" name="facebook_url"
                                                                    type="url" value="{{ $settings->facebook_url }}"
                                                                    placeholder="{{ __('Facebook URL') }}...">
                                                                @error('facebook_url')
                                                                    <span
                                                                        class="help-block text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">{{ __('Youtube Url') }}</label>
                                                                <input class="form-control" name="youtube_url"
                                                                    type="url" value="{{ $settings->youtube_url }}"
                                                                    placeholder="{{ __('Youtube Url') }}...">
                                                                @error('youtube_url')
                                                                    <span
                                                                        class="help-block text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">{{ __('Twitter Url') }}</label>
                                                                <input class="form-control" name="twitter_url"
                                                                    type="url" value="{{ $settings->twitter_url }}"
                                                                    placeholder="{{ __('Twitter Url') }}...">
                                                                @error('twitter_url')
                                                                    <span
                                                                        class="help-block text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label">{{ __('Linkedin url') }}</label>
                                                                <input class="form-control" name="linkedin_url"
                                                                    type="url" value="{{ $settings->linkedin_url }}"
                                                                    placeholder="{{ __('Linkedin url') }}...">
                                                                @error('linkedin_url')
                                                                    <span
                                                                        class="help-block text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label">{{ __('Telegram number') }}</label>
                                                                <input class="form-control" name="telegram_url"
                                                                    type="number" value="{{ $settings->telegram_url }}"
                                                                    placeholder="{{ __('Linkedin number') }}...">
                                                                @error('telegram_url')
                                                                    <span class="help-block text-danger">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label">{{ __('Instagram Url') }}</label>
                                                                <input class="form-control" name="instagram_url"
                                                                    type="url"
                                                                    value="{{ $settings->instagram_url }}"
                                                                    placeholder="{{ __('Linkedin url') }}...">
                                                                @error('instagram_url')
                                                                    <span class="help-block text-danger">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="form-label">{{ __('WhatsApp Number') }}</label>
                                                                <input class="form-control" name="whatsapp_number"
                                                                    type="text"
                                                                    value="{{ $settings->whatsapp_number }}"
                                                                    placeholder="{{ __('WhatsApp Number') }}...">
                                                                @error('whatsapp_number')
                                                                    <span
                                                                        class="help-block text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Google Settings --}}
{{--                                        <div class="col-lg-6">--}}
{{--                                            <div class="card">--}}
{{--                                                <div class="card-header">--}}
{{--                                                    <h3 class="card-title">Google Login</h3>--}}
{{--                                                </div>--}}
{{--                                                <div class="card-body">--}}

{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-6">--}}
{{--                                                            <div class="mb-3">--}}
{{--                                                                <label--}}
{{--                                                                    class="form-label">{{ __('Google client id') }}</label>--}}
{{--                                                                <input class="form-control" name="google_client_id"--}}
{{--                                                                    type="text"--}}
{{--                                                                    value="{{ $settings->google_client_id }}"--}}
{{--                                                                    placeholder="{{ __('Google client id') }}...">--}}
{{--                                                                @error('google_client_id')--}}
{{--                                                                    <span--}}
{{--                                                                        class="help-block text-danger">{{ $message }}</span>--}}
{{--                                                                @enderror--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-6">--}}
{{--                                                            <div class="mb-3">--}}
{{--                                                                <label--}}
{{--                                                                    class="form-label">{{ __('Google client secret') }}</label>--}}
{{--                                                                <input class="form-control" name="google_client_secret"--}}
{{--                                                                    type="text"--}}
{{--                                                                    value="{{ $settings->google_client_secret }}"--}}
{{--                                                                    placeholder="{{ __('Google client secret') }}...">--}}
{{--                                                                @error('google_client_secret')--}}
{{--                                                                    <span--}}
{{--                                                                        class="help-block text-danger">{{ $message }}</span>--}}
{{--                                                                @enderror--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        {{-- Facebook Settings --}}
{{--                                        <div class="col-lg-6">--}}
{{--                                            <div class="card">--}}
{{--                                                <div class="card-header">--}}
{{--                                                    <h3 class="card-title">Facebook Login</h3>--}}
{{--                                                </div>--}}
{{--                                                <div class="card-body">--}}

{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-6">--}}
{{--                                                            <div class="mb-3">--}}
{{--                                                                <label--}}
{{--                                                                    class="form-label">{{ __('Facebook client id') }}</label>--}}
{{--                                                                <input class="form-control" name="facebook_client_id"--}}
{{--                                                                    type="text"--}}
{{--                                                                    value="{{ $settings->facebook_client_id }}"--}}
{{--                                                                    placeholder="{{ __('Facebook client id') }}...">--}}
{{--                                                                @error('facebook_client_id')--}}
{{--                                                                    <span--}}
{{--                                                                        class="help-block text-danger">{{ $message }}</span>--}}
{{--                                                                @enderror--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-6">--}}
{{--                                                            <div class="mb-3">--}}
{{--                                                                <label--}}
{{--                                                                    class="form-label">{{ __('Facebook client secret') }}</label>--}}
{{--                                                                <input class="form-control" name="facebook_client_secret"--}}
{{--                                                                    type="text"--}}
{{--                                                                    value="{{ $settings->facebook_client_secret }}"--}}
{{--                                                                    placeholder="{{ __('Facebook client secret') }}...">--}}
{{--                                                                @error('facebook_client_secret')--}}
{{--                                                                    <span--}}
{{--                                                                        class="help-block text-danger">{{ $message }}</span>--}}
{{--                                                                @enderror--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">reCAPTCHA Configuration</h3>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">

                                                        <div class="col-lg-6">
                                                            <div class="form-group" style="margin-top: 35px;">
                                                                <label for="recapcha_status" class="form-label">{{ __('reCAPTCHA Active') }}</label>
                                                                <input id="recapcha_status" name="recapcha_status"
                                                                    data-toggle="toggle" data-onstyle="success"
                                                                    data-on="Active" data-off="Deactive"
                                                                    data-offstyle="danger" type="checkbox"
                                                                    @if ($settings->recaptcha_enable) checked @endif>
                                                                @error('recapcha_status')
                                                                    <span
                                                                        class="help-block text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6" id="site_key_section">
                                                            <div class="form-group">
                                                                <label for="site_key">Site Key</label>
                                                                <input class="form-control" id="site_key"
                                                                    name="site_key" type="text"
                                                                    value="{{ $settings->recapcha_site_key }}">
                                                                @error('site_key')
                                                                    <span
                                                                        class="help-block text-danger">{{ $message }}</span>
                                                                @enderror

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-success" type="submit">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection

@push('script')
    <script src="{{ asset('backend/js/bootstrap4-toggle.min.js') }}"></script>
    <script>
        $(".updateFrom").on('submit', function() {
            $(this).find('button').html(`
                <span id="">
                    <span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span>
                    Updating ...
                </span>
            `);
            $(this).find('button').attr('disabled', true);
        });

        $(function() {
            $('#recapcha_status').change(function() {
                recapchaStatusChange();
            })
            recapchaStatusChange();
        })

        function recapchaStatusChange() {
            console.log("test");
            let state = $('#recapcha_status').prop('checked');
            if (state) {
                $('#site_key_section').show();
            } else {
                $('#site_key_section').hide();
            }
        }
    </script>
@endpush
