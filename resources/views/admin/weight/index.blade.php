@extends('admin.layouts.master')

@section('price_menu', 'menu-open')

@section('weight', 'active')

@section('title') Weight @endsection

@push('style')
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Weight</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Weight</li>
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
                                        <h3 class="card-title">Manage Weight </h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            {{-- @if (Auth::user()->can('admin.cities.create')) --}}
                                                <a href="javascript:void(0)" data-toggle="modal"
                                                    data-target="#addRegionModal" class="btn btn-primary">Add New</a>
                                            {{-- @endif --}}

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table id="dataTables" class="table table-hover text-nowrap jsgrid-table">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th width="15%">Name</th>
                                            <th width="15%">Order Number</th>
                                            <th width="15%">Status</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($weights) && count($weights) > 0)
                                            @foreach ($weights as $key => $row)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->order_id }}</td>
                                                    <td>
                                                        @if ($row->status == 1)
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if (Auth::user()->can('admin.weights.edit'))
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-secondary edit btn-sm"
                                                                data-id="{{ $row->id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        @endif

                                                        @if (Auth::user()->can('admin.weights.delete'))
                                                            <a href="{{ route('admin.weights.delete', $row->id) }}"
                                                                id="deleteData" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
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
    <div class="modal fade" id="addRegionModal" tabindex="-1" aria-labelledby="addRegionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRegionModalLabel">Add Weight</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.weights.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"
                                placeholder="Enter Weight" required>
                        </div>
                        <div class="form-group">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="text" name="weight" id="weight" value="{{ old('weight') }}" class="form-control"
                                   placeholder="Enter Weight" required>
                        </div>
                        <div class="form-group">
                            <label for="order_id" class="form-label">Order Number</label>
                            <input type="number" name="order_id" id="order_id" value="{{ old('order_id') }}" class="form-control"
                                placeholder="Enter Order Number" required>
                        </div>
                        <div class="form-group">
                            <label for="order_id" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group float-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- edit modal --}}
    <div class="modal fade" id="editregionModal" tabindex="-1" aria-labelledby="editregionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editregionModalLabel">Edit Weight</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
            $.get('weights/' + cat_id + '/edit', function(data) {
                console.log(data);
                $('#editregionModal').modal('show');
                $('#modal_body').html(data);
            });
        });
    </script>
@endpush
