@extends('admin.layouts.master')

@section('payments', 'menu-open')

@section('transaction', 'active')

@section('title')
    Transaction
@endsection

@push('style')
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Transaction</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Transaction</li>
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
                                        <h3 class="card-title">Manage Transaction </h3>
                                    </div>
                                    
                                    <div class="col-6">
                                        @if(Auth::user()->is_merchant == 1)
                                            <div class="float-right">
                                                <button type="button" class="btn btn-info">Current
                                                    Balance: {{ getPrice(Auth::user()->topup_blance) }}</button>
                                                <a class="btn btn-primary"
                                                   href="{{ route('admin.merchant.recharge.create') }}">Recharge</a>

                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap jsgrid-table" id="dataTables">
                                    <thead>
                                    <tr>
                                        <th width="5%">SL</th>
                                        <th width="10%">Transaction Id</th>
                                        <th width="10%">Payment Provider</th>
                                        <th width="10%">User Name</th>
                                        <th width="30%">Comments</th>
                                        <th width="10%">Type</th>
                                        <th width="10%">Amount</th>
                                        <th width="10%">Purpose</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($transactions) && count($transactions) > 0)
                                        @foreach ($transactions as $key => $row)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $row->transaction_id }}</td>
                                                <td>{{ $row->payment_provider }}</td>
                                                <td>{{ $row->user->name?? "" }}</td>
                                                <td>
                                                    {{ Str::limit($row->comments, 65, '...') }}
                                                </td>
                                                <td>
                                                    <span class="btn btn-xs btn-{{ $row->txn_type == 'IN' ? 'success' : 'danger' }}" style="min-width: 40px">{{ $row->txn_type }}</span>
                                                </td>
                                                <td class="text-{{ $row->txn_type == 'IN' ? 'success' : 'danger' }}">{{ getPrice($row->amount) }}</td>
                                                <td>{{ $row->txn_purpose }}</td>
                                                {{-- <td>
                                                    @if (Auth::user()->can('admin.merchant.transaction.delete'))
                                                        <a class="btn btn-danger btn-sm" id="deleteData"
                                                           href="{{ route('admin.merchant.transaction.delete', $row->id) }}"><i
                                                                class="fa fa-trash-alt"></i></a>
                                                    @endif
                                                </td> --}}
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


