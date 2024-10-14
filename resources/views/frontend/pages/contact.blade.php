@extends('frontend.layouts.app')

@section('title')
    {{ __('Contact Us') }}
@endsection

{{-- @push('meta')
    <link href="{{ asset('frontend/images/favicons/apple-icon-60x60.png') }}" rel="apple-touch-icon" sizes="60x60">
    <link href="{{ asset('frontend/images/favicons/apple-icon-72x72.png') }}" rel="apple-touch-icon" sizes="72x72">
    <link href="{{ asset('frontend/images/favicons/apple-icon-76x76.png') }}" rel="apple-touch-icon" sizes="76x76">
    <link href="{{ asset('frontend/images/favicons/apple-icon-114x114.png') }}" rel="apple-touch-icon" sizes="114x114">
    <link href="{{ asset('frontend/images/favicons/apple-icon-120x120.png') }}" rel="apple-touch-icon" sizes="120x120">
    <link href="{{ asset('frontend/images/favicons/apple-icon-144x144.png') }}" rel="apple-touch-icon" sizes="144x144">
    <link href="{{ asset('frontend/images/favicons/apple-icon-152x152.png') }}" rel="apple-touch-icon" sizes="152x152">
    <link href="{{ asset('frontend/images/favicons/apple-icon-180x180.png') }}" rel="apple-touch-icon" sizes="180x180">
    <link type="image/png" href="{{ asset('frontend/images/favicons/android-icon-192x192.png') }}" rel="icon"
        sizes="192x192">
    <link type="image/png" href="{{ asset('frontend/images/favicons/favicon-32x32.png') }}" rel="icon" sizes="32x32">
    <link type="image/png" href="{{ asset('frontend/images/favicons/favicon-96x96.png') }}" rel="icon" sizes="96x96">
    <link type="image/png" href="{{ asset('frontend/images/favicons/favicon-16x16.png') }}" rel="icon" sizes="16x16">
@endpush --}}
@push('meta')
<meta property="og:title" content="{{ $meta_title }}" />
<meta property="og:description" content="{{ $meta_description }}" />
<meta property="og:image" content="{{ asset($meta_image) }}" />
@endpush
@push('css')
@endpush

@section('content')
    {{-- breadcrumb end  --}}
    <div class="breadcrumb_sec mt-5 mb-5">
        <div class="container">
            <div class="text-center">
                <h4>{{ __('Contact Us') }}</h4>
                <p>{{ __('Get in touch with us easily') }}</p>
            </div>
        </div>
    </div>
    {{-- contact start --}}
    <div class="contact-section mb-5">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-9">
                    <div class="row gy-4 mb-5">
                        <div class="col-md-6 col-lg-4 text-center">
                            <div class="contact_info">
                                <div class="icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                @if ($setting->office_address)
                                    <div class="address">
                                        <strong>Head Office:</strong>
                                        {{ $setting->office_address }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 text-center">
                            <div class="contact_info">
                                <div class="icon">
                                    <i class="fa fa-phone-volume"></i>
                                </div>
                                @if ($setting->phone_no)
                                    <div class="address">
                                        <p>{{ $setting->phone_no }}</p>
                                        {{-- <p>{{ $setting->whatsapp_number }}</p> --}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 text-center">
                            <div class="contact_info">
                                <div class="icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                @if ($setting->email || $setting->support_email)
                                    <div class="address">
                                        <p>{{ $setting->email }}</p>
                                        <p>{{ $setting->support_email }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="contact-form">
                        <form action="{{ route('contact.submit') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label">Name<small class="text-danger">*</small></label>
                                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                                            type="text" placeholder="Enter your name" required>
                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label">Email<small class="text-danger">*</small> </label>
                                        <input class="form-control @error('email') is-invalid @enderror" name="email"
                                            type="email" placeholder="Enter your email" required>
                                        @error('email')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label class="form-label">Message<small class="text-danger">*</small></label>
                                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" cols="30"
                                            rows="6" placeholder="Write your message" required></textarea>
                                        @error('message')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
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
