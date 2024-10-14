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
@section('merchant_menu', 'menu-open')

@section('merchant_menu', 'active')

@section('title') Merchant @endsection

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
                                <h5 class="m-0">{{ __('Merchant List') }}
                                    <div class="float-right">
                                        <a class="btn btn-primary" href="{{ route('admin.merchant.create') }}">Add New</a>
                                    </div>
                                </h5>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap jsgrid-table" id="dataTables">
                                    <thead>
                                        <tr>
                                            <th width="5%">Sl</th>
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Business Name') }}</th>
                                            <th>{{ __('Business Owner Name') }}</th>
                                            <th>{{ __('Business Owner Email') }}</th>
                                            <th>{{ __('Business Owner Phone') }}</th>
                                            <th>{{ __('Approved') }}</th>
                                            <th width="10%">{{ __('action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($merchantRequests) && $merchantRequests->count() > 0)
                                            @foreach ($merchantRequests as $key => $merchantRequest)
                                                <tr>
                                                    <td></td>

                                                    <td>
                                                        @if ($merchantRequest->image)
                                                            <img class="img" src="{{ asset($merchantRequest->image) }}"
                                                                alt="Image">
                                                        @else
                                                            <img class="img"
                                                                src="{{ asset('uploads/default-user.png') }}"
                                                                alt="Image">
                                                        @endif
                                                    </td>
                                                    <td>{{ $merchantRequest->business_name }}</td>
                                                    <td>{{ $merchantRequest->business_owner_name }}</td>
                                                    <td>{{ $merchantRequest->business_email }}</td>
                                                    <td>{{ $merchantRequest->business_owner_phone }}</td>
                                                    <td>{{ $merchantRequest->status ? 'Approved' : 'Pending' }}</td>
                                                    <td>
                                                        @if (Auth::user()->can('admin.merchant-request.show'))
                                                            <a class="btn btn-secondary btn-sm" id=""
                                                                href="{{ route('admin.merchant-request.show', ['merchant_request' => $merchantRequest->id]) }}"><i
                                                                    class="fa fa-eye"></i></a>
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
@endsection
