@extends('frontend.layouts.app')

@section('title')
    {{ __('Pricing') }}
@endsection
{{-- @push('meta')
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('frontend/images/favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('frontend/images/favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('frontend/images/favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('frontend/images/favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('frontend/images/favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('frontend/images/favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('frontend/images/favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/images/favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('frontend/images/favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/images/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('frontend/images/favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend/images/favicons/favicon-16x16.png') }}">
@endpush --}}
@push('meta')
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
    <meta property="og:image" content="{{ asset($meta_image) }}" />
@endpush

@section('content')
    <!-- ======================= start  ========================= -->
    <div class="breadcrumb_sec mt-5 mb-5">
        <div class="container">
            <div class="text-center">
                <h4>{{ __('Pricing') }}</h4>
                <p>{{ __('DhereyeDelivery Rate Chart [Only Somalia City Mogadishu area]') }}</p>
            </div>
        </div>
    </div>
    <div class="pricing-sec mb-5">
        <div class="container">
            <!-- Regular Delivery -->
            @foreach ($prices as $price)
                @if ($price->pricing->count() > 0)
                    <div class="pricing-table">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <tbody>

                                    <tr>
                                        <th colspan="5">{{ $price->name }}</th>
                                    </tr>
                                    <tr>
                                        <th width="110">Item</th>
                                        <th>Products Weight</th>
                                        <th width="120">Inter City Price</th>
                                        <th width="120">Inside City Price</th>
                                    </tr>
                                    @foreach ($price->pricing as $pricing)
                                        <tr>
                                            <td>{{ $pricing->item_name }}</td>
                                            <td>{{ $pricing->hasWeight->name ?? '' }}</td>
                                            <td>{{ getPrice($pricing->inside_main_city_price) ?? '' }}</td>
                                            <td>{{ getPrice($pricing->inter_city_price) ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection

