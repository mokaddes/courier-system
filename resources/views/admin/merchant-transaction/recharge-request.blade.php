@extends('admin.layouts.master')

@section('payments', 'menu-open')

@section('recharge-request', 'active')

@section('title')
    Recharge Request
@endsection

@push('style')
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Recharge Request</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Recharge Request</li>
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
                                        <h3 class="card-title">Recharge Request </h3>
                                    </div>
                                    @if (Auth::user()->can('admin.merchant.recharge.create'))
                                        @if(Auth::user()->is_merchant == 1)
                                            <div class="col-6">
                                                <div class="float-right">
                                                    <a class="btn btn-primary" href="{{ route('admin.merchant.recharge.create') }}">Recharge</a>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap jsgrid-table" id="dataTables">
                                    <thead>
                                    <tr>
                                        <th width="5%">SL</th>
                                        <th width="15%">Merchant</th>
                                        <th width="15%">Amount</th>
                                        <th width="15%">Slip Number</th>
                                        <th width="15%">Payment Date</th>
                                        <th width="15%">Notes</th>
                                        <th width="15%">Proof Image</th>
                                        <th width="15%">Status</th>
                                        @if(Auth::user()->is_merchant == 1)
                                            <th width="15%">Action</th>
                                        @endif

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($recharge_requests) && count($recharge_requests) > 0)
                                        @foreach ($recharge_requests as $key => $row)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $row->rechargeRequest->name?? "" }}</td>
                                                <td>{{ getPrice($row->amount) }}</td>
                                                <td>{{ $row->slip_number }}</td>
                                                <td>{{ date('d M Y', strtotime($row->payment_date)) }}</td>
                                                {{-- <td>
                                                    @if($row->status == 0)
                                                    <span class="badge bg-danger">Pending</span>
                                                    @elseif($row->status == 1)
                                                    <span class="badge bg-success">Approved</span>
                                                    @else
                                                    <span class="badge bg-warning">Denied</span>
                                                    @endif

                                                </td> --}}
                                                <td>{{ Str::limit($row->payment_note, 120, '...') }}</td>
                                                <td>
                                                    <a href="{{ asset($row->proof_image) }}" target="_blank">
                                                        <img src="{{ asset($row->proof_image) }}" alt="Proof Image"
                                                             width="65px">
                                                    </a>
                                                </td>


                                                <td>
                                                    @if (Auth::user()->can('admin.merchant.recharge.request.status'))
                                                        @if($row->status == 0)
                                                            <a class="btn btn-warning edit btn-sm"
                                                               href="{{ route('admin.merchant.recharge.request.status', $row->id) }}" onclick="return confirm('Are you sure, You want to approved this!!')">
                                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                                Approve
                                                            </a>
                                                        @else
                                                            <span class="badge bg-success">Approved</span>
                                                        @endif
                                                    @else
                                                        @if($row->status == 0)
                                                            <span class="badge bg-warning">Pending</span>
                                                        @else
                                                            <span class="badge bg-success">Approved</span>
                                                        @endif
                                                    @endif
                                                </td>
                                                @if(Auth::user()->is_merchant == 1 && $row->status == 0)
                                                    <td>
                                                        <a class="btn btn-primary edit btn-sm"
                                                           href="{{ route('admin.merchant.recharge.edit', $row->id) }}">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="btn btn-danger btn-sm" id="deleteData"
                                                           href="{{ route('admin.merchant.recharge.delete', $row->id) }}"><i
                                                                    class="fa fa-trash-alt"></i></a>
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif
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

@push('script')


@endpush
