<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = ServiceCategory::orderBy('id', 'desc')->paginate(10);
        return view('admin.service_category.index', compact('list'), ['page_title' => 'Service Category']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'          => 'required|unique:service_categories,name',
            'description'   => 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $data = new ServiceCategory;
        $data->name = $request->name;
        $data->color = $request->color;
        $data->description = $request->description;
        $data->image = imageUpload($request->file('image'), 'service_category' , false);
        $data->save();

        return redirect()->route('service-category.index')->with('success', 'Service category added successfully !!');
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
        $list = ServiceCategory::orderBy('id', 'desc')->paginate(10);
        $edit_data = ServiceCategory::find($id);
        return view('admin.service_category.index', compact('list', 'edit_data'), ['page_title' => 'Service Category']);
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
            'name'          => 'required|unique:service_categories,name,'.$id,
            'description'   => 'required',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $data = ServiceCategory::find($id);
        $data->name = $request->name;
        $data->color = $request->color;
        $data->description = $request->description;
        if($request->file('image')){
            $data->image = imageUpload($request->file('image'), 'service_category' , false);
        }
        $data->save();

        return redirect()->route('service-category.index')->with('success', 'Service category updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ServiceCategory::destroy($id);
        return redirect()->route('service-category.index')->with('success', 'Service category deleted successfully !!');
    }

    public function featureUpdate($id)
    {
        $data = ServiceCategory::find($id);
        if($data->featured == 1){
            $data->featured = 0;
        }elseif($data->featured == 0){
            $data->featured = 1;
        }
        $data->save();

        return $data->featured;
    }

    public function statusUpdate($id)
    {
        $data = ServiceCategory::find($id);
        if($data->status == 1){
            $data->status = 0;
        }elseif($data->status == 0){
            $data->status = 1;
        }
        $data->save();

        return $data->status;
    }
}
