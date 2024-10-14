@extends('frontend.layouts.app')

@section('title')
    {{ __('Sing Up') }}
@endsection

@push('css')
    <style>
        .icon {
            color: var(--bg-primary);
        }
    </style>
@endpush

@section('content')
    <div class="login-section pb-5 pt-5">
        <div class="container">
            <div class="m-auto">
                <div class="card card-lg" style="height: 28rem">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">

                        <i class="icon fas fa-10x fa-check-circle"></i>

                        <h3 class="">Successfull</h3>
                        <h4 class="">Please wait for the admin approval</h4>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
