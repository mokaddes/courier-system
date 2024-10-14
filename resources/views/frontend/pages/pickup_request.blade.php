@extends('frontend.layouts.app')

@section('title')
    {{ __('Pickup Request') }}
@endsection

{{-- @push('meta')
    <link href="{{ asset('frontend/images/favicons/apple-icon-60x60.png') }}" rel="apple-touch-icon" sizes="60x60">
    <link href="{{ asset('frontend/images/favicons/apple-icon-72x72.png') }}" rel="apple-touch-icon" sizes="72x72">
    <link href="{{ asset('frontend/images/favicons/apple-icon-76x76.png') }}" rel="apple-touch-icon" sizes="76x76">
    <link href="{{ asset('frontend/images/favicons/apple-icon-114x114.png') }}" rel="apple-touch-icon" sizes="114x114">
    <link href="{{ asset('frontend/images/favicons/apple-icon-120x120.png') }}" rel="apple-touch-icon" sizes="120x120">
    <link href="{{ asset('frontend/images/favicons/apple-icon-144x144.png') }}" rel="apple-touch-icon" sizes="144x144">
    <link href="{{ asset('frontend/images/favicons/apple-icon-152x152.png') }}" rel="apple-touch-icon" sizes="152x152">
    <link href="{{ asset('frontend/images/favicons/apple-icon-180x180.png') }}" rel="apple-touch-icon" sizes="180x180">
    <link type="image/png" href="{{ asset('frontend/images/favicons/android-icon-192x192.png') }}" rel="icon"
          sizes="192x192">
    <link type="image/png" href="{{ asset('frontend/images/favicons/favicon-32x32.png') }}" rel="icon" sizes="32x32">
    <link type="image/png" href="{{ asset('frontend/images/favicons/favicon-96x96.png') }}" rel="icon" sizes="96x96">
    <link type="image/png" href="{{ asset('frontend/images/favicons/favicon-16x16.png') }}" rel="icon" sizes="16x16">
@endpush --}}
@push('meta')
<meta property="og:title" content="{{ $meta_title }}" />
<meta property="og:description" content="{{ $meta_description }}" />
<meta property="og:image" content="{{ asset($meta_image) }}" />
@endpush
@push('css')
@endpush

@section('content')
    {{-- breadcrumb --}}
    <div class="breadcrumb_sec mt-5 mb-5">
        <div class="container">
            <div class="text-center">
                <h4>{{ 'Pick up request' }}</h4>
                <p>
                    {{ 'Please submit this form for your order for pickup and delivery:' }}
                </p>
            </div>
        </div>
    </div>
    {{-- pick up request start  --}}
    <div class="pick-up-request-sec mb-5">

        <div class="container">
            <div class="pickup-form">
                <form action="{{ route('pickup.request.submit') }}" method="post" class="px-3">
                    @csrf
                    <fieldset class="border p-3 mb-5 mt-5">
                        <legend class="w-auto float-none">Pickup Location</legend>
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label required" for="pickup_name">Name</label>
                                    <input class="form-control @error('pickup_name') is-invalid @enderror"
                                           id="pickup_name"
                                           name="pickup_name" type="text" value="{{ old('pickup_name') }}"
                                           placeholder="Enter name" autocomplete="off" required>
                                    @error('pickup_name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label" for="contact_person">Contact Person Name <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control @error('pickup_contact_name') is-invalid @enderror"
                                           id="pickup_contact_name" name="pickup_contact_name" type="text"
                                           value="{{ old('pickup_contact_name') }}"
                                           placeholder="Enter contact person name"
                                           autocomplete="off" required>
                                    @error('pickup_contact_name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label required" for="pickup_address">Address</label>
                                    <input class="form-control @error('pickup_address') is-invalid @enderror"
                                           id="pickup_address" name="pickup_address" type="text"
                                           value="{{ old('pickup_address') }}" placeholder="Enter address"
                                           autocomplete="off"
                                           required>
                                    @error('pickup_address')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            {{--                        <div class="col-md-6 col-xl-4">--}}
                            {{--                            <div class="form-group">--}}
                            {{--                                <label class="form-label required" for="pickup_street_address">Street Address</label>--}}
                            {{--                                <input class="form-control @error('pickup_street_address') is-invalid @enderror"--}}
                            {{--                                    id="pickup_street_address" name="pickup_street_address" type="text"--}}
                            {{--                                    value="{{ old('pickup_street_address') }}" placeholder="Enter street address"--}}
                            {{--                                    autocomplete="off" required>--}}
                            {{--                                @error('pickup_street_address')--}}
                            {{--                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
                            {{--                                @enderror--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}

                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="pickup_street_address" class="form-label">State<span
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


                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label required" for="pickup_city">City</label>
                                    <select class="form-control form-select @error('pickup_city') is-invalid @enderror"
                                            id="pickup_city" name="pickup_city" required>
                                        @if (isset($cities) && $cities->count() > 0)
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                        @if (old('city') == $city->id) selected @endif>
                                                    {{ $city->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('pickup_city')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label required" for="pickup_zip">Zip / Postal Code</label>
                                    <input class="form-control @error('pickup_zip') is-invalid @enderror"
                                           id="pickup_zip"
                                           name="pickup_zip" type="text" value="{{ old('pickup_zip') }}"
                                           placeholder="Zip / postal code" autocomplete="off" required>
                                    @error('pickup_zip')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label required" for="pickup_mobile">Mobile Number</label>
                                    <input class="form-control @error('pickup_mobile') is-invalid @enderror"
                                           id="pickup_mobile" name="pickup_mobile" type="text"
                                           value="{{ old('pickup_mobile') }}" placeholder="Enter mobile number"
                                           autocomplete="off" required>
                                    @error('pickup_mobile')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label" for="pickup_email">Email</label>
                                    <input class="form-control @error('pickup_email') is-invalid @enderror"
                                           id="pickup_email"
                                           name="pickup_email" type="email" value="{{ old('pickup_email') }}"
                                           placeholder="Enter email address" autocomplete="off">
                                    @error('pickup_email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="border p-3 mb-5">
                        <legend class="w-auto float-none">Delivery Location</legend>
                        <div class="row">

                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label required" for="delivery_name">Name</label>
                                    <input class="form-control @error('delivery_name') is-invalid @enderror"
                                           id="delivery_name" name="delivery_name" type="text"
                                           value="{{ old('delivery_name') }}" placeholder="Enter name"
                                           autocomplete="off"
                                           required>
                                    @error('delivery_name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label required" for="delivery_contact_name">Contact Person
                                        Name</label>
                                    <input class="form-control @error('delivery_contact_name') is-invalid @enderror"
                                           id="delivery_contact_name " name="delivery_contact_name" type="text"
                                           value="{{ old('delivery_contact_name') }}"
                                           placeholder="Enter contact person name"
                                           autocomplete="off" required>
                                    @error('delivery_contact_name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label required" for="delivery_address">Address</label>
                                    <input class="form-control @error('delivery_address') is-invalid @enderror"
                                           id="delivery_address" name="delivery_address" type="text"
                                           value="{{ old('delivery_address') }}" placeholder="Enter address"
                                           autocomplete="off"
                                           required>
                                    @error('delivery_address')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            {{--                        <div class="col-md-6 col-xl-4">--}}
                            {{--                            <div class="form-group">--}}
                            {{--                                <label class="form-label required" for="delivery_street_address">Street Address</label>--}}
                            {{--                                <input class="form-control @error('delivery_street_address') is-invalid @enderror"--}}
                            {{--                                    id="delivery_street_address" name="delivery_street_address" type="text"--}}
                            {{--                                    value="{{ old('delivery_street_address') }}" placeholder="Enter street address"--}}
                            {{--                                    autocomplete="off" required>--}}
                            {{--                                @error('delivery_street_address')--}}
                            {{--                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
                            {{--                                @enderror--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}


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

                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label required" for="delivery_city">City</label>
                                    <select
                                        class="form-control form-select @error('delivery_city') is-invalid @enderror"
                                        id="delivery_city" name="delivery_city" required>
                                        @if (isset($cities) && $cities->count() > 0)
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                        @if (old('delivery_city') == $city->id) selected @endif>{{ $city->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('delivery_city')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label required" for="delivery_zip">Zip / Postal Code</label>
                                    <input class="form-control @error('delivery_zip') is-invalid @enderror"
                                           id="delivery_zip"
                                           name="delivery_zip" type="text" value="{{ old('delivery_zip') }}"
                                           placeholder="Zip / postal code" autocomplete="off" required>
                                    @error('delivery_zip')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label required" for="delivery_mobile">Mobile Phone</label>
                                    <input
                                        class="form-control @error('delivery_mobile') border-danger is-invalid @enderror"
                                        id="delivery_mobile" name="delivery_mobile" type="text"
                                        value="{{ old('delivery_mobile') }}" placeholder="Enter mobile number"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        autocomplete="off" required>
                                    @error('delivery_mobile')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border p-3 mb-5">
                        <legend class="w-auto float-none">Product Details</legend>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="product_name" class="form-label required">Product
                                        Name </label>
                                    <input type="text"
                                           value="{{ old('product_name')}}"
                                           name="product_name" id="product_name"
                                           class="form-control @error('product_name') border-danger @enderror"
                                           placeholder="Product Name" required>
                                    @error('product_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label required" for="quantity">Quantity</label>
                                    <input class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                                           name="quantity" type="number" value="{{ old('quantity') }}"
                                           placeholder="Enter quantity" autocomplete="off"
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                           required>
                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label required" for="weight">Weight</label>
                                    <select class="form-control form-select @error('quantity') is-invalid @enderror"
                                            id="weight" name="weight" required>
                                        @if (isset($weights) && $weights->count() > 0)
                                            @foreach ($weights as $value)
                                                <option value="{{ $value->id }}"
                                                        @if (old('weight') == $value->id) selected @endif>{{ $value->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('weight')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label required" for="cod_amount">COD Amount</label>
                                    <input class="form-control @error('weight') is-invalid @enderror" id="cod_amount"
                                           name="cod_amount" type="number" value="{{ old('cod_amount') }}"
                                           placeholder="In Sh" autocomplete="off"
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                           required>
                                    @error('cod_amount')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label required" for="cod_amount">Delivery Method</label>
                                    <select
                                        class="form-control form-select @error('pricing_group_id') is-invalid @enderror"
                                        id="pricing_group_id" name="pricing_group_id" required>
                                        @if (isset($pricing_groups) && $pricing_groups->count() > 0)
                                            @foreach ($pricing_groups as $value)
                                                @if($value->pricing->count() > 0)
                                                    <option value="{{ $value->id }}"
                                                            @if (old('pricing_group_id') == $value->id) selected @endif>{{ $value->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('pricing_group_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label required" for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description"
                                              name="description"
                                              cols="30" rows="5" placeholder="Enter description" required>{{ old('description') }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="col-12 mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection

@push('js')

    <script !src="">
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
                    $('#pickup_city').html(res);
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
