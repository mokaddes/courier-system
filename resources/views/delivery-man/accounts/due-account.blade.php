@extends('admin.layouts.master')

@section('accounts_menu', 'menu-open')

@section('due_account_menu', 'active')

@section('title')
    COD Amount
@endsection

@push('style')
    <style>
        .status {
            cursor: default !important;
            min-width: 60px !important;
        }

        .payment {
            cursor: default !important;
            min-width: 50px !important;
        }

        .select2-container {
            display: block !important;

        }

        .select2-container .select2-selection--multiple {

            min-height: 42px !important;

        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #6c757d !important;
            border: 1px solid #725a5a !important;


        }


    </style>
@endpush
@php
    $status = [
        0 => 'Pending',
        1 => 'Active',
        2 => 'Waiting for Delivery Man',
        3 => 'Picked By Delivery Man',
        4 => 'Delivered',
        5 => 'Returned'
    ];
@endphp
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('COD Amount') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                        href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('COD Amount') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0">{{ __('COD Amount') }}</h5>
                            </div>
                            <div class="card-body">

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap jsgrid-table" id="dataTables">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Order Info</th>
                                            <th>Merchant/Guest</th>
                                            <th>Price</th>
                                            <th>Status</th>

                                            <th>Receivable Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($rows) && count($rows) > 0)
                                            @foreach ($rows as $key => $row)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td style="max-width: 150px;">
                                                        <p class="mb-0">Tracking number : {{ $row->traking_number }}</p>
                                                        <p class="mb-0">Order number : #{{ $row->id }}</p>
                                                        <p class="mb-0">Phone : {{ $row->pickup_mobile }}</p>
                                                        <p class="mb-0">Date : {{ date('d M Y', strtotime($row->created_at)) }}</p>

                                                    </td>

                                                    <td>
                                                        @if (isset($row->merchant_id))
                                                            <a href="#">{{ $row->hasMerchant->name ?? '' }}</a>
                                                        @else
                                                            Guest
                                                        @endif
                                                        <p>Deliveryman : {{ $row->hasDeliveryman->name ?? '' }}</p>

                                                    </td>

                                                    <td>
                                                        <p class="mb-0">Delivery cost : {{ getprice($row->amount) }}
                                                            @if ($row->payment_status == 1)
                                                                - Paid
                                                            @else
                                                                - Unpaid

                                                            @endif

                                                        </p>
                                                        <p class="mb-0">COD amount : {{ getprice($row->cod_amount) }}</p>
                                                    </td>
                                                    <td>

                                                        <span class="btn btn-xs btn-info status">{{ $status[$row->status] ?? '' }}</span>


                                                    </td>

                                                    <td>

                                                        @php
                                                            $cod_amount  = $row->cod_amount;
                                                        @endphp
                                                        @if ($row->payment_status == "0")
                                                            @php
                                                                $cod_amount  += $row->amount;
                                                            @endphp
                                                        @endif

                                                        {{ getprice($cod_amount) }}
                                                        @if($row->cod_received_by_admin == 0)
                                                            <p>Received By Admin: <a href="{{ route('admin.accounts.duereceive',$row->id) }}" onclick="return confirm('Are you sure, Deliveryman gave to admin?')">No</a></p>
                                                        @endif

                                                        @if($row->cod_received_by_admin == 1)
                                                            <p>Received By Admin: <a href="#">Yes</a></p>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
