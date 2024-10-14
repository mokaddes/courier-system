@extends('admin.layouts.master')


@section('payments', 'menu-open')

@section('recharge-request', 'active')

@section('title')
    Recharge
@endsection

@push('style')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        /* Custom styles for the tab headers */
        .recharge_section .nav-tabs {
            display: flex;
            justify-content: center;
            padding-left: 30px;
            padding-right: 30px;
            border: none !important;
        }

        .recharge_section .nav-link {
            border: none;
            background-color: #ddd;
            color: #333;
            border-radius: 0;
            padding: 10px 25px;
            margin: 0;
            border-left: 1px solid #EEEEEE;
        }

        .recharge_section .nav-link.active {
            background-color: #007bff;
            color: #fff;
        }
    </style>
@endpush

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Recharge</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Recharge</li>
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
                                        <h3 class="card-title">Recharge</h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            <a class="btn btn-primary"
                                               href="{{ route('admin.merchant.recharge.request') }}">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">

                                <div class="container recharge_section">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link {{ old('edahab_phone') ||  old('zaad_phone') ? '' : 'active' }}" data-toggle="tab" href="#form1">Recharge
                                                request</a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <a class="nav-link {{ old('edahab_phone') ? 'active' : '' }} " data-toggle="tab" href="#form2">Edahab Pay</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ old('zaad_phone') ? 'active' : '' }}" data-toggle="tab" href="#form3">Zaad Pay</a>
                                        </li> --}}
                                    </ul>

                                    <div class="tab-content mt-3">
                                        <div id="form1" class="tab-pane fade {{ old('edahab_phone') ||  old('zaad_phone') ? '' : 'show active' }} ">
                                            <form action="{{ route('admin.merchant.recharge.store') }}" method="post"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-md-8 col-sm-12">
                                                        <div class="row ">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label class="form-label required"
                                                                           for="name">Amount</label>
                                                                    <input
                                                                        class="form-control @error('name') border-danger @enderror"
                                                                        id="" name="amount" type="number" step="any"
                                                                        value="{{ old('amount') }}" placeholder="Amount"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label class="form-label required"
                                                                           for="proof_image">Proof
                                                                        Image</label>
                                                                    <input
                                                                        class="form-control @error('name') border-danger @enderror"
                                                                        id="imageInput" name="proof_image" type="file"
                                                                        value="{{ old('proof_image') }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="slip_number">Slip
                                                                        Number</label>
                                                                    <input
                                                                        class="form-control @error('slip_number') border-danger @enderror"
                                                                        id="" name="slip_number" type="text" placeholder="Slip Number"
                                                                        value="{{ old('slip_number') }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label class="form-label required" for="name">Payment
                                                                        Date</label>
                                                                    <input
                                                                        class="form-control @error('payment_date') border-danger @enderror"
                                                                        id="datepicker" name="payment_date" type="text"
                                                                        value="{{ date('m/d/Y') }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group ">
                                                                    <label class="form-label required" for="name">Payment
                                                                        Note</label>
                                                                    <textarea name="payment_note" id="payment_note" cols="30" rows="2"
                                                                              class="form-control" placeholder="Payment note">{{ old('payment_note') }}</textarea>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-success">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="form2" class="tab-pane fade {{ old('edahab_phone') ? 'show active' : '' }}">
                                            <form action="{{ route('admin.edahab.confirm') }}" method="post">
                                                @csrf
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-md-6 col-sm-8">
                                                        <div class="col-md-8 container-fluid">
                                                            <div class="form-group">
                                                                <label class="form-label required"
                                                                       for="name">Amount</label>
                                                                <input
                                                                    class="form-control @error('name') border-danger @enderror"
                                                                    id="edahab_amount" name="amount" type="number"
                                                                    step="any"
                                                                    value="{{ old('amount') }}" placeholder="Amount"
                                                                    required>
                                                            </div>
                                                            <div class="edahap_phn_sec">
                                                                <label for="edahab_phone" class="form-label required">Edahab
                                                                    Phone</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="edahab_code">+252</span>
                                                                    </div>
                                                                    <input type="number" name="edahab_phone"
                                                                           class="form-control"
                                                                           placeholder="Edahab Phone" id="edahab_phone"
                                                                           aria-label="edahab_phone" value="{{ old('edahab_phone') }}"
                                                                           aria-describedby="edahab_code">
                                                                    <div class="input-group-prepend edit_edahab"
                                                                         style="display: none">
                                                                        <span class="input-group-text" id="edit_edahab"><i
                                                                                class="fa fa-edit"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="confirm_section" style="display: none">
                                                                <label for="confirm_code" class="form-label required">Confirm
                                                                    Code</label>
                                                                <input type="number" name="confirm_code"
                                                                       class="form-control"
                                                                       placeholder="Confirm Code" id="confirm_code">
                                                            </div>
                                                            <input type="hidden" id="sent_code">
                                                        </div>
                                                        <div class="text-center m-3">
                                                            <button type="button" class="edahabBtn btn btn-success"
                                                                    onclick="edahabPayment()"
                                                                    style="text-align:center;">
                                                                <span style="">{{ __('Payment') }}</span>
                                                            </button>
                                                            <button type="submit" id="edahab_confirmBtn" onclick="edahabOrder(event)"
                                                                    class="edahab_confirm  btn btn-success"
                                                                    style="text-align:center; display: none">
                                                                <span style="">{{ __('Confirm') }}</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="form3" class="tab-pane fade {{ old('zaad_phone') ?  'show active' : '' }}">
                                            <form action="{{ route('admin.zaad.pay') }}" method="post">
                                                @csrf
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-md-6 col-sm-8">
                                                        <div class="col-md-8 container-fluid">
                                                            <div class="form-group">
                                                                <label class="form-label required"
                                                                       for="name">Amount</label>
                                                                <input
                                                                    class="form-control @error('name') border-danger @enderror"
                                                                    id="" name="amount" type="number" step="any"
                                                                    value="{{ old('amount') }}" placeholder="Amount"
                                                                    required>
                                                            </div>
                                                            <label for="zaad_phone" class="form-label required">Zaad
                                                                Phone</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                          id="zaad_code">+252</span>
                                                                </div>
                                                                <input type="number" name="zaad_phone"
                                                                       class="form-control"
                                                                       placeholder="Zaad Phone" id="zaad_phone"
                                                                       aria-label="zaad_phone" value="{{ old('zaad_phone') }}"
                                                                       aria-describedby="zaad_code">
                                                            </div>

                                                        </div>

                                                        <div class="text-center m-3">
                                                            <button type="submit" id="loaderForPlaceOrder"
                                                                    class="loaderForPlaceOrder btn btn-success"
                                                                    style="text-align:center;">
                                                                <span style="">{{ __('Payment') }}</span>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function () {
            var currentDate = new Date();
            $("#datepicker").datepicker({
                // minDate: currentDate
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            // Add change event listener to the file input
            $('#imageInput').on('change', function () {
                var input = $(this)[0];

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {

                        $('.previewImage').show();
                        $('#previewImage').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });

        function edahabPayment() {
            let number = $('#edahab_phone').val();
            let amount = $('#edahab_amount').val();
            if (amount == '') {
                alert('Please enter amount');
                return false;
            }
            if (number == '') {
                alert('Please enter phone number');
                return false;
            }

            $(".edahabBtn").prop('disabled', true);

            $(".edahabBtn").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            $.ajax({
                url: '{{ route("admin.edahab.pay") }}',
                method: 'GET',
                data: {
                    edahab_phone: number,
                    amount: amount,
                },
                success: function (res) {
                    console.log(res)
                    if (res.status == true) {
                        $("#edahab_phone").prop('readonly', true);
                        $("#edahab_amount").prop('readonly', true);
                        $(".confirm_section").show();
                        $(".edahabBtn").hide();
                        $(".edahab_confirm").show();
                        $(".edit_edahab").show();
                        $("#sent_code").val(res.code);
                        toastr.success(res.message);
                    } else {
                        $(".edahabBtn").prop('disabled', false);
                        $(".edahabBtn").html('Payment');
                        toastr.error(res.message);
                    }

                }
            });
        }

        $('#edit_edahab').click(function () {
            $("#edahab_phone").prop('readonly', false);
            $("#edahab_amount").prop('readonly', false);
            $(".confirm_section").hide();
            $(".edahabBtn").show();
            $(".edahabBtn").prop('disabled', false);
            $(".edahabBtn").html('Payment');
            $(".edahab_confirm").hide();
            $(".edit_edahab").hide();
        });

        function edahabOrder(e) {
            if ($('#confirm_code').val() != $('#sent_code').val()) {
                $('#edahab_confirmBtn').prop('disabled', false);
                $('#edahab_confirmBtn').html('Confirm');
                console.log('eee')
                toastr.error('Please enter a valid code.')
                e.preventDefault();
                return false;
            }
        }
    </script>
@endpush
