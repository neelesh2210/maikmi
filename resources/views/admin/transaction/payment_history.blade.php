@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8 card-title">
                            <h4>{{ $page_title }}</h4>
                        </div>
                        <div class="col-4">
                            <form action="{{route('transaction.payment')}}" method="GET">
                                <div class="input-group flatpickr" id="flatpickr-date-range">
                                    <input type="text" name="date" class="form-control" placeholder="Select Date.." value="{{$selectedDate}}" data-input>
                                    <button type="submit" class="btn btn-secondary" title="Submit"><i data-feather="search" width="15" height="15"></i></button>
                                    <a href="{{route('transaction.payment')}}" class="btn btn-secondary active" title="Clear"><i data-feather="x-circle" width="15" height="15"></i></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Transaction Id</th>
                                    <th>user</th>
                                    <th>Balance</th>
                                    <th>Call Time</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($list as $key=> $data)
                                    <tr>
                                        <td>{{ $key + 1 + ($list->currentPage() - 1) * $list->perPage() }}</td>
                                        <td>{{ $data->transaction_id }}</td>
                                        <td>{{ $data->getUser->name }} ( {{ ucfirst($data->getUser->type) }} )</td>
                                        <td>₹ {{ $data->balance }} /-</td>
                                        <td>{{ $data->call_time? getSecondToTime($data->call_time):"--" }}</td>
                                        <td><span class="badge {{$data->status=='credit' ? 'bg-success' : 'bg-danger'}}">{{ ucfirst($data->status) }}</span></td>
                                        <td>{{ dateTimeFormat($data->created_at) }}</td>
                                    </tr>
                                @empty

                                    <tr>
                                        <td colspan="10" class="text-center text-danger">
                                            <i class="link-icon" data-feather="frown"
                                                style="width: 50px; height:50px;"></i><br>
                                            Opps!! There Are No Data Found..
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $list->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
