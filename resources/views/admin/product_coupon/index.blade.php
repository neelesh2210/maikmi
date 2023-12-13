@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-6 text-end">
                            <x-add-btn route="{{route('product-coupon.create')}}" />
                        </div>
                    </div>
                </div>
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
                                                <span class="badge bg-success">Active</span>
                                            @elseif ($data->start_at >= date('Y-m-d'))
                                                <span class="badge bg-warning">Upcoming</span>
                                            @else
                                                <span class="badge bg-danger">Expired</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input status_update" name="status" value="{{$data->id}}" @if ($data->status == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td>
                                            <x-edit-btn route="{{ route('product-coupon.edit', $data->id) }}" />
                                            <x-delete-btn route="{{ route('product-coupon.destroy', $data->id) }}" />
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
        </div>
    </div>
    <script>
        $(".status_update").change(function(){
            var id = $(this).val();
            $.get("{{ route('product-coupon.statusUpdate', '') }}/"+id, function(data)
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
