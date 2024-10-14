@extends('admin.layouts.master')
@push('style')
    <style>
        .img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 100px;
            height: 120px;
        }
    </style>
@endpush
@section('merchant_menu', 'menu-open')

@section('merchant_menu', 'active')

@section('title') Merchant | Details @endsection

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Merchant') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Merchant') }}</li>
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
                                <h5 class="m-0">{{ __('Merchant Details') }}
                                    <div class="float-right">
                                        <a class="btn btn-primary" href="{{ route('admin.merchant.index') }}">Back</a>

                                    </div>
                                </h5>
                            </div>
                            <div class="card-body table-responsive p-0">

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-2">
                                    <div class="row">

                                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    @if ($merchant_request->profile_pic)
                                                        <img class="img-fluid"
                                                            src="{{ asset($merchant_request->profile_pic) }}"
                                                            alt="profile_pic" style="height: 200px;width:250px;">
                                                    @else
                                                        <img class="img" src="{{ asset('uploads/default-user.png') }}"
                                                            alt="profile_pic">
                                                    @endif
                                                </div>
                                                <h5 class="text-center mt-2">Profile Picture</h5>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    @if ($merchant_request->id_font_image)
                                                        <img class="img-fluid"
                                                            src="{{ asset($merchant_request->id_font_image) }}"
                                                            alt="admin user image" style="height: 200px;width:250px;">
                                                    @else
                                                        <img class="img" src="{{ asset('uploads/default-user.png') }}"
                                                            alt="admin user image">
                                                    @endif
                                                </div>
                                                <h5 class="text-center mt-2">Id Font Side</h5>

                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    @if ($merchant_request->id_back_image)
                                                        <img class="img-fluid"
                                                            src="{{ asset($merchant_request->id_back_image) }}"
                                                            alt="admin user image" style="height: 200px;width:250px;">
                                                    @else
                                                        <img class="img" src="{{ asset('uploads/default-user.png') }}"
                                                            alt="admin user image">
                                                    @endif
                                                </div>
                                                <h5 class="text-center mt-2">Id Back Side</h5>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped">

                                    <tr>
                                        <td style="width: 20%">Business Name</td>
                                        <td class="text-start" style="width: 80%">{{ $merchant_request->business_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Owner's Full Name</td>
                                        <td class="text-start" style="width: 80%">
                                            {{ $merchant_request->business_owner_name }}</td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <td style="width: 20%">Business Owner Phone</td>
                                        <td class="text-start" style="width: 80%">
                                            {{ $merchant_request->business_owner_phone }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Business Email</td>
                                        <td class="text-start" style="width: 80%">{{ $merchant_request->business_email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Address Line</td>
                                        <td class="text-start" style="width: 80%">{{ $merchant_request->address_line }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Street Address</td>
                                        <td class="text-start" style="width: 80%">{{ $merchant_request->street_address }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">State / Province / Region</td>
                                        <td class="text-start" style="width: 80%">{{ $merchant_request->state }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">City</td>
                                        <td class="text-start" style="width: 80%">{{ $merchant_request->city }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">ZIP / Postal Code</td>
                                        <td class="text-start" style="width: 80%">{{ $merchant_request->zip_code }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Bank Name</td>
                                        <td class="text-start" style="width: 80%">{{ $merchant_request->bank_name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Branch Name</td>
                                        <td class="text-start" style="width: 80%">{{ $merchant_request->bank_branch_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Account Type</td>
                                        <td class="text-start" style="width: 80%">{{ $merchant_request->account_type }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Account Holder Name</td>
                                        <td class="text-start" style="width: 80%">
                                            {{ $merchant_request->account_holder_name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Account Number</td>
                                        <td class="text-start" style="width: 80%">{{ $merchant_request->account_number }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">ID Type</td>
                                        <td class="text-start" style="width: 80%">{{ $merchant_request->id_type }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">ID Number</td>
                                        <td class="text-start" style="width: 80%">{{ $merchant_request->id_number }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Status</td>
                                        <td class="text-start" style="width: 80%">
                                            @if ($merchant_request->status == '0')
                                                In-active
                                            @elseif ($merchant_request->status == '2')
                                                Pending Request
                                            @elseif ($merchant_request->status == '1')
                                                Active
                                            @endif
                                        </td>
                                    </tr>

                                </table>

                            </div>

                            @if ($merchant_request->status != 1)
                                <form
                                    action="{{ route('admin.merchant-request.approved', ['merchant_request' => $merchant_request->id]) }}"
                                    method="post">
                                    @csrf
                                    <div class="d-flex justify-content-center m-3">
                                        @if ($merchant_request->status == '0')
                                            <button class="btn btn-success">Active</button>
                                        @elseif ($merchant_request->status == '2')
                                            <button class="btn btn-success">Approved</button>
                                        @endif
                                    </div>

                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
