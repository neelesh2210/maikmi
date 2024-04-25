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
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($service_catelogs as $key => $service_catelog)
                                    <tr>
                                        <td>{{($key+1) + ($service_catelogs->currentPage() - 1)*$service_catelogs->perPage()}}</td>
                                        <td>{{$service_catelog->category->name}}</td>
                                        <td>{{$service_catelog->name}}</td>
                                        <td>{{ucwords($service_catelog->gender)}}</td>
                                        <td><img src="{{imageUrl($service_catelog->image)}}" alt="image" onerror="this.onerror=null; this.src='{{asset('admin_css/no-pictures.png')}}'"></td>
                                        <td>
                                            <x-edit-btn route="{{ route('service-catelog.edit', $service_catelog->id) }}" />
                                            <x-delete-btn route="{{ route('service-catelog.destroy', $service_catelog->id) }}" />
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
                            {{ $service_catelogs->links() }}
                        </div>
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
                        <form id="valid_form" method="POST" action="{{route('service-catelog.update',$edit_data->id)}}" enctype="multipart/form-data">
                        @method('PUT')
                    @else
                        <form id="valid_form" method="POST" action="{{route('service-catelog.store')}}" enctype="multipart/form-data">
                    @endisset
                        @csrf
                        <div class="mb-3">
                            <label for="service_category_ids" class="form-label">Categories</label>
                            <select name="category_id" class="form-control js-example-basic-single" data-placeholder="Select category" required>
                                <option value="">Select Category...</option>
                                @foreach ($serviceCategoryList as $category)
                                    <option value="{{(int)$category->id}}" @isset($edit_data) @if($edit_data->category_id == $category->id) selected @endif @endisset>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('service_category_ids')
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
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" class="form-control" data-placeholder="Select Gender" required>
                                <option value="male" @isset($edit_data) @if($edit_data->gender == 'male') selected @endif @endisset>Male</option>
                                <option value="female" @isset($edit_data) @if($edit_data->gender == 'female') selected @endif @endisset>Female</option>

                            </select>
                            @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
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
                            <x-cancle-btn text="Cancel" route="{{route('service-catelog.index')}}" />
                        @endisset
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".featured_update").change(function(){
            var id = $(this).val();
            $.get("{{ route('service-category.featureUpdate', '') }}/"+id, function(data)
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
            $.get("{{ route('service-category.statusUpdate', '') }}/"+id, function(data)
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
                    title: 'Category status updated successfully !!',
                });

            });
        });
    </script>

@endsection
