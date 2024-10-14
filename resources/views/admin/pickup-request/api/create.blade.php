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
                                        <h1 class="card-title">Pickup Request</h1>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-4">
                                <form action="{{ route('api.pickup-request.store') }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
{{--                                    <fieldset class="border p-3 mb-5">--}}
{{--                                        <legend class="w-auto">API Information</legend>--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label class="form-label" for="merchant_id">Merchant ID--}}
{{--                                                        <span--}}
{{--                                                            class="text-danger">*</span></label>--}}
{{--                                                    <input--}}
{{--                                                        class="form-control"--}}
{{--                                                        id="merchant_id" name="merchant_id" type="text"--}}
{{--                                                        value="{{ $api_key->merchant_id }}" readonly>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label class="form-label" for="public_key">Public Key--}}
{{--                                                        <span--}}
{{--                                                            class="text-danger">*</span></label>--}}
{{--                                                    <input--}}
{{--                                                        class="form-control"--}}
{{--                                                        id="public_key" name="public_key" type="text"--}}
{{--                                                        value="{{ $api_key->public_key }}" readonly>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label class="form-label" for="secret_key">Secret Key--}}
{{--                                                        <span--}}
{{--                                                            class="text-danger">*</span></label>--}}
{{--                                                    <input--}}
{{--                                                        class="form-control"--}}
{{--                                                        id="secret_key" name="secret_key" type="text"--}}
{{--                                                        value="{{ old('secret_key') }}" required>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </fieldset>--}}

                                    <input type="hidden" name="redirect_url" value="{{ request('redirect_url') }}">
                                    <input type="hidden" name="api_key_id" value="{{ $api_key->id }}">
                                    <fieldset class="border p-3 mb-5">
                                        <legend class="w-auto">Contact Information</legend>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="pickup_contact_name">Contact Person
                                                        name
                                                        <span
                                                            class="text-danger">*</span></label>
                                                    <input
                                                        class="form-control"
                                                        id="pickup_contact_name" name="pickup_contact_name" type="text"
                                                        value="{{ old('pickup_contact_name') }}"
                                                        placeholder="Enter Contact Person name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="pickup_address">Address <span
                                                            class="text-danger">*</span></label>
                                                    <input
                                                        class="form-control"
                                                        id="pickup_address" name="pickup_address" type="text"
                                                        value="{{ old('pickup_address') }}" placeholder="Enter Address"
                                                        required>
                                                </div>
                                            </div>
                                            {{--                                        <div class="col-lg-4">--}}
                                            {{--                                            <div class="form-group">--}}
                                            {{--                                                <label class="form-label" for="pickup_name">Street address </label>--}}
                                            {{--                                                <input--}}
                                            {{--                                                    class="form-control @error('pickup_street_address') is-invalid @enderror"--}}
                                            {{--                                                    id="pickup_street_address" name="pickup_street_address" type="text"--}}
                                            {{--                                                    value="{{ old('pickup_street_address') }}"--}}
                                            {{--                                                    placeholder="Enter Street address">--}}
                                            {{--                                                @error('pickup_street_address')--}}
                                            {{--                                                <span class="invalid-feedback"--}}
                                            {{--                                                      role="alert"><strong>{{ $message }}</strong></span>--}}
                                            {{--                                                @enderror--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </div>--}}

                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                <div class="form-group">
                                                    <label for="pickup_street_address required"
                                                           class="form-label">State<span
                                                            class="text-danger">*</span></label>
                                                    <select name="pickup_street_address"
                                                            id="pickup_street_address"
                                                            class="form-control "
                                                            required>
                                                        <option value="" class="d-none">Select State</option>
                                                        @foreach($states as $state)
                                                            <option value="{{$state->id}}"
                                                                    @if(old('pickup_street_address') == $state->id) selected @endif>{{$state->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="pickup_city_id">City <span
                                                            class="text-danger">*</span></label>
                                                    <select
                                                        class="form-control "
                                                        id="pickup_city_id" name="pickup_city" required>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="pickup_zip">Zip / Postal
                                                        Code </label>
                                                    <input
                                                        class="form-control "
                                                        id="pickup_zip" name="pickup_zip" type="text"
                                                        value="{{ old('pickup_zip') }}"
                                                        placeholder="Enter Zip / Postal Code">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="pickup_mobile">Mobile Number <span
                                                            class="text-danger">*</span></label>
                                                    <input
                                                        class="form-control "
                                                        id="pickup_mobile" name="pickup_mobile" type="text"
                                                        value="{{ old('pickup_mobile') }}"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                        placeholder="Enter Mobile Number" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="pickup_email">Email</label>
                                                    <input
                                                        class="form-control"
                                                        id="pickup_email" name="pickup_email" type="email"
                                                        value="{{ old('pickup_mobile') }}" placeholder="Enter Email">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="border p-3 mb-5">
                                        <legend class="w-auto">Delivery Location</legend>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="delivery_name">Name <span
                                                            class="text-danger">*</span></label>
                                                    <input
                                                        class="form-control "
                                                        id="delivery_name" name="delivery_name" type="text"
                                                        value="{{ old('delivery_name') }}" placeholder="Enter Name"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="delivery_contact_name">Contact Person
                                                        name <span
                                                            class="text-danger">*</span></label>
                                                    <input
                                                        class="form-control"
                                                        id="delivery_contact_name" name="delivery_contact_name"
                                                        type="text" value="{{ old('delivery_contact_name') }}"
                                                        placeholder="Enter Contact Person name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="delivery_address">Address <span
                                                            class="text-danger">*</span></label>
                                                    <input
                                                        class="form-control "
                                                        id="delivery_address" name="delivery_address" type="text"
                                                        value="{{ old('delivery_address') }}"
                                                        placeholder="Enter Address"
                                                        required>
                                                </div>
                                            </div>
                                            {{--                                        <div class="col-lg-4">--}}
                                            {{--                                            <div class="form-group">--}}
                                            {{--                                                <label class="form-label" for="delivery_street_address">Street--}}
                                            {{--                                                    address</label>--}}
                                            {{--                                                <input--}}
                                            {{--                                                    class="form-control @error('delivery_street_address') is-invalid @enderror"--}}
                                            {{--                                                    id="delivery_street_address" name="delivery_street_address"--}}
                                            {{--                                                    type="text" value="{{ old('delivery_street_address') }}"--}}
                                            {{--                                                    placeholder="Enter Street address">--}}
                                            {{--                                                @error('delivery_street_address')--}}
                                            {{--                                                <span class="invalid-feedback"--}}
                                            {{--                                                      role="alert"><strong>{{ $message }}</strong></span>--}}
                                            {{--                                                @enderror--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </div>--}}


                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                <div class="form-group">
                                                    <label for="delivery_street_address" class="form-label">State<span
                                                            class="text-danger">*</span></label>
                                                    <select name="delivery_street_address"
                                                            id="delivery_street_address"
                                                            class="form-control "
                                                            required>
                                                        <option value="" class="d-none">Select State</option>
                                                        @foreach($states as $state)
                                                            <option value="{{$state->id}}"
                                                                    @if(old('delivery_street_address') == $state->id) selected @endif>{{$state->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="delivery_city">City <span
                                                            class="text-danger">*</span></label>
                                                    <select
                                                        class="form-control "
                                                        id="delivery_city" name="delivery_city" required>
                                                        @if (isset($cities) && $cities->count() > 0)
                                                            @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}">{{ $city->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="delivery_zip">Zip / Postal
                                                        Code </label>
                                                    <input
                                                        class="form-control "
                                                        id="delivery_zip" name="delivery_zip" type="text"
                                                        value="{{ old('delivery_zip') }}"
                                                        placeholder="Enter Zip / Postal Code">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="delivery_mobile">Mobile Number <span
                                                            class="text-danger">*</span></label>
                                                    <input
                                                        class="form-control"
                                                        id="delivery_mobile" name="delivery_mobile" type="number"
                                                        value="{{ old('delivery_mobile') }}"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                        placeholder="Enter Mobile Number" required>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="border p-3 mb-5">
                                        <legend class="w-auto">Product Details</legend>
                                        <div class="row">

                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                <div class="form-group">
                                                    <label for="product_name" class="form-label">Product Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" value="{{old('product_name')}}"
                                                           name="product_name"
                                                           id="product_name"
                                                           class="form-control "
                                                           placeholder="Product Name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="quantity">Quantity <span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control "
                                                           id="quantity" name="quantity" type="number"
                                                           value="{{ old('quantity') }}"
                                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                           placeholder="Enter Quantity" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="weight">Weight <span
                                                            class="text-danger">*</span><span
                                                            class="text-danger">(Per Item)</span></label>
                                                    <select class="form-control "
                                                            id="weight" name="weight" required>
                                                        @if (isset($weights) && $weights->count() > 0)
                                                            @foreach ($weights as $weight)
                                                                <option value="{{ $weight->id }}">{{ $weight->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="cod_amount">COD Amount <span
                                                            class="text-danger">*</span></label>
                                                    <input
                                                        class="form-control "
                                                        id="cod_amount" name="cod_amount" type="number"
                                                        value="{{ old('cod_amount') }}" placeholder="Enter Cod Amount"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="pricing_group_id">Delivery Method
                                                        *</label>
                                                    <select
                                                        class="form-control "
                                                        id="pricing_group_id" name="pricing_group_id" required>
                                                        @if (isset($pricing_groups) && $pricing_groups->count() > 0)
                                                            @foreach ($pricing_groups as $value)
                                                                <option value="{{ $value->id }}">{{ $value->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="summernote">Product Description <span
                                                            class="text-danger">*</span> </label>
                                                    <textarea
                                                        class="form-control "
                                                        id="summernote" name="description"
                                                        cols="30" rows="3" placeholder="Enter Details"
                                                        required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="col-lg-12 text-center">
                                        <div class="form-group">
                                            <button class="btn btn-success" type="submit">Add Pickup Request
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
