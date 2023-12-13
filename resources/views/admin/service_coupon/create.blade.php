@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-6 text-end">
                            <x-cancle-btn text="Back" route="{{route('service-coupon.index')}}" />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('service-coupon.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="code" class="form-label">Code</label>
                                <input id="code" class="form-control" type="text" name="code" required placeholder="Enter code">
                                @error('code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="discount_type" class="form-label">Discount Type</label>
                                <select name="discount_type" id="discount_type" class="form-control js-example-basic-single" required>
                                    <option value="">Select discount type</option>
                                    <option value="percent">Percent</option>
                                    <option value="fixed">Fixed</option>
                                </select>
                                @error('service_category_ids')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="discount" class="form-label">Discount</label>
                                <input id="discount" class="form-control" type="number" name="discount" required placeholder="Enter discount">
                                @error('discount')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="services_ids" class="form-label">Services</label>
                                <select name="services_ids[]" id="services_ids" class="form-control js-example-basic-multiple" multiple data-placeholder="Select services" required>
                                    @foreach ($servicesList as $service)
                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                    @endforeach
                                </select>
                                @error('services_ids')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="salons_ids" class="form-label">Salon</label>
                                <select name="salons_ids[]" id="salons_ids" class="form-control js-example-basic-multiple" multiple data-placeholder="Select Salon" required>
                                    @foreach ($salonsList as $salonData)
                                        <option value="{{$salonData->id}}">{{$salonData->name}}</option>
                                    @endforeach
                                </select>
                                @error('salons_ids')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="service_category_ids" class="form-label">Categories</label>
                                <select name="categories_ids[]" id="service_category_ids" class="form-control js-example-basic-multiple" multiple data-placeholder="Select categories" required>
                                    @foreach ($categoryList as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('service_category_ids')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="col-md-3 mb-3">
                                <label for="dates" class="form-label">Start / End Date</label>
                                <div class="input-group flatpickr min-date-range" id="dates">
                                    <input type="text" name="dates" class="form-control" placeholder="Start / End Date" data-input>
                                </div>
                                {{-- <input id="expires_at" class="form-control" type="date" name="expires_at" min="{{date('Y-m-d', strtotime("+1 day"))}}" required> --}}
                                @error('dates')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="easyMdeExample" class="form-label">Description</label>
                                <textarea name="description" id="easyMdeExample" rows="4" class="form-control" placeholder="Enter description"></textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <x-save-btn text="Save" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
