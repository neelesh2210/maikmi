@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-6 text-end">
                            <x-cancle-btn text="Back" route="{{route('coupon.index')}}" />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('coupon.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="salon_id" class="form-label">Salon <span class="text-danger">*</span></label>
                                <select name="salon_id" id="salon_id" class="form-control js-example-basic-single" required onchange="changeDiv()">
                                    <option value="">Select Salon</option>
                                    @foreach ($salons as $salon)
                                        <option value="{{$salon->id}}" @if(old('salon_id') == $salon->id) selected @endif>{{$salon->name}}</option>
                                    @endforeach
                                </select>
                                @error('salon_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="code" class="form-label">Code <span class="text-danger">*</span></label>
                                <input id="code" class="form-control" type="text" name="code" value="{{old('code')}}" required placeholder="Enter Code">
                                @error('code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input id="title" class="form-control" type="text" name="title" value="{{old('title')}}" placeholder="Enter Title">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input id="image" class="form-control" type="file" name="image">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-8" style="padding-right: 0px">
                                        <input id="amount" class="form-control" type="number" name="amount" value="{{old('amount')}}" required placeholder="Enter Amount" required>
                                        @error('amount')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4" style="padding-left: 0px">
                                        <select name="amount_type" id="amount_type" class="form-control" required>
                                            <option value="amount" @if(old('amount_type') == 'amount') selected @endif>₹</option>
                                            <option value="percent" @if(old('amount_type') == 'percent') selected @endif>%</option>
                                        </select>
                                        @error('amount_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                                <input id="start_date" class="form-control" type="date" name="start_date" value="{{old('start_date')}}" required placeholder="Enter Start Date" required>
                                @error('start_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                                <input id="end_date" class="form-control" type="date" name="end_date" value="{{old('end_date')}}" required placeholder="Enter End Date" required>
                                @error('end_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="number_of_usages" class="form-label">Number of Usages <span class="text-danger">*</span></label>
                                <input id="number_of_usages" class="form-control" type="number" name="number_of_usages" value="{{old('number_of_usages')}}" required placeholder="Enter Number of Usages" required>
                                @error('number_of_usages')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="coupon_type" class="form-label">Coupon Type <span class="text-danger">*</span></label>
                                <select name="coupon_type" id="coupon_type" class="form-control" required onchange="changeDiv()">
                                    <option value="total_order_value" @if(old('coupon_type') == 'total_order_value') selected @endif>Total Order Value</option>
                                    <option value="service" @if(old('coupon_type') == 'service') selected @endif>Service</option>
                                </select>
                                @error('coupon_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3" id="total_order_amount_div">
                                <label for="total_order_amount" class="form-label">Total Order Amount</label>
                                <input id="total_order_amount" class="form-control" type="number" name="total_order_amount" value="{{old('total_order_amount')}}" required placeholder="Enter Total Order Amount">
                                @error('total_order_amount')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-9 mb-3 d-none" id="service_ids_div">
                                <label for="service_ids" class="form-label">Services</label>
                                <select name="service_ids[]" id="service_ids" class="form-control js-example-basic-multiple" multiple data-placeholder="Select Services" required>
                                    <option value="">Select Services</option>
                                </select>
                                @error('service_ids')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="easyMdeExample" class="form-label">Description</label>
                                <textarea name="description" rows="4" class="form-control" placeholder="Enter description">{{old('description')}}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="status" name="status" value="{{old('status')}}" @if(old('status') == 1) checked @endif>
                                    <label class="form-check-label" for="status">
                                        Status
                                    </label>
                                </div>
                            </div>
                        </div>
                        <x-save-btn text="Save" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        @if(old('coupon_type'))
            $(changeDiv());
        @endif

        function changeDiv(){
            var coupon_type = $('#coupon_type').val();

            if(coupon_type === 'total_order_value'){
                $('#total_order_amount_div').removeClass('d-none');
                $('#total_order_amount').attr('required',true);
                $('#service_ids_div').addClass('d-none');
                $('#service_ids').attr('required',false);
            }else if(coupon_type === 'service'){
                $.ajax({
                    url: "{{route('get.salon.service')}}",
                    type: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        salon_id: $('#salon_id').val()
                    },
                    success: function(response){

                        $('#total_order_amount_div').addClass('d-none');
                        $('#total_order_amount').attr('required',false);
                        $('#service_ids_div').removeClass('d-none');
                        $('#service_ids').attr('required',true);

                        var services = response;
                        var options = '';
                        var oldServiceIds = @json(old('service_ids', [])).map(Number);

                        services.forEach(service => {
                            let selected = '';
                            if (Array.isArray(oldServiceIds) && oldServiceIds.includes(service.id)) {
                                selected = 'selected';
                            }

                            options += '<option value="'+service.id+'" '+selected+'>'+service.name+'</option>';
                        });
                        $('#service_ids').html(options);
                        @if(!old('coupon_type'))
                            $(".js-example-basic-multiple").select2();
                        @endif
                    }
                });
            }else{
                $('#total_order_amount_div').addClass('d-none');
                $('#service_ids_div').addClass('d-none');
                $('#total_order_amount').attr('required',false);
                $('#service_ids').attr('required',false);
            }
        }

    </script>

@endsection
