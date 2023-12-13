@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-6 text-end">
                            <x-cancle-btn text="Back" route="{{route('app_sliders.index')}}" />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('app_sliders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="order" class="form-label">Order</label>
                                <input id="order" class="form-control" type="number" name="order" required placeholder="Enter Order">
                                @error('order')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="text" class="form-label">Text</label>
                                <input id="text" class="form-control" type="text" name="text" required placeholder="Enter text">
                                @error('text')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="button" class="form-label">Button</label>
                                <input id="button" class="form-control" type="text" name="button" required placeholder="Enter button">
                                @error('button')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="text_position" class="form-label">Text Position</label>
                                <select name="text_position" id="text_position" class="form-control js-example-basic-single" required>
                                    <option value="top_start">Top Start</option>
                                    <option value="top_center">Top Center</option>
                                    <option value="top_end">Top End</option>
                                    <option value="center_start">Center Start</option>
                                    <option value="center">Center</option>
                                    <option value="center_end">Center End</option>
                                    <option value="bottom_start">Bottom Start</option>
                                    <option value="bottom_center">Bottom Center</option>
                                    <option value="bottom_end">Bottom End</option>
                                </select>
                                @error('text_position')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="text_color" class="form-label">Text Color</label>
                                <input id="text_color" class="form-control form-control-color" type="color" name="text_color" required placeholder="Enter text color">
                                @error('text_color')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="button_color" class="form-label">Button Color</label>
                                <input id="button_color" class="form-control form-control-color" type="color" name="button_color" required placeholder="Enter button color">
                                @error('button_color')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="background_color" class="form-label">Background Color</label>
                                <input id="background_color" class="form-control form-control-color" type="color" name="background_color" required placeholder="Enter background color">
                                @error('background_color')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input id="image" class="form-control" type="file" name="image" required>
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="image_fit" class="form-label">Image Fit</label>
                                <select name="image_fit" id="image_fit" class="form-control js-example-basic-single" required>
                                    <option value="cover">Cover</option>
                                    <option value="fill">Fill</option>
                                    <option value="contain">Contain</option>
                                    <option value="fit_height">Fit Height</option>
                                    <option value="fit_width">Fit Width</option>
                                    <option value="none">None</option>
                                    <option value="scale_down">Scale Down</option>
                                </select>
                                @error('image_fit')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="salon_id" class="form-label">Salon</label>
                                <select name="salon_id" id="salon_id" class="form-control js-example-basic-single" required>
                                    <option value="">Select Salon</option>
                                    @foreach ($salonList as $salonData)
                                        <option value="{{$salonData->id}}">{{$salonData->name}}</option>
                                    @endforeach
                                </select>
                                @error('service_category_ids')
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
