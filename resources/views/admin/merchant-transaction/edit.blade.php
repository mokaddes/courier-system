@extends('admin.layouts.master')


@section('payments', 'menu-open')

@section('recharge-request', 'active')

@section('title')Recharge update @endsection

@push('style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
                            <li class="breadcrumb-item active">Recharge update</li>
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
                                        <h3 class="card-title">Recharge Update</h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            <a class="btn btn-primary"
                                                href="{{ route('admin.merchant.recharge.request') }}">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body ">
                                <form action="{{ route('admin.merchant.recharge.update',$recharge_request->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-8 col-sm-8">
                                            <div class="row ">
                                                    <div class="col-12">
                                                        <div class="form-group" style="text-align: center;">
                                                            <img src="{{ asset($recharge_request->proof_image) }}" id="previewImage" alt="Proof Image" width="100px" height="100px" class="rounded-circle">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="form-label required" for="name">Amount</label>
                                                            <input class="form-control @error('name') border-danger @enderror" id="" name="amount" type="number" value="{{ $recharge_request->amount }}" required>
                                                            @error('amount')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="proof_image">Proof Image</label>
                                                            <input class="form-control @error('name') border-danger @enderror"
                                                                id="imageInput" name="proof_image" type="file"
                                                                value="{{ old('proof_image') }}">
                                                            @error('proof_image')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="slip_number">Slip Number</label>
                                                            <input class="form-control @error('slip_number') border-danger @enderror"
                                                                id="" name="slip_number" type="text"
                                                                value="{{ $recharge_request->slip_number }}">
                                                            @error('slip_number')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="form-label required" for="name">Payment Date</label>
                                                            <input class="form-control @error('payment_date') border-danger @enderror"
                                                                id="datepicker" name="payment_date" type="text"
                                                                value="{{ date('d-m-Y', strtotime($recharge_request->payment_date)) }}" required>
                                                            @error('payment_date')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group ">
                                                            <label class="form-label required" for="name">Payment Note</label>
                                                            <textarea name="payment_note" id="payment_note" cols="30" rows="2" class="form-control">{{ $recharge_request->payment_note }}</textarea>
                                                            @error('payment_note')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card-footer text-center">
                                                    <button type="submit" class="btn btn-success">Update</button>
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


@endsection
@push('script')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
        $(function() {
      var currentDate = new Date();
      $("#datepicker").datepicker({
        // minDate: currentDate
      });
    });
    </script>

    <script>
        $(document).ready(function() {
        // Add change event listener to the file input
        $('#imageInput').on('change', function() {
            var input = $(this)[0];

            if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // Set the source of the preview image to the data URL
                $('#previewImage').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
            }
        });
        });
    </script>
@endpush
