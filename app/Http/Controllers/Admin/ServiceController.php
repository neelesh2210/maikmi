<?php

namespace App\Http\Controllers\Admin;

use App\Models\Salon;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Service::orderBy('id', 'desc')->with('getSalon')->paginate(10);
        return view('admin.service.index', compact('list'), ['page_title' => 'Service List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salonList = Salon::orderBy('id', 'desc')->get();
        $serviceCategoryList = ServiceCategory::orderBy('id', 'desc')->get();
        $services = Service::orderBy('id', 'desc')->get();
        return view('admin.service.create', compact('salonList', 'serviceCategoryList', 'services'), ['page_title' => 'Service Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'salon_id'              => 'required',
            'name'                  => 'required',
            'category_ids'          => 'required',
            'price'                 => 'required',
            'discount_price'        => 'required',
            'duration'              => 'required',
            'image'                 => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $data = new Service;
        $data->salon_id = $request->salon_id;
        $data->user_id = Salon::find($request->salon_id)->user_id;
        $data->service_category_ids = $request->category_ids;
        $data->service_subcategory_ids = ServiceSubCategory::whereIn('service_category_id', $request->category_ids)->pluck('id')->toArray();
        $data->name = $request->name;
        $data->price = $request->price;
        $data->discount_price = $request->discount_price;
        $data->duration = $request->duration;
        $data->image = imageUpload($request->file('image'), true);
        $data->description = $request->description;
        $data->addon_services = $request->addon_services;
        $data->featured = $request->featured ? 1 : 0;
        $data->enable_booking = $request->enable_booking ? 1 : 0;
        $data->enable_at_salon = $request->enable_at_salon ? 1 : 0;
        $data->enable_at_customer_address = $request->enable_at_customer_address ? 1 : 0;
        $data->available = $request->available ? 1 : 0;
        $data->save();

        return redirect()->route('services.index')->with('success', 'Service added successfully !!');
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
        $data = Service::find($id);
        $salonList = Salon::orderBy('id', 'desc')->get();
        $serviceCategoryList = ServiceCategory::orderBy('id', 'desc')->get();
        $services = Service::where('id', '!=', $id)->orderBy('id', 'desc')->get();
        return view('admin.service.edit', compact('salonList', 'serviceCategoryList', 'data', 'services'), ['page_title' => 'Service Edit']);
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
        $this->validate($request, [
            'salon_id'              => 'required',
            'name'                  => 'required',
            'category_ids'          => 'required',
            'price'                 => 'required',
            'discount_price'        => 'required',
            'duration'              => 'required',
            'image'                 => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $data = Service::find($id);
        $data->salon_id = $request->salon_id;
        $data->user_id = Salon::find($request->salon_id)->user_id;
        $data->service_category_ids = $request->category_ids;
        $data->service_subcategory_ids = ServiceSubCategory::whereIn('service_category_id', $request->category_ids)->pluck('id')->toArray();
        $data->name = $request->name;
        $data->price = $request->price;
        $data->discount_price = $request->discount_price;
        $data->duration = $request->duration;
        if($request->file('image')){
            $data->image = imageUpload($request->file('image'), true);
        }
        $data->description = $request->description;
        $data->addon_services = $request->addon_services;
        $data->featured = $request->featured ? 1 : 0;
        $data->enable_booking = $request->enable_booking ? 1 : 0;
        $data->enable_at_salon = $request->enable_at_salon ? 1 : 0;
        $data->enable_at_customer_address = $request->enable_at_customer_address ? 1 : 0;
        $data->available = $request->available ? 1 : 0;
        $data->is_ban = $request->is_ban ? 1 : 0;
        $data->save();

        return redirect()->route('services.index')->with('success', 'Service updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::destroy($id);
        return redirect()->route('services.index')->with('success', 'Service deleted successfully !!');
    }
}
