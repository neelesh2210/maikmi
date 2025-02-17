@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-4 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-4">
                            <form action="{{route('service-booking.index')}}">
                                <button type="submit" name="export" value="export" class="btn btn-primary" style="height: 31px;padding-top: 2px;">Export</button>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <x-add-btn route="{{route('services.create')}}" />
                        </div>
                    </div>
                    <form action="{{route('service-booking.index')}}">
                        <div class="row">
                            <div class="col-3">
                                <label for="search_status">Status</label>
                                <select name="search_status" class="form-control form-sm-control">
                                    <option value="">All</option>
                                    <option value="waiting" @if($search_status == 'waiting') selected @endif>Waiting</option>
                                    <option value="pending" @if($search_status == 'pending') selected @endif>Pending</option>
                                    <option value="booked" @if($search_status == 'booked') selected @endif>Booked</option>
                                    <option value="confirmed" @if($search_status == 'confirmed') selected @endif>Confirmed</option>
                                    <option value="completed" @if($search_status == 'completed') selected @endif>Completed</option>
                                    <option value="cancelled" @if($search_status == 'cancelled') selected @endif>Cancelled</option>
                                    <option value="time_update" @if($search_status == 'time_update') selected @endif>Time Update</option>
                                    <option value="started" @if($search_status == 'started') selected @endif>Started</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="salon_id">Salon</label>
                                <select name="salon_id" class="form-control form-sm-control js-example-basic-multiple">
                                    <option value="">All</option>
                                    @foreach (App\Models\Salon::oldest('name')->get() as $salon)
                                        <option value="{{$salon->id}}" @if($search_salon == $salon->id) selected @endif>{{$salon->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="date">Date</label>
                                <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="flatpickr-date-range">
                                    <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
                                    <input type="text" name="search_date" value="{{$search_date}}" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
                                </div>
                            </div>
                            <div class="col-md-3" style="margin-top: 20px;">
                                <button class="btn btn-primary" style="height: 31px;padding-top: 2px;">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Booking Id</th>
                                    <th>Salon</th>
                                    <th>Booked By</th>
                                    <th>Payment</th>
                                    <th>Booking Date & Time</th>
                                    <th>Booking At</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($list as $key=> $data)
                                    <tr>
                                        <td>{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                        <td> {{$data->booking_id}} </td>
                                        <td> <a href="{{ route('salon.show', $data->salon_id ) }}">{{$data->getSalon->name}}</a> </td>
                                        <td> {{$data->getBookedBy->name}} </td>
                                        <td>
                                            <b>Type: </b>{{$data->payment_type}} <br>
                                            <b>Total Amount: </b> ₹{{$data->total_amount}} <br>
                                            <b>Paid Amount: </b> ₹{{$data->paid_amount}}
                                        </td>
                                        <td> {{$data->booking_date}} {{$data->booking_time}}</td>
                                        <td> {{$data->booking_at}} </td>
                                        <td> {{ucfirst($data->status)}} </td>

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
                        <div class="mt-2">
                            {{ $list->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
