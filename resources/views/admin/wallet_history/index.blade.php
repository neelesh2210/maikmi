@extends('backend.layouts.app')
@section('content')
    <style>
        .br-rad{
            border-radius: 50px;
            border: 3px solid;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-6 text-end">
                            <x-cancle-btn route="{{ url()->previous() }}" text="Back"/>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <a href="{{ imageUrl($data->userDetail->photo) }}" target="_blank" title="Astrologer Photo">
                                <img src="{{ imageUrl($data->userDetail->photo) }}" alt="astrologer photo" class="br-rad mb-2" onerror="this.onerror=null; this.src='{{ asset('admin_css/user.png') }}'" height="100" width="100">
                            </a>
                            <br>
                            <p><b>Name : </b> {{$data->name}} ( {{ucfirst($data->type)}} )</p>
                            <p><b>Phone : </b> {{$data->phone}}</p>
                            @if ($data->type != 'user')
                                <p><b>Experience : </b> {{$data->userDetail->experience}}</p>
                            @endif
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6 card-title"><h5>Wallet Balance</h5></div>
                                        <div class="col-6 text-end"><h4> ₹ {{$data->balance}} /- </h4></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="dataTableExample" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Balance</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i= 1;
                                                @endphp
                                                @forelse ($data->walletHistory as $history)
                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                        <td>{{$history->balance}}</td>
                                                        <td>
                                                            @if ($history->status=="credit")
                                                                <span class="badge rounded-pill bg-success">{{ucfirst($history->status)}}</span>
                                                            @else
                                                                <span class="badge rounded-pill bg-danger">{{ucfirst($history->status)}}</span>
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
                </div>
            </div>
        </div>
    </div>

@endsection
