@extends('frontend.layouts.app')

@section('title')
    {{ __('Home') }}
@endsection

@push('meta')
<meta property="og:title" content="{{ $meta_title }}" />
<meta property="og:description" content="{{ $meta_description }}" />
<meta property="og:image" content="{{ asset($meta_image) }}" />
@endpush

@push('css')
@endpush

@section('content')
    {{-- banner start --}}
    <div class="banner-section pt-5 pb-5 mb-5">
        <div class="container">
            <div class="banner-content text-center mb-0 mb-lg-5">
                <h2>On Time. Every Time. Any Time - Trust Us for Your <span>Delivery</span> Needs</h2>
            </div>
            <div class="row align-items-center pb-5">
                <div class="col-lg-6">
                    <div class="banner_img">
                        <img class="w-100" src="{{ asset('frontend/images/banner.png') }}" alt="image">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="delivery_calculate">
                        <div class="mb-4 text-center text-sm-start">
                            <h4>Calculate Your Delivery Cost</h4>
                            <p>
                                Delivery Cost can be Changed On Special requirements.Please Contact with Authority For
                                your Special requirements.
                            </p>
                        </div>
                        <form id="checkDeliveryCostForm" action="{{ route('deliveryCost') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="region_id">Pickup Region</label>
                                        <select class="form-control form-select" id="region_id" name="region_id" required>
                                            <option class="d-nonde" value="">Select Region</option>
                                            @foreach ($region as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="pickup_city">Pickup City</label>
                                        <select class="form-control form-select" id="pickup_city_id" name="pickup_city_id"
                                            required>
                                            <option class="d-nonde" value="">Select Pickup City</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="delivery_region">Delivery Region</label>
                                        <select class="form-control form-select" id="delivery_region_id"
                                            name="delivery_region_id" required>
                                            <option class="d-nonde" value="">Delivery region</option>
                                            @foreach ($region as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="delivery_city">Delivery City</label>
                                        <select class="form-control form-select" id="delivery_city_id"
                                            name="delivery_city_id" required>
                                            <option class="d-nonde" value="">Select Delivery city</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="weight">Weight (Kg)</label>
                                        <select class="form-control form-select" id="weight" name="weight" required>

                                            @foreach ($weights as $weight)
                                                <option value="{{ $weight->id }}">{{ $weight->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="delivery_type">Delivery Type</label>
                                        <select class="form-control form-select" id="delivery_type" name="delivery_type">
                                            @foreach ($pricingGroups as $pricingGroup)
                                                <option data-name="{{ $pricingGroup->name }}"
                                                    value="{{ $pricingGroup->id }}">{{ $pricingGroup->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12" id="resultPriceSection">

                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" id="checkPriceBtn" type="submit">Check</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- service start  --}}
    {{-- <div class="service-section mb-5">
        <div class="container">
            <div class="section-heading text-center mb-5">
                <h4>Our <span>Services</span></h4>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-11">
                    <div class="service-wrapper text-center">
                        <div class="row g-0">
                            <div class="col-lg-6 col-xl-4">
                                <div class="service-wrap">
                                    <div class="service-content">
                                        <i class="icon las la-shipping-fast"></i>
                                        <h4>Same day courier</h4>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum, quo quaerat
                                            fugiat autem voluptates ducimus. Nemo impedit veniam minus unde, error ex
                                            dolor
                                            magni dolore at dolorem temporibus ea odio?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="service-wrap border-xl-right">
                                    <div class="service-content">
                                        <i class="icon las la-star"></i>
                                        <h4>Priority courier</h4>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum, quo quaerat
                                            fugiat autem voluptates ducimus. Nemo impedit veniam minus unde, error ex
                                            dolor
                                            magni dolore at dolorem temporibus ea odio?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="service-wrap border-right">
                                    <div class="service-content">
                                        <i class="icon las la-lock"></i>
                                        <h4>Priority Secure Courier</h4>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum, quo quaerat
                                            fugiat autem voluptates ducimus. Nemo impedit veniam minus unde, error ex
                                            dolor
                                            magni dolore at dolorem temporibus ea odio?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="service-wrap border-xl-right">
                                    <div class="service-content">
                                        <i class="icon las la-truck"></i>
                                        <h4>Next day delivery</h4>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum, quo quaerat
                                            fugiat autem voluptates ducimus. Nemo impedit veniam minus unde, error ex
                                            dolor
                                            magni dolore at dolorem temporibus ea odio?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="service-wrap">
                                    <div class="service-content">
                                        <i class="icon las la-sticky-note"></i>
                                        <h4>Contract runs</h4>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum, quo quaerat
                                            fugiat autem voluptates ducimus. Nemo impedit veniam minus unde, error ex
                                            dolor
                                            magni dolore at dolorem temporibus ea odio?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="service-wrap border-right border-lg-right">
                                    <div class="service-content">
                                        <i class="icon las la-truck"></i>
                                        <h4>Logistics services</h4>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum, quo quaerat
                                            fugiat autem voluptates ducimus. Nemo impedit veniam minus unde, error ex
                                            dolor
                                            magni dolore at dolorem temporibus ea odio?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="service-wrap border-bottom">
                                    <div class="service-content">
                                        <i class="icon las la-cogs"></i>
                                        <h4>Specialist services</h4>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum, quo quaerat
                                            fugiat autem voluptates ducimus. Nemo impedit veniam minus unde, error ex
                                            dolor
                                            magni dolore at dolorem temporibus ea odio?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="service-wrap border-bottom border-xl-right">
                                    <div class="service-content">
                                        <i class="icon las la-shopping-cart"></i>
                                        <h4>eCommerce Services</h4>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum, quo quaerat
                                            fugiat autem voluptates ducimus. Nemo impedit veniam minus unde, error ex
                                            dolor
                                            magni dolore at dolorem temporibus ea odio?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="service-wrap border-right" style="border-bottom: 0 !important;">
                                    <div class="service-content">
                                        <i class="icon las la-globe-europe"></i>
                                        <h4>International courier</h4>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum, quo quaerat
                                            fugiat autem voluptates ducimus. Nemo impedit veniam minus unde, error ex
                                            dolor
                                            magni dolore at dolorem temporibus ea odio?
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="service-section mb-5">
        <div class="container">
            <div class="section-heading text-center mb-5">
                <h4>Our <span>Services</span></h4>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-11">
                    <div class="service-wrapper text-center">
                        <div class="row g-0">
                            @php
                                $borderes = ['', 'border-xl-right', 'border-right', 'border-xl-right', '', 'border-right border-lg-right', 'border-bottom', 'border-bottom border-xl-right', 'border-right'];
                            @endphp
                            @foreach ($ourServices as $ourService)
                                <div class="col-lg-6 col-xl-4">
                                    <div class="service-wrap {{ $borderes[$loop->index] }}"
                                        @if ($loop->last) style="border-bottom: 0 !important;" @endif>
                                        <div class="service-content">
                                            <i class="icon {{ $ourService->icon }}"></i>
                                            <h4>{{ $ourService->title }}</h4>
                                            <p>
                                                {{ $ourService->description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- delivery process start  --}}
    <div class="delivery-process mb-5">
        <div class="container">
            <div class="section-heading text-center mb-5">
                <h4>Our <span>Process</span></h4>
            </div>
            <div class="process_timeline">
                <div class="main-timeline">
                    <div class="timeline">
                        <div class="timeline-content" href="#">
                            <div class="timeline-icon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <h3 class="title">Book Service (Online / Call / Email)</h3>
                            <p class="description">
                                You can book service via online form or directly via email or calling to our support team.
                            </p>
                        </div>
                    </div>
                    <div class="timeline">
                        <div class="timeline-content" href="#">
                            <div class="timeline-icon">
                                <i class="fa fa-truck"></i>
                            </div>
                            <h3 class="title">Quick Pick Up and Packing</h3>
                            <p class="description">
                                You delivery boy will collect the product to packing and pickup
                            </p>
                        </div>
                    </div>
                    <div class="timeline">
                        <div class="timeline-content" href="#">
                            <div class="timeline-icon">
                                <i class="fa fa-home"></i>
                            </div>
                            <h3 class="title">Sorting At Nearest Hub</h3>
                            <p class="description">
                               Delivery boy will be sent from nearest hub so that you customer get the product on time.
                            </p>
                        </div>
                    </div>
                    <div class="timeline">
                        <div class="timeline-content" href="#">
                            <div class="timeline-icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <h3 class="title">Delivery To Recipient</h3>
                            <p class="description">
                                Delivery boy will send the product carefully to your customer door.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/js/axios.min.js') }}"></script>
    <script>
        $(document).on('change', '#region_id ', function(e) {
            var region_id = e.target.value;
            // console.log(region_id);
            $.ajax({
                method: 'get',
                url: "{{ route('getPickup-area') }}",
                data: {
                    region_id: region_id
                },
                success: function(res) {

                    // console.log(res);
                    $('#pickup_city_id').html(res);
                }
            })
        })

        $(document).on('change', '#delivery_region_id ', function(e) {
            var delivery_region_id = e.target.value;
            // console.log(region_id);
            $.ajax({
                method: 'get',
                url: "{{ route('getdelivery-area') }}",
                data: {
                    delivery_region_id: delivery_region_id
                },
                success: function(res) {
                    $('#delivery_city_id').html(res);
                }
            })
        });

        $('#checkDeliveryCostForm').submit(function(event) {
            event.preventDefault();
            var values = {};
            $.each($(this).serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });

            let deliveryType = $('#delivery_type option:selected').data('name');

            let symbol = "{{ getCurrency() }}"
            console.log(symbol);




            axios.post("{{ route('deliveryCost') }}", values).then((response) => {
                const {
                    data: {
                        status

                    }
                } = response;

                const {
                    pickup_city_id,
                    delivery_city_id
                } = values;

                if (status) {
                    const {
                        price: {
                            inside_main_city_price,
                            inter_city_price
                        }
                    } = response.data;
                    if (pickup_city_id == delivery_city_id) {
                        $('#resultPriceSection').html(
                            `<h4 class="text-center"><strong>${deliveryType} : </strong>${symbol+inside_main_city_price}</h4>`
                        );
                    } else {

                        $('#resultPriceSection').html(
                            `<h4 class="text-center"><strong>${deliveryType} : </strong>${symbol+inter_city_price}</h4>`
                        );
                    }
                } else {
                    $('#resultPriceSection').html(
                        `<h4 class="text-center">Delivery is unavailable in those location or change the weight or delivery type.</h4>`
                    );
                }

                $('#checkPriceBtn').prop('disabled', false).html('Check');
            })

        });
    </script>
@endpush
