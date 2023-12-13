@extends('vendors.layouts.app')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="bi bi-clipboard2-data icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    {{$page_title}}
                </div>
            </div>
            <div class="page-title-actions">
                <a href="{{route('vendors.products.create')}}" class="btn-shadow btn btn-info"><i class="bi bi-plus-lg"></i> New</a>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th>Categories</th>
                            <th>Available</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($list as $key=> $data)
                            <tr>
                                <td>{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                <td>
                                    <img src="{{imageUrl($data->image)}}" alt="image" onerror="this.onerror=null; this.src='{{ asset('admin_css/no-pictures.png') }}'" height="40" width="40">
                                    {!! $data->is_ban == 1 ? '<br> <span class="badge badge-pill badge-danger">Banned</span>' : '' !!}
                                </td>
                                <td>
                                    {{$data->name}}
                                    {!! $data->featured == 1 ? '<br> <span class="badge badge-pill badge-primary">Featured</span>' : '' !!}
                                </td>
                                <td> {{$data->price}} </td>
                                <td> {{$data->discount_price}} </td>
                                <td>
                                    {{$data->getProductCategory($data->product_category_ids)}}
                                </td>
                                <td> {!! $data->available == 1 ? '<span class="badge badge-pill badge-success">Yes</span>' : '<span class="badge badge-pill badge-danger">No</span>' !!} </td>
                                <td>
                                    <x-edit-btn route="{{ route('vendors.products.edit', $data->id) }}" />
                                    <x-delete-btn route="{{ route('vendors.products.destroy', $data->id) }}" />
                                </td>
                            </tr>
                        @empty

                            <tr>
                                <td colspan="10" class="text-center text-danger">
                                    <img src="{{asset('vendors_css/no_data.gif')}}" alt="">
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
