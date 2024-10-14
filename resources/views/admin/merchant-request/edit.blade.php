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

@section('merchant_user', 'active')

@section('title') Merchant | Update @endsection

@push('style')
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Merchant user update') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Merchant update') }}</li>
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
                                <h5 class="m-0">{{ __('Merchant Update') }}
                                    <span class="float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.merchant.index') }}">
                                            Back</a>
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.merchant.update', $admin->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">

                                            <label class="form-label" for="email">Image </label>
                                            <input class="form-control @error('image') is-invalid @enderror" name="image"
                                                type="file">
                                            @if ($errors->has('image'))
                                                <span class="text-danger text-left">{{ $errors->first('image') }}</span>
                                            @endif
                                            @if ($admin->image)
                                                <img class="img mt-2" src="{{ asset($admin->image) }}" alt="Image">
                                            @else
                                                <img class="img mt-2" src="{{ asset('uploads/default-user.png') }}"
                                                    alt="Image">
                                            @endif
                                        </div>

                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label" for="name">Name *</label>
                                            <input class="form-control @error('name') is-invalid @enderror" name="name"
                                                type="text" value="{{ $admin->name }}" placeholder="Name"
                                                autocomplete="off" required>

                                            @if ($errors->has('name'))
                                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label" for="email">Email *</label>
                                            <input class="form-control @error('email') is-invalid @enderror" name="email"
                                                type="email" value="{{ $admin->email }}" placeholder="Email address"
                                                autocomplete="off" required>
                                            @if ($errors->has('email'))
                                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label" for="password">Password </label>
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                name="password" type="password" value="{{ old('password') }}"
                                                placeholder="Enter Password" autocomplete="off">
                                            @if ($errors->has('password'))
                                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>

                                    </div>

                                    <button class="btn btn-primary" type="submit">Update</button>
                                </form>
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
