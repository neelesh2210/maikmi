@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-4">
                            <h5>Salon Detail:-</h5>
                            <b>Name: </b>{{$salon->name}} <br>
                            <b>Phone: </b>{{$salon->phone_number}} <br>
                            <b>City: </b>{{$salon->city}} <br>
                            <b>Address: </b>{{$salon->address}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Engage Time</th>
                                    <th>Engage Duration</th>
                                    <th>Is Free</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($workers as $key=> $worker)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$worker->name}}</td>
                                        <td>{{$worker->engage_time}}</td>
                                        <td>{{$worker->engage_duration}}</td>
                                        <td>
                                            @if($worker->is_free == '0')
                                                <span class="badge bg-danger">Busy</span>
                                            @else
                                                <span class="badge bg-success">Free</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-danger">
                                            <i class="link-icon" data-feather="frown" style="width: 50px; height:50px;"></i><br>
                                            Opps!! There Are No Data Found..
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
