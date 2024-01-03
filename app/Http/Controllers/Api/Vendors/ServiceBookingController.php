<?php

namespace App\Http\Controllers\Api\Vendors;

use Illuminate\Http\Request;
use App\Models\ServiceBooking;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\ServiceBookingResource;

class ServiceBookingController extends Controller
{

    public function serviceBookingList(){
        return response([
            'success'       => true,
            'data'          => ServiceBookingResource::collection(ServiceBooking::where('user_id', auth()->id())->orderBy('id', 'desc')->get()),
        ], 200);
    }

}
