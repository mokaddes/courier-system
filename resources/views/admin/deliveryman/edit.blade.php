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
@section('deliveryman_menu', 'menu-open')

@section('deliveryman_list', 'active')

@section('title')
    Delivery Man | Update
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

        ..select2-container--default.select2-container--focus .select2-selection--multiple {
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
                        <h1 class="m-0">{{ __('Delivery Man user update') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Delivery Man update') }}</li>
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
                                <h5 class="m-0">{{ __('Delivery Man Update') }}
                                    <span class="float-right">
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.deliveryman.index') }}">
                                            Back</a>
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.deliveryman.update', ['id' => $admin->id]) }}"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <fieldset class="border p-3 mb-5 mt-2">
                                            <legend class="w-auto float-none">Account Information</legend>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-4">
                                                    <label class="form-label required" for="name">Name</label>
                                                    <input class="form-control @error('name') is-invalid @enderror"
                                                           name="name" type="text"
                                                           value="{{ old('name') ? old('name') : $admin->name ?? '' }}"
                                                           placeholder="Name" autocomplete="off" required>

                                                    @if ($errors->has('name'))
                                                        <span
                                                            class="text-danger text-left">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-4">
                                                    <label class="form-label required" for="email">Email</label>
                                                    <input class="form-control @error('email') is-invalid @enderror"
                                                           name="email" type="email"
                                                           value="{{ old('email') ? old('email') : $admin->email ?? '' }}"
                                                           placeholder="Email address" autocomplete="off" required>
                                                    @if ($errors->has('email'))
                                                        <span
                                                            class="text-danger text-left">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label required">{{ __('Phone number') }}</label>
                                                        <input
                                                            class="form-control @error('business_owner_phone') is-invalid @enderror"
                                                            name="business_owner_phone" type="text"
                                                            value="{{ old('business_owner_phone') ? old('business_owner_phone') : $admin->business_owner_phone ?? '' }}"
                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                            placeholder="{{ __('Phone number') }}" required>
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
                                                                value="{{ old('address_line') ? old('address_line') : $admin->address_line ?? '' }}"
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
                                                                value="{{ old('street_address') ? old('street_address') : $admin->street_address ?? '' }}"
                                                                placeholder="{{ __('Street Address') }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                        <div class="mb-4">
                                                            <label
                                                                class="form-label required">{{ __('State / Province / Region') }}</label>
                                                            <select
                                                                class="form-control @error('state') is-invalid @enderror"
                                                                id="region_id" name="state" required>
                                                                <option value="">{{ __('Select State') }}</option>
                                                                @foreach ($regions as $region)
                                                                    <option value="{{ $region->id }}"
                                                                            @if ($admin->state == $region->id) selected @endif>
                                                                        {{ $region->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                        <div class="mb-4">
                                                            <label class="form-label required">{{ __('City') }}</label>
                                                            <select
                                                                class="form-control @error('city') is-invalid @enderror"
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
                                                                name="zip_code" type="text"
                                                                value="{{ old('zip_code') ? old('zip_code') : $admin->zip_code ?? '' }}"
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
                                                        <label class="form-label">{{ __('Bank Name') }}</label>
                                                        <input
                                                            class="form-control @error('bank_name') is-invalid @enderror"
                                                            name="bank_name" type="text"
                                                            value="{{ old('bank_name') ? old('bank_name') : $admin->bank_name ?? '' }}"
                                                            placeholder="{{ __('Bank Name') }}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label">{{ __('Branch Name') }}</label>
                                                        <input
                                                            class="form-control @error('bank_branch_name') is-invalid @enderror"
                                                            name="bank_branch_name" type="text"
                                                            value="{{ old('bank_branch_name') ? old('bank_branch_name') : $admin->bank_branch_name ?? '' }}"
                                                            placeholder="{{ __('Branch Name') }}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label">{{ __('Account Type') }}</label>
                                                        <select
                                                            class="form-control @error('account_type') is-invalid @enderror"
                                                            name="account_type">
                                                            <option value="savings"
                                                                    @if (old('account_type') == 'savings' || $admin->bank_name == 'savings') selected @endif>
                                                                Savings
                                                            </option>
                                                            <option value="current"
                                                                    @if (old('account_type') == 'current' || $admin->bank_name == 'current') selected @endif>
                                                                Current
                                                            </option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label">{{ __('Account Holder Name') }}</label>
                                                        <input
                                                            class="form-control @error('account_holder_name') is-invalid @enderror"
                                                            name="account_holder_name" type="text"
                                                            value="{{ old('account_holder_name') ? old('account_holder_name') : $admin->account_holder_name ?? '' }}"
                                                            placeholder="{{ __('Account Holder Name') }}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <div class="mb-4">
                                                        <label
                                                            class="form-label">{{ __('Account Number') }}</label>
                                                        <input
                                                            class="form-control @error('account_number') is-invalid @enderror"
                                                            name="account_number" type="text"
                                                            value="{{ old('account_number') ? old('account_number') : $admin->account_number ?? '' }}"
                                                            placeholder="{{ __('Account Number') }}">
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
                                                                    @if (old('id_type') == 'Passport' || $admin->id_type == 'Passport') selected @endif>
                                                                Passport
                                                            </option>
                                                            <option value="National Identity Card"
                                                                    @if (old('id_type') == 'National Identity Card' || $admin->id_type == 'National Identity Card') selected @endif>
                                                                National Identity Card
                                                            </option>
                                                            <option value="Driving License"
                                                                    @if (old('id_type') == 'Driving License' || $admin->id_type == 'Driving License') selected @endif>
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
                                                            name="id_number" type="text"
                                                            value="{{ old('id_number') ? old('id_number') : $admin->id_number ?? '' }}"
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

                                        <button class="btn btn-success" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Password Change</h5>
                    </div>
                    <div class="card-body">
                        <form class="updateFrom" action="{{ route('admin.password.update', $admin->id) }}"
                              method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="name">
                                            {{ __('Password') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" name="password" type="password"
                                               placeholder="{{ __('New Password') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="email">
                                            {{ __('Confirm Password') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" name="password_confirmation" type="password"
                                               placeholder="{{ __('Confirm Password') }}" required>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">
                                            {{ __('Update') }}
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
@endsection

@push('script')
    <script src="{{ asset('backend/js/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/image-uploader.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            // $('#roles').select2({
            //     tags: false
            // });


        });


        $('.id_font_image').imageUploader({
            label: "Id Font Image",
            imagesInputName: "id_font_image",
            maxFiles: 1,
            preloaded: [{
                'id': 1,
                src: "{{ asset($admin->id_font_image) }}"
            }]
        });
        $('.id_back_image').imageUploader({
            label: "Id Back Image",
            imagesInputName: "id_back_image",
            maxFiles: 1,
            preloaded: [{
                'id': 1,
                src: "{{ asset($admin->id_back_image) }}"
            }]
        });
        $('.profile_image').imageUploader({
            label: "Profile Image",
            imagesInputName: "profile_image",
            maxFiles: 1,
            preloaded: [{
                'id': 1,
                src: "{{ asset($admin->profile_pic) }}"
            }]
        });


        $(document).ready(function () {
            let selectedCity = parseInt("{{ $admin->city }}");
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
