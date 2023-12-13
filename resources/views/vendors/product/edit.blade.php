@extends('vendors.layouts.app')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="bi bi-tags icon-gradient bg-mean-fruit"></i>
            </div>
            <div>
                {{$page_title}}
            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{route('vendors.products.index')}}" class="btn-shadow btn btn-danger"><i class="bi bi-x-lg"></i> Back</a>
        </div>
    </div>
</div>
<div class="card">
    @if ($data->is_ban == 1)
        <div class="alert alert-danger text-center" role="alert"><h5> Opps This product is ban by admin side !!</h5></div>
    @endif
    <div class="card-body">
        <form action="{{ route('vendors.products.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="Name" class="form-label">Name</label>
                    <input id="Name" class="form-control" type="text" name="name" required placeholder="Enter name" value="{{$data->name}}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="service_category_ids" class="form-label">Categories</label>
                    <select name="category_ids[]" id="service_category_ids" class="form-control js-example-basic-multiple" multiple data-placeholder="Select categories" required>
                        @foreach ($productCategoryList as $category)
                            <option value="{{$category->id}}" @if(in_array($category->id, $data->product_category_ids)) selected @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('service_category_ids')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input id="image" class="form-control" type="file" name="image">
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input id="price" class="form-control" type="number" name="price" required placeholder="Enter price" value="{{$data->price}}">
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>
                <div class="col-md-4 mb-3">
                    <label for="discount_price" class="form-label">Discount Price</label>
                    <input id="discount_price" class="form-control" type="number" name="discount_price" required placeholder="Enter discount price" value="{{$data->discount_price}}">
                    @error('discount_price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4 md-3">
                    @if ($data->is_ban == 0)
                        <div class="form-check form-check-inline mt-4 pt-2">
                            <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1" {{$data->featured == 1 ? 'checked' : ''}}>
                            <label class="form-check-label" for="featured">
                                Featured
                            </label>
                        </div>

                        <div class="form-check form-check-inline mt-4 pt-2">
                            <input type="checkbox" class="form-check-input" id="available" name="available" value="1" {{$data->available == 1 ? 'checked' : ''}}>
                            <label class="form-check-label" for="available">
                                Available
                            </label>
                        </div>
                    @endif
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
