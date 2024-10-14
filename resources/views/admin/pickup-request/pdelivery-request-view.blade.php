@extends('admin.layouts.master')
@push('style')
    <style>
        .img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 80px;
            height: 70px;
        }
    </style>
@endpush
@section('order-management', 'menu-open')

@section('pending-for-delivery', 'active')

@section('title') Delivery Man Pending Request View @endsection

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Delivery Man Pending Request View') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Delivery Man Pending Request View') }}</li>
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
                                    <h5 class="m-0">{{ __('Delivery Man Pending Request View') }}
                                        <div class="float-right">
                                            {{-- @if (Auth::user()->can('admin.deliveryman.create'))
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('admin.deliveryman.create') }}">Add
                                                    New</a>
                                            @endif --}}
                                        </div>
                                    </h5>
                                </div>

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap jsgrid-table" id="dataTables">
                                        <tr>
                                            <td widht="20%">Tracking Number</td>
                                            <td widht="80%">{{ $pdelivery_reqs->pickupRequest->traking_number?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pickup Name</td>
                                            <td>{{ $pdelivery_reqs->pickupRequest->pickup_contact_name?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td>{{ date('d M Y', strtotime($pdelivery_reqs->pickupRequest->created_at))?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <td>Delivery Name</td>
                                            <td>{{ $pdelivery_reqs->hasDeliveryman->name?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <td>Delivery Email</td>
                                            <td>{{ $pdelivery_reqs->hasDeliveryman->email?? "" }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>
                                                @if($pdelivery_reqs->status == 1)
                                                <span class="badge bg-success">Accepted</span>
                                                @elseif($pdelivery_reqs->status == 0)
                                                <span class="badge bg-danger">pending </span>
                                                @else
                                                <span class="badge bg-secondary">already accepted By Others</span>
                                                @endif
                                            </td>
                                        </tr>
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
