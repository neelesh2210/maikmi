@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 card-title text-center mb-4"><u><h4>{{$page_title}}</h4></u></div>
                        <div class="col-6 card-title">
                            <u><h4>User Detail</h4></u>
                            <b>Name: </b> {{json_decode($order->address)->name}} <br>
                            <b>Phone: </b> {{json_decode($order->address)->phone}} <br>
                            <b>Address: </b> {{json_decode($order->address)->first_address}},{{json_decode($order->address)->city}},{{json_decode($order->address)->state}},{{json_decode($order->address)->country}}-{{json_decode($order->address)->pincode}}<br>
                        </div>
                        <div class="col-6 card-title">
                            <u><h4>Salon Detail</h4></u>
                            <b>Name: </b> {{json_decode($order->salon)->name}} <br>
                            <b>Phone: </b> {{json_decode($order->salon)->phone_number}} <br>
                            <b>Address: </b> {{json_decode($order->salon)->address}},{{json_decode($order->salon)->city}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Discount Price</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (json_decode($order->products) as $key=>$product)
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td class="text-center">{{$product->name}}</td>
                                        <td class="text-center">₹ {{$product->price}}</td>
                                        <td class="text-center">₹ {{$product->discount_price}}</td>
                                        <td class="text-center">{{$product->product_order_status}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <b>Payment Type:</b> {{$order->payment_type}} <br>
                        <b>Total Amount:</b>₹ {{$order->total_amount}} <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
