@extends('vendors.layouts.app')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="bi bi-tags icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    {{$page_title}}
                </div>
            </div>
            {{-- <div class="page-title-actions">
                <a href="{{route('vendors.services.create')}}" class="btn-shadow btn btn-info"><i class="bi bi-plus-lg"></i> New</a>
            </div> --}}
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Booking Id</th>
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
                                <td> {{$data->getBookedBy->name}} </td>
                                <td> {{$data->payment_type}} </td>
                                <td> {{$data->booking_date}} {{$data->booking_time}}</td>
                                <td> {{$data->booking_at}} </td>
                                <td> {{ucfirst($data->status)}} </td>

                            </tr>
                        @empty

                            <tr>
                                <td colspan="10" class="text-center text-danger">
                                    <img src="{{asset('vendors_css/no_data.gif')}}" alt="">
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
@endsection
