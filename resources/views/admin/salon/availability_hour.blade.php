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

                    <form action="{{ route('availability-hour.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="table-responsive mb-3">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>Days</th>
                                        <th>Start At</th>
                                        <th>End At</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Sunday
                                            <input type="hidden" name="days[]" value="sunday">
                                        </td>
                                        <td>
                                            <div class="input-group flatpickr" id="flatpickr-time">
                                                <input type="text" class="form-control form-control-sm" placeholder="Select time" name="start_at[]" data-input value="{{availabilityHour($data->id, 'sunday') ? availabilityHour($data->id, 'sunday')->start_at : ''}}">
                                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group flatpickr" id="flatpickr-time">
                                                <input type="text" class="form-control form-control-sm" placeholder="Select time" name="end_at[]" data-input value="{{availabilityHour($data->id, 'sunday') ? availabilityHour($data->id, 'sunday')->end_at : ''}}">
                                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" name="sunday_status" value="1" {{availabilityHour($data->id, 'sunday') && availabilityHour($data->id, 'sunday')->status == 0 ? '' : 'checked'}}>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Monday
                                            <input type="hidden" name="days[]" value="monday">
                                        </td>
                                        <td>
                                            <div class="input-group flatpickr" id="flatpickr-time">
                                                <input type="text" class="form-control form-control-sm" placeholder="Select time" name="start_at[]" data-input value="{{availabilityHour($data->id, 'monday') ? availabilityHour($data->id, 'monday')->start_at : ''}}">
                                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group flatpickr" id="flatpickr-time">
                                                <input type="text" class="form-control form-control-sm" placeholder="Select time" name="end_at[]" data-input value="{{availabilityHour($data->id, 'monday') ? availabilityHour($data->id, 'monday')->end_at : ''}}">
                                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" name="monday_status" value="1" {{availabilityHour($data->id, 'monday') && availabilityHour($data->id, 'monday')->status == 0 ? '' : 'checked'}}>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Tuesday
                                            <input type="hidden" name="days[]" value="tuesday">
                                        </td>
                                        <td>
                                            <div class="input-group flatpickr" id="flatpickr-time">
                                                <input type="text" class="form-control form-control-sm" placeholder="Select time" name="start_at[]" data-input value="{{availabilityHour($data->id, 'tuesday') ? availabilityHour($data->id, 'tuesday')->start_at : ''}}">
                                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group flatpickr" id="flatpickr-time">
                                                <input type="text" class="form-control form-control-sm" placeholder="Select time" name="end_at[]" data-input value="{{availabilityHour($data->id, 'tuesday') ? availabilityHour($data->id, 'tuesday')->end_at : ''}}">
                                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" name="tuesday_status" value="1" {{availabilityHour($data->id, 'tuesday') && availabilityHour($data->id, 'tuesday')->status == 0 ? '' : 'checked'}}>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Wednesday
                                            <input type="hidden" name="days[]" value="wednesday">
                                        </td>
                                        <td>
                                            <div class="input-group flatpickr" id="flatpickr-time">
                                                <input type="text" class="form-control form-control-sm" placeholder="Select time" name="start_at[]" data-input value="{{availabilityHour($data->id, 'wednesday') ? availabilityHour($data->id, 'wednesday')->start_at : ''}}">
                                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group flatpickr" id="flatpickr-time">
                                                <input type="text" class="form-control form-control-sm" placeholder="Select time" name="end_at[]" data-input value="{{availabilityHour($data->id, 'wednesday') ? availabilityHour($data->id, 'wednesday')->end_at : ''}}">
                                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" name="wednesday_status" value="1" {{availabilityHour($data->id, 'wednesday') && availabilityHour($data->id, 'wednesday')->status == 0 ? '' : 'checked'}}>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Thursday
                                            <input type="hidden" name="days[]" value="thursday">
                                        </td>
                                        <td>
                                            <div class="input-group flatpickr" id="flatpickr-time">
                                                <input type="text" class="form-control form-control-sm" placeholder="Select time" name="start_at[]" data-input value="{{availabilityHour($data->id, 'thursday') ? availabilityHour($data->id, 'thursday')->start_at : ''}}">
                                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group flatpickr" id="flatpickr-time">
                                                <input type="text" class="form-control form-control-sm" placeholder="Select time" name="end_at[]" data-input value="{{availabilityHour($data->id, 'thursday') ? availabilityHour($data->id, 'thursday')->end_at : ''}}">
                                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" name="thursday_status" value="1" {{availabilityHour($data->id, 'thursday') && availabilityHour($data->id, 'thursday')->status == 0 ? '' : 'checked'}}>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Friday
                                            <input type="hidden" name="days[]" value="friday">
                                        </td>
                                        <td>
                                            <div class="input-group flatpickr" id="flatpickr-time">
                                                <input type="text" class="form-control form-control-sm" placeholder="Select time" name="start_at[]" data-input value="{{availabilityHour($data->id, 'friday') ? availabilityHour($data->id, 'friday')->start_at : ''}}">
                                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group flatpickr" id="flatpickr-time">
                                                <input type="text" class="form-control form-control-sm" placeholder="Select time" name="end_at[]" data-input value="{{availabilityHour($data->id, 'friday') ? availabilityHour($data->id, 'friday')->end_at : ''}}">
                                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" name="friday_status" value="1" {{availabilityHour($data->id, 'friday') && availabilityHour($data->id, 'friday')->status == 0 ? '' : 'checked'}}>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Saturday
                                            <input type="hidden" name="days[]" value="saturday">
                                        </td>
                                        <td>
                                            <div class="input-group flatpickr" id="flatpickr-time">
                                                <input type="text" class="form-control form-control-sm" placeholder="Select time" name="start_at[]" data-input value="{{availabilityHour($data->id, 'saturday') ? availabilityHour($data->id, 'saturday')->start_at : ''}}">
                                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group flatpickr" id="flatpickr-time">
                                                <input type="text" class="form-control form-control-sm" placeholder="Select time" name="end_at[]" data-input value="{{availabilityHour($data->id, 'saturday') ? availabilityHour($data->id, 'saturday')->end_at : ''}}">
                                                <span class="input-group-text input-group-addon" data-toggle><i data-feather="clock"></i></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" name="saturday_status" value="1" {{availabilityHour($data->id, 'saturday') && availabilityHour($data->id, 'saturday')->status == 0 ? '' : 'checked'}}>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <x-save-btn text="Update" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
