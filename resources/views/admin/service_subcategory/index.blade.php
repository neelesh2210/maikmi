@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4> {{$page_title}} </h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Icon</th>
                                    <th>Name</th>
                                    <th>Color</th>
                                    <th>Featured</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($list as $key => $data)
                                    <tr>
                                        <td>{{($key+1) + ($list->currentPage() - 1)*$list->perPage()}}</td>
                                        <td><img src="{{imageUrl($data->image)}}" alt="image" onerror="this.onerror=null; this.src='{{asset('admin_css/no-pictures.png')}}'"></td>
                                        <td>{{$data->name}}</td>
                                        <td><span class="badge" style="background:{{$data->color}};">{{$data->color}}</span></td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input featured_update" name="featured" value="{{$data->id}}" @if ($data->featured == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input status_update" name="status" value="{{$data->id}}" @if ($data->status == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td>
                                            <x-edit-btn route="{{ route('service-subcategory.edit', $data->id) }}" />
                                            <x-delete-btn route="{{ route('service-subcategory.destroy', $data->id) }}" />
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
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4>@isset($edit_data) Update {{$page_title}} @else Create {{$page_title}} @endisset</h4>
                    </div>
                </div>
                <div class="card-body">
                    @isset($edit_data)
                        <form id="valid_form" method="POST" action="{{route('service-subcategory.update',$edit_data->id)}}" enctype="multipart/form-data">
                        @method('PUT')
                    @else
                        <form id="valid_form" method="POST" action="{{route('service-subcategory.store')}}" enctype="multipart/form-data">
                    @endisset
                        @csrf
                        <div class="mb-3">
                            <label for="service_category_id" class="form-label">Service Category</label>
                            <select name="service_category_id" id="service_category_id" class="form-control js-example-basic-single">
                                <option value="">Select Service Category</option>
                                @foreach ($categoryList as $category)
                                    <option value="{{$category->id}}" @if(isset($edit_data) && $edit_data->service_category_id == $category->id) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('service_category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" class="form-control" type="text" name="name" required placeholder="Enter category name" @isset($edit_data) value="{{$edit_data->name}}" @endisset>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input id="color" class="form-control form-control-color" type="color" name="color" required placeholder="Enter category name" @isset($edit_data) value="{{$edit_data->color}}" @endisset>
                            @error('color')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Icon</label>
                            <input id="image" class="form-control" type="file" name="image" accept="image/*" @isset($edit_data) @else required @endif>
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        @isset($edit_data)
                            <div class="mb-3">
                                <img src="{{imageUrl($edit_data->image)}}" class="img-fluid" alt="Banner" onerror="this.onerror=null; this.src='{{asset('admin_css/no-pictures.png')}}'">
                            </div>
                        @endisset
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="2" required placeholder="Enter desctiption">@isset($edit_data){{$edit_data->description}}@endisset</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        @isset($edit_data) <x-save-btn text="Update" /> @else <x-save-btn text="Save" /> @endisset
                        @isset($edit_data)
                            <x-cancle-btn text="Cancel" route="{{route('service-subcategory.index')}}" />
                        @endisset
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".featured_update").change(function(){
            var id = $(this).val();
            $.get("{{ route('service-subcategory.featureUpdate', '') }}/"+id, function(data)
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

        $(".status_update").change(function(){
            var id = $(this).val();
            $.get("{{ route('service-subcategory.statusUpdate', '') }}/"+id, function(data)
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
                    title: 'Subcategory status updated successfully !!',
                });

            });
        });
    </script>

@endsection
