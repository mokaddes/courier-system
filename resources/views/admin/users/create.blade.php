@extends('admin.layouts.master')

@section('adnin_user_role', 'menu-open')

@section('admin-user', 'active')

@section('title') Admin|Create @endsection

@push('style')
    <link href="{{ asset('backend/css/select2.min.css') }}" rel="stylesheet">
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--multiple {
            padding: 5px;
        }

        .select2-search__field {
            border: none !important;
        }

        ..select2-container--default.select2-container--focus .select2-selection--multiple {
            padding: 5px !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: solid black 1px;
            outline: 0;
            padding: 5px !important;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Admin create') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Admin create') }}</li>
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
                                <h5 class="m-0">{{ __('Admin create') }}
                                    <span class="float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.user.index') }}">
                                            Back</a>
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body">

                                <form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label" for="email">Image <span class="text-success">(Preferred Size 1:1)</span></label>
                                            <input class="form-control " name="image" type="file">

                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                            <input class="form-control @error('name') is-invalid @enderror" name="name"
                                                type="text" value="{{ old('name') }}" placeholder="Name"
                                                autocomplete="off" required>

                                            @if ($errors->has('name'))
                                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                            <input class="form-control @error('email') is-invalid @enderror" name="email"
                                                type="email" value="{{ old('email') }}" placeholder="Email address"
                                                autocomplete="off" required>
                                            @if ($errors->has('email'))
                                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                name="password" type="password" value="{{ old('password') }}"
                                                placeholder="Enter Password" autocomplete="off" required>
                                            @if ($errors->has('password'))
                                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-group">

                                                <label for="roles">Roles <span class="text-danger">*</span></label>
                                                <select class="form-control" id="roles" name="roles[]"
                                                    multiple="multiple" required>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role }}">{{ $role }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                    </div>

                                    <button class="btn btn-primary" type="submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('backend/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#roles').select2({
                tags: false
            });
        });
    </script>
@endpush
