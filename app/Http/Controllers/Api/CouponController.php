<?php

namespace App\Http\Controllers\Api;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Vendors\CouponResource;

class CouponController extends Controller
{

    public function index($salon_id) {
        $coupons = CouponResource::collection(Coupon::where('salon_id', $salon_id)->latest()->get());

        return response()->json(['coupons' => $coupons, 'status' => 200], 200);

    }

}
