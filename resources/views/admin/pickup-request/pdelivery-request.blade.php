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
@section('order-management', 'menu-open')

@section('pending-for-delivery', 'active')

@section('title')
    Pending for Delivery Man
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Pending for Delivery Man') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Pending for Delivery Man') }}</li>
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
                                <h5 class="m-0">{{ __('Delivery Man Pending Request') }}
                                    <div class="float-right">
                                        {{-- @if (Auth::user()->can('admin.deliveryman.create'))
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('admin.deliveryman.create') }}">Add
                                                New</a>
                                        @endif --}}
                                    </div>
                                </h5>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap jsgrid-table" id="dataTables">
                                    <thead>
                                    <tr>
                                        <th width="5%">Sl</th>
                                        <th>{{ __('Tracking Number') }}</th>
                                        <th>{{ __('Merchant/Guest Name') }}</th>
                                        <th>{{ __('Merchant/Guest Location') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{__('Customer Name')}}</th>
                                        <th>{{__('Customer Location')}}</th>
                                        <th>{{ __('Deliveryman Name') }}</th>
                                        <th>{{ __('Deliveryman Email') }}</th>
                                        {{-- <th>{{ __('Status') }}</th> --}}
                                        <th width="10%">{{ __('Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($pdelivery_reqs) && $pdelivery_reqs->count() > 0)
                                        @foreach ($pdelivery_reqs as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->pickupRequest->traking_number?? "" }}</td>
                                                <td>{{ $item->pickupRequest->pickup_contact_name?? "" }}</td>
                                                <td><p><strong>City : </strong>{{$item->pickupRequest->city->name ?? ""  }}</p> <p><strong>State:</strong>{{$item->pickupRequest->hasPickupState->name?? "" }}</p><p><strong>Address: {{$item->pickupRequest->pickup_address ?? ""}}</strong></p></td>
                                                <td>{{ date('d M Y', strtotime($item->pickupRequest->created_at))?? "" }}</td>
                                                <td>{{$item->pickupRequest->delivery_contact_name}}</td>
                                                <td><p><strong>City : </strong>{{$item->pickupRequest->deliveryCity->name ?? "" }}</p> <p><strong>State: </strong>{{ $item->pickupRequest->hasDeliveryState->name ?? ""}}</p><p><strong>Address:</strong>{{ $item->pickupRequest->delivery_address ?? "" }}</p></td>
                                                <td>{{ $item->hasDeliveryman->name?? "" }}</td>
                                                <td>{{ $item->hasDeliveryman->email?? "" }}</td>
                                                {{-- <td>
                                                    @if($item->status == 1)
                                                    <span class="badge bg-success">Accepted</span>
                                                    @elseif($item->status == 0)
                                                    <span class="badge bg-danger">pending </span>
                                                    @else
                                                    <span class="badge bg-secondary">already accepted By Others</span>
                                                    @endif
                                                </td> --}}

                                                <td>


                                                    @if(Auth::user()->is_deliveryman == 1)

                                                        @if($item->status == 0)
                                                            <a class="btn btn-warning btn-sm" id=""
                                                               href="{{ route('admin.pickup-request.approve', $item->id) }}" onclick="return confirm('Are Your Sure, You want to approve this!!')" data-toggle="tooltip" data-placement="top" title="Approved">
                                                                Approve
                                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                            </a>
                                                        @endif

                                                    @endif

                                                    @if (Auth::user()->can('admin.pickup-request.pdeliveryView'))
                                                        <a class="btn btn-secondary btn-sm" id=""
                                                           href="{{ route('admin.pickup-request.pdeliveryView', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Show"><i
                                                                    class="fa fa-eye"></i>
                                                        </a>
                                                    @endif

                                                    @if (Auth::user()->can('admin.pickup-request.pdelivery.delete'))
                                                        <a class="btn btn-danger btn-sm" id="deleteData"
                                                           href="{{ route('admin.pickup-request.pdelivery.delete', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                                    class="fa fa-trash"></i></a>
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
