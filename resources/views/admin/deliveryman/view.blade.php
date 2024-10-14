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
@section('deliveryman_menu', 'menu-open')

@section('deliveryman_list', 'active')

@section('title') Delivery Man | Details @endsection

@section('content')
    @php
        $userr = Auth::user();
    @endphp
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Delivery Man') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Delivery Man') }}</li>
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
                                <h5 class="m-0">{{ __('Delivery Man Details') }}
                                    <div class="float-right">
                                        <a class="btn btn-primary" href="{{ route('admin.deliveryman.index') }}">Back</a>

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
                                <table class="table table-striped">

                                    <tr>
                                        <td style="width: 20%">Name</td>
                                        <td class="text-start" style="width: 80%">{{ $admin->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Email</td>
                                        <td class="text-start" style="width: 80%">{{ $admin->email }}
                                        </td>
                                    </tr>

                                    <tr>
                                    <tr>
                                        <td style="width: 20%">Phone Number</td>
                                        <td class="text-start" style="width: 80%">
                                            {{ $admin->business_owner_phone }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Address Line</td>
                                        <td class="text-start" style="width: 80%">{{ $admin->address_line }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Street Address</td>
                                        <td class="text-start" style="width: 80%">{{ $admin->hasState->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">State / Province / Region</td>
                                        <td class="text-start" style="width: 80%">{{ $admin->state }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">City</td>
                                        <td class="text-start" style="width: 80%">{{ $admin->city }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">ZIP / Postal Code</td>
                                        <td class="text-start" style="width: 80%">{{ $admin->zip_code }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Bank Name</td>
                                        <td class="text-start" style="width: 80%">{{ $admin->bank_name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Branch Name</td>
                                        <td class="text-start" style="width: 80%">{{ $admin->bank_branch_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Account Type</td>
                                        <td class="text-start" style="width: 80%">{{ $admin->account_type }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Account Holder Name</td>
                                        <td class="text-start" style="width: 80%">
                                            {{ $admin->account_holder_name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Account Number</td>
                                        <td class="text-start" style="width: 80%">{{ $admin->account_number }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">ID Type</td>
                                        <td class="text-start" style="width: 80%">{{ $admin->id_type }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">ID Number</td>
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
@endsection
