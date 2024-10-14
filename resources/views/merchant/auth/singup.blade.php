@extends('frontend.layouts.app')

@section('title')
    {{ __('Sing Up') }}
@endsection
{{-- @push('meta')
<meta property="og:title" content="{{ $meta_title }}" />
<meta property="og:description" content="{{ $meta_description }}" />
<meta property="og:image" content="{{ asset($meta_image) }}" />
@endpush --}}
@push('css')
    <link href="{{ asset('frontend/css/image-uploader.min.css') }}" rel="stylesheet">
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
    <div class="login-section pb-5 pt-5">
        <div class="container">
            <div class="mx-auto">
                <div class="card card-lg">
                    <div class="login-form card-body">
                        <form method="POST" action="{{ route('merchant.register.store') }}"
                              enctype="multipart/form-data" class="px-5">
                            @csrf
                            <div class="text-center">
                                <div class="heading mb-5">
                                    <h1 class="title">{{ __('Merchant Registration') }}</h1>
                                    <p>Only the English character is allowed.</p>
                                    <p>{{ __('Already have an account?') }}
                                        <a class="link" href="{{ route('merchant.login') }}">{{ __('Sign In') }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                <fieldset class="border p-3 mb-5 mt-2">
                                    <legend class="w-auto float-none">Account Information</legend>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                            <div class="mb-4">
                                                <label
                                                    class="form-label required">{{ __('Name of Your Business') }}</label>
                                                <input class="form-control @error('business_name') is-invalid @enderror"
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
                                                    placeholder="{{ __('Business Ownerll Name') }}" required>
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
                                                <label class="form-label required">{{ __('Business Email') }}</label>
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
                                                <label class="form-label required">{{ __('Address Line') }}</label>
                                                <input class="form-control @error('address_line') is-invalid @enderror"
                                                       name="address_line" type="text" value="{{ old('address_line') }}"
                                                       placeholder="{{ __('Address Line') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <div class="mb-4">
                                                <label class="form-label required">{{ __('Street Address') }}</label>
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
                                                    class="form-control form-select @error('state') is-invalid @enderror"
                                                    id="region_id" name="state" value="{{ old('state') }}" required>
                                                    <option value="">{{ __('Select State') }}</option>
                                                    @foreach ($regions as $region)
                                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <div class="mb-4">
                                                <label class="form-label required">{{ __('City') }}</label>
                                                <select
                                                    class="form-control form-select @error('city') is-invalid @enderror"
                                                    id="pickup_city_id" name="city" value="{{ old('city') }}" required>
                                                    <option value="">{{ __('Select City') }}</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <div class="mb-4">
                                                <label class="form-label required">{{ __('ZIP / Postal Code') }}</label>
                                                <input class="form-control @error('zip_code') is-invalid @enderror"
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
                                                <input class="form-control @error('bank_name') is-invalid @enderror"
                                                       name="bank_name" type="text" value="{{ old('bank_name') }}"
                                                       placeholder="{{ __('Bank Name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <div class="mb-4">
                                                <label class="form-label required">{{ __('Branch Name') }}</label>
                                                <input
                                                    class="form-control @error('bank_branch_name') is-invalid @enderror"
                                                    name="bank_branch_name" type="text"
                                                    value="{{ old('bank_branch_name') }}"
                                                    placeholder="{{ __('Branch Name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <div class="mb-4">
                                                <label class="form-label required">{{ __('Account Type') }}</label>
                                                <select
                                                    class="form-control form-select @error('account_type') is-invalid @enderror"
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
                                                <label class="form-label required">{{ __('Account Number') }}</label>
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
                                                    class="form-control form-select @error('id_type') is-invalid @enderror"
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
                                                <input class="form-control @error('id_number') is-invalid @enderror"
                                                       name="id_number" type="text" value="{{ old('id_number') }}"
                                                       placeholder="{{ __('ID Number') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <div class="mb-4">
                                                <label class="form-label required">{{ __('ID\'s Front Image') }}</label>
                                                <div class="id_font_image"></div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <div class="mb-4">
                                                <label class="form-label required">{{ __('ID\'s Back Image') }}</label>
                                                <div class="id_back_image"></div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                            <div class="mb-4">
                                                <label
                                                    class="form-label required">{{ __('Profile Picture') }}</label><span
                                                    class="text-danger">(Preferred size is 300x300px)</span>
                                                <div class="profile_image"></div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="border p-3 mb-5">
                                    <legend class="w-auto float-none">Terms & Conditions</legend>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="mb-4">
                                        <div class="terms_condition"
                                             style="padding:20px 30px; height:300px; overflow:scroll;">
                                            {!! $page_content->terms_condition ?? "" !!}
                                        </div>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" id="termsCheckbox" name="agree"
                                               type="checkbox" required>
                                        <label class="form-check-label" for="termsCheckbox">
                                            {{ __('I agree to the Terms & Conditions.') }}
                                        </label>
                                    </div>
                                </div>
                                </fieldset>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-primary btn-lg" type="submit"
                                        style="min-width:30%">{{ __('Register') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
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

        $(document).on('change', '#region_id ', function (e) {
            var region_id = e.target.value;
            // console.log(region_id);
            $.ajax({
                method: 'get',
                url: "{{ route('getPickup-area') }}",
                data: {
                    region_id: region_id
                },
                success: function (res) {

                    // console.log(res);
                    $('#pickup_city_id').html(res);
                }
            })
        })
    </script>

    
@endpush
