@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-6 text-end">
                            <x-cancle-btn text="Back" route="{{route('user.index')}}" />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($list as $data)
                            <div class="col-12 col-md-6 col-xl-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        @if($data->is_default)<span class="badge bg-success float-end" style="position: absolute; right: 0; top: 0;">Default</span>@endif
                                        <h5 class="mb-3"><i class="bi bi-geo-alt"></i> {{$data->address}}</h5>
                                        <span class="badge rounded-pill border border-primary text-primary">{{ucfirst($data->type)}}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
