@extends('admin.layouts.master')

@section('settings_menu', 'menu-open')

@section('seo', 'active')
@section('title') {{ __('SEO') }} @endsection
@push('style')
<style>
    .img-style {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 130px;
    height: 100px;
  }
</style>
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">SEO</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">SEO</li>
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
                                        <h3 class="card-title">SEO Update</h3>
                                    </div>

                                </div>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('admin.seo.update', $seo->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        @if($seo->image)
                                        <div class="col-lg-12 text-center">
                                            <img src="{{ asset($seo->image) }}" alt="" class="img-style">
                                        </div>
                                        @endif
                                        
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" name="title" class="form-control" value="{{ $seo->title }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Image</label>
                                                <input type="file" name="image" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{ $seo->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 p-3">
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-info">Update</button>
                                            </div>
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
@endsection


