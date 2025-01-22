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
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Coupon Type</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Number of Usages</th>
                                    <th class="text-center">Total Used</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($coupons as $key=> $coupon)
                                    <tr>
                                        <td class="text-center">{{($key+1) + ($coupons->currentPage() - 1)*$coupons->perPage()}}</td>
                                        <td>
                                            <b>Name: </b> {{$coupon->salon->name}} <br>
                                            <b>Phone: </b> {{$coupon->salon->name}}
                                        </td>
                                        <td class="text-center">{{$coupon->code}}</td>
                                        <td class="text-center">
                                            <img src="{{imageUrl($coupon->image)}}" alt="image" onerror="this.onerror=null; this.src='{{ asset('admin_css/no-pictures.png') }}'">
                                        </td>
                                        <td class="text-center">
                                            @if($coupon->amount_type == 'amount')
                                                ₹
                                            @endif
                                            {{$coupon->amount}}
                                            @if($coupon->amount_type == 'percent')
                                                %
                                            @endif
                                        </td>
                                        <td>
                                            <b>Coupon Type: </b> {{ucwords(str_replace('_',' ',$coupon->coupon_type))}} <br>
                                            @if($coupon->coupon_type == 'service')
                                                {{implode(',',App\Models\Service::whereIn('id',json_decode($coupon->service_ids))->pluck('name')->toArray())}}
                                            @else
                                                <b>Total Order Value: </b> {{$coupon->total_order_amount}}
                                            @endif
                                        </td>
                                        <td class="text-center"> {{$coupon->start_date}} - {{$coupon->end_date}} </td>
                                        <td class="text-center"> {{$coupon->number_of_usages}} </td>
                                        <td class="text-center"> {{$coupon->total_used}} </td>
                                        <td class="text-center">
                                            {!! $coupon->is_active == '1' ? '<span class="badge rounded-pill bg-success">Active</span>' : '<span class="badge rounded-pill bg-danger">Inactive</span>' !!}
                                        </td>
                                        <td class="text-center">
                                            <x-edit-btn route="{{ route('coupon.edit', $coupon->id) }}" />
                                            <x-delete-btn route="{{ route('coupon.destroy', $coupon->id) }}" />
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
                            {{ $coupons->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
