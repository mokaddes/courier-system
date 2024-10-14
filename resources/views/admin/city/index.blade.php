@extends('admin.layouts.master')

@section('location_menu', 'menu-open')

@section('cities', 'active')

@section('title') City @endsection

@push('style')
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">City</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">City</li>
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
                                        <h3 class="card-title">Manage City </h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            @if (Auth::user()->can('admin.cities.store'))
                                                <a class="btn btn-primary" data-toggle="modal" data-target="#addRegionModal"
                                                    href="javascript:void(0)">Add New</a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap jsgrid-table" id="dataTables">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th width="15%">City Name</th>
                                            <th width="15%">Region Name</th>
                                            <th width="15%">County Name</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($cities) && count($cities) > 0)
                                            @foreach ($cities as $key => $row)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->region->name ?? 'N/A' }}</td>
                                                    <td>{{ $row->county->name ?? 'N/A' }}</td>

                                                    <td>
                                                        @if (Auth::user()->can('admin.region.edit'))
                                                            <a class="btn btn-secondary edit btn-sm"
                                                                data-id="{{ $row->id }}" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endif

                                                        @if (Auth::user()->can('admin.region.delete'))
                                                            <a class="btn btn-danger btn-sm" id="deleteData"
                                                                href="{{ route('admin.cities.delete', $row->id) }}" data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                                    class="fa fa-trash-alt"></i></a>
                                                        @endif
                                                    </td>
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
    {{-- create modal --}}
    <div class="modal fade" id="addRegionModal" aria-labelledby="addRegionModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRegionModalLabel">Add City</h5>
                    <button class="close" data-dismiss="modal" type="button" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.cities.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="country_id">Country <span class="text-danger">*</span></label>
                            <select class="form-control" id="country_id" name="country_id">
                                @if (isset($country) && count($country) > 0)
                                    @foreach ($country as $key => $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="region_id">Region <span class="text-danger">*</span></label>
                            <select class="form-control" id="region_id" name="region_id">
                                @if (isset($region) && count($region) > 0)
                                    @foreach ($region as $key => $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">City <span class="text-danger">*</span></label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="City name"
                                required>
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-danger" data-dismiss="modal" type="button">Cancel</button>
                            <button class="btn btn-success" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- edit modal --}}
    <div class="modal fade" id="editregionModal" aria-labelledby="editregionModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editregionModalLabel">Edit City</h5>
                    <button class="close" data-dismiss="modal" type="button" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modal_body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).on('click', '.edit', function() {
            let cat_id = $(this).data('id');
            $.get('cities/' + cat_id + '/edit', function(data) {

                $('#editregionModal').modal('show');
                $('#modal_body').html(data);
            });
        });
    </script>
@endpush
