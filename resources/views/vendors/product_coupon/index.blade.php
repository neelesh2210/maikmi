@extends('vendors.layouts.app')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="bi bi-receipt-cutoff icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    {{$page_title}}
                </div>
            </div>
            <div class="page-title-actions">
                <a href="{{route('vendors.product-coupon.create')}}" class="btn-shadow btn btn-info"><i class="bi bi-plus-lg"></i> New</a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Discount</th>
                            <th>Start / End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($list as $key=> $data)
                            <tr>
                                <td>{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                <td> {{$data->code}} </td>
                                <td> {{$data->discount}} {{$data->discount_type=="percent" ? '%' : '₹'}}</td>
                                <td>
                                    {{$data->start_at}} To {{$data->end_at}}  <br>
                                    @if ($data->start_at <= date('Y-m-d') && $data->end_at >= date('Y-m-d'))
                                        <span class="badge badge-pill badge-success">Active</span>
                                    @elseif ($data->start_at >= date('Y-m-d'))
                                        <span class="badge badge-pill badge-warning">Upcoming</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Expired</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="status_update" value="{{$data->id}}">
                                        <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="status" value="{{$data->id}}" @if ($data->status == 1) checked @endif data-size="mini">
                                    </div>
                                    {{-- <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input status_update" name="status" value="{{$data->id}}" @if ($data->status == 1) checked @endif>
                                    </div> --}}
                                </td>
                                <td>
                                    <x-edit-btn route="{{ route('vendors.product-coupon.edit', $data->id) }}" />
                                    <x-delete-btn route="{{ route('vendors.product-coupon.destroy', $data->id) }}" />
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
                    {{ $list->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(".status_update").click(function(){
            var id = $(this).attr('value');
            $.get("{{ route('vendors.product-coupon.statusUpdate', '') }}/"+id, function(data)
            {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                Toast.fire({
                    icon: (data == "1") ? "success" : "error",
                    title: 'Status updated successfully !!',
                });

            });
        });
    </script>
@endsection
