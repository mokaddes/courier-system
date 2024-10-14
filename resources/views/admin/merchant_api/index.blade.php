@extends('admin.layouts.master')
@section('merchant_api', 'active')

@section('title') {{ $data['title'] ?? '' }} @endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $data['title'] ?? 'Page Header' }}</h1>
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
                            <h3 class="card-title">{{ $data['title'] ?? 'Page Header' }}</h3>
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
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @if ($liveApi)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">Live</button>
                            </li>
                        @endif
                        @if ($demoApi)
                            <li class="nav-item  @if (!$liveApi) active @endif" role="presentation">
                                <button class="nav-link " id="profile-tab" data-toggle="tab" data-target="#profile"
                                    type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">Demo</button>
                            </li>
                        @endif

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        {{-- live --}}
                        @if ($liveApi)
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="p-2">
                                    <p>
                                        <strong>Merchant id:</strong>
                                        {{ $liveApi->merchant_id }}
                                    </p>
                                    <p>
                                        <strong>Public key:</strong>
                                        {{ $liveApi->public_key }}
                                    </p>
                                    <p>
                                        <strong>Secret key:</strong>
                                        {{ $liveApi->secret_key }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        {{-- demo --}}
                        @if ($demoApi)
                            <div class="tab-pane fade @if (!$liveApi) show active @endif" id="profile"
                                role="tabpanel" aria-labelledby="profile-tab">
                                <div class="p-2">
                                    <p>
                                        <strong>Merchant id:</strong>
                                        {{ $demoApi->merchant_id }}
                                    </p>
                                    <p>
                                        <strong>Public key:</strong>
                                        {{ $demoApi->public_key }}
                                    </p>
                                    <p>
                                        <strong>Secret key:</strong>
                                        {{ $demoApi->secret_key }}
                                    </p>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- Create Api --}}
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
                                @if (!$demoApi)
                                    <option value="demo">Demo</option>
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
