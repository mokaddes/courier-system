@extends('frontend.layouts.app')

@section('title')
    {{ __('Privacy Policy') }}
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
    <div class="breadcrumb_sec mt-5 mb-5">
        <div class="container">
            <div class="text-center">
                <h4>{{ __('Privacy Policy') }}</h4>
            </div>
        </div>
    </div>
    {{-- custome page start --}}
    <div class="custome-page mb-5">
        <div class="container">
            {!! $pageContent->privacy_policy ?? '' !!}
        </div>
    </div>
@endsection

@push('js')
@endpush
