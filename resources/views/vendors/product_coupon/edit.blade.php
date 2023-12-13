@extends('vendors.layouts.app')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="bi bi-receipt-cutoff icon-gradient bg-mean-fruit"></i>
            </div>
            <div>
                {{$page_title}}
            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{route('vendors.product-coupon.index')}}" class="btn-shadow btn btn-danger"><i class="bi bi-x-lg"></i> Back</a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('vendors.product-coupon.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="code" class="form-label">Code</label>
                    <input id="code" class="form-control" type="text" name="code" required placeholder="Enter code" value="{{$data->code}}" readonly>
                    @error('code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="discount_type" class="form-label">Discount Type</label>
                    <select name="discount_type" id="discount_type" class="form-control js-example-basic-single" required>
                        <option value="">Select discount type</option>
                        <option value="percent" {{$data->discount_type == "percent" ? "selected": ""}}>Percent</option>
                        <option value="fixed" {{$data->discount_type == "fixed" ? "selected": ""}}>Fixed</option>
                    </select>
                    @error('discount_type')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="discount" class="form-label">Discount</label>
                    <input id="discount" class="form-control" type="number" name="discount" required placeholder="Enter discount" value="{{$data->discount}}">
                    @error('discount')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="products_ids" class="form-label">Products</label>
                    <select name="products_ids[]" id="products_ids" class="form-control js-example-basic-multiple" multiple data-placeholder="Select products" required>
                        @foreach ($productsList as $product)
                            <option value="{{$product->id}}" @if(in_array($product->id, $data->products_ids)) selected @endif>{{$product->name}}</option>
                        @endforeach
                    </select>
                    @error('products_ids')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="service_category_ids" class="form-label">Categories</label>
                    <select name="categories_ids[]" id="service_category_ids" class="form-control js-example-basic-multiple" multiple data-placeholder="Select categories" required>
                        @foreach ($categoryList as $category)
                            <option value="{{$category->id}}" @if(in_array($category->id, $data->categories_ids)) selected @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('service_category_ids')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="col-md-3 mb-3">
                    <label for="dates" class="form-label">Start / End Date</label>
                    <div class="input-group flatpickr min-date-range" id="dates">
                        <input type="text" name="dates" class="form-control" placeholder="Start / End Date" value="{{$data->start_at}} to {{$data->end_at}}" data-input>
                    </div>
                    @error('dates')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <div class="col-md-12 mb-3">
                    <label for="easyMdeExample" class="form-label">Description</label>
                    <textarea name="description" id="easyMdeExample" rows="4" class="form-control" placeholder="Enter description">{{$data->description}}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <x-save-btn text="Update" />
        </form>
    </div>
</div>
@endsection
