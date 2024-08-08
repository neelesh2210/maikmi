@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('send.notification.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input id="title" class="form-control" type="text" name="title" required placeholder="Enter Title" value="{{old('title')}}">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="body" class="form-label">Body</label>
                                <input id="body" class="form-control" type="text" name="body" required placeholder="Enter Body" value="{{old('body')}}">
                                @error('body')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="customer" class="form-label">Customer</label>
                                <input type="radio" name="to_send" id="customer" value="customer">
                                <label for="salon" class="form-label">Salon</label>
                                <input type="radio" name="to_send" id="salon" value="salon">
                                <label for="all" class="form-label">All</label>
                                <input type="radio" name="to_send" id="all" value="all">
                            </div>
                        </div>
                        <x-save-btn text="Send"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
