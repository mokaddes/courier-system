@php
    $setting = App\Models\Setting::first();
    // dd($setting);
@endphp
<div class="container">
    <div class="row gy-4">
        <div class="col-xl-4">
            <div class="footer-widget mb-4">
                <h3>{{ __('Contact Information') }}</h3>
            </div>
            <div class="contact_info">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon">
                        <i class="fa fa-phone-volume"></i>
                    </div>
                    <div class="address">
                        <strong>{{ __('Phone:') }}</strong>
                        <a href="tel:{{ __($setting->phone_no) }}">{{ __($setting->phone_no) }}</a>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="icon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="address">
                        <strong>{{ __('Head Office:') }}</strong>
                        {{ __($setting->office_address) }}
                    </div>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="address">
                        <strong>{{ __('Email:') }}</strong>
                        <a href="mailto:{{ __($setting->email) }}">{{ __($setting->email) }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2 ps-xl-5">
            <div class="footer-widget mb-4">
                <h3>{{ __('About') }}</h3>
            </div>
            <div class="links">
                <ul>
                    <li><a href="{{ route('about') }}">{{ __('About Us') }}</a></li>
                    <li><a href="{{ route('contact') }}">{{ __('Contact Us') }}</a></li>
                    <li><a href="{{ route('pricing') }}">{{ __('Pricing') }}</a></li>
                    <li><a href="{{ route('ecommerce') }}">{{ __('Ecommerce') }}</a></li>
                    <li><a href="{{ route('merchant.register') }}">{{ __('Become a Merchant') }}</a></li>
                </ul>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="footer-widget mb-4">
                <h3>{{ __('Help & Suppor') }}t</h3>
            </div>
            <div class="links">
                <ul>
                    <li><a href="{{ route('privacy.policy') }}">{{ __('Privacy Policy') }}</a></li>
                    <li><a href="{{ route('terms.onditions') }}">{{ __('Terms & Conditions') }}</a></li>
                    <li><a href="{{ route('tracking') }}">{{ __('Tracking') }}</a></li>
                    <li><a href="{{ route('pickup.request') }}">{{ __('Pick Up Request') }}</a></li>
                    <li><a href="{{ route('merchant.api.document') }}">{{ __('Api Documentation') }}</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-xl-4">
            <div class="footer-widget mb-4">
                <h3>{{ __('Get In Touch') }}</h3>
            </div>
            <div class="social_media">
                <ul>
                    @if ($setting->facebook_url)
                        <li>
                            <a href="{{ $setting->facebook_url }}">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </li>
                    @endif
                    @if ($setting->twitter_url)
                        <li>
                            <a href="{{ $setting->twitter_url }}">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                    @endif
                    @if ($setting->linkedin_url)
                        <li>
                            <a href="{{ $setting->linkedin_url }}">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                    @endif
                    @if ($setting->instagram_url)
                        <li>
                            <a href="{{ $setting->instagram_url }}">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    @endif
                    @if ($setting->youtube_url)
                        <li>
                            <a href="{{ $setting->youtube_url }}">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    @endif
                    @if ($setting->telegram_url)
                        <li>
                            <a href="https://t.me/+{{ $setting->telegram_url }}">
                                <i class="fab fa-telegram"></i>
                            </a>
                        </li>
                    @endif
                    @if ($setting->whatsapp_number)
                        <li>
                            <a href="https://api.whatsapp.com/send?phone={{ $setting->whatsapp_number }}">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    {{-- copyright --}}
    <div class="copyright text-center pt-4">
        <p>{{ __($setting->copyright_text) }}</p>
    </div>
</div>
