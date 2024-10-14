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
@section('adnin_user_role', 'menu-open')

@section('admin-user', 'active')

@section('title') Admins @endsection

@section('content')
    @php
        $userr = Auth::user();
    @endphp
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Admins') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Admins') }}</li>
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
                                <h5 class="m-0">{{ __('Admin List') }}
                                    <div class="float-right">
                                        <a class="btn btn-primary" href="{{ route('admin.user.create') }}">Add New</a>

                                    </div>
                                </h5>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap jsgrid-table" id="dataTables">
                                    <thead>
                                        <tr>
                                            <th width="5%">Sl</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Role') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Image') }}</th>
                                            <th width="10%">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($users) && $users->count() > 0)
                                            @foreach ($users as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>
                                                        @if (!empty($item->getRoleNames()))
                                                            @foreach ($item->getRoleNames() as $v)
                                                                <label
                                                                    class="badge badge-success">{{ $v }}</label>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>
                                                        @if ($item->image)
                                                            <img class="img" src="{{ asset($item->image) }}"
                                                                alt="Image">
                                                        @else
                                                            <img class="img"
                                                                src="{{ asset('uploads/default-user.png') }}"
                                                                alt="Image">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-success btn-sm" id=""
                                                            href="{{ route('admin.user.edit', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                                class="fa fa-edit"></i></a>
                                                        <a class="btn btn-secondary btn-sm" id=""
                                                            href="{{ route('admin.user.show', $item->id) }}" data-toggle="tooltip" data-placement="top" title="View"><i
                                                                class="fa fa-eye"></i></a>
                                                        {{-- <a class="btn btn-danger btn-sm disabled" id="deleteData"
                                                            href="#">Delete</a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
