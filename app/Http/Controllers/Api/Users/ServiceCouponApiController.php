<?php

namespace App\Http\Controllers\Api\Users;

use Illuminate\Http\Request;
use App\Models\ServiceCoupon;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\ServiceCouponResource;

class ServiceCouponApiController extends Controller
{
    public function checkCoupon(Request $request)
    {
        try {
            $now = date('Y-m-d');
            $data = ServiceCoupon::where('code', $request->coupon_code)
            ->where('start_at', '<=', $now)
            ->where('end_at', '>=', $now)
            ->where('status', 1)->first();
            if($data){

                return response([
                    'success'       => true,
                    'data'          => new ServiceCouponResource($data)
                ], 200);

            }
            return response([
                'success'       => false,
                'message'       => 'Invalid coupon.'
            ], 400);


        } catch (\Exception $e) {

            return response([
                'success'       => false,
                'message'       => 'Somthing went worng.'
            ], 400);

        }
    }
}
