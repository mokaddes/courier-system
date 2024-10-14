@extends('admin.layouts.master')

@section('merchant_menu', 'menu-open')

@section('merchant_user', 'active')

@section('title')
    Merchant|Create
@endsection

@push('style')
    <link href="{{ asset('backend/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/image-uploader.min.css') }}" rel="stylesheet">

    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--multiple {
            padding: 5px;
        }

        .select2-search__field {
            border: none !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            padding: 5px !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: solid black 1px;
            outline: 0;
            padding: 5px !important;
        }
    </style>
    <style>
        .terms_condition ul li {
            list-style: disc;
        }

        .image-uploader .uploaded .uploaded-image {
            display: inline-block;
            width: 100%;
            padding-bottom: calc(16.6666667% - 1rem);
            height: 0;
            position: relative;
            margin: .5rem;
            background: #f3f3f3;
            cursor: default;
            height: 8rem;
        }

        .image-uploader .uploaded .uploaded-image img {
            object-fit: scale-down;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Merchant create') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Merchant create') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0">{{ __('Merchant create') }}
                                    <span class="float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.merchant.index') }}">
                                            Back</a>
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body">

                                <form method="POST" action="{{ route('admin.merchant.store') }}"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <fieldset class="border p-3 mb-5 mt-2">
                                            <legend class="w-auto float-none">Account Information</legend>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-4">
                                                    <label class="form-label required" for="name">Name</label>
                                                    <input class="form-control @error('name') is-invalid @enderror"
                                                           name="name" type="text" value="{{ old('name') }}"
                                                           placeholder="Name" autocomplete="off" required>

                                                    @if ($errors->has('name'))
                                                        <span
                                                            class="text-danger text-left">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-4">
                                                    <label class="form-label required" for="email">Email</label>
                                                    <input class="form-control @error('email') is-invalid @enderror"
                                                           name="email" type="email" value="{{ old('email') }}"
                                                           placeholder="Email address" autocomplete="off" required>
                                                    @if ($errors->has('email'))
                                                        <span
                                                            class="text-danger text-left">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-4">
                                                    <label class="form-label required" for="password">Password</label>
                                                    <input class="form-control @error('password') is-invalid @enderror"
                                                           name="password" type="password" value="{{ old('password') }}"
                                                           placeholder="Enter Password" autocomplete="off" required>
                                                    @if ($errors->has('password'))
                                                        <span
                                                            class="text-danger text-left">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label required">{{ __('Name of Your Business') }}</label>
                                                        <input
                                                            class="form-control @error('business_name') is-invalid @enderror"
                                                            name="business_name" type="text"
                                                            value="{{ old('business_name') }}"
                                                            placeholder="{{ __('Business Name') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label required">{{ __('Owner\'s Full Name') }}</label>
                                                        <input
                                                            class="form-control @error('business_owner_name') is-invalid @enderror"
                                                            name="business_owner_name" type="text"
                                                            value="{{ old('business_owner_name') }}"
                                                            placeholder="{{ __('Business Owner Full Name') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label required">{{ __('Business Owner Phone') }}</label>
                                                        <input
                                                            class="form-control @error('business_owner_phone') is-invalid @enderror"
                                                            name="business_owner_phone" type="text"
                                                            value="{{ old('business_owner_phone') }}"
                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                            placeholder="{{ __('Business Owner Phone') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label required">{{ __('Business Email') }}</label>
                                                        <input
                                                            class="form-control @error('business_email') is-invalid @enderror"
                                                            name="business_email" type="email"
                                                            value="{{ old('business_email') }}"
                                                            placeholder="{{ __('Email') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <fieldset class="border p-3 mb-5">
                                            <legend class="w-auto float-none">Address</legend>
                                            <div class="row">

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label required">{{ __('Address Line') }}</label>
                                                        <input
                                                            class="form-control @error('address_line') is-invalid @enderror"
                                                            name="address_line" type="text"
                                                            value="{{ old('address_line') }}"
                                                            placeholder="{{ __('Address Line') }}" required>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label required">{{ __('Street Address') }}</label>
                                                        <input
                                                            class="form-control @error('street_address') is-invalid @enderror"
                                                            name="street_address" type="text"
                                                            value="{{ old('street_address') }}"
                                                            placeholder="{{ __('Street Address') }}" required>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label required">{{ __('State / Province / Region') }}</label>
                                                        <select
                                                            class="form-control @error('state') is-invalid @enderror"
                                                            id="region_id" name="state" value="{{ old('state') }}"
                                                            required>
                                                            <option value="">{{ __('Select State') }}</option>
                                                            @foreach ($regions as $region)
                                                                <option value="{{ $region->id }}"
                                                                        @if(old('state') == $region->id ) selected @endif>{{ $region->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label class="form-label required">{{ __('City') }}</label>
                                                        <select class="form-control @error('city') is-invalid @enderror"
                                                                id="pickup_city_id" name="city"
                                                                value="{{ old('city') }}"
                                                                required>
                                                            <option value="">{{ __('Select City') }}</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label required">{{ __('ZIP / Postal Code') }}</label>
                                                        <input
                                                            class="form-control @error('zip_code') is-invalid @enderror"
                                                            name="zip_code" type="text" value="{{ old('zip_code') }}"
                                                            placeholder="{{ __('ZIP / Postal Code') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <fieldset class="border p-3 mb-5">
                                            <legend class="w-auto float-none">Payment Information</legend>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label class="form-label required">{{ __('Bank Name') }}</label>
                                                        <input
                                                            class="form-control @error('bank_name') is-invalid @enderror"
                                                            name="bank_name" type="text" value="{{ old('bank_name') }}"
                                                            placeholder="{{ __('Bank Name') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label required">{{ __('Branch Name') }}</label>
                                                        <input
                                                            class="form-control @error('bank_branch_name') is-invalid @enderror"
                                                            name="bank_branch_name" type="text"
                                                            value="{{ old('bank_branch_name') }}"
                                                            placeholder="{{ __('Branch Name') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label required">{{ __('Account Type') }}</label>
                                                        <select
                                                            class="form-control @error('account_type') is-invalid @enderror"
                                                            name="account_type" required>
                                                            <option value="savings"
                                                                    @if (old('account_type') == 'savings') selected @endif>
                                                                Savings
                                                            </option>
                                                            <option value="current"
                                                                    @if (old('account_type') == 'current') selected @endif>
                                                                Current
                                                            </option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label required">{{ __('Account Holder Name') }}</label>
                                                        <input
                                                            class="form-control @error('account_holder_name') is-invalid @enderror"
                                                            name="account_holder_name" type="text"
                                                            value="{{ old('account_holder_name') }}"
                                                            placeholder="{{ __('Account Holder Name') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label required">{{ __('Account Number') }}</label>
                                                        <input
                                                            class="form-control @error('account_number') is-invalid @enderror"
                                                            name="account_number" type="text"
                                                            value="{{ old('account_number') }}"
                                                            placeholder="{{ __('Account Number') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="border p-3 mb-5">
                                            <legend class="w-auto float-none">Verification Information</legend>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label class="form-label required">{{ __('ID Type') }}</label>
                                                        <select
                                                            class="form-control @error('id_type') is-invalid @enderror"
                                                            name="id_type" required>
                                                            <option value="Passport"
                                                                    @if (old('id_type') == 'Passport') selected @endif>
                                                                Passport
                                                            </option>
                                                            <option value="National Identity Card"
                                                                    @if (old('id_type') == 'National Identity Card') selected @endif>
                                                                National Identity Card
                                                            </option>
                                                            <option value="Driving License"
                                                                    @if (old('id_type') == 'Driving License') selected @endif>
                                                                Driving License
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label class="form-label required">{{ __('ID Number') }}</label>
                                                        <input
                                                            class="form-control @error('id_number') is-invalid @enderror"
                                                            name="id_number" type="text" value="{{ old('id_number') }}"
                                                            placeholder="{{ __('ID Number') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label required">{{ __('ID\'s Front Image') }}</label>
                                                        <div class="id_font_image"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label required">{{ __('ID\'s Back Image') }}</label>
                                                        <div class="id_back_image"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label required">{{ __('Profile Picture') }}</label>
                                                        <span class="text-danger">(Preferred size is 300x300px)</span>
                                                        <div class="profile_image"></div>
                                                    </div>
                                                </div>

                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">

                                        <button class="btn btn-success" type="submit">Save</button>
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
    <script src="{{ asset('backend/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            // $('#roles').select2({
            //     tags: false
            // });
        });
    </script>
    <script src="{{ asset('frontend/js/image-uploader.min.js') }}"></script>
    <script>
        $('.id_font_image').imageUploader({
            label: "Id Font Image",
            imagesInputName: "id_font_image",
            maxFiles: 1
        });
        $('.id_back_image').imageUploader({
            label: "Id Back Image",
            imagesInputName: "id_back_image",
            maxFiles: 1
        });
        $('.profile_image').imageUploader({
            label: "Profile Image",
            imagesInputName: "profile_image",
            maxFiles: 1
        });

        $(document).ready(function () {
            let selectedCity = parseInt("{{ old('city') }}");
            getCity(selectedCity);
        })

        $(document).on('change', '#region_id', function (e) {
            getCity();
        })

        function getCity(selectedCity = null) {
            var region_id = $("#region_id").val();

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
    </script>
@endpush
