@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-6 text-end">
                            <x-add-btn route="{{route('salon.create')}}" />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Shop Info</th>
                                    <th>Owner Info</th>
                                    <th>Service Booking</th>
                                    <th>Featured</th>
                                    <th>Available</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($list as $key=> $data)
                                    <tr>
                                        <td>{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                        <td><img src="{{imageUrl($data->image)}}" alt="image" onerror="this.onerror=null; this.src='{{ asset('admin_css/no-pictures.png') }}'"></td>
                                        <td>
                                            <b>Name : </b>{{$data->name}} <br>
                                            <b>Phone : </b>{{$data->phone_number}} <br>
                                        </td>
                                        <td>
                                            <b>Name : </b>{{$data->getOwner->name}} <br>
                                            <b>Phone : </b> {{$data->getOwner->phone}} <br>
                                        </td>
                                        <td>
                                            <a href="{{route('service-booking.index')}}?salon_id={{$data->id}}">
                                                <span class="badge bg-primary" title="Total Service Booking">{{$data->getServiceBooking->count()}}</span>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input featured_update" name="featured" value="{{$data->id}}" @if ($data->featured == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input available_update" name="available" value="{{$data->id}}" @if ($data->available == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td>
                                            <a type="button" id="actionBtn{{$data->id}}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical icon-lg text-muted pb-3px"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="actionBtn{{$data->id}}">
                                                <a class="dropdown-item d-flex align-items-center" href="{{ route('salon.show', $data->id) }}"><i class="bi bi-eye icon-sm me-2"></i><span class="">View</span></a>
                                                <a class="dropdown-item d-flex align-items-center" href="{{ route('salon.edit', $data->id) }}"><i class="bi bi-pencil-square icon-sm me-2"></i><span class="">Edit</span></a>
                                                <a class="dropdown-item d-flex align-items-center" href="{{ route('salon-gallery.edit', $data->id) }}"><i class="bi bi-image icon-sm me-2"></i><span class="">Gallery</span></a>
                                                <a class="dropdown-item d-flex align-items-center" href="{{ route('availability-hour.edit', $data->id) }}"><i class="bi bi-clock-history icon-sm me-2"></i><span class="">Availability Hour</span></a>
                                                <a class="dropdown-item d-flex align-items-center" href="{{route('salon.worker.list',$data->id)}}"><i class="bi bi-people icon-sm me-2"></i>Workers</a>
                                            </div>
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
        $(".featured_update").change(function(){

            var id = $(this).val();
            $.get("{{ route('salon.featureUpdate', '') }}/"+id, function(data)
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
                    title: 'Feature status update successfully !!',
                });

            });
        });

        $(".available_update").change(function(){

            var id = $(this).val();
            $.get("{{ route('salon.availableUpdate', '') }}/"+id, function(data)
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
                    title: 'Available status update successfully !!',
                });

            });
        });
    </script>
@endsection
