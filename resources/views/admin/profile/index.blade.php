@extends('admin.layouts.master')

@section('title')
    {{ __('Admin Profile') }}
@endsection

@push('style')
    <link href="{{ asset('frontend/css/image-uploader.min.css') }}" rel="stylesheet">
    <style>
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
                        <h1 class="m-0">{{ __('Profile') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Profile') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{ asset(Auth::user()->image ?? 'assets/default.png') }}" alt=""
                                         style="width:120px; height:120px; display:block;">
                                </div>
                                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                                <p class="text-muted text-center">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        @if (Auth::user()->is_merchant || Auth::user()->is_deliveryman == 1)
                            <div class="card">
                                <div class="card-body">
                                    <form class="updateFrom"
                                          action="{{ route('admin.profile.update', Auth::user()->id) }}"
                                          method="POST" enctype="multipart/form-data">
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

                                                    @if(Auth::user()->is_deliveryman == 1)
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                                            <div class="mb-4">
                                                                <label
                                                                    class="form-label required">{{ __('Phone Number') }}</label>
                                                                <input
                                                                    class="form-control @error('business_owner_phone') is-invalid @enderror"
                                                                    name="business_owner_phone" type="text"
                                                                    value="{{ old('business_owner_phone') ? old('business_owner_phone') : $admin->business_owner_phone ?? '' }}"
                                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                    placeholder="{{ __('Phone Number') }}" required>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                                            <div class="mb-4">
                                                                <label
                                                                    class="form-label required">{{ __('Name of Your Business') }}</label>
                                                                <input
                                                                    class="form-control @error('business_name') is-invalid @enderror"
                                                                    name="business_name" type="text"
                                                                    value="{{ old('business_name') ? old('business_name') : $admin->business_name ?? '' }}"
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
                                                                    value="{{ old('business_owner_name') ? old('business_owner_name') : $admin->business_owner_name ?? '' }}"
                                                                    placeholder="{{ __('Business Owner Full Name') }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                                            <div class="mb-4">
                                                                <label
                                                                    class="form-label required">{{ __('Business Owner Phone') }}</label>
                                                                <input
                                                                    class="form-control @error('business_owner_phone') is-invalid @enderror"
                                                                    name="business_owner_phone" type="text"
                                                                    value="{{ old('business_owner_phone') ? old('business_owner_phone') : $admin->business_owner_phone ?? '' }}"
                                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                    placeholder="{{ __('Business Owner Phone') }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                            <div class="mb-4">
                                                                <label
                                                                    class="form-label required">{{ __('Business Email') }}</label>
                                                                <input
                                                                    class="form-control @error('business_email') is-invalid @enderror"
                                                                    name="business_email" type="email"
                                                                    value="{{ old('business_email') ? old('business_email') : $admin->business_email ?? '' }}"
                                                                    placeholder="{{ __('Email') }}" required>
                                                            </div>
                                                        </div>
                                                    @endif
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
                                                            <label
                                                                class="form-label required">{{ __('City') }}</label>
                                                            <select
                                                                class="form-control @error('city') is-invalid @enderror"
                                                                id="pickup_city_id" name="city"
                                                                value="{{ old('city') }}" required>
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
                                                                placeholder="{{ __('ZIP / Postal Code') }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="border p-3 mb-5">
                                                <legend class="w-auto float-none">Payment Information</legend>
                                                <div class="row">
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                        <div class="mb-4">
                                                            <label
                                                                class="form-label {{ Auth::user()->is_merchant ? 'required' : '' }} ">{{ __('Bank Name') }}</label>
                                                            <input
                                                                class="form-control @error('bank_name') is-invalid @enderror"
                                                                name="bank_name" type="text"
                                                                value="{{ old('bank_name') ? old('bank_name') : $admin->bank_name ?? '' }}"
                                                                placeholder="{{ __('Bank Name') }}" {{ Auth::user()->is_merchant ? 'required' : '' }}>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                        <div class="mb-4">
                                                            <label
                                                                class="form-label {{ Auth::user()->is_merchant ? 'required' : '' }}">{{ __('Branch Name') }}</label>
                                                            <input
                                                                class="form-control @error('bank_branch_name') is-invalid @enderror"
                                                                name="bank_branch_name" type="text"
                                                                value="{{ old('bank_branch_name') ? old('bank_branch_name') : $admin->bank_branch_name ?? '' }}"
                                                                placeholder="{{ __('Branch Name') }}" {{ Auth::user()->is_merchant ? 'required' : '' }}>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                        <div class="mb-4">
                                                            <label
                                                                class="form-label {{ Auth::user()->is_merchant ? 'required' : '' }}">{{ __('Account Type') }}</label>
                                                            <select
                                                                class="form-control @error('account_type') is-invalid @enderror"
                                                                name="account_type" {{ Auth::user()->is_merchant ? 'required' : '' }}>
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
                                                                class="form-label {{ Auth::user()->is_merchant ? 'required' : '' }}">{{ __('Account Holder Name') }}</label>
                                                            <input
                                                                class="form-control @error('account_holder_name') is-invalid @enderror"
                                                                name="account_holder_name" type="text"
                                                                value="{{ old('account_holder_name') ? old('account_holder_name') : $admin->account_holder_name ?? '' }}"
                                                                placeholder="{{ __('Account Holder Name') }}" {{ Auth::user()->is_merchant ? 'required' : '' }}>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                        <div class="mb-4">
                                                            <label
                                                                class="form-label {{ Auth::user()->is_merchant ? 'required' : '' }}">{{ __('Account Number') }}</label>
                                                            <input
                                                                class="form-control @error('account_number') is-invalid @enderror"
                                                                name="account_number" type="text"
                                                                value="{{ old('account_number') ? old('account_number') : $admin->account_number ?? '' }}"
                                                                placeholder="{{ __('Account Number') }}" {{ Auth::user()->is_merchant ? 'required' : '' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="border p-3 mb-5">
                                                <legend class="w-auto float-none">Verification Information</legend>
                                                <div class="row">
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                        <div class="mb-4">
                                                            <label
                                                                class="form-label required">{{ __('ID Type') }}</label>
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
                                                            <label
                                                                class="form-label required">{{ __('ID Number') }}</label>
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
                                                                class="form-label ">{{ __('Profile Picture') }} <small class="text-danger">*</small><span class="text-success">(Preferred Size 1:1)</span></label>
                                                            <div class="profile_image"></div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </fieldset>
                                            <div class="col-12 text-center">
                                                <button class="btn btn-primary" type="submit">
                                                    {{ __('Update') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        @else
                            <div class="card">
                                <div class="card-body">
                                    <form class="updateFrom"
                                          action="{{ route('admin.profile.update', Auth::user()->id) }}"
                                          method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label required"
                                                           for="image">{{ __('Profile Photo') }} </label><span
                                                        class="text-danger">(Preferred size is 300x300px)</span>
                                                    <input class="form-control" id="image" name="image"
                                                           type="file">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label required"
                                                           for="name">{{ __('Name') }}</label>
                                                    <input class="form-control" name="name" type="text"
                                                           value="{{ Auth::user()->name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label required"
                                                           for="email">{{ __('Email') }}</label>
                                                    <input class="form-control" name="email" type="text"
                                                           value="{{ Auth::user()->email }}">
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
                        @endif

                        <div class="card">
                            <div class="card-body">
                                <form class="updateFrom" action="{{ route('admin.password.update', Auth::user()->id) }}"
                                      method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        {{--                                        <div class="col-lg-6 col-md-12">--}}
                                        {{--                                            <div class="form-group">--}}
                                        {{--                                                <label for="image" class="form-label">--}}
                                        {{--                                                    {{ __('Old Password') }}--}}
                                        {{--                                                    <span class="text-danger">*</span>--}}
                                        {{--                                                </label>--}}
                                        {{--                                                <input type="password" name="oldpassword" class="form-control"--}}
                                        {{--                                                       placeholder="{{ __('Old Password') }}" required>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
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
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('frontend/js/image-uploader.min.js') }}"></script>

    <script>
        $(".updateFrom").on('submit', function () {
            $(this).find('button').html(`
                <span id="">
                    <span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span>
                    Updating ...
                </span>
            `);
            $(this).find('button').attr('disabled', true);
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
