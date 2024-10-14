@extends('admin.layouts.master')
@section('pickup-request', 'active')
@section('order-management', 'menu-open')

@section('title')
    Pickup Request
@endsection

@push('style')
    <style>
        .status {
            cursor: default !important;
            min-width: 60px !important;
        }

        .payment {
            cursor: default !important;
            min-width: 50px !important;
        }

        .select2-container {
            display: block !important;

        }

        .select2-container .select2-selection--multiple {

            min-height: 42px !important;

        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #6c757d !important;
            border: 1px solid #725a5a !important;


        }


    </style>
@endpush
@php
    $status = [
        0 => 'Pending',
        1 => 'Active',
        2 => 'Waiting for Delivery Man',
        3 => 'Picked By Delivery Man',
        4 => 'Delivered',
        5 => 'Returned'
    ];
@endphp

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pickup Request</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pickup Request</li>
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
                                        <h3 class="card-title">Pickup Request</h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            @if (Auth::user()->can('admin.pickup-request.create') && Auth::user()->is_merchant != '1')

                                                <a class="btn btn-primary" href="{{ route('admin.pickup-request.create') }}?for=merchant">Add
                                                    New (Merchant)</a>

                                                <a class="btn btn-primary" href="{{ route('admin.pickup-request.create') }}?for=guest">Add
                                                    New (Guest)</a>
                                            @elseif (Auth::user()->can('admin.pickup-request.create') && Auth::user()->is_merchant == '1')
                                                <a class="btn btn-primary" href="{{ route('admin.pickup-request.create') }}?for=merchant">Add
                                                    New </a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap jsgrid-table" id="dataTables">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Order Info</th>
                                        <th>Merchant/Guest</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Delivery Cost</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($rows) && count($rows) > 0)
                                        @foreach ($rows as $key => $row)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td style="max-width: 150px;">
                                                    <p class="mb-0">Tracking number : {{ $row->traking_number }}</p>
                                                    <p class="mb-0">Order number : #{{ $row->id }}</p>
                                                    <p class="mb-0">Phone : {{ $row->pickup_mobile }}</p>
                                                    <p class="mb-0">Date : {{ date('d M Y', strtotime($row->created_at)) }}</p>

                                                </td>

                                                <td>
                                                    @if (isset($row->merchant_id))
                                                        <a href="{{ route('admin.merchant.show', ['id' => $row->merchant_id]) }}">{{ $row->hasMerchant->name ?? '' }}</a>
                                                    @else
                                                        Guest
                                                    @endif

                                                </td>

                                                <td>
                                                    <p class="mb-0">Delivery cost : {{ getprice($row->amount) }}</p>
                                                    <p class="mb-0">COD amount : {{ getprice($row->cod_amount) }}</p>
                                                </td>
                                                <td>

                                                    <span class="btn btn-xs btn-info status">{{ $status[$row->status] ?? '' }}</span>


                                                    @if (Auth::user()->is_deliveryman == 1 && $row->status > 0 && $row->status < 4 )
                                                        <a class="btn btn-secondary active btn-xs"
                                                           href="{{ route('admin.pickup-request.status.change', [$row->id, $row->status+1]) }}"
                                                           data-toggle="tooltip" data-placement="top"
                                                           title="Status change to next"  onclick="return confirm('Are you sure?')" ><i class="fa fa-thumbs-up"></i></a>

                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($row->payment_status == 1)
                                                        <span class="btn btn-xs btn-success payment">Paid</span>
                                                    @else
                                                        <span class="btn btn-xs btn-danger payment">Unpaid</span>
                                                        @if(Auth::user()->is_merchant == 1)
                                                            <a class="btn btn-info btn-xs"
                                                               href="{{ $row->hasMerchant->topup_blance <= $row->amount ? route('admin.merchant.recharge.create') : route('admin.pickup-request.merchant.payment', $row->id) }}"
                                                               onclick="{{ $row->hasMerchant->topup_blance >= $row->amount ? 'return confirm("This will be charged from your balance. Are you want to proceed?")' : 'return alert("You dont have sufficient balance. Please recharge. ")' }}"
                                                               title="Payment"><i
                                                                        class="fas fa-sack-dollar"></i></a>
                                                        @elseif(Auth::user()->is_deliveryman != 1)
                                                            <a class="btn btn-info btn-xs"
                                                               href="{{ route('admin.pickup-request.merchant.payment', $row->id) }}"
                                                               onclick="return confirm('Are you want to proceed?')"
                                                               title="Payment"><i
                                                                        class="fas fa-sack-dollar"></i></a>
                                                        @endif
                                                    @endif

                                                </td>
                                                <td>
                                                    @if (Auth::user()->can('admin.pickup-request.assign.deliveryman') && $row->status < 2)
                                                        <a class="btn btn-info btn-sm"
                                                           href="javascript:void(0)"
                                                           onclick="showDeliverymanModal('{{ $row->id }}', '{{ $row->deliveryman_id ?? '' }}')"
                                                           data-toggle="tooltip" data-placement="top"
                                                           title="Assign delivery man"><i
                                                                    class="fas fa-shipping-fast"></i></a>
                                                    @endif
                                                    @if (Auth::user()->can('admin.pickup-request.edit') && $row->status == 0)
                                                        <a class="btn btn-primary edit btn-sm"
                                                           href="{{ route('admin.pickup-request.edit', $row->id) }}"
                                                           data-toggle="tooltip" data-placement="top"
                                                           title="Edit"><i
                                                                    class="fa fa-edit"></i></a>
                                                    @endif
                                                    @if (Auth::user()->can('admin.pickup-request.view'))
                                                        <a class="btn btn-info view btn-sm"
                                                           href="{{ route('admin.pickup-request.view', $row->id) }}"
                                                           data-toggle="tooltip" data-placement="top"
                                                           title="View"><i
                                                                    class="fa fa-eye"></i></a>
                                                    @endif

                                                    {{-- @endif --}}

                                                    @if ((Auth::user()->can('admin.pickup-request.delete') && $row->status < 3) && $row->payment_status != "1")

                                                            <a class="btn btn-danger btn-sm" id="deleteData"
                                                               href="{{ route('admin.pickup-request.delete', $row->id) }}"
                                                               data-toggle="tooltip" data-placement="top"
                                                               title="Delete"><i class="fa fa-trash-alt"></i></a>

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
    <div class="modal fade" tabindex="-1" role="dialog" id="AssignDeliveryModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Delivery Man</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.pickup-request.assign.deliveryman') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="pickup_request_id" name="pickup_request_id">
                        <div class="mb-3">
                            <label for="deliveryman_id" class="form-label">Delivery Man</label>
                            <select name="deliveryman_id[]" id="deliveryman_id" multiple class="form-control select2" required>
                                @foreach($deliveryman as $man)
                                    <option value="{{ $man->id }}" {{ old('deliveryman_id') == $man->id ? 'selected' : '' }} >{{ $man->name ?? "" }}
                                        (ID:{{ $man->deliveryman_id ?? ""}}), {{ $man->hasState->name ?? '' }}, {{ $man->hasCity->name ?? '' }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Assign Delivery</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        function showDeliverymanModal(id, deliveryman_id) {
            console.log(id, deliveryman_id)
            $('#pickup_request_id').val(id);
            let options = $("#deliveryman_id option");
            options.each(function () {
                let option = $(this);
                let dataId = option.val();
                if (parseInt(dataId) == parseInt(deliveryman_id)) {
                    option.prop("selected", true);
                } else {
                    option.prop("selected", false);
                }
            });
            $('#AssignDeliveryModal').modal('show');
        }

    </script>
@endpush
