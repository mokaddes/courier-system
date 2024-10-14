@extends('frontend.layouts.app')

@section('title')
    {{ __('Ecommerce') }}
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
    {{-- breadcrumb start  --}}
    <div class="breadcrumb_sec mt-5 mb-5">
        <div class="container">
            <div class="text-center">
                <h4>{{ __('eCommerce Services') }}</h4>
            </div>
        </div>
    </div>
    {{-- ecommerce start --}}
    <div class="ecommerce_service_sec mb-5">
        <div class="container">
            @foreach ($ecommerceServices as $ecommerceService)
                <div class="ecommerce_service">
                    <div class="row gy-4 align-items-center">
                        <div class="ecom_service_content text-sm-start">
                            <h3 class="text-center">{{ $ecommerceService->title ?? '' }}</h3>
                        </div>
                        <div class="col-lg-6">
                            <div class="ecom_service_img text-center">
                                <img class="img-fluid"
                                    src="{{ isset($ecommerceService->photo) ? asset($ecommerceService->photo) : asset('frontend/images/services/1.png') }}"
                                    alt="{{$ecommerceService->title}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ecom_service_content text-center text-sm-start">
                                <p>
                                    {!! $ecommerceService->description ?? '' !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('js')
@endpush
