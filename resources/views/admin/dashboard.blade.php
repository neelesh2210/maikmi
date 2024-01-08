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
        <div class="col-md-4">
            <div class="card cardinfo">
                <div class="card-body">
                    <h6>NEW CUSTOMERS</h6>
                    <p>{{$total_customers}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card cardinfo">
                <div class="card-body">
                    <h6>NEW BOOKING</h6>
                    <p>{{$total_bookings}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
