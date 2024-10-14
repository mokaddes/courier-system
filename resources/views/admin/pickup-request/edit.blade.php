@extends('admin.layouts.master')

@section('order-management', 'menu-open')
@section('pickup-request', 'active')

@section('title')
    Pickup Request Edit
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pickup Request Edit </h1>
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
                                        <h3 class="card-title">Pickup Request Edit</h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            <a class="btn btn-primary" href="{{ route('admin.pickup-request.index') }}">Back</a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-4">
                                <form action="{{ route('admin.pickup-request.update', $pickup_request->id) }}"
                                      method="post" enctype="multipart/form-data">
                                    @csrf
                                    <fieldset class="border p-3 mb-5">
                                        <legend class="w-auto">Contact Information</legend>
                                        <div class="row">
                                            @if (!Auth::user()->is_merchant)

                                                @if ($pickup_request->merchant_id)
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label required" for="merchant_id">Merchant
                                                            </label>
                                                            <select class="form-control form-select" id="merchant_id"
                                                                    name="merchant_id" onchange="run()">
                                                                <option value="" hidden>Select Merchant</option>
                                                                @if (isset($merchants) && $merchants->count() > 0)
                                                                    @foreach ($merchants as $value)
                                                                        <option data-name="{{ $value->name }}"
                                                                                data-address="{{ $value->address_line }}"
                                                                                data-state="{{ $value->state }}"
                                                                                data-city="{{ $value->city }}"
                                                                                data-zip_code="{{ $value->zip_code }}"
                                                                                data-pickup_mobile="{{ $value->business_owner_phone }}"
                                                                                data-pickup_email="{{ $value->business_email }}"
                                                                                value="{{ $value->id }}"
                                                                                {{ $pickup_request->merchant_id == $value->id ? 'selected' : '' }}>
                                                                            {{ $value->name }}
                                                                            (ID-{{ $value->merchant_id ?? 'N/A' }})
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('pickup_name')
                                                            <span class="invalid-feedback"
                                                                  role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                            @if (Auth::user()->is_merchant)

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label required" for="pickup_name">Name</label>
                                                        <input
                                                                class="form-control @error('pickup_name') is-invalid @enderror"
                                                                id="pickup_name" name="pickup_name" type="text"
                                                                value="{{ $pickup_request->pickup_name }}"
                                                                placeholder="Enter Name" required>
                                                        @error('pickup_name')
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="pickup_name">Contact Person
                                                        name
                                                    </label>
                                                    <input
                                                            class="form-control @error('pickup_contact_name') is-invalid @enderror"
                                                            id="pickup_contact_name" name="pickup_contact_name" type="text"
                                                            value="{{ $pickup_request->pickup_contact_name }}"
                                                            placeholder="Enter Contact Person name" required>
                                                    @error('pickup_contact_name')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="pickup_name">Address</label>
                                                    <input
                                                            class="form-control @error('pickup_address') is-invalid @enderror"
                                                            id="pickup_address" name="pickup_address" type="text"
                                                            value="{{ $pickup_request->pickup_address }}"
                                                            placeholder="Enter Address" required>
                                                    @error('pickup_address')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                <div class="form-group">
                                                    <label for="pickup_street_address" class="form-label">State </label>
                                                    <select name="pickup_street_address" id="pickup_street_address"

                                                            class="form-control @error('pickup_street_address') border-danger @enderror"required>
                                                        <option value="" class="d-none">Select State</option>
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}"
                                                                    @if ($pickup_request->pickup_street_address == $state->id) selected @endif>
                                                                {{ $state->name }}</option>
                                                        @endforeach

                                                    </select>

                                                    @error('pickup_street_address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="pickup_city_id">City</label>
                                                    <select class="form-control @error('pickup_city') is-invalid @enderror"
                                                            id="pickup_city_id" name="pickup_city">
                                                        @if (isset($cities) && $cities->count() > 0)
                                                            @foreach ($cities as $item)
                                                                <option value="{{ $item->id }}"
                                                                        {{ $pickup_request->pickup_city == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('pickup_city')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="pickup_zip">Zip / Postal
                                                        Code </label>
                                                    <input

                                                            class="form-control @error('pickup_zip') is-invalid @enderror"id="pickup_zip" name="pickup_zip" type="text"
                                                            value="{{ $pickup_request->pickup_zip }}"
                                                            placeholder="Enter Zip / Postal Code">
                                                    @error('pickup_zip')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="pickup_mobile">Mobile
                                                        Number</label>
                                                    <input
                                                            class="form-control @error('pickup_mobile') is-invalid @enderror"
                                                            id="pickup_mobile" name="pickup_mobile" type="text"
                                                            value="{{ $pickup_request->pickup_mobile }}"
                                                            placeholder="Enter Mobile Number" required>
                                                    @error('pickup_mobile')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="pickup_email">Email</label>
                                                    <input
                                                            class="form-control @error('pickup_email') is-invalid @enderror"
                                                            id="pickup_email" name="pickup_email" type="email"
                                                            value="{{ $pickup_request->pickup_email }}"
                                                            placeholder="Enter Email" required>
                                                    @error('pickup_email')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="border p-3 mb-5">
                                        <legend class="w-auto">Delivery Location</legend>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="delivery_name">Name</label>
                                                    <input
                                                            class="form-control @error('delivery_name') is-invalid @enderror"
                                                            id="delivery_name" name="delivery_name" type="text"
                                                            value="{{ $pickup_request->delivery_name }}"
                                                            placeholder="Enter Name" required>
                                                    @error('delivery_name')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="delivery_contact_name">Contact Person
                                                        name
                                                    </label>
                                                    <input class="form-control @error('delivery_contact_name') is-invalid @enderror"
                                                            id="delivery_contact_name" name="delivery_contact_name"
                                                            type="text"
                                                            value="{{ $pickup_request->delivery_contact_name }}"
                                                            placeholder="Enter Contact Person name" required>
                                                    @error('delivery_contact_name')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="pickup_name">Address</label>
                                                    <input
                                                            class="form-control @error('delivery_address') is-invalid @enderror"
                                                            id="delivery_address" name="delivery_address" type="text"
                                                            value="{{ $pickup_request->delivery_address }}"
                                                            placeholder="Enter Address" required>
                                                    @error('delivery_address')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                <div class="form-group">
                                                    <label for="delivery_street_address" class="form-label">State<span
                                                                class="text-danger">*</span></label>
                                                    <select name="delivery_street_address" id="delivery_street_address"
                                                            @if($pickup_request->payment_status) disabled @endif
                                                            class="form-control @error('delivery_street_address') border-danger @enderror"
                                                            required>
                                                        <option value="" class="d-none">Select State</option>
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}"
                                                                    @if (old('delivery_street_address') || $pickup_request->delivery_street_address == $state->id) selected @endif>
                                                                {{ $state->name }}</option>
                                                        @endforeach

                                                    </select>

                                                    @error('delivery_street_address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="delivery_city">City</label>
                                                    <select
                                                            @if($pickup_request->payment_status) disabled @endif
                                                            class="form-control @error('delivery_city') is-invalid @enderror"
                                                            id="delivery_city" name="delivery_city">
                                                        @if (isset($cities) && $cities->count() > 0)
                                                            @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}"
                                                                        {{ $pickup_request->delivery_city == $city->id ? 'selected' : '' }}>
                                                                    {{ $city->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('delivery_city')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="delivery_zip">Zip / Postal
                                                        Code </label>
                                                    <input @if($pickup_request->payment_status) readonly @endif
                                                            class="form-control @error('delivery_zip') is-invalid @enderror"
                                                            id="delivery_zip" name="delivery_zip" type="text"
                                                            value="{{ $pickup_request->delivery_zip }}"
                                                            placeholder="Enter Zip / Postal Code">
                                                    @error('delivery_zip')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="delivery_mobile">Mobile
                                                        Number</label>
                                                    <input
                                                            class="form-control @error('delivery_mobile') is-invalid @enderror"
                                                            id="delivery_mobile" name="delivery_mobile" type="text"
                                                            value="{{ $pickup_request->delivery_mobile }}"
                                                            placeholder="Enter Mobile Number" required>
                                                    @error('delivery_mobile')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="border p-3 mb-5">
                                        <legend class="w-auto">Product Details</legend>
                                        <div class="row">

                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                <div class="form-group">
                                                    <label for="product_name" class="form-label required">Product
                                                        Name </label>
                                                    <input type="text"
                                                           value="{{ old('product_name') ?? $pickup_request->product_name }}"
                                                           name="product_name" id="product_name"
                                                           class="form-control @error('product_name') border-danger @enderror"
                                                           placeholder="Product Name" required>
                                                    @error('product_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="quantity">Quantity</label>
                                                    <input class="form-control @error('quantity') is-invalid @enderror"
                                                           id="quantity" name="quantity" type="number"
                                                           value="{{ $pickup_request->quantity }}"
                                                           @if($pickup_request->payment_status) readonly @endif
                                                           placeholder="Enter Quantity" required>
                                                    @error('quantity')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="weight">Weight <span
                                                                class="text-danger">(Per Item)</span></label>
                                                    <select class="form-control @error('weight') is-invalid @enderror"
                                                            @if($pickup_request->payment_status) disabled @endif
                                                            id="weight" name="weight">
                                                        @if (isset($weights) && $weights->count() > 0)
                                                            @foreach ($weights as $weight)
                                                                <option value="{{ $weight->id }}"
                                                                        {{ $pickup_request->weight == $weight->id ? 'selected' : '' }}>
                                                                    {{ $weight->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('weight')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="weight">COD Amount</label>
                                                    <input @if($pickup_request->payment_status) readonly @endif
                                                    class="form-control @error('cod_amount') is-invalid @enderror"
                                                           id="cod_amount" name="cod_amount" type="number"
                                                           value="{{ $pickup_request->cod_amount }}"
                                                           placeholder="Enter Cod Amount" required>
                                                    @error('cod_amount')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="pricing_group_id">Delivery
                                                        Method
                                                    </label>
                                                    <select
                                                            class="form-control @error('pricing_group_id') is-invalid @enderror"
                                                            @if($pickup_request->payment_status) disabled @endif
                                                            id="pricing_group_id" name="pricing_group_id">
                                                        @if (isset($pricing_groups) && $pricing_groups->count() > 0)
                                                            @foreach ($pricing_groups as $value)
                                                                <option value="{{ $value->id }}"
                                                                        {{ $pickup_request->pricing_group_id == $value->id ? 'selected' : '' }}>
                                                                    {{ $value->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('pricing_group_id')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label required" for="description">Product
                                                        Description</label>
                                                    <textarea
                                                            class="form-control @error('description') is-invalid @enderror" id="summernote" name="description"
                                                            cols="30" rows="3" placeholder="Enter Details">{{ $pickup_request->description }}</textarea>
                                                    @error('description')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="col-lg-12 text-center">
                                        <div class="form-group">
                                            <button class="btn btn-success" type="submit">Update Pickup
                                                Request
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
@endsection

@push('script')
    <script>
        function run() {
            const name = $('#merchant_id option:selected').data('name');
            const address = $('#merchant_id option:selected').data('address');
            const state = $('#merchant_id option:selected').data('state');
            const city = $('#merchant_id option:selected').data('city');
            const zip_code = $('#merchant_id option:selected').data('zip_code');
            const pickup_mobile = $('#merchant_id option:selected').data('pickup_mobile');
            const pickup_email = $('#merchant_id option:selected').data('pickup_email');

            console.log(selector)
            $("#pickup_contact_name").val(name)
            $("#pickup_address").val(address)
            $('#pickup_street_address').val(state);
            getCity(city);
            $('#pickup_zip').val(zip_code);
            $('#pickup_mobile').val(pickup_mobile);
            $('#pickup_email').val(pickup_email);
        }

        $(document).ready(function () {
            let selectedCity = parseInt("{{ old('pickup_city_id') ?? $pickup_request->pickup_city }}");
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
            let selectedCity = parseInt("{{ old('delivery_city') ?? $pickup_request->delivery_city }}");
            getCity(selectedCity);
        })

        $(document).on('change', '#delivery_street_address', function () {
            getCity2();
        })

        function getCity2(selectedCity = null) {
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
@endpush
