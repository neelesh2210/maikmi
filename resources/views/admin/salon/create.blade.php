@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-6 text-end">
                            <x-cancle-btn text="Back" route="{{route('salon.index')}}" />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('salon.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <h4 class="card-title">Salon Detail</h4>
                            <hr>
                            <div class="col-md-4 mb-3">
                                <label for="Name" class="form-label">Name</label>
                                <input id="Name" class="form-control" type="text" name="name" required placeholder="Enter name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input id="phone_number" class="form-control" type="number" name="phone_number" required placeholder="Enter phone number">
                                @error('phone_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input id="image" class="form-control" type="file" name="image" required>
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input id="latitude" class="form-control" type="text" name="latitude" required placeholder="Enter latitude">
                                @error('latitude')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <a href="javascript:;" onclick="getLocation()"><small class="float-end">Get Latitude & Longitude</small></a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input id="longitude" class="form-control" type="text" name="longitude" required placeholder="Enter latitude">
                                @error('latitude')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" rows="1" class="form-control" required placeholder="Enter address"></textarea>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="availability_range" class="form-label">Availability Range (Km)</label>
                                <input id="availability_range" class="form-control" type="number" name="availability_range" required placeholder="Enter availability range">
                                @error('availability_range')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">City</label>
                                <input id="city" class="form-control" type="text" name="city" required placeholder="Enter city">
                                @error('city')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="easyMdeExample" class="form-label">Description</label>
                                <textarea name="description" id="easyMdeExample" rows="4" class="form-control" placeholder="Enter description"></textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <h4 class="card-title">Salon Owner</h4>
                            <hr>
                            <div class="col-md-6 mb-3">
                                <label for="owner_name" class="form-label">Owner Name</label>
                                <input id="owner_name" class="form-control" type="text" name="owner_name" required placeholder="Enter owner name">
                                @error('owner_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="owner_phone_number" class="form-label">Owner Phone Number</label>
                                <input id="owner_phone_number" class="form-control" type="number" name="phone" required placeholder="Enter owner phone number">
                                @error('owner_phone_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <x-save-btn text="Save" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var latInput=document.getElementById("latitude");
        var longInput=document.getElementById("longitude");
        var apikey = "AIzaSyBXxlZ72plyeDDHfBL6llFvF3D-E5Tk6J4";

        function getLocation(){
            if (navigator.geolocation){
                navigator.geolocation.getCurrentPosition(showPosition);
            }else{
                alert("Geolocation is not supported by this browser.");
            }
        }
        function showPosition(position){
            var lat = position.coords.latitude;
            var longi = position.coords.longitude;
            latInput.value = lat;
            longInput.value = longi;

            $.get({ url: `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${longi}&sensor=false&key=${apikey}`, success(data) {
                //console.log(data.results[1].formatted_address);
                //console.log(data.results[1].formatted_address);
                $('#address').val(data.results[1].formatted_address);
            }});
        }
    </script>
@endsection
