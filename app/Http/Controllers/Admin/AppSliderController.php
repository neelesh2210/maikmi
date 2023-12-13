<?php

namespace App\Http\Controllers\Admin;

use App\Models\Salon;
use App\Models\Service;
use App\Models\AppSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppSliderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:slider-list', ['only' => ['index', 'store', 'edit']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = AppSlider::orderBy('id', 'desc')->orderBy('order', 'asc')->get();
        return view('admin.app_slider.index', compact('list'), ['page_title' => 'App Sliders']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salonList = Salon::orderBy('id', 'desc')->get();
        return view('admin.app_slider.create', compact('salonList'), ['page_title' => 'App Slider Create']);
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
            'image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = new AppSlider;
        $data->order = $request->order;
        $data->text = $request->text;
        $data->button = $request->button;
        $data->text_position = $request->text_position;
        $data->text_color = $request->text_color;
        $data->button_color = $request->button_color;
        $data->background_color = $request->background_color;
        $data->image_fit = $request->image_fit;
        $data->salon_id = $request->salon_id;
        $data->image = imageUpload($request->file('image'), false);
        $data->save();
        return redirect()->route('app_sliders.index')->with('success', 'App Slider Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = AppSlider::find($id);
        if($data->status == 1){
            $data->status = 0;
        }elseif($data->status == 0){
            $data->status = 1;
        }
        $data->save();
        return 1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salonList = Salon::orderBy('id', 'desc')->get();
        $data =  AppSlider::find($id);
        return view('admin.app_slider.edit', compact('salonList','data'), ['page_title' => 'App Slider Edit']);
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
            'image'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = AppSlider::find($id);
        $data->order = $request->order;
        $data->text = $request->text;
        $data->button = $request->button;
        $data->text_position = $request->text_position;
        $data->text_color = $request->text_color;
        $data->button_color = $request->button_color;
        $data->background_color = $request->background_color;
        $data->image_fit = $request->image_fit;
        $data->salon_id = $request->salon_id;
        if($request->file('image')){
            $data->image = imageUpload($request->file('image'), 'slider', false);
        }
        $data->save();
        return redirect()->route('app_sliders.index')->with('success', 'App Slider updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AppSlider::find($id)->delete();
        return redirect()->route('app_sliders.index')->with('error', 'App Slider Deleted Successfully');
    }
}
