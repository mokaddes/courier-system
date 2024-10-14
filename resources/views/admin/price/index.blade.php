@extends('admin.layouts.master')

@section('price_menu', 'menu-open')

@section('price', 'active')

@section('title') {{ $data['title'] ?? '' }} @endsection

@push('style')
    <link href="{{ asset('backend/css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
@endpush

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $data['title'] ?? '' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ $data['title'] ?? '' }}</li>
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
                                        <h3 class="card-title">Manage {{ $data['title'] ?? '' }} </h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            @if (Auth::user()->can('admin.country.create'))
                                                <a class="btn btn-primary" href="{{ route('admin.price.create') }}">Add
                                                    New</a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap jsgrid-table" id="dataTables">
                                    <thead>
                                        <tr>

                                            <th>#</th>
                                            <th>Price Name</th>
                                            <th>Price Group</th>
                                            <th>Weight</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($data['pricing'] as $pricingGroup)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pricingGroup->item_name }}</td>
                                                <td>{{ $pricingGroup->hasPrice->name ??""}}</td>
                                                <td>{{ $pricingGroup->hasWeight->name??"" }}</td>
                                                <td>
                                                    <p class="mb-0">Inside City : {{ getprice($pricingGroup->inside_main_city_price) }} </p>
                                                    <p class="mb-0">Outside City : {{ getprice($pricingGroup->inter_city_price) }}</p>
                                                </td>


                                                <td>
                                                    @if (Auth::user()->can('admin.price.edit'))
                                                    <input id="status" data-toggle="toggle" data-on="Active"
                                                        data-off="Inactive" data-id="{{ $pricingGroup->id }}"
                                                        data-onstyle="success" data-offstyle="danger" type="checkbox"
                                                        onchange="status(this)"
                                                        @if ($pricingGroup->status) checked @endif>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if (Auth::user()->can('admin.price.edit'))
                                                    <a class="btn btn-info btn-sm"
                                                        href="{{ route('admin.price.edit', ['price' => $pricingGroup->id]) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                            class="fas fa-edit"></i></a>
                                                    @endif
                                                    @if (Auth::user()->can('admin.price.delete'))
                                                    <a class="btn btn-danger btn-sm" id="deleteData"
                                                        href="{{ route('admin.price.delete', ['price' => $pricingGroup->id]) }}" data-toggle="tooltip" data-placement="top" title="Delete"

                                                    ><i
                                                            class="fas fa-trash-alt"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
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
    <script src="{{ asset('backend/js/bootstrap4-toggle.min.js') }}"></script>
    <script src="{{ asset('backend/js/axios.min.js') }}"></script>
    <script>
        function status(event) {


            const {
                id
            } = event.dataset;
            let state = event.checked;


            axios.post("{{ route('admin.price.status') }}", {
                id,
                state
            }).then((response) => {
                const {
                    data
                } = response;
                if (data) {
                    toastr.success('Price is activate', {
                        "closeButton": true,
                    });



                } else {
                    toastr.error('Price is inactivate', {
                        "closeButton": true,
                    });


                }
            }).catch((error) => {
                console.log(error);
            })




        };
    </script>
@endpush
