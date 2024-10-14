@php
    $setting = App\Models\Setting::first();
@endphp
<div class="container">
    <!-- desktop menu -->
    <nav class="navbar navbar-expand-lg p-0">
        <div class="container-fluid">
            <a class="navbar-brand p-0" href="{{ route('home') }}">
                <img src="@if ($setting->site_logo) {{ asset($setting->site_logo) }} @else {{ asset('frontend/images/logo.png') }} @endif"
                    alt="logo">
            </a>
            <div class="d-flex align-items-center">
                <a class="login_btn d-block d-lg-none me-3" href="{{ route('login') }}">
                    <img src="{{ asset('frontend/images/icons/login-user.svg') }}" alt="">
                    {{ __('Login') }}
                </a>
                <button class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#mobileNavExample"
                    type="button" type="button" aria-controls="mobileNavExample">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tracking') }}">{{ __('Track') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pricing') }}">{{ __('Pricing') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ecommerce') }}">{{ __('Ecommerce') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pickup.request') }}">{{ __('Pick Up Request') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">{{ __('Contact Us') }}</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @if (Auth::Check())
                        <a class="login_btn" href="{{ route('user.dashboard') }}">
                            @if (Auth::user()->image)
                                <img class="rounded-circle"
                                    src="{{ asset('frontend/images/profile/' . Auth::user()->image) }}"
                                    alt="Profile Image" width="50px">
                            @else
                                <img class="rounded-circle" src="{{ asset('frontend/default-user.png') }}"
                                    alt="Profile Image" width="50px">
                            @endif
                            Profile
                        </a>
                    @else
                        <a class="login_btn" href="{{ route('merchant.login') }}">
                            <img src="{{ asset('frontend/images/icons/login-user.svg') }}" alt="">
                            Login
                        </a>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- mobile menu -->
    <div class="mobile_nav d-block d-lg-none">
        <div class="offcanvas offcanvas-start" id="mobileNavExample" aria-labelledby="mobileNavExampleLabel"
            tabindex="-1">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="mobileNavExampleLabel">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('frontend/images/logo.png') }}" alt="logo">
                    </a>
                </h5>
                <button class="btn-close" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tracking') }}">{{ __('Track') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pricing') }}">{{ __('Pricing') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ecommerce') }}">{{ __('Ecommerce') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pickup.request') }}">{{ __('Pick Up Request') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">{{ __('Contact Us') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
