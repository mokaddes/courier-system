@extends('admin.layouts.master')
@section('dashboard', 'active')

@section('title') {{ $data['title'] ?? '' }} @endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $data['title'] ?? 'Page Header' }} - {{Auth::user()->name}} (<span class="text-capitalize">{{Auth::guard('admin')->user()->getRoleNames()->first()}}</span>)</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @if(Auth::user()->is_merchant != 1 && Auth::user()->is_deliveryman != 1)
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Pickup Requets</span>
                                    <span class="info-box-number">{{ $data['totalPickup'] ?? 00 }}</span>
                                </div>
                                <a class="stretched-link" href="{{ route('admin.pickup-request.index') }}"></a>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->is_merchant != 1 && Auth::user()->is_deliveryman != 1)
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text">Merchant's Pending Pickup Request</span>
                                    <span class="info-box-number">{{ $data['pendingPickupmerchant'] ?? 00 }}</span>
                                </div>
                                <a class="stretched-link" href="{{ route('admin.pickup-request.index', ['status' => 'pending', 'type'=>'merchant']) }}"></a>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->is_merchant != 1 && Auth::user()->is_deliveryman != 1)
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text">Guest's Pending Pickup Request</span>
                                    <span class="info-box-number">{{ $data['pendingPickupGuest'] ?? 00 }}</span>
                                </div>
                                <a class="stretched-link" href="{{ route('admin.pickup-request.index', ['status' => 'pending', 'type'=>'guest']) }}"></a>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->is_merchant != 1 && Auth::user()->is_deliveryman != 1)
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Merchant</span>
                                    <span class="info-box-number">{{ $data['total_merchant'] }}</span>
                                </div>
                                <a class="stretched-link" href="{{ route('admin.merchant.index') }}"></a>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->is_merchant != 1 &&  Auth::user()->is_deliveryman != 1)
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text">Pending Recharge Request</span>
                                    <span class="info-box-number">{{ $data['pending_recharge_request'] }}</span>
                                </div>
                                <a class="stretched-link" href="{{ route('admin.merchant.recharge.request', ['status' => 'pending']) }}"></a>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->is_merchant != 1 &&  Auth::user()->is_deliveryman != 1)
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Deliveryman</span>
                                    <span class="info-box-number">{{ $data['total_deliveryman'] ?? 00 }}</span>
                                </div>
                                <a class="stretched-link" href="{{ route('admin.deliveryman.index') }}"></a>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->is_merchant == 1)
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Pickup Request</span>
                                    <span class="info-box-number">{{ $data['total_merchantPickup_request'] ?? 00 }}</span>
                                </div>
                                <a class="stretched-link" href="{{ route('admin.pickup-request.index') }}"></a>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->is_deliveryman == 1)
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Pickup Request</span>
                                    <span class="info-box-number">{{ $data['total_deliverymanpickup_request'] ?? 00 }}</span>
                                </div>
                                <a class="stretched-link" href="{{ route('admin.pickup-request.index') }}"></a>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->is_merchant == 1)
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text">Current Balance</span>
                                    <span class="info-box-number">{{ getPrice($data['total_current_ballance']->topup_blance)?? 00 }}</span>
                                </div>
                                <a class="stretched-link" href="{{ route('admin.merchant.transaction.index') }}"></a>
                            </div>
                        </div>
                    @endif
                    {{-- <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <div class="info-box-content">
                                <span class="info-box-text">Total Custome Page</span>
                                <span class="info-box-number">00</span>
                            </div>
                            <a class="stretched-link" href="#"></a>
                        </div>
                    </div> --}}
                </div>

            </div>
        </div>
    </div>

@endsection
