<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $setting = App\Models\Setting::first();
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pickup Request - {{ $setting->site_name }}</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset($setting->favicon) }}" type="image/x-icon">

    @include('admin.layouts.style')
    {{-- toastr style --}}
    <link rel="stylesheet" href="{{ asset('massage/toastr/toastr.css') }}">
    <link href="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- custom css  --}}
    <link rel="stylesheet" href="{{asset('backend/css/summernote.min.css')}}">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <div class="w-75 container-fluid">
        <div class="content mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h1 class="card-title">API Information</h1>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-4">
                                <form action="{{ route('api.pickup-request.check') }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="pickup_contact_name">Merchant ID
                                                        <span
                                                            class="text-danger">*</span></label>
                                                    <input
                                                        class="form-control"
                                                        id="merchant_id" name="merchant_id" type="text"
                                                        value="{{ old('merchant_id') }}"
                                                        placeholder="Enter Merchant ID" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="pickup_contact_name">Public Key
                                                        <span
                                                            class="text-danger">*</span></label>
                                                    <input
                                                        class="form-control"
                                                        id="public_key" name="public_key" type="text"
                                                        value="{{ old('public_key') }}"
                                                        placeholder="Enter Public key" required>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-lg-12 text-center">
                                        <div class="form-group">
                                            <button class="btn btn-success" type="submit">Submit
                                            </button>
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
@include('admin.layouts.script')

<script src="{{asset('backend/js/summernote.min.js')}}"></script>
<script>
    function run() {
        const name = $('#merchant_id option:selected').data('name');
        const address = $('#merchant_id option:selected').data('address');
        const state = $('#merchant_id option:selected').data('state');
        const city = $('#merchant_id option:selected').data('city');
        const zip_code = $('#merchant_id option:selected').data('zip_code');
        const pickup_mobile = $('#merchant_id option:selected').data('pickup_mobile');
        const pickup_email = $('#merchant_id option:selected').data('pickup_email');


        $("#pickup_contact_name").val(name)
        $("#pickup_address").val(address)
        $('#pickup_street_address').val(state);
        getCity(city);
        $('#pickup_zip').val(zip_code);
        $('#pickup_mobile').val(pickup_mobile);
        $('#pickup_email').val(pickup_email);
    }

    $(document).ready(function () {
        let selectedCity = parseInt("{{ old('pickup_city') }}");
        getCity(selectedCity);
    })

    $(document).on('change', '#pickup_street_address', function () {
        getCity();
    })


    function getCity(selectedCity = null) {
        const region_id = $("#pickup_street_address").val();
        console.log(region_id);

        $.ajax({
            method: 'get',
            url: "{{ route('getPickup-area') }}",
            data: {
                region_id: region_id,
                selected_city: selectedCity
            },
            success: function (res) {

                // console.log(res);
                $('#pickup_city_id').html(res);
            }
        })
    }


    $(document).ready(function () {
        let selectedCity = parseInt("{{ old('delivery_street_address') }}");
        getCityDelivary(selectedCity);
    })

    $(document).on('change', '#delivery_street_address', function () {
        getCityDelivary();
    })

    function getCityDelivary(selectedCity = null) {
        const region_id = $("#delivery_street_address").val();
        console.log(region_id);

        $.ajax({
            method: 'get',
            url: "{{ route('getPickup-area') }}",
            data: {
                region_id: region_id,
                selected_city: selectedCity
            },
            success: function (res) {

                // console.log(res);
                $('#delivery_city').html(res);
            }
        })
    }


</script>
</body>
