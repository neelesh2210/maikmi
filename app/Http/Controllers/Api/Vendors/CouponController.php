<?php

namespace App\Http\Controllers\Api\Vendors;

use Auth;
use App\Models\Coupon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{

    public function index() {
        $coupons = Coupon::where('salon_id', Auth::user()->getSalon()->id)->latest()->get();

        return response()->json(['coupons' => $coupons, 'status' => 200], 200);
    }

    public function store(Request $request) {
        $this->validate([
            'code'              =>  'required|unique:coupons,code|max:10',
            'title'             =>  'nullable|max:100',
            'image'             =>  'nullable|mimes:png,jpg,jpeg,webp',
            'description'       =>  'nullable|max:500',
            'coupon_type'       =>  'required|in:service,total_order_value',
            'service_ids'       =>  'nullable|required_if:coupon_type,service|array',
            'service_ids.*'     =>  'exists:services,id',
            'total_order_amount'=>  'nullable|requried_if:coupon_type,total_order_value|integer|min:1',
            'start_date'        =>  'requried|date_format:Y-m-d',
            'end_date'          =>  'requried|date_format:Y-m-d|after_or_equal:start_date',
            'number_of_usages'  =>  'requried|integer|min:1',
            'is_active'         =>  'requried|in:1,0',
        ]);

        $coupon = new Coupon;
        $coupon->salon_id = Auth::user()->getSalon()->id;
        $coupon->slug = Str::slug($request->code);
        $coupon->code = $request->code;
        $coupon->title = $request->title;
        $coupon->image = $request->image;
        $coupon->description = $request->description;
        $coupon->coupon_type = $request->coupon_type;
        $coupon->service_ids = $request->service_ids;
        $coupon->total_order_amount = $request->total_order_amount;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->number_of_usages = $request->number_of_usages;
        $coupon->is_active = $request->is_active;
        $coupon->save();
    }

}
