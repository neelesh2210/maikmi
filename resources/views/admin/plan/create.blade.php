@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-6 text-end">
                            <x-cancle-btn text="Back" route="{{route('plan.index')}}" />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('plan.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input id="title" class="form-control" type="text" name="title" value="{{old('title')}}" required placeholder="Enter Title...">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input id="price" class="form-control" type="number" step="0.01" name="price" value="{{old('price')}}" required placeholder="Enter Price...">
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="discounted_price" class="form-label">Discounted Price</label>
                                <input id="discounted_price" class="form-control" type="number" step="0.01" name="discounted_price" value="{{old('discounted_price')}}" required placeholder="Enter Discounted Price...">
                                @error('discounted_price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="duration" class="form-label">Duration (in Days)</label>
                                <input id="duration" class="form-control" type="number" step="1" name="duration" value="{{old('duration')}}" required placeholder="Enter Duration...">
                                @error('duration')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" rows="4" class="form-control" placeholder="Enter description">{{old('description')}}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="term_and_condition" class="form-label">Term And Condition</label>
                                <textarea name="term_and_condition" rows="4" class="form-control" placeholder="Enter term_and_condition">{{old('term_and_condition')}}</textarea>
                                @error('term_and_condition')
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
