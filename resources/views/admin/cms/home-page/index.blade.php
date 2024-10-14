@extends('admin.layouts.master')

@section('cms_menu', 'menu-open')
@section('our_service', 'active')
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
                                        <h3 class="card-title">Manage {{ $data['title'] ?? '' }} </h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            @if (Auth::user()->can('admin.cms.ourservice.create'))
                                            <a class="btn btn-primary" href="{{ route('admin.cms.ourservice.create') }}">Add
                                                New</a>
                                            @endif    
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap jsgrid-table" id="dataTables">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th width="25%">Icon</th>
                                            <th width="25%">Title</th>
                                            <th class="text-center" width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['ourServices'] as $ourServices)
                                            <tr>
                                                <td>{{ $ourServices->sort_order }}</td>
                                                <td>{{ $ourServices->icon }}</td>
                                                <td>{{ $ourServices->title }}</td>
                                                <td class="d-flex justify-content-center">
                                                    @if (Auth::user()->can('admin.cms.ourservice.edit'))
                                                    <a class="btn btn-info"
                                                        href="{{ route('admin.cms.ourservice.edit', ['our_service' => $ourServices->id]) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                            class="fas fa-edit"></i></a>
                                                    @endif        
                                                    &emsp;
                                                    @if (Auth::user()->can('admin.cms.ourservice.destroy'))
                                                    <form
                                                        action="{{ route('admin.cms.ourservice.destroy', ['our_service' => $ourServices->id]) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-danger" type="submit" data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
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