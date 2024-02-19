@extends('admin.layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
        </div>
        <form action="{{route('admin.dashboard')}}">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="flatpickr-date-range">
                    <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
                    <input type="text" name="search_date" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
                </div>
                <div>
                    <button class="btn btn-primary"><i class="bi bi-search pe-2"></i>Fillter</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card cardinfo">
                <div class="card-body">
                    <h6>Users</h6>
                    <p>{{$total_users}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card cardinfo">
                <div class="card-body">
                    <h6>Shops</h6>
                    <p>{{$total_shops}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card cardinfo">
                <div class="card-body">
                    <h6>Products</h6>
                    <p>{{$total_products}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card cardinfo">
                <div class="card-body">
                    <h6>Services</h6>
                    <p>{{$total_services}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card cardinfo">
                <div class="card-body">
                    <u><h4 class="text-center">Order Stats</h4></u>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-end">
                            <b>Pending Order</b>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>:</b>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="badge bg-warning" title="Pending Order">{{$total_pending_orders}}</span>
                        </div>
                        <div class="col-md-4 text-end">
                            <b>Completed Order</b>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>:</b>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="badge bg-success" title="Completed Order">{{$total_completed_orders}}</span>
                        </div>
                        <div class="col-md-4 text-end">
                            <b>Total Order</b>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>:</b>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="badge bg-primary" title="Completed Order">{{$total_orders}}</span>
                        </div>
                        <div class="col-md-4 text-end">
                            <b>Total Order Amount</b>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>:</b>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="badge bg-primary" title="Completed Order">₹ {{$total_order_amount}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card cardinfo">
                <div class="card-body">
                    <u><h4 class="text-center">Booking Stats</h4></u>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-end">
                            <b>Pending Booking</b>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>:</b>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="badge bg-warning" title="Pending Order">{{$total_pending_bookings}}</span>
                        </div>
                        <div class="col-md-4 text-end">
                            <b>Completed Booking</b>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>:</b>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="badge bg-success" title="Completed Order">{{$total_completed_bookings}}</span>
                        </div>
                        <div class="col-md-4 text-end">
                            <b>Total Booking</b>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>:</b>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="badge bg-primary" title="Completed Order">{{$total_bookings}}</span>
                        </div>
                        <div class="col-md-4 text-end">
                            <b>Total Booking Amount</b>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>:</b>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="badge bg-primary" title="Completed Order">₹ {{$total_booking_amount}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
