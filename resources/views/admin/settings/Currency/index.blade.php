@extends('admin.layouts.master')

@section('settings_menu', 'menu-open')

@section('currency', 'active')

@section('title')
    {{ __('Currency') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Currency') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('currency') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-row align-items-center">
                        <div class="col-auto my-1">
                        </div>

                        <div class="col-auto my-2 py-2 ">
                            <button class="btn btn-primary " type="submit"
                                style="margin-top:25px">{{ __('save') }}</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="line-height: 36px;">{{ __('Currency List') }}</h3>
                            <a class="btn bg-success float-right d-flex align-items-center justify-content-center"
                                href=""><i class="fas fa-plus"></i>&nbsp; {{ __('Add') }}</a>
                            <a class="btn btn-outline-success float-right d-flex align-items-center justify-content-center mr-2"
                                href="" target="blank">
                                &nbsp; {{ __('Check Example') }}</a>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>{{ __('name') }}</th>
                                        <th>{{ __('code') }}</th>
                                        <th>{{ __('symbol') }}</th>
                                        <th>{{ __('position') }}</th>
                                        <th width="15%">{{ __('actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>United state dollar</td>
                                        <td>usd</td>
                                        <td>$</td>
                                        <td>left</td>
                                        <td>
                                            <a class="btn btn-warning mt-0 mr-2" data-toggle="tooltip" href="#"
                                                title="{{ __('you_can_not_delete_or_edit_this_currency') }}">
                                                <i class="fas fa-lock"></i>

                                                <a class="btn btn-warning mt-0 mr-2" data-toggle="tooltip" href="#"
                                                    title="{{ __('you_can_not_delete_or_edit_this_currency') }}">
                                                    <i class="fas fa-lock"></i>
                                                    <a href="#"class="btn btn-info mt-0 mr-2"><i
                                                            class="fas fa-edit"></i></a>

                                                    <form class="d-inline" action="" method="POST">

                                                        @csrf
                                                        <button class="btn bg-danger" data-toggle="tooltip"
                                                            data-placement="top" title="{{ __('delete_language') }}"
                                                            onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        $('input[name="default"]').on('switchChange.bootstrapSwitch', function(event, state) {
            $('#' + event.currentTarget.id).submit();
        });
    </script>
@endsection
