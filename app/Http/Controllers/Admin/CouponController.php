<?php

namespace App\Http\Controllers\Admin;

use App\Models\Salon;
use App\Models\Coupon;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{

    public function index(){
        $coupons = Coupon::with('salon')->latest()->paginate(10);

        return view('admin.coupons.index', compact('coupons') ,['page_title' => 'Coupon List']);
    }

    public function create(){
        $salons = Salon::oldest('name')->get();

        return view('admin.coupons.create', compact('salons') ,['page_title' => 'Add Coupon']);
    }

    public function store(Request $request) {
        $request->validate([
            'salon_id'          =>  'required|exists:salons,id',
            'code'              =>  'required|unique:coupons,code|max:10',
            'title'             =>  'nullable|max:100',
            'image'             =>  'nullable|mimes:png,jpg,jpeg,webp',
            'amount_type'       =>  'required|in:amount,percent',
            'amount'            =>  [
                                        'required',
                                        'integer',
                                        'min:1',
                                        function ($attribute, $value, $fail) use ($request) {
                                            if ($request->amount_type == 'percent' && $value > 100) {
                                                $fail('The '.$attribute.' may not be greater than 100 when amount type is percent.');
                                            }
                                        },
                                    ],
            'description'       =>  'nullable|max:500',
            'coupon_type'       =>  'required|in:service,total_order_value',
            'service_ids'       =>  'nullable|required_if:coupon_type,service|array',
            'service_ids.*'     =>  [
                Rule::exists('services', 'id')->where(function ($query) use ($request){
                    $query->where('salon_id', $request->salon_id);
                }),
            ],
            'total_order_amount'=>  'nullable|required_if:coupon_type,total_order_value|integer|min:1',
            'start_date'        =>  'required|date_format:Y-m-d',
            'end_date'          =>  'required|date_format:Y-m-d|after_or_equal:start_date',
            'number_of_usages'  =>  'required|integer|min:1',
        ]);

        $coupon = new Coupon;
        $coupon->salon_id = $request->salon_id;
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
        $coupon->service_ids = json_encode(array_map('intval',$request->service_ids));
        $coupon->total_order_amount = $request->total_order_amount;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->number_of_usages = $request->number_of_usages;
        if($request->status){
            $coupon->is_active = '1';
        }else{
            $coupon->is_active = '0';
        }
        $coupon->save();

        return redirect()->route('coupon.index')->with('success','Coupon added successfully');
    }

    public function edit($id){
        $salons = Salon::oldest('name')->get();
        $coupon = Coupon::where('id',$id)->first();

        return view('admin.coupons.edit', compact('salons','coupon') ,['page_title' => 'Edit Coupon']);
    }

    public function update(Request $request, $id) {
        $coupon = Coupon::where('id', $id)->first();

        $request->validate([
            'salon_id'          =>  'required|exists:salons,id',
            'code'              =>  'required|max:10|unique:coupons,code,'.$coupon->id,
            'title'             =>  'nullable|max:100',
            'image'             =>  'nullable|mimes:png,jpg,jpeg,webp',
            'amount_type'       =>  'required|in:amount,percent',
            'amount'            =>  [
                                        'required',
                                        'integer',
                                        'min:1',
                                        function ($attribute, $value, $fail) use ($request) {
                                            if ($request->amount_type == 'percent' && $value > 100) {
                                                $fail('The '.$attribute.' may not be greater than 100 when amount type is percent.');
                                            }
                                        },
                                    ],
            'description'       =>  'nullable|max:500',
            'coupon_type'       =>  'required|in:service,total_order_value',
            'service_ids'       =>  'nullable|required_if:coupon_type,service|array',
            'service_ids.*'     =>  [
                Rule::exists('services', 'id')->where(function ($query) use ($request){
                    $query->where('salon_id', $request->salon_id);
                }),
            ],
            'total_order_amount'=>  'nullable|required_if:coupon_type,total_order_value|integer|min:1',
            'start_date'        =>  'required|date_format:Y-m-d',
            'end_date'          =>  'required|date_format:Y-m-d|after_or_equal:start_date',
            'number_of_usages'  =>  'required|integer|min:1',
        ]);

        $coupon->salon_id = $request->salon_id;
        $coupon->code = $request->code;
        $coupon->title = $request->title;
        if($request->hasFile('image')){
            $coupon->image = imageUpload($request->file('image'), true);
        }
        $coupon->amount_type = $request->amount_type;
        $coupon->amount = $request->amount;
        $coupon->description = $request->description;
        $coupon->coupon_type = $request->coupon_type;
        $coupon->service_ids = json_encode(array_map('intval',$request->service_ids));
        $coupon->total_order_amount = $request->total_order_amount;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->number_of_usages = $request->number_of_usages;
        if($request->status){
            $coupon->is_active = '1';
        }else{
            $coupon->is_active = '0';
        }
        $coupon->save();

        return redirect()->route('coupon.index')->with('success','Coupon added successfully');
    }

    public function destroy($id){
        Coupon::where('id',$id)->delete();

        return redirect()->route('coupon.index')->with('error','Coupon deleted successfully');
    }

    public function getSalonService(Request $request) {
        return Service::where('salon_id', $request->salon_id)->get();
    }

}
