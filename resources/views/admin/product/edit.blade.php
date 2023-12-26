@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-6 text-end">
                            <x-cancle-btn text="Back" route="{{route('products.index')}}" />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="Name" class="form-label">Name</label>
                                <input id="Name" class="form-control" type="text" name="name" required placeholder="Enter name" value="{{$data->name}}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
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
                            <div class="col-md-3 mb-3">
                                <label for="salon_id" class="form-label">Shop</label>
                                <select name="salon_id" id="salon_id" class="form-control js-example-basic-single" required>
                                    <option value="">Select Shop</option>
                                    @foreach ($salonList as $salonData)
                                        <option value="{{$salonData->id}}" @if($salonData->id == $data->salon_id) selected @endif>{{$salonData->name}}</option>
                                    @endforeach
                                </select>
                                @error('service_category_ids')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
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
                            <div class="col-md-6 md-3">
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

                                <div class="form-check form-check-inline mt-4 pt-2 float-end">
                                    <input type="checkbox" class="form-check-input" id="is_ban" name="is_ban" value="1" {{$data->is_ban == 1 ? 'checked' : ''}}>
                                    <label class="form-check-label text-danger" for="is_ban">
                                        Ban Product
                                    </label>
                                </div>
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
        </div>
    </div>
@endsection
