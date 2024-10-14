@extends('admin.layouts.master')

@section('order-management', 'menu-open')
@section('pickup-request', 'active')
@section('title')
    Pickup Request
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('backend/css/summernote.min.css')}}">
@endpush
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
                                            @if (Auth::user()->can('admin.pickup-request.index'))
                                                <a class="btn btn-primary"
                                                   href="{{ route('admin.pickup-request.index') }}">Back</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-4">
                                <form action="{{ route('admin.pickup-request.store') }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <fieldset class="border p-3 mb-5">
                                        <legend class="w-auto">Contact Information</legend>
                                        <div class="row">
                                            @if (isset($merchants))
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="merchant_id">Merchant <span
                                                                    class="text-danger">*</span></label>
                                                        <select class="form-control form-select" id="merchant_id"
                                                                name="merchant_id" onchange="run()" required>
                                                            <option value="" hidden>Select Merchant</option>
                                                            @if (isset($merchants) && $merchants->count() > 0)
                                                                @foreach ($merchants as $value)
                                                                    <option data-name="{{ $value->name }}"
                                                                            data-address="{{$value->address_line}}"
                                                                            data-state="{{$value->state}}"
                                                                            data-city="{{$value->city}}"
                                                                            data-zip_code="{{$value->zip_code}}"
                                                                            data-pickup_mobile="{{$value->business_owner_phone}}"
                                                                            data-pickup_email="{{$value->business_email}}"

                                                                            {{$value->id == auth()->guard('admin')->id() ? "selected" : ""}}
                                                                            value="{{ $value->id }}">{{ $value->name }}
                                                                        >


                                                                        ID-{{$value->merchant_id ?? "N/A"}}
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
                                            @if (!isset($merchants))

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="pickup_id">Name <span
                                                                    class="text-danger">*</span></label>
                                                        <input
                                                                class="form-control @error('pickup_name') is-invalid @enderror"
                                                                id="pickup_id" name="pickup_name" type="text"
                                                                value="{{ old('pickup_name') }}" placeholder="Enter Name"
                                                                required>
                                                        @error('pickup_name')
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="pickup_contact_name">Contact Person
                                                        name
                                                        <span
                                                                class="text-danger">*</span></label>
                                                    <input
                                                            class="form-control @error('pickup_contact_name') is-invalid @enderror"
                                                            id="pickup_contact_name" name="pickup_contact_name" type="text"
                                                            value="{{ old('pickup_contact_name') }}"
                                                            placeholder="Enter Contact Person name" required>
                                                    @error('pickup_contact_name')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="pickup_address">Address <span
                                                                class="text-danger">*</span></label>
                                                    <input
                                                            class="form-control @error('pickup_address') is-invalid @enderror"
                                                            id="pickup_address" name="pickup_address" type="text"
                                                            value="{{ old('pickup_address') }}" placeholder="Enter Address"
                                                            required>
                                                    @error('pickup_address')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                <div class="form-group">
                                                    <label for="pickup_street_address"
                                                           class="form-label required">State<span
                                                                class="text-danger">*</span></label>
                                                    <select name="pickup_street_address"
                                                            id="pickup_street_address"
                                                            class="form-control @error('pickup_street_address') border-danger @enderror"
                                                            required>
                                                        <option value="" class="d-none">Select State</option>
                                                        @foreach($states as $state)
                                                            <option value="{{$state->id}}"
                                                                    @if(old('pickup_street_address') == $state->id) selected @endif>{{$state->name}}</option>
                                                        @endforeach

                                                    </select>

                                                    @error('pickup_street_address')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="pickup_city_id">City <span
                                                                class="text-danger">*</span></label>
                                                    <select
                                                            class="form-control @error('pickup_city') is-invalid @enderror"
                                                            id="pickup_city_id" name="pickup_city" required>

                                                    </select>
                                                    @error('pickup_city')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="pickup_zip">Zip / Postal
                                                        Code </label>
                                                    <input
                                                            class="form-control @error('pickup_zip') is-invalid @enderror"
                                                            id="pickup_zip" name="pickup_zip" type="text"
                                                            value="{{ old('pickup_zip') }}"
                                                            placeholder="Enter Zip / Postal Code">
                                                    @error('pickup_zip')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="pickup_mobile">Mobile Number <span
                                                                class="text-danger">*</span></label>
                                                    <input
                                                            class="form-control @error('pickup_mobile') is-invalid @enderror"
                                                            id="pickup_mobile" name="pickup_mobile" type="text"
                                                            value="{{ old('pickup_mobile') }}"
                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                            placeholder="Enter Mobile Number" required>
                                                    @error('pickup_mobile')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="pickup_email">Email</label>
                                                    <input
                                                            class="form-control @error('pickup_email') is-invalid @enderror"
                                                            id="pickup_email" name="pickup_email" type="email"
                                                            value="{{ old('pickup_mobile') }}" placeholder="Enter Email">
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
                                                    <label class="form-label" for="delivery_name">Name <span
                                                                class="text-danger">*</span></label>
                                                    <input
                                                            class="form-control @error('delivery_name') is-invalid @enderror"
                                                            id="delivery_name" name="delivery_name" type="text"
                                                            value="{{ old('delivery_name') }}" placeholder="Enter Name"
                                                            required>
                                                    @error('delivery_name')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="delivery_contact_name">Contact Person
                                                        name <span
                                                                class="text-danger">*</span></label>
                                                    <input
                                                            class="form-control @error('delivery_contact_name') is-invalid @enderror"
                                                            id="delivery_contact_name" name="delivery_contact_name"
                                                            type="text" value="{{ old('delivery_contact_name') }}"
                                                            placeholder="Enter Contact Person name" required>
                                                    @error('delivery_contact_name')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="delivery_address">Address <span
                                                                class="text-danger">*</span></label>
                                                    <input
                                                            class="form-control @error('delivery_address') is-invalid @enderror"
                                                            id="delivery_address" name="delivery_address" type="text"
                                                            value="{{ old('delivery_address') }}"
                                                            placeholder="Enter Address"
                                                            required>
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
                                                    <select name="delivery_street_address"
                                                            id="delivery_street_address"
                                                            class="form-control @error('delivery_street_address') border-danger @enderror"
                                                            required>
                                                        <option value="" class="d-none">Select State</option>
                                                        @foreach($states as $state)
                                                            <option value="{{$state->id}}"
                                                                    @if(old('delivery_street_address') == $state->id) selected @endif>{{$state->name}}</option>
                                                        @endforeach

                                                    </select>

                                                    @error('delivery_street_address')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="delivery_city">City <span
                                                                class="text-danger">*</span></label>
                                                    <select
                                                            class="form-control @error('delivery_city') is-invalid @enderror"
                                                            id="delivery_city" name="delivery_city" required>
                                                        @if (isset($cities) && $cities->count() > 0)
                                                            @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}">{{ $city->name }}
                                                                </option>
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
                                                    <label class="form-label" for="delivery_zip">Zip / Postal
                                                        Code </label>
                                                    <input
                                                            class="form-control @error('delivery_zip') is-invalid @enderror"
                                                            id="delivery_zip" name="delivery_zip" type="text"
                                                            value="{{ old('delivery_zip') }}"
                                                            placeholder="Enter Zip / Postal Code">
                                                    @error('delivery_zip')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="delivery_mobile">Mobile Number <span
                                                                class="text-danger">*</span></label>
                                                    <input
                                                            class="form-control @error('delivery_mobile') is-invalid @enderror"
                                                            id="delivery_mobile" name="delivery_mobile" type="number"
                                                            value="{{ old('delivery_mobile') }}"
                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
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
                                                    <label for="product_name" class="form-label">Product Name <span
                                                                class="text-danger">*</span></label>
                                                    <input type="text" value="{{old('product_name')}}"
                                                           name="product_name"
                                                           id="product_name"
                                                           class="form-control @error('product_name') border-danger @enderror"
                                                           placeholder="Product Name" required>
                                                    @error('product_name')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="quantity">Quantity <span
                                                                class="text-danger">*</span></label>
                                                    <input class="form-control @error('quantity') is-invalid @enderror"
                                                           id="quantity" name="quantity" type="number"
                                                           value="{{ old('quantity') }}"
                                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                           placeholder="Enter Quantity" required>
                                                    @error('quantity')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="weight">Weight <span
                                                                class="text-danger">*</span><span
                                                                class="text-danger">(Per Item)</span></label>
                                                    <select class="form-control @error('weight') is-invalid @enderror"
                                                            id="weight" name="weight" required>
                                                        @if (isset($weights) && $weights->count() > 0)
                                                            @foreach ($weights as $weight)
                                                                <option value="{{ $weight->id }}">{{ $weight->name }}
                                                                </option>
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
                                                    <label class="form-label" for="cod_amount">COD Amount <span
                                                                class="text-danger">*</span></label>
                                                    <input
                                                            class="form-control @error('cod_amount') is-invalid @enderror"
                                                            id="cod_amount" name="cod_amount" type="number"
                                                            value="{{ old('cod_amount') }}" placeholder="Enter Cod Amount"
                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                            required>
                                                    @error('cod_amount')
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="pricing_group_id">Delivery Method
                                                        *</label>
                                                    <select
                                                            class="form-control @error('pricing_group_id') is-invalid @enderror"
                                                            id="pricing_group_id" name="pricing_group_id" required>
                                                        @if (isset($pricing_groups) && $pricing_groups->count() > 0)
                                                            @foreach ($pricing_groups as $value)
                                                                <option value="{{ $value->id }}">{{ $value->name }}
                                                                </option>
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
                                                    <label class="form-label" for="summernote">Product Description <span
                                                                class="text-danger">*</span> </label>
                                                    <textarea
                                                            class="form-control @error('description') is-invalid @enderror"
                                                            id="summernote" name="description"
                                                            cols="30" rows="3" placeholder="Enter Details"
                                                            required></textarea>
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
@endsection

@push('script')
    <script src="{{asset('backend/js/summernote.min.js')}}"></script>
    <script>
        function run() {
            let marchant = $('#merchant_id option:selected');
            const name = marchant.data('name');
            const address = marchant.data('address');
            const state = marchant.data('state');
            const city = marchant.data('city');
            const zip_code = marchant.data('zip_code');
            const pickup_mobile = marchant.data('pickup_mobile');
            const pickup_email = marchant.data('pickup_email');


            $("#pickup_contact_name").val(name)
            $("#pickup_address").val(address)
            $('#pickup_street_address').val(state);
            getCity(city);
            $('#pickup_zip').val(zip_code);
            $('#pickup_mobile').val(pickup_mobile);
            $('#pickup_email').val(pickup_email);
        }

        $(document).ready(function () {
            run()
            {{--let selectedCity = parseInt("{{ old('pickup_city') }}");--}}
            {{--getCity(selectedCity);--}}
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
@endpush
