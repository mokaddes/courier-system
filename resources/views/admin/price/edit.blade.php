@extends('admin.layouts.master')

@section('price_menu', 'menu-open')

@section('price', 'active')

@section('title') {{ $data['title'] ?? '' }} @endsection

@push('style')
@endpush

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $data['title'] ?? '' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ $data['title'] ?? '' }}</li>
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
                                        <h3 class="card-title">{{ $data['title'] ?? '' }} </h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">

                                            <a class="btn btn-primary" href="{{ route('admin.price.index') }}">Back</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('admin.price.update',$data['price']->id) }}" method="post">
                                @csrf
                                <div class="card-body">

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                                <div class="form-group">
                                                    <label class="form-label required" for="name">Price Name</label>
                                                    <input class="form-control @error('item_name') border-danger @enderror"
                                                        id="item_name" name="item_name" type="text" placeholder="Enter Price Name"
                                                        value="{{ $data['price']->item_name  }}" required>
                                                    @error('item_name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                                <div class="form-group">
                                                    <label class="form-label required" for="price_group">Price Group Name</label>
                                                    <select
                                                        class="form-control @error('pricing_group_id') border-danger @enderror"
                                                        id="pricing_group_id" name="pricing_group_id" required>
                                                        <option value="">Select Price Group</option>
                                                        @foreach ($data['pricingGroups'] as $pricingGroup)
                                                            <option value="{{ $pricingGroup->id }}" {{ $data['price']->pricing_group_id == $pricingGroup->id ? "selected": "" }}>

                                                                {{ $pricingGroup->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pricing_group_id')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                                <div class="form-group">
                                                    <label class="form-label required" for="price_group">Weight</label>
                                                    <select class="form-control @error('price_group') border-danger @enderror"
                                                        id="weight_id" name="weight_id" required>
                                                        <option value="">Select Price Group</option>
                                                        @foreach ($data['weights'] as $value)
                                                            <option value="{{ $value->id }}" {{ $data['price']->weight_id == $value->id ? "selected" : "" }}>
                                                                {{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('weight_id')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                                <div class="form-group">
                                                    <label class="form-label" for="order" required>Order Number</label>
                                                    <input class="form-control @error('order_id') border-danger @enderror"
                                                        id="order_id" name="order_id" type="number"
                                                        value="{{ $data['price']->order_id }}" placeholder="Enter Order Number" required>
                                                    @error('order_id')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                                <div class="form-group">
                                                    <label class="form-label required" for="status">Inside Main City Price</label>
                                                    <input class="form-control @error('inside_main_city_price') border-danger @enderror"
                                                        id="inside_main_city_price" name="inside_main_city_price" type="number" placeholder="Enter Main City Price"
                                                        value="{{ $data['price']->inside_main_city_price }}" required>
                                                    @error('inside_main_city_price')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                                <div class="form-group">
                                                    <label class="form-label required" for="status" >Inter City Price</label>
                                                    <input class="form-control @error('inter_city_price') border-danger @enderror"
                                                        id="inter_city_price" name="inter_city_price" type="number" placeholder="Enter City Price"
                                                        value="{{ $data['price']->inter_city_price }}"  required>
                                                    @error('inter_city_price')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                                <div class="form-group">
                                                    <label class="form-label required" for="status">Status</label>
                                                    <select class="form-control @error('status') border-danger @enderror"
                                                        id="status" name="status" required>
                                                        <option value="1"
                                                            @if ($data['price']->status == '1') selected @endif selected>
                                                            Active</option>
                                                        <option value="0"
                                                            @if ($data['price']->status  == '0') selected @endif>
                                                            Inactive</option>
                                                    </select>
                                                    @error('status')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="card-footer text-center">
                                    <button class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
@endpush
