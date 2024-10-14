@extends('admin.layouts.master')
@section('merchant_api', 'menu-open')
@section('live_key', 'active')

@section('title')
    {{ $title ?? '' }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'Page Header' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="card-title">{{ $title ?? 'Page Header' }}</h3>
                        </div>
                        @if (isset($liveApi) && isset($demoApi))
                        @else
                            <div>
                                <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal"
                                   data-target="#exampleModal">Create Api Key</a>
                            </div>
                        @endif
                    </div>
                </div>


                <div class="card-body">
                    <div class="p-2">
                        <p>
                            <strong>Merchant id:</strong>
                            {{ $liveApi->merchant_id ?? "" }}
                        </p>
                        <p>
                            <strong>Public key:</strong>
                            {{ $liveApi->public_key ?? "" }}
                        </p>
                        <p>
                            <strong>Secret key:</strong>
                            {{ $liveApi->secret_key ?? "" }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

     Create Api
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Merchant Api Key</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.merchantapi.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="mode" id="mode" class="form-control" required>
                                <option value="" class="d-none">Select</option>
                                @if (!$liveApi)
                                    <option value="live">Live</option>
                                @endif

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
