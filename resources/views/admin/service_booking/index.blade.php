@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-6 text-end">
                            <x-add-btn route="{{route('services.create')}}" />
                        </div>
                    </div>
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
                                    <th>Payment Type</th>
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
                                        <td> {{$data->payment_type}} </td>
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
