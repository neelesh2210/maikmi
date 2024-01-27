@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Order Id</th>
                                    <th class="text-center">Salon</th>
                                    <th class="text-center">Order By</th>
                                    <th class="text-center">Total Order Amount</th>
                                    <th class="text-center">Payment Type</th>
                                    <th class="text-center">Order Date & Time</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $key=> $order)
                                    <tr>
                                        <td class="text-center">{{($key+1) + ($orders->currentPage() - 1)*$orders->perPage()}}</td>
                                        <td class="text-center"> {{$order->order_id}} </td>
                                        <td>
                                            <b>Name: </b> {{json_decode($order->salon)->name}} <br>
                                            <b>Phone: </b> {{json_decode($order->salon)->phone_number}} <br>
                                            <b>Address: </b> {{json_decode($order->salon)->address}},{{json_decode($order->salon)->city}}
                                        </td>
                                        <td>
                                            <b>Name: </b> {{json_decode($order->address)->name}} <br>
                                            <b>Phone: </b> {{json_decode($order->address)->phone}} <br>
                                            <b>Address: </b> {{json_decode($order->address)->first_address}},{{json_decode($order->address)->city}},{{json_decode($order->address)->state}},{{json_decode($order->address)->country}}-{{json_decode($order->address)->pincode}}<br>
                                        </td>
                                        <td class="text-center">₹ {{$order->total_amount}} </td>
                                        <td class="text-center"> {{$order->payment_type}}</td>
                                        <td class="text-center"> {{$order->created_at}} </td>
                                        <td class="text-center">
                                            <a class="btn btn-icon btn-primary btn-sm mr-1" href="{{route('product.order.detail',$order->order_id)}}" title="Order Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
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
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
