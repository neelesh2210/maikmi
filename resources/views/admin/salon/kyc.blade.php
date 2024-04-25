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
                    @if($salon->kyc_document)
                        @foreach (json_decode($salon->kyc_document) as $key=>$kyc_document)
                            <h4>{{ucwords(str_replace('_',' ',$key))}}</h4>
                            <img src="{{imageUrl($kyc_document)}}" alt="image" onerror="this.onerror=null; this.src='{{ asset('admin_css/no-pictures.png') }}'" height="100px" width="100px">
                        @endforeach
                    @endif
                    <form action="{{route('salon.kycStatusUpdate',$salon->id)}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="kyc_status" class="form-label">KYC Status</label>
                                <select name="kyc_status" class="form-control">
                                    <option value="1" @if($salon->kyc_status == '1') selected @endif>Verified</option>
                                    <option value="0" @if($salon->kyc_status == '0') selected @endif>Not Verified</option>
                                </select>
                                @error('kyc_status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <x-save-btn text="Update" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
