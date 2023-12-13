<?php

namespace App\Http\Controllers\Vendors;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ServiceCoupon;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;

class ServiceCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = ServiceCoupon::whereJsonContains('salons_ids', ''.auth()->user()->getSalon->id)->orderBy('id', 'desc')->paginate(10);
        return view('vendors.service_coupon.index', compact('list'), ['page_title' => 'Service Coupon List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicesList = Service::where('user_id', auth()->id())->get();
        $categoryList = ServiceCategory::get();
        return view('vendors.service_coupon.create', compact('servicesList', 'categoryList'), ['page_title' => 'Create Service Coupon']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'code'              => 'required|unique:service_coupons,code',
            'discount_type'     => 'required',
            'discount'          => 'required',
            'description'       => 'required',
            'services_ids'      => 'required',
            'categories_ids'    => 'required',
            'expires_at'        => 'required',
        ]);
        $data = new ServiceCoupon;
        $data->code = $request->code;
        $data->discount_type = $request->discount_type;
        $data->discount = $request->discount;
        $data->services_ids = $request->services_ids;
        $data->salons_ids = [strval(auth()->user()->getSalon->id)];
        $data->categories_ids = $request->categories_ids;

        $explodeDate = explode(" to ",$request->dates);
        if(count($explodeDate) == 1){
            return redirect()->back()->with('error', 'Invalid coupon date selected.');
        }
        $start_at = $explodeDate[0];
        $end_at = $explodeDate[1];

        $data->start_at = $start_at;
        $data->end_at = $end_at;

        $data->description = $request->description;
        $data->save();

        return redirect()->route('vendors.service-coupon.index')->with('success', 'Coupon added successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ServiceCoupon::find($id);
        $servicesList = Service::where('user_id', auth()->id())->get();
        $categoryList = ServiceCategory::get();
        return view('vendors.service_coupon.edit', compact('data', 'servicesList', 'categoryList'), ['page_title' => 'Update Service Coupon']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'discount_type'     => 'required',
            'discount'          => 'required',
            'description'       => 'required',
            'services_ids'      => 'required',
            'categories_ids'    => 'required',
            'expires_at'        => 'required',
        ]);
        $data = ServiceCoupon::find($id);
        $data->code = $data->code;
        $data->discount_type = $request->discount_type;
        $data->discount = $request->discount;
        $data->services_ids = $request->services_ids;
        $data->salons_ids = $data->salons_ids;
        $data->categories_ids = $request->categories_ids;

        $explodeDate = explode(" to ",$request->dates);
        if(count($explodeDate) == 1){
            return redirect()->back()->with('error', 'Invalid coupon date selected.');
        }
        $start_at = $explodeDate[0];
        $end_at = $explodeDate[1];

        $data->start_at = $start_at;
        $data->end_at = $end_at;

        $data->description = $request->description;
        $data->save();

        return redirect()->route('vendors.service-coupon.index')->with('success', 'Coupon updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ServiceCoupon::destroy($id);
        return redirect()->route('vendors.service-coupon.index')->with('success', 'Coupon deleted successfully !!');
    }

    public function statusUpdate($id)
    {
        $data = ServiceCoupon::find($id);
        if($data->status == 1){
            $data->status = 0;
        }elseif($data->status == 0){
            $data->status = 1;
        }
        $data->save();

        return $data->status;
    }
}
