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

@section('merchant_user', 'active')

@section('title') Merchant | Details @endsection

@section('content')
    @php
        $userr = Auth::user();
    @endphp
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
                                                    @if ($admin->profile_pic)
                                                        <img class="img-fluid" src="{{ asset($admin->profile_pic) }}"
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
                                                    @if ($admin->id_font_image)
                                                        <img class="img-fluid" src="{{ asset($admin->id_font_image) }}"
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
                                                    @if ($admin->id_back_image)
                                                        <img class="img-fluid" src="{{ asset($admin->id_back_image) }}"
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
                                <div class="row m-2">
                                    <div class="col-12 com-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <table class="table table-bordered">

                                            <tr>
                                                <td style="width: 30%">Name</td>
                                                <td class="text-start" style="width: 80%">{{ $admin->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Balance</td>
                                                <td class="text-start" style="width: 80%">{{ $admin->balance ?? 0 }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Email</td>
                                                <td class="text-start" style="width: 80%">{{ $admin->email }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Owner's Full Name</td>
                                                <td class="text-start" style="width: 80%">
                                                    {{ $admin->business_owner_name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Business Name</td>
                                                <td class="text-start" style="width: 80%">
                                                    {{ $admin->business_name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Business Owner Phone</td>
                                                <td class="text-start" style="width: 80%">{{ $admin->business_owner_phone }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Business Email</td>
                                                <td class="text-start" style="width: 80%">{{ $admin->business_email }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Address Line</td>
                                                <td class="text-start" style="width: 80%">{{ $admin->address_line }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Street Address</td>
                                                <td class="text-start" style="width: 80%">{{ $admin->hasState->name ?? '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">State / Province / Region</td>
                                                <td class="text-start" style="width: 80%">{{ $admin->state }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-12 com-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td style="width: 30%">City</td>
                                                <td class="text-start" style="width: 80%">{{ $admin->city }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">ZIP / Postal Code</td>
                                                <td class="text-start" style="width: 80%">{{ $admin->zip_code }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Bank Name</td>
                                                <td class="text-start" style="width: 80%">{{ $admin->bank_name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Branch Name</td>
                                                <td class="text-start" style="width: 80%">{{ $admin->bank_branch_name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Account Type</td>
                                                <td class="text-start" style="width: 80%">{{ $admin->account_type }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Account Holder Name</td>
                                                <td class="text-start" style="width: 80%">
                                                    {{ $admin->account_holder_name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">Account Number</td>
                                                <td class="text-start" style="width: 80%">{{ $admin->account_number }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">ID Type</td>
                                                <td class="text-start" style="width: 80%">{{ $admin->id_type }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%">ID Number</td>
                                                <td class="text-start" style="width: 80%">{{ $admin->id_number }}</td>
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
    </div>
@endsection
