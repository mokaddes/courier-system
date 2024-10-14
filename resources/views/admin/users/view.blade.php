@extends('admin.layouts.master')
@push('style')
<style>
    .img {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 100px;
    height: 120px;
  }
</style>
@endpush
@section('adnin_user_role', 'menu-open')


@section('admin-user', 'active')

@section('title') Admin|Details @endsection

@section('content')
    @php
        $userr = Auth::user();
    @endphp
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Admin') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Admin') }}</li>
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
                                <h5 class="m-0">{{ __('Admin Details') }}
                                    <div class="float-right">
                                        <a href="{{ route('admin.user.index') }}"
                                            class="btn btn-primary">Back</a>

                                    </div>
                                </h5>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped">
                                    <tr>
                                    <td style="width: 20%" >Admin Image</td>
                                    <td style="width: 80%">
                                        @if($admin->image)
                                        <img src="{{ asset($admin->image) }}" class="img" alt="admin user image"></td>
                                        @else
                                        <img src="{{ asset('uploads/default-user.png') }}" class="img" alt="admin user image"> 
                                        @endif
                                </tr>
                                    <tr>
                                        <td style="width: 20%"> Name</td>
                                        <td style="width: 80%">{{ $admin->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Email</td>
                                        <td style="width: 80%">{{ $admin->email }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:20%">Date</td>
                                        <td style="width:80%">{{ date('d M Y', strtotime($admin->created_at)) }}</td>
                                    </tr>
                                  
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
