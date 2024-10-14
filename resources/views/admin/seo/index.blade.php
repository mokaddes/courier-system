@extends('admin.layouts.master')

@section('settings_menu', 'menu-open')

@section('seo', 'active')
@section('title') {{ __('SEO') }} @endsection

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
                                        <h3 class="card-title">Manage SEO </h3>
                                    </div>

                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap jsgrid-table" id="dataTables">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th width="30%">Title</th>
                                            <th width="40%">Description</th>
                                            <th width="10%">Image</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($seos as $key => $value)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $value->title }}</td>
                                                <td >{{ $value->description }}</td>
                                                <td >
                                                    <img src="{{ asset($value->image) }}" alt="Seo Image" width="65px">
                                                </td>
                                                <td>
                                                    @if (Auth::user()->can('admin.seo.update'))
                                                    <a href="{{ route('admin.seo.edit', $value->id) }}" class="btn btn-info">
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
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


