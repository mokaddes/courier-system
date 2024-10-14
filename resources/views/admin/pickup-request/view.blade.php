@extends('admin.layouts.master')
@section('pickup-request', 'active')
@section('order-management', 'menu-open')
@section('title')
    Pickup Request Details
@endsection

@push('style')
    <style>
        hr {
            width: 100%;
            display: block;
        }
    </style>
    <style>

        .container {
            max-width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .main {
            padding: 60px;
            width: 90%;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            border-bottom: 1px solid #eee;
        }

        .header .survey_logo img {
            width: 118px;
            height: 118px;
            margin-top: 5px;
            border-radius: 50%;
        }

        .survey_logo {
            width: 80px;
            height: 80px;
            margin-bottom: 55px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;

            border-top: 1px solid #eee;

        }

        .footer_area {
            padding: 0px 60px;
        }

        .footer .logo img {
            width: 60px;
            height: 35px;
            margin-top: 25px;
        }

        .footer .company-info {
            flex-grow: 1;
            text-align: right;
            line-height: 40px;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin-bottom: 6%;
        }

        .company-info {
            text-align: right;
        }

        .company-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .survey-info {
            font-size: 14px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            padding: 10px;
            text-align: center;
        }

        tbody td {
            padding: 10px;
            text-align: right !important;
        }

        thead th {
            background-color: #f2f2f2;
        }


    </style>
@endpush
{{-- @php
    $user = $data['user'];
@endphp --}}
@section('content')
    <div class="content-wrapper pb-5">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pickup Request Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pickup Request</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container w-75" id="myDiv">
            <div class="main container-fluid">
                <div class="header">
                    <div class="survey_logo">
                        <img src="{{ asset($setting->site_logo) }}"
                             alt="Company Logo">
                    </div>
                    <div class="company-info">
                        <div class="company-name">Tracking Number: {{ $pickup_request->traking_number }}</div>
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
                                    <span class="btn btn-xs btn-warning status">Pending</span>
                                @elseif($pickup_request->status == 1)
                                    <span class="btn btn-xs btn-info status">Assigned</span>
                                @elseif($pickup_request->status == 2)
                                    <span class="btn btn-xs btn-primary status">Picked</span>
                                @elseif($pickup_request->status == 3)
                                    <span class="btn btn-xs btn-success status">Delivered</span>
                                @elseif($pickup_request->status == 4)
                                    <span class="btn btn-xs btn-danger status">Delivered</span>
                                @endif
                            </li>

                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-right">Delivery Details</h5>
                        <hr>
                        <ul style="list-style: none" class="text-right">
                            <li><strong>Delivery
                                    Name : </strong>{{ $pickup_request->delivery_name }}</li>
                            <li><strong>Delivery Contact
                                    name : </strong>{{ $pickup_request->delivery_contact_name }}
                            </li>
                            <li><strong>Delivery
                                    Address : </strong>{{ $pickup_request->delivery_address }}
                            </li>
                            <li><strong>Delivery State : </strong>{{ $pickup_request->hasDeliveryState->name ?? "" }}
                            </li>
                            <li><strong>Delivery
                                    City : </strong>{{ $pickup_request->city->name ?? 'N/A' }}
                            </li>
                            <li><strong>Delivery
                                    Zip : </strong>{{ $pickup_request->delivery_zip }}</li>
                            <li><strong>Delivery
                                    Mobile : </strong>{{ $pickup_request->delivery_mobile }}</li>
                            <li>
                                <strong>Date : </strong>{{ date('d M Y', strtotime($pickup_request->created_at)) }}
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product/Details</th>
                                    <th></th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <!-- Repeat the following block for each item -->
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td class="text-left">
                                        {{ $pickup_request->product_name }} ({{$pickup_request->weights->name}})
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
                                    <td colspan="2" class="pt-0">{{ getPrice($pickup_request->cod_amount) }}</td>
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
                                    <td colspan="2" class="pt-0"><strong>{{ getPrice($paid) }}</strong></td>
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

            <div class="buttons text-center mb-5 mt-4 mb-5">
                <a class="print-button btn btn-outline-success px-4" id="printBtn"
                   onclick="printDiv('myDiv')">Print</a>
            </div>
        </div>
    </div>

@endsection
@push('script')
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
