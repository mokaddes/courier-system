@extends('admin.layouts.master')

@section('cms_menu', 'menu-open')
@section('ecommerce', 'active')
@section('title') {{ $data['title'] ?? '' }} @endsection

@push('style')
    <style>
        .search-control {
            width: 100% !important;
        }
    </style>
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
                                        <h3 class="card-title">Create {{ $data['title'] ?? '' }} </h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            <a href="{{route('admin.cms.ecommerceService.index')}}" class="btn btn-primary btn-sm">Back</a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <form action="{{ route('admin.cms.ecommerceService.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <img id="preview" src="{{ asset('images/default.png') }}" height="150px" />
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                                <label class="form-label required">{{ __('Image') }} <span
                                                        class="text-danger">({{ __('Recommended size : 180x60') }})</span>
                                                </label>
                                                <input class="form-control" name="image" type="file"
                                                    placeholder="{{ __('image') }}..." accept=".png,.jpg,.jpeg,.gif,.svg"
                                                    onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])" />

                                            </div>

                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label required" for="title">Title</label>
                                                    <input
                                                        class="form-control required @error('title') border-danger @enderror"
                                                        id="title" name="title" type="text"
                                                        value="{{ old('title') }}" required>
                                                    @error('title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label required" for="title">Order</label>
                                                    <input
                                                        class="form-control required @error('order') border-danger @enderror"
                                                        id="order" name="order" type="number"
                                                        value="{{ old('order') }}"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                        required>
                                                    @error('order')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <div class="form-group">
                                                    <label class="form-label required" for="description">Description</label>
                                                    <textarea class="form-control required @error('description') border-danger @enderror" id="summernote" name="description"
                                                        type="text" value="{{ old('description') }}" rows="10" required></textarea>
                                                    @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-2 text-center">

                                                <button class="btn btn-success" type="submit">Save</button>
                                            </div>

                                        </div>
                                    </form>
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
