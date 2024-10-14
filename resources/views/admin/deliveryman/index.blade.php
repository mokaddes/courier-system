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
@section('deliveryman_menu', 'menu-open')

@section('deliveryman_list', 'active')

@section('title') Delivery Man @endsection

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Delivery Man') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Delivery Man') }}</li>
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
                                    <h5 class="m-0">{{ __('Delivery Man List') }}
                                        <div class="float-right">
                                            @if (Auth::user()->can('admin.deliveryman.create'))
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('admin.deliveryman.create') }}">Add
                                                    New</a>
                                            @endif
                                        </div>
                                    </h5>
                                </div>

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap jsgrid-table" id="dataTables">
                                        <thead>
                                            <tr>
                                                <th width="5%">Sl</th>
                                                <th>{{ __('Image') }}</th>
                                                <th>{{ __('Delivery Man ID') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Phone') }}</th>
                                                <th>{{ __('Email') }}</th>
                                                <th>{{ __('Total Order') }}</th>
                                                <th width="10%">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($users) && $users->count() > 0)
                                                @foreach ($users as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
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
                                                        <td>{{ $item->deliveryman_id }}</td>

                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->business_owner_phone }}</td>
                                                        <td>{{ $item->email }}</td>

                                                        <td class="text-center">
                                                            <a href="{{ route('admin.pickup-request.index', ['deliveryman_id' => $item->deliveryman_id]) }}" class="btn btn-sm btn-info">{{ $item->deliveryPickupRequest()->count() }}</a>
                                                        </td>
                                                        <td>
                                                            @if (Auth::user()->can('admin.deliveryman.edit'))
                                                                <a class="btn btn-success btn-sm" id=""
                                                                    href="{{ route('admin.deliveryman.edit', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                                        class="fa fa-edit"></i></a>
                                                            @endif
                                                            @if (Auth::user()->can('admin.deliveryman.view'))
                                                                <a class="btn btn-secondary btn-sm" id=""
                                                                    href="{{ route('admin.deliveryman.show', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Show"><i
                                                                        class="fa fa-eye"></i></a>
                                                            @endif

                                                            @if (Auth::user()->can('admin.deliveryman.delete'))
                                                            <a class="btn btn-danger btn-sm" href="{{ route('admin.deliveryman.destroy', ['id' => $item->id]) }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                                             @endif

                                                            @if (Auth::user()->can('admin.deliveryman.accounts') )
                                                             <a class="btn btn-primary btn-sm" href="{{ route('admin.deliveryman.accounts', ['id' => $item->id]) }}" data-toggle="tooltip" data-placement="top" title="Delete">A</a>
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
