@extends('admin.layouts.master')

@push('style')
    <link href="{{ asset('backend/css/select2.min.css') }}" rel="stylesheet">
    <style>
        .img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 80px;
            height: 70px;
        }

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
@section('adnin_user_role', 'menu-open')

@section('admin-user', 'active')

@section('title')
    Admin|Update
@endsection

@push('style')
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Admin update') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Admin update') }}</li>
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
                                <h5 class="m-0">{{ __('Admin Update') }}
                                    <span class="float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.user.index') }}">
                                            Back</a>
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.user.update', $admin->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">

                                            <label class="form-label" for="email">Image <span class="text-success">(Preferred Size 1:1)</span></label>
                                            <input class="form-control @error('image') is-invalid @enderror"
                                                   name="image"
                                                   type="file">
                                            @if ($errors->has('image'))
                                                <span class="text-danger text-left">{{ $errors->first('image') }}</span>
                                            @endif
                                            @if ($admin->image)
                                                <img class="img mt-2" src="{{ asset($admin->image) }}" alt="Image">
                                            @else
                                                <img class="img mt-2" src="{{ asset('uploads/default-user.png') }}"
                                                    alt="Image">
                                            @endif
                                        </div>

                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                            <input class="form-control @error('name') is-invalid @enderror" name="name"
                                                type="text" value="{{ $admin->name }}" placeholder="Name"
                                                autocomplete="off" required>

                                            @if ($errors->has('name'))
                                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                            <input class="form-control @error('email') is-invalid @enderror" name="email"
                                                type="email" value="{{ $admin->email }}" placeholder="Email address"
                                                autocomplete="off" required>
                                            @if ($errors->has('email'))
                                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        {{-- <div class="col-lg-4 mb-3">
                                            <label class="form-label" for="password">Password </label>
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                name="password" type="password" value="{{ old('password') }}"
                                                placeholder="Enter Password" autocomplete="off">
                                            @if ($errors->has('password'))
                                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div> --}}
                                        <div class="col-lg-4 mb-3">

                                            <div class="form-group">
                                                <label class="form-label" for="roles">Role <span class="text-danger">*</span></label>

                                                {!! Form::select('roles[]', $roles, $userRole, [
                                                    'class' => 'form-control',
                                                    'multiple',
                                                    'id' => 'roles',
                                                    'required' => true,
                                                ]) !!}

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Password Change</h5>
                    </div>
                    <div class="card-body">
                        <form class="updateFrom" action="{{ route('admin.password.update', $admin->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="name">
                                            {{ __('Password') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" name="password" type="password"
                                            placeholder="{{ __('New Password') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="email">
                                            {{ __('Confirm Password') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" name="password_confirmation" type="password"
                                            placeholder="{{ __('Confirm Password') }}" required>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
