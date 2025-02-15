<?php

namespace App\Http\Controllers\Api\Vendors;

use Auth;
use App\Models\Coupon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Vendors\CouponResource;

class CouponController extends Controller
{

    public function index() {
        $coupons = CouponResource::collection(Coupon::where('salon_id', Auth::user()->getSalon->id)->latest()->get());

        return response()->json(['coupons' => $coupons, 'status' => 200], 200);
    }

    public function store(Request $request) {
        $request->validate([
            'code'              =>  'required|unique:coupons,code|max:10',
            'title'             =>  'nullable|max:100',
            'image'             =>  'nullable|mimes:png,jpg,jpeg,webp',
            'amount_type'       =>  'required|in:amount,percent',
            'amount'            =>  'required|integer|min:1',
            'description'       =>  'nullable|max:500',
            'coupon_type'       =>  'required|in:service,total_order_value',
            // 'service_ids'       =>  'nullable|required_if:coupon_type,service|array',
            // 'service_ids.*'     =>  [
            //                             Rule::exists('services', 'id')->where(function ($query) {
            //                                 $query->where('salon_id', Auth::user()->getSalon->id);
            //                             }),
            //                         ],
            'total_order_amount'=>  'nullable|required_if:coupon_type,total_order_value|integer|min:1',
            'start_date'        =>  'required|date_format:Y-m-d',
            'end_date'          =>  'required|date_format:Y-m-d|after_or_equal:start_date',
            'number_of_usages'  =>  'required|integer|min:1',
            'is_active'         =>  'required|in:1,0',
        ]);

        $coupon = new Coupon;
        $coupon->salon_id = Auth::user()->getSalon->id;
        $coupon->slug = Str::slug($request->code);
        $coupon->code = $request->code;
        $coupon->title = $request->title;
        if($request->hasFile('image')){
            $coupon->image = imageUpload($request->file('image'), true);
        }
        $coupon->amount_type = $request->amount_type;
        $coupon->amount = $request->amount;
        $coupon->description = $request->description;
        $coupon->coupon_type = $request->coupon_type;
        $coupon->service_ids = $request->service_ids;
        $coupon->total_order_amount = $request->total_order_amount;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->number_of_usages = $request->number_of_usages;
        $coupon->is_active = $request->is_active;
        $coupon->save();

        return response()->json(['message'=>'Coupon Added Successfully!', 'status'=>200],200);
    }

    public function update(Request $request, $slug) {
        $coupon = Coupon::where('salon_id', Auth::user()->getSalon->id)->where('slug', $slug)->first();

        if(!$coupon){
            return response()->json(['message'=>'Coupon not found!', 'status'=>422],422);
        }

        $request->validate([
            'code'              =>  'required|max:10|unique:coupons,code,'.$coupon->id,
            'title'             =>  'nullable|max:100',
            'image'             =>  'nullable|mimes:png,jpg,jpeg,webp',
            'amount_type'       =>  'required|in:amount,percent',
            'amount'            =>  'required|integer|min:1',
            'description'       =>  'nullable|max:500',
            'coupon_type'       =>  'required|in:service,total_order_value',
            // 'service_ids'       =>  'nullable|required_if:coupon_type,service|array',
            // 'service_ids.*'     =>  [
            //                             Rule::exists('services', 'id')->where(function ($query) {
            //                                 $query->where('salon_id', Auth::user()->getSalon->id);
            //                             }),
            //                         ],
            'total_order_amount'=>  'nullable|required_if:coupon_type,total_order_value|integer|min:1',
            'start_date'        =>  'required|date_format:Y-m-d',
            'end_date'          =>  'required|date_format:Y-m-d|after_or_equal:start_date',
            'number_of_usages'  =>  'required|integer|min:1',
            'is_active'         =>  'required|in:1,0',
        ]);

        $coupon->code = $request->code;
        $coupon->title = $request->title;
        if($request->hasFile('image')){
            $coupon->image = imageUpload($request->file('image'), true);
        }
        $coupon->amount_type = $request->amount_type;
        $coupon->amount = $request->amount;
        $coupon->description = $request->description;
        $coupon->service_ids = $request->service_ids;
        $coupon->total_order_amount = $request->total_order_amount;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->number_of_usages = $request->number_of_usages;
        $coupon->is_active = $request->is_active;
        $coupon->save();

        return response()->json(['message'=>'Coupon Updated Successfully!', 'status'=>200],200);
    }

    public function destroy($slug) {
        $coupon = Coupon::where('salon_id', Auth::user()->getSalon->id)->where('slug', $slug)->first();

        if(!$coupon){
            return response()->json(['message'=>'Coupon not found!', 'status'=>422],422);
        }

        $coupon->delete();

        return response()->json(['message'=>'Coupon Deleted Successfully!', 'status'=>200],200);
    }

}
