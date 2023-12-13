@extends('admin.layouts.app')
@section('content')
    @include('admin.user.search')
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
                                    <th>#</th>
                                    <th>Info</th>
                                    <th>Address</th>
                                    {{-- <th>Wallet Balance</th> --}}
                                    <th>Status</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($list as $key=> $data)
                                    <tr>
                                        <td>{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                        <td>
                                            <b>Name:</b> {{$data->name}} <br>
                                            <b>Phone:</b> {{$data->phone}} <br>
                                        </td>
                                        <td>
                                            @if ($data->getDefaultAddress)
                                                <a href="{{route('user-address.index')}}?user_id={{$data->id}}">
                                                    {{mb_strimwidth($data->getDefaultAddress->address, 0, 25, ' ...')}}
                                                </a>
                                            @else
                                                NA
                                            @endif
                                        </td>
                                        {{-- <td>
                                            <a href="{{route('wallet-history.index')}}?user_id={{$data->id}}" title="{{$data->name}} Wallet History">
                                                ₹ {{$data->balance}}
                                            </a>
                                            ₹ {{$data->balance}}
                                        </td> --}}

                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input status_update" name="is_active" value="{{$data->id}}" @if ($data->is_active == "active") checked @endif>
                                            </div>
                                        </td>
                                        {{-- <td>
                                            <x-edit-btn route="{{ route('user.edit', $data->id) }}" />

                                            <x-delete-btn route="{{ route('user.destroy', $data->id) }}" />
                                        </td> --}}
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

            var id= $(this).val();
            $.get("{{ route('user.statusUpdate', '') }}/"+id, function(data)
            {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                Toast.fire({
                    icon: (data == "active") ? "success" : "error",
                    title: 'User '+data+'d Successfully !!',
                });

            });
        });
    </script>
@endsection
