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
            <a href="{{route('vendors.services.index')}}" class="btn-shadow btn btn-danger"><i class="bi bi-x-lg"></i> Back</a>
        </div>
    </div>
</div>
<div class="card">
    @if ($data->is_ban == 1)
        <div class="alert alert-danger text-center" role="alert"><h5> Opps This service is ban by admin side !!</h5></div>
    @endif
    <div class="card-body">
        <form action="{{ route('vendors.services.update', $data->id) }}" method="POST" enctype="multipart/form-data">
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
                        @foreach ($serviceCategoryList as $category)
                            <option value="{{$category->id}}" @if(in_array($category->id, $data->service_category_ids)) selected @endif>{{$category->name}}</option>
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
                <div class="col-md-3 mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input id="price" class="form-control" type="number" name="price" required placeholder="Enter price" value="{{$data->price}}">
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>
                <div class="col-md-3 mb-3">
                    <label for="discount_price" class="form-label">Discount Price</label>
                    <input id="discount_price" class="form-control" type="number" name="discount_price" required placeholder="Enter discount price" value="{{$data->discount_price}}">
                    @error('discount_price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="duration" class="form-label">Duration <small>(Minutes)</small></label>
                    <input id="duration" class="form-control" type="number" name="duration" required value="{{$data->duration}}" placeholder="Enter minutes">
                    @error('duration')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="addon_services" class="form-label">Addon Services</label>
                    <select name="addon_services[]" id="addon_services" class="form-control js-example-basic-multiple" multiple data-placeholder="Select addon services">
                        @foreach ($services as $service)
                            <option value="{{$service->id}}" @if($data->addon_services && in_array($service->id, $data->addon_services)) selected @endif>{{$service->name}}</option>
                        @endforeach
                    </select>
                    @error('addon_services')
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
                @if ($data->is_ban == 0)
                    <div class="col-md-12 mb-3">
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1" {{$data->featured == 1 ? 'checked' : ''}}>
                            <label class="form-check-label" for="featured">
                                Featured
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="enable_booking" name="enable_booking" value="1" {{$data->enable_booking == 1 ? 'checked' : ''}}>
                            <label class="form-check-label" for="enable_booking">
                                Enable booking
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="enable_at_salon" name="enable_at_salon" value="1" {{$data->enable_at_salon == 1 ? 'checked' : ''}}>
                            <label class="form-check-label" for="enable_at_salon">
                                Enable booking at salon
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="enable_at_customer_address" name="enable_at_customer_address" value="1" {{$data->enable_at_customer_address == 1 ? 'checked' : ''}}>
                            <label class="form-check-label" for="enable_at_customer_address">
                                Enable booking at customer address
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="available" name="available" value="1" {{$data->available == 1 ? 'checked' : ''}}>
                            <label class="form-check-label" for="available">
                                Available
                            </label>
                        </div>
                    </div>
                @endif
            </div>
            <button class="btn btn-success" type="submit"><i class="bi bi-check-lg"></i> Update</button>
        </form>
    </div>
</div>
@endsection
