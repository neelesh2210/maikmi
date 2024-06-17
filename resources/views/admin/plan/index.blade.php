@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-6 text-end">
                            <x-add-btn route="{{route('plan.create')}}" />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Discounted Price</th>
                                    <th class="text-center">Duration</th>
                                    <th class="text-center">Is Active</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($plans as $key=> $plan)
                                    <tr>
                                        <td class="text-center">{{($key+1) + ($plans->currentPage() - 1)*$plans->perPage()}}</td>
                                        <td class="text-center">{{$plan->title}}</td>
                                        <td class="text-center">₹ {{$plan->price}}</td>
                                        <td class="text-center">₹ {{$plan->discounted_price}}</td>
                                        <td class="text-center">{{$plan->duration}} Days</td>
                                        <td class="text-center">
                                            <div class="form-switch">
                                                <input type="checkbox" class="form-check-input status_update" name="status" value="{{$plan->id}}" @if ($plan->is_active == '1') checked @endif>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <x-edit-btn route="{{ route('plan.edit', $plan->id) }}" />
                                            <x-delete-btn route="{{ route('plan.destroy', $plan->id) }}" />
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
                            {{ $plans->appends(['search_status'=>$search_status,'search_key'=>$search_key])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(".status_update").change(function(){

            var id = $(this).val();
            $.get("{{ route('plan.show', '') }}/"+id, function(data)
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
                    title: 'Status update successfully !!',
                });

            });
        });

    </script>

@endsection
