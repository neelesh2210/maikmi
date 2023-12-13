@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-6 text-end">
                            <x-cancle-btn text="Back" route="{{route('staffs.index')}}" />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::model($data, ['method' => 'PATCH','route' => ['staffs.update', $data->id]]) !!}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Name" class="form-label">Name</label>
                                <input id="Name" class="form-control" type="text" name="name" required placeholder="Enter Name" value="{{$data->name}}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" class="form-control" type="text" name="email" required placeholder="Enter Email" value="{{$data->email}}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" class="form-control" type="password" name="password" placeholder="Enter Password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <input id="confirm-password" class="form-control" type="password" name="confirm-password" placeholder="Enter Confirm Password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="roles" class="form-label">Roles</label>
                                <select name="roles" id="roles" class="form-control js-example-basic-single" required>
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role}}" @if(in_array($role, $userRole)) selected @endif>{{$role}}</option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <x-save-btn text="Update" />
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
