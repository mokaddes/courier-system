@extends('admin.layouts.master')

@section('cms_menu', 'menu-open')
@section('our_service', 'active')
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
                                        <h3 class="card-title">{{ $data['title'] ?? '' }} </h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            <a href="{{route('admin.cms.ourservice.index')}}" class="btn btn-primary btn-sm">Back</a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl 12">
                                    <form
                                        action="{{ route('admin.cms.ourservice.update', ['our_service' => $our_service->id]) }}"
                                        method="POST">
                                        @csrf
                                        <input id="icon" name="icon" type="hidden"
                                            value="{{ old('icon') ? old('icon') : $our_service->icon ?? '' }}">

                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <label for="icon-picker" class="required">Pick the icon</label>
                                                <div id="target"
                                                    data-icon="{{ old('icon') ? old('icon') : $our_service->icon ?? '' }}"
                                                    data-name="icon"></div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                <div class="form-group">

                                                    <label for="icon-picker" class="required">Title</label>
                                                    <input
                                                        class="form-control required @error('title') border-danger @enderror"
                                                        id="title" name="title" type="text"
                                                        value="{{ old('title') ? old('title') : $our_service->title ?? '' }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                <div class="form-group">

                                                    <label for="icon-picker" class="required">Order </label>
                                                    <input
                                                        class="form-control required @error('order') border-danger @enderror"
                                                        id="" name="order" type="number"
                                                        value="{{ old('order') ? old('order') : $our_service->sort_order ?? '' }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                <div class="form-group">

                                                    <label for="icon-picker" class="required">Description</label>
                                                    <textarea name="description" id="description" cols="30" rows="2" class="form-control required @error('description') border-danger @enderror">{{ $our_service->description }}</textarea>
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
    <script src="{{ asset('backend/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
    <script>
        $('#target').iconpicker({
            align: 'center', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-left',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: 10,
            footer: true,
            header: true,
            icon: "{{ old('icon') ? old('icon') : $our_service->icon ?? '' }}",
            iconset: 'fontawesome5',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom', // Only in button tag
            rows: 5,
            search: true,
            searchText: 'Search',
            selectedClass: 'btn-success',
            unselectedClass: ''
        });
        $('#target').on('change', function(e) {
            $('#icon').val(e.icon);
        });
    </script>
@endpush
