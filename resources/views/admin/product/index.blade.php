@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-6 text-end">
                            <x-add-btn route="{{route('products.create')}}" />
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
                                    <th>Name</th>
                                    <th>Shop</th>
                                    <th>Price</th>
                                    <th>Discount Price</th>
                                    <th>Categories</th>
                                    <th>Feature</th>
                                    <th>Available</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($list as $key=> $data)
                                    <tr>
                                        <td>{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                        <td>
                                            <img src="{{imageUrl($data->image)}}" alt="image" onerror="this.onerror=null; this.src='{{ asset('admin_css/no-pictures.png') }}'">
                                            {!! $data->is_ban == 1 ? '<br> <span class="badge rounded-pill bg-danger">Banned</span>' : '' !!}
                                        </td>
                                        <td>
                                            {{$data->name}}
                                            {!! $data->featured == 1 ? '<br> <span class="badge rounded-pill bg-primary">Featured</span>' : '' !!}
                                        </td>
                                        <td> <a href="{{ route('salon.show', $data->salon_id ) }}">{{$data->getSalon->name}}</a> </td>
                                        <td> {{$data->price}} </td>
                                        <td> {{$data->discount_price}} </td>
                                        <td>
                                            {{$data->getProductCategory($data->product_category_ids)}}
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input featured_update" name="featured" value="{{$data->id}}" @if ($data->featured == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td> {!! $data->available == 1 ? '<span class="badge rounded-pill bg-success">Yes</span>' : '<span class="badge rounded-pill bg-danger">No</span>' !!} </td>
                                        <td>
                                            <x-edit-btn route="{{ route('products.edit', $data->id) }}" />
                                            <x-delete-btn route="{{ route('products.destroy', $data->id) }}" />
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
            $.get("{{ route('product.featureUpdate', '') }}/"+id, function(data)
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

    </script>

@endsection
