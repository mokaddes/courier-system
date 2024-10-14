@extends('admin.layouts.master')
@push('style')
    <style>
        .img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 80px;
            height: 70px;
        }
    </style>
@endpush
@section('merchant_menu', 'menu-open')

@section('merchant_user', 'active')

@section('title')
    Merchant
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Merchant') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Merchant') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <ul class="nav nav-tabs">
                    @if (Auth::user()->can('admin.merchant.index'))
                        <li class="nav-item">
                            <a class="nav-link @if (Request::is('admin/merchant')) active @endif"
                               href="{{ route('admin.merchant.index') }}">Merchant</a>
                        </li>
                    @endif
                    @if (Auth::user()->can('admin.merchant-request.index'))
                        <li class="nav-item">
                            <a class="nav-link @if (Request::is('admin/merchant-request/index')) active @endif"
                               href="{{ route('admin.merchant-request.index') }}">Merchant Request ({{count($merchantRequests) ?? 0}})</a>
                        </li>
                    @endif
                </ul>
                @if (Request::is('admin/merchant'))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="m-0">{{ __('Merchant List') }}
                                        <div class="float-right">
                                            @if (Auth::user()->can('admin.merchant.create'))
                                                <a class="btn btn-primary btn-sm"
                                                   href="{{ route('admin.merchant.create') }}">Add
                                                    New</a>
                                            @endif
                                        </div>
                                    </h5>
                                </div>

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap jsgrid-table" id="dataTables">
                                        <thead>
                                        <tr>
                                            <th width="5%">Sl</th>
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Merchant ID') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Business Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Available Balance') }}</th>
                                            <th>{{ __('Total Request') }}</th>
                                            <th width="10%">{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($users) && $users->count() > 0)
                                            @foreach ($users as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        @if ($item->image)
                                                            <img class="img" src="{{ asset($item->image) }}"
                                                                 alt="Image">
                                                        @else
                                                            <img class="img"
                                                                 src="{{ asset('uploads/default-user.png') }}"
                                                                 alt="Image">
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->merchant_id }}</td>

                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->business_name }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ getPrice($item->topup_blance) }}</td>

                                                    <td class="text-center">
                                                        <a href="{{ route('admin.pickup-request.index', ['merchant_id' => $item->merchant_id]) }}"
                                                           class="btn btn-sm btn-info">{{ $item->merchantPickupRequest()->count() }}</a>
                                                    </td>
                                                    <td>
                                                        @if (Auth::user()->can('admin.merchant.edit'))
                                                            <a class="btn btn-primary btn-sm" id="bonus" title="Give bonus" data-toggle="tooltip" data-placement="top"
                                                               href="javascript:void(0);" onclick="showBonusModal('{{ $item->id }}', '{{ $item->name }}', '{{ getPrice($item->topup_blance) }}')">
                                                                <i class="fas fa-hand-holding-dollar"></i>
                                                            </a>
                                                        @endif
                                                        @if (Auth::user()->can('admin.merchant.edit'))
                                                            <a class="btn btn-success btn-sm" id="" title="Edit" data-toggle="tooltip" data-placement="top"
                                                               href="{{ route('admin.merchant.edit', $item->id) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if (Auth::user()->can('admin.merchant.view'))
                                                            <a class="btn btn-secondary btn-sm" id="" title="Show" data-toggle="tooltip" data-placement="top"
                                                               href="{{ route('admin.merchant.show', $item->id) }}"><i
                                                                    class="fa fa-eye"></i></a>
                                                        @endif

                                                        @if (Auth::user()->can('admin.merchant.delete') && $item->can_delete)
                                                            <a class="btn btn-danger btn-sm" id="deleteData" title="Delete" data-toggle="tooltip" data-placement="top" href="{{ route('admin.merchant.destroy', ['id' => $item->id]) }}"><i
                                                                    class="fa fa-trash"></i></a>
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
                @endif

                @if (Request::is('admin/merchant-request/index'))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="m-0">{{ __('Merchant List') }}
                                        <div class="float-right">
                                            <a class="btn btn-primary" href="{{ route('admin.merchant.create') }}">Add
                                                New</a>

                                        </div>
                                    </h5>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap jsgrid-table" id="dataTables">
                                        <thead>
                                        <tr>
                                            <th width="5%">Sl</th>
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Business Name') }}</th>
                                            <th>{{ __('Business Owner Name') }}</th>
                                            <th>{{ __('Business Owner Email') }}</th>
                                            <th>{{ __('Business Owner Phone') }}</th>
                                            <th>{{ __('Approved') }}</th>
                                            <th width="10%">{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($merchantRequests) && $merchantRequests->count() > 0)
                                            @foreach ($merchantRequests as $key => $merchantRequest)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>

                                                    <td>
                                                        @if ($merchantRequest->image)
                                                            <img class="img"
                                                                 src="{{ asset($merchantRequest->image) }}"
                                                                 alt="Image">
                                                        @else
                                                            <img class="img"
                                                                 src="{{ asset('uploads/default-user.png') }}"
                                                                 alt="Image">
                                                        @endif
                                                    </td>
                                                    <td>{{ $merchantRequest->business_name }}</td>
                                                    <td>{{ $merchantRequest->business_owner_name }}</td>
                                                    <td>{{ $merchantRequest->business_email }}</td>
                                                    <td>{{ $merchantRequest->business_owner_phone }}</td>
                                                    <td>
                                                        @if ($merchantRequest->status == '2')
                                                            Pending
                                                        @elseif ($merchantRequest->status == '1')
                                                            Approved
                                                        @else
                                                            Inactive
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (Auth::user()->can('admin.marchant-request.show'))
                                                            <a class="btn btn-secondary btn-sm"
                                                               href="{{ route('admin.merchant-request.show', ['merchant_request' => $merchantRequest->id]) }}" data-toggle="tooltip" data-placement="top" title="Show"><i
                                                                    class="fa fa-eye"></i></a>
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
                @endif

            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="merchantBonusModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Give bonus to <strong id="merchant_name"></strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.merchant.bonus') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <h5>Current balance: <strong id="current_balance"></strong> </h5>
                        </div>
                        <input type="hidden" id="merchant_id" name="merchant_id">
                        <div class="mb-3">
                            <label for="amount" class="form-label required">Amount</label>
                            <input type="number" class="form-control" placeholder="Amount" step="any" name="amount" id="amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="deliveryman_id" class="form-label">Comment</label>
                            <textarea class="form-control" placeholder="Comment" name="comments" id="comments"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        function showBonusModal(id, name, balance) {
            $('#merchant_id').val(id);
            $('#amount').val('');
            $('#comments').val('');
            $('#merchant_name').text(name);
            $('#current_balance').text(balance);
            $('#merchantBonusModal').modal('show');
        }
    </script>
@endpush
