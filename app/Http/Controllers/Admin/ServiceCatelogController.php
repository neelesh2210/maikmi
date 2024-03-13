<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use App\Models\Admin\ServiceCatelog;

class ServiceCatelogController extends Controller
{

    public function index(){
        $service_catelogs = ServiceCatelog::latest()->paginate(10);
        $serviceCategoryList = ServiceCategory::orderBy('id', 'desc')->get();

        return view('admin.service_catelog.index',compact('service_catelogs','serviceCategoryList'),['page_title'=>'Service Catelog']);
    }

    public function store(Request $request){
        $this->validate($request,[
            'category_id'=>'required|numeric',
            'name'=>'required',
            'image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description'=>'required'
        ]);

        $service_catelog = new ServiceCatelog;
        $service_catelog->category_id = $request->category_id;
        $service_catelog->name = $request->name;
        if($request->file('image')){
            $service_catelog->image = imageUpload($request->file('image'), 'service_catelogs' , false);
        }
        $service_catelog->description = $request->description;
        $service_catelog->save();

        return redirect()->route('service-catelog.index')->with('success','Service Added to Catelog Successfully!');
    }

    public function edit($id){
        $service_catelogs = ServiceCatelog::latest()->paginate(10);
        $serviceCategoryList = ServiceCategory::orderBy('id', 'desc')->get();
        $edit_data = ServiceCatelog::find($id);

        return view('admin.service_catelog.index',compact('service_catelogs','serviceCategoryList','edit_data'),['page_title'=>'Service Catelog']);
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'category_id'=>'required|numeric',
            'name'=>'required',
            'image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description'=>'required'
        ]);

        $service_catelog = ServiceCatelog::find($id);
        $service_catelog->category_id = $request->category_id;
        $service_catelog->name = $request->name;
        if($request->file('image')){
            $service_catelog->image = imageUpload($request->file('image'), 'service_catelogs' , false);
        }
        $service_catelog->description = $request->description;
        $service_catelog->save();

        return redirect()->route('service-catelog.index')->with('success','Service Update to Catelog Successfully!');
    }

    public function destroy($id){
        ServiceCatelog::destroy($id);

        return redirect()->route('service-catelog.index')->with('error','Service Deleted to Catelog!');
    }

}
