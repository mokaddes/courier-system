@extends('admin.layouts.master')

@section('price_menu', 'menu-open')

@section('price_group', 'active')

@section('title') {{ $data['title'] ?? '' }} @endsection

@push('style')
@endpush

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $data['title'] ?? '' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ $data['title'] ?? '' }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h3 class="card-title">{{ $data['title'] ?? '' }} </h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">

                                            <a class="btn btn-primary"
                                                href="{{ route('admin.price-group.index') }}">Back</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form
                                action="{{ route('admin.price-group.update', ['price_group' => $data['price_group']->id]) }}"
                                method="post">
                                @csrf
                                <div class="card-body">

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                                <div class="form-group">
                                                    <label class="form-label required" for="name" >Group Name</label>
                                                    <input class="form-control @error('name') border-danger @enderror"
                                                        id="" name="name" type="text"
                                                        value="{{ old('name') ? old('name') : $data['price_group']->name ?? '' }}" required>
                                                    @error('name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                                <div class="form-group">
                                                    <label class="form-label required" for="name">Group Code</label>
                                                    <input class="form-control @error('code') border-danger @enderror"
                                                           id="" name="code" type="text"
                                                           value="{{ old('code') ? old('code') : $data['price_group']->code ?? '' }}" required>
                                                    @error('code')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                                <div class="form-group">
                                                    <label class="form-label required" for="order">Order</label>
                                                    <input class="form-control @error('order') border-danger @enderror"
                                                        id="" name="order" type="text"
                                                        value="{{ old('order') ? old('order') : $data['price_group']->order_id ?? '' }}" required>
                                                    @error('order')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                                <div class="form-group">
                                                    <label class="form-label required" for="status">Status</label>
                                                    <select class="form-control @error('status') border-danger @enderror"
                                                        id="" name="status" required>
                                                        <option value="1"
                                                            @if ($data['price_group']->status == '1') selected @endif>Active
                                                        </option>
                                                        <option value="0"
                                                            @if ($data['price_group']->status == '0') selected @endif>Inactive
                                                        </option>
                                                    </select>
                                                    @error('status')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="card-footer text-center">
                                    <button class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
@endpush
