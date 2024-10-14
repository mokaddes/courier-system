@extends('frontend.layouts.app')

@section('title')
    {{ __('Tracking') }}
@endsection
@push('meta')
<meta property="og:title" content="{{ $meta_title }}" />
<meta property="og:description" content="{{ $meta_description }}" />
<meta property="og:image" content="{{ asset($meta_image) }}" />
@endpush
@push('css')
    <style>
        .tracking-bg {
            width: 100%;
            height: 100%;
            background-image: url("{{ asset('frontend/images/tracking.png') }}");
            background-repeat: no-repeat, repeat;
        }

        hr {
            width: 100%;
            display: block;
        }

        .invoice {
            margin: 20px auto;
            padding: 20px;
        }

        .invoice .container {
            max-width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice .main {
            padding: 60px;
            width: 90%;
        }

        .invoice .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            border-bottom: 1px solid #eee;
        }

        .invoice .header .survey_logo img {
            width: 118px;
            height: 118px;
            margin-top: 5px;
            border-radius: 50%;
        }

        .invoice .survey_logo {
            width: 80px;
            height: 80px;
            margin-bottom: 55px;
        }

        .invoice .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;

            border-top: 1px solid #eee;

        }

        .invoice .footer_area {
            padding: 0px 60px;
        }

        .invoice .footer .logo img {
            width: 60px;
            height: 35px;
            margin-top: 25px;
        }

        .invoice .footer .company-info {
            flex-grow: 1;
            text-align: right;
            line-height: 40px;
        }

        .invoice .logo {
            width: 80px;
            height: 80px;
            margin-bottom: 6%;
        }

        .invoice .company-info {
            text-align: right;
        }

        .invoice .company-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .invoice .survey-info {
            font-size: 14px;
            color: #666;
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice th {
            padding: 10px;
            text-align: center;
        }

        .invoice tbody td {
            padding: 10px;
            text-align: right !important;
        }

        .invoice thead th {
            background-color: #f2f2f2;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .text-info {
            color: #0dcaf0 !important;
        }

        .text-primary {
            color: #0d6efd !important;
        }

        .text-success {
            color: #198754 !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }
        .border-top{
            border-top: 1px solid #ddd !important;
        }


    </style>
@endpush

@section('content')
    {{-- breadcrumb --}}
    <div class="breadcrumb_sec mt-5 mb-5">
        <div class="container">
            <div class="text-center">
                <h4>Product Tracking</h4>
                <p>Track your product & see the current condition</p>
            </div>
        </div>
    </div>
    {{-- tracking start --}}
    <div class="product-tracking mb-5" style="min-height: 25rem">
        <div class="container">
            <div class="row gy-5 d-flex justify-content-center">
                <div class="tracking-bg">

                </div>

                <div class="col-md-9">
                    <div class="tracking-form mb-3">
                        <form action="{{ route('tracking') }}" method="get">
                            <div class="input-group">
                                <input class="form-control" id="traking_id" name="traking_id" type="text"
                                       value="{{ request()->traking_id ?? '' }}" placeholder="Enter your tracking id"
                                       required>
                                <button class="btn btn-primary" type="submit">Track Your Product</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if (isset(request()->traking_id) && isset($pickup_request))
                    <div class="invoice mt-0">
                        <div class="container col-md-9" id="myDiv">
                            <div class="main container-fluid">
                                <div class="header">
                                    <div class="survey_logo">
                                        <img src="{{ asset($setting->site_logo) }}"
                                             alt="Company Logo">
                                    </div>
                                    <div class="company-info">
                                        <div class="company-name">Tracking
                                            Number: {{ $pickup_request->traking_number }}</div>
                                        <div class="company-name">Due Balance: {{ getPrice($due) }}</div>
                                        <div
                                            class="survey-info">{{ date_format(date_create($pickup_request->created_at), 'd, M Y') }}</div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <h5>Pickup Details</h5>
                                        <hr>
                                        <ul style="list-style: none" class="text-left p-0 ">
                                            @if(isset($pickup_request->pickup_name))

                                                <li><strong>Pickup Name
                                                        : </strong>{{ $pickup_request->pickup_name }}</li>
                                            @endif
                                            <li><strong>Pickup Contact Name
                                                    : </strong>{{ $pickup_request->pickup_contact_name }}</li>
                                            <li><strong>Pickup Address
                                                    : </strong>{{ $pickup_request->pickup_address }}</li>
                                            <li><strong>Pickup State
                                                    : </strong>{{ $pickup_request->hasPickupState->name ?? "" }}</li>
                                            <li><strong>Pickup City
                                                    : </strong>{{ $pickup_request->city->name ?? 'N/A' }}</li>
                                            <li><strong>Pickup Zip : </strong>{{ $pickup_request->pickup_zip }}
                                            </li>
                                            <li><strong>Pickup Mobile
                                                    : </strong>{{ $pickup_request->pickup_mobile }}</li>
                                            <li><strong>Pickup Email
                                                    : </strong>{{ $pickup_request->pickup_email }}</li>
                                            <li><strong>
                                                    Published Status:</strong>
                                                @if ($pickup_request->status == 0)
                                                    <strong class="text-warning ">Pending</strong>
                                                @elseif($pickup_request->status == 1)
                                                    <strong class="text-info ">Assigned</strong>
                                                @elseif($pickup_request->status == 2)
                                                    <strong class="text-primary ">Picked</strong>
                                                @elseif($pickup_request->status == 3)
                                                    <strong class="text-success ">Delivered</strong>
                                                @elseif($pickup_request->status == 4)
                                                    <strong class="text-danger ">Delivered</strong>
                                                @endif
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-end">Delivery Details</h5>
                                        <hr>
                                        <ul style="list-style: none" class="text-end">
                                            <li><strong>Delivery
                                                    Name : </strong>{{ $pickup_request->delivery_name }}</li>
                                            <li><strong>Delivery Contact
                                                    name : </strong>{{ $pickup_request->delivery_contact_name }}
                                            </li>
                                            <li><strong>Delivery
                                                    Address : </strong>{{ $pickup_request->delivery_address }}
                                            </li>
                                            <li><strong>Delivery State
                                                    : </strong>{{ $pickup_request->hasDeliveryState->name ?? "" }}
                                            </li>
                                            <li><strong>Delivery
                                                    City : </strong>{{ $pickup_request->city->name ?? 'N/A' }}
                                            </li>
                                            <li><strong>Delivery
                                                    Zip : </strong>{{ $pickup_request->delivery_zip }}</li>
                                            <li><strong>Delivery
                                                    Mobile : </strong>{{ $pickup_request->delivery_mobile }}</li>
                                            <li>
                                                <strong>Date
                                                    : </strong>{{ date('d M Y', strtotime($pickup_request->created_at)) }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <hr>
                                        <div class="table-responsive">
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product/Details</th>
                                                    <th style="width: 15%;"></th>
                                                    <th style="width: 15%;">Amount</th>
                                                </tr>
                                                </thead>
                                                <!-- Repeat the following block for each item -->
                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td class="text-left">
                                                        {{ $pickup_request->product_name }}
                                                        ({{$pickup_request->weights->name}})
                                                    </td>
                                                    <td></td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Delivery Cost</td>
                                                    <td>{{ $pickup_request->quantity }}
                                                        x{{ number_format($pickup_request->unit_amount, 2) }}</td>
                                                    <td>{{ getPrice($pickup_request->amount) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="pt-0">COD Amount</td>
                                                    <td colspan="2"
                                                        class="pt-0">{{ getPrice($pickup_request->cod_amount) }}</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2" class="pt-0">Sub Total</td>
                                                    <td colspan="2" class="pt-0">{{ getPrice($total) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="pt-0">Tax</td>
                                                    <td colspan="2" class="pt-0">{{ getPrice(0) }}</td>
                                                </tr>
                                                <tr class="border-top">
                                                    <td colspan="2"><strong>Total</strong></td>
                                                    <td colspan="2"><strong>{{ getPrice($total) }}</strong></td>
                                                </tr>
                                                <tr class="text-success">
                                                    <td colspan="2" class="pt-0"><strong>Paid</strong></td>
                                                    <td colspan="2" class="pt-0"><strong>{{ getPrice($paid) }}</strong>
                                                    </td>
                                                </tr>
                                                <tr class="border-top text-danger">
                                                    <td colspan="2"><strong>Due</strong></td>
                                                    <td colspan="2"><strong>{{ getPrice($due) }}</strong></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <h5>Terms and Conditions</h5>
                                        <hr>
                                        {!! $pickup_request->description !!}
                                    </div>
                                </div>
                                <div class="footer mt-5">
                                    <div class="company-info">
                                        Powered by {{ $setting->site_name }}
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="buttons text-center mb-5 mt-4 mb-5">
                                <a class="print-button btn btn-outline-success px-4" id="printBtn"
                                   onclick="printDiv('myDiv')">Print</a>
                            </div> --}}
                        </div>
                    </div>
                @elseif(isset(request()->traking_id) && !isset($pickup_request))
                    <div class="col-lg-8">
                        <div class="tracking-pro-content text-center text-danger">
                            <h4>Invalid Tracking Number</h4>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    function printDiv(divId) {
        let printContents = $('#' + divId).html();
        let originalContents = $('body').html();
        let $printContents = $(printContents); // Wrap in jQuery object
        $printContents.find('#printBtn').addClass('d-none');
        $('body').html($printContents);
        window.print();
        $('body').html(originalContents);
    }
</script>
@endpush
