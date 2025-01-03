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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">


    <style>
        .modal-backdrop {
            background: rgba(0, 0, 0, 0.8) !important;
            backdrop-filter: blur(5px);
        }

        .modal-content {
            border-radius: 12px;
            overflow: hidden;
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            border-bottom: none;
        }

        .modal-title {
            font-weight: bold;
            color: #0d6efd;
        }



        .modal-body {
            padding: 2rem 2.5rem;
        }

        .form-floating label {
            color: #6c757d;
        }







    </style>
@endpush

@section('content')
    {{-- banner start --}}
    <div class="banner-section position-relative py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-start">
                    <div class="banner-img">
                        <img src="{{ asset('frontend/images/banner.png') }}" class="img-fluid rounded shadow-lg" alt="Delivery Banner">
                    </div>
                </div>
                <div class="col-lg-6 text-end">
                    <div class="banner-content">
                        <h1 class="fw-bold text-dark mb-3">
                            Reliable <span class="text-primary">Delivery</span> Solutions, On Time. Every Time.
                        </h1>
                        <p class="text-muted mb-4">
                            Count on us to handle your delivery needs with efficiency and care. Flexible options for your unique requirements.
                        </p>
                        <button class="btn btn-primary btn-lg px-4" data-bs-toggle="modal" data-bs-target="#deliveryCostModal">
                            Calculate Delivery Cost
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Service Start --}}
    <div class="service-section mb-5">
        <div class="container">
            <div class="section-heading text-center mb-5">
                <h4 class="fw-bold">Our <span class="text-primary">Services</span></h4>
            </div>
            <div class="d-none d-md-block">
                {{-- Grid Layout for Large Screens --}}
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-11">
                        <div class="service-wrapper text-center">
                            <div class="row g-4">
                                @foreach ($ourServices as $ourService)
                                    <div class="col-lg-6 col-xl-4">
                                        <div class="service-wrap">
                                            <div class="service-content">
                                                <div class="icon-wrapper">
                                                    <i class="icon {{ $ourService->icon }}"></i>
                                                </div>
                                                <h4 class="mt-3">{{ $ourService->title }}</h4>
                                                <p class="text-muted">
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
            <div class="d-block d-md-none">
                {{-- Slider Layout for Small Devices --}}
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($ourServices as $ourService)
                            <div class="swiper-slide">
                                <div class="service-wrap">
                                    <div class="service-content">
                                        <div class="icon-wrapper">
                                            <i class="icon {{ $ourService->icon }}"></i>
                                        </div>
                                        <h4 class="mt-3">{{ $ourService->title }}</h4>
                                        <p class="text-muted">
                                            {{ $ourService->description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- Pagination for the slider --}}
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- Service End --}}



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

    <!-- Modal -->
    <div class="modal fade" id="deliveryCostModal" tabindex="-1" aria-labelledby="deliveryCostModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header border-0 position-relative">
                    <h5 class="modal-title text-primary" id="deliveryCostModalLabel">Calculate Your Delivery Cost</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body px-4 pb-4">
                    <p class="text-muted text-center mb-4">
                        Delivery costs may vary based on special requirements. Please contact us for more information.
                    </p>
                    <form id="checkDeliveryCostForm" action="{{ route('deliveryCost') }}" method="post">
                        @csrf
                        <div class="row g-3">
                            <!-- Form Fields -->
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <select class="form-select" id="region_id" name="region_id" required>
                                        <option value="" selected>Select Region</option>
                                        @foreach ($region as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="region_id">Pickup Region</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <select class="form-select" id="pickup_city_id" name="pickup_city_id" required>
                                        <option value="" selected>Select Pickup City</option>
                                    </select>
                                    <label for="pickup_city_id">Pickup City</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <select class="form-select" id="delivery_region_id" name="delivery_region_id" required>
                                        <option value="" selected>Select Delivery Region</option>
                                        @foreach ($region as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="delivery_region_id">Delivery Region</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <select class="form-select" id="delivery_city_id" name="delivery_city_id" required>
                                        <option value="" selected>Select Delivery City</option>
                                    </select>
                                    <label for="delivery_city_id">Delivery City</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <select class="form-select" id="weight" name="weight" required>
                                        @foreach ($weights as $weight)
                                            <option value="{{ $weight->id }}">{{ $weight->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="weight">Weight (Kg)</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <select class="form-select" id="delivery_type" name="delivery_type">
                                        @foreach ($pricingGroups as $pricingGroup)
                                            <option value="{{ $pricingGroup->id }}">{{ $pricingGroup->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="delivery_type">Delivery Type</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="resultPriceSection"></div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary btn-lg w-100" id="checkPriceBtn" type="submit">Check Cost</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
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

        document.addEventListener("DOMContentLoaded", function () {
            new Swiper('.swiper-container', {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                slidesPerView: 1,
                spaceBetween: 20,
            });
        });

    </script>
@endpush
