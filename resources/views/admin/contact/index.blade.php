@extends('admin.layouts.master')

@section('contact', 'active')
@section('title') {{ $data['title'] ?? '' }} @endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Contact</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Contact</li>
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
                                        <h3 class="card-title">Manage Contact </h3>
                                    </div>

                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap jsgrid-table" id="dataTables">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th width="10%">Name</th>
                                            <th width="10%">Email</th>
                                            <th width="15%">Message</th>
                                            <th width="10%">Date</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($data['rows']) && count($data['rows']) > 0)
                                            @foreach ($data['rows'] as $key => $row)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->email }}</td>
                                                    <td>{{ Str::limit($row->message, 50, '...') }}</td>
                                                    <td>
                                                        {{ date('d M Y', strtotime($row->created_at)) }}
                                                    </td>

                                                    </td>
                                                    <td>
                                                        @if (Auth::user()->can('admin.contact.view'))
                                                            <a class="btn btn-primary btn-sm view"
                                                                data-id="{{ $row->id }}" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="View"><i
                                                                    class="fa fa-eye"></i></a>
                                                        @endif
                                                        @if (Auth::user()->can('admin.contact.delete'))
                                                            <a class="btn btn-danger btn-sm" id="deleteData"
                                                                href="{{ route('admin.contact.delete', $row->id) }}" data-toggle="tooltip" data-placement="top" title="Delete"><i
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

    {{-- edit modal --}}
    <div class="modal fade" id="viewContactModal" aria-labelledby="viewContactModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewContactModalLabel">View Contact Info</h5>
                    <button class="close" data-dismiss="modal" type="button" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modal_body"></div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script type="text/javascript">
        $(document).on('click', '.view', function() {
            let cat_id = $(this).data('id');
            $.get('contact/' + cat_id + '/view', function(data) {
                console.log(data);
                $('#viewContactModal').modal('show');
                $('#modal_body').html(data);
            });
        });
    </script>
@endpush
