@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-6 text-end">
                            <x-add-btn route="{{route('app_sliders.create')}}" />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sliders</th>
                                    <th>Order</th>
                                    <th>Text</th>
                                    <th>Button</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($list as $data)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td><img src="{{ imageUrl($data->image) }}" alt="Slider"
                                                onerror="this.onerror=null; this.src='{{ asset('admin_css/no-pictures.png') }}'">
                                        </td>
                                        <td>{{$data->order}}</td>
                                        <td><p style="color:{{$data->text_color}}">{{$data->text}}</p></td>
                                        <td><button class="btn" style="color:{{$data->button_color}}; background:{{$data->background_color}}" disabled> {{$data->button}} </button></td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input status" name="status"
                                                    value="{{ $data->id }}"
                                                    @if ($data->status == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td>
                                            <x-edit-btn route="{{ route('app_sliders.edit', $data->id) }}" />
                                            <x-delete-btn route="{{ route('app_sliders.destroy', $data->id) }}" />
                                        </td>
                                    </tr>
                                @empty

                                    <tr>
                                        <td colspan="10" class="text-center text-danger">
                                            <i class="link-icon" data-feather="frown"
                                                style="width: 50px; height:50px;"></i><br>
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
        {{-- <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4>
                            @isset($edit_data)
                                Update {{ $page_title }}
                            @else
                                Create {{ $page_title }}
                            @endisset
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    @isset($edit_data)
                        <form id="valid_form" method="POST" action="{{ route('app_sliders.update', $edit_data->id) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                        @else
                            <form id="valid_form" method="POST" action="{{ route('app_sliders.store') }}"
                                enctype="multipart/form-data">
                            @endisset
                            @csrf
                            <div class="mb-3">
                                <label for="slider" class="form-label">Slider</label>
                                <input id="slider" class="form-control" type="file" name="slider" accept="image/*"
                                    @isset($edit_data) @else required @endif>
                        </div>
                        @isset($edit_data)
                            <div class="mb-3">
                                <img src="{{ imageUrl($edit_data->slider) }}" class="img-fluid" alt="Slider" onerror="this.onerror=null; this.src='{{ asset('admin_css/no-pictures.png') }}'">
                            </div>
                        @endisset
                                    @isset($edit_data) <x-save-btn text="Update" /> @else <x-save-btn text="Save" /> @endisset
                                    @isset($edit_data)
                            <x-cancle-btn text="Cancel" route="{{ route('app_sliders.index') }}" />
                        @endisset
                                    </form>
                            </div>
                </div>
            </div>
        </div> --}}
    </div>
    <script>
        $(".status").change(function() {

            var id = $(this).val();
            $.get("{{ route('app_sliders.show', '') }}/" + id, function(data) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                Toast.fire({
                    icon: 'success',
                    title: 'Slider Status Updated Successfully',
                });

            });
        });
    </script>
@endsection
