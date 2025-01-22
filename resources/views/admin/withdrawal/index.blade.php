@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-6 text-end">
                            <x-add-btn route="{{route('coupon.create')}}" />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Salon</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($withdrawals as $key=> $withdrawal)
                                    <tr>
                                        <td class="text-center">{{($key+1) + ($withdrawals->currentPage() - 1)*$withdrawals->perPage()}}</td>
                                        <td>
                                            <b>Name: </b> {{$withdrawal->salon->name}} <br>
                                            <b>Phone: </b> {{$withdrawal->salon->name}}
                                        </td>
                                        <td class="text-center">₹ {{$withdrawal->amount}}</td>
                                        <td class="text-center">
                                            @if($withdrawal->status == 'pending')
                                                <select id="status_{{$withdrawal->id}}" class="form-control" onchange="changeStatus('{{$withdrawal->id}}')">
                                                    <option value="pending">Pending</option>
                                                    <option value="success">Success</option>
                                                    <option value="cancel">Cancel</option>
                                                </select>
                                            @else
                                                <span class="badge rounded-pill bg-success">{{ucfirst($withdrawal->status)}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{$withdrawal->created_at->format('d M Y')}}
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
                        <div class="mt-2">
                            {{ $withdrawals->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        function changeStatus(){

        }

    </script>
@endsection
