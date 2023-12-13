<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = ProductCategory::orderBy('id', 'desc')->paginate(10);
        return view('admin.product_category.index', compact('list'), ['page_title' => 'Product Category']);
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
            'name'          => 'required|unique:product_categories,name',
            'description'   => 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $data = new ProductCategory;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->image = imageUpload($request->file('image'), 'product_category' , false);
        $data->save();

        return redirect()->route('product-category.index')->with('success', 'Product category added successfully !!');
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
        $list = ProductCategory::orderBy('id', 'desc')->paginate(10);
        $edit_data = ProductCategory::find($id);
        return view('admin.product_category.index', compact('list', 'edit_data'), ['page_title' => 'Product Category']);
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
            'name'          => 'required|unique:product_categories,name,'.$id,
            'description'   => 'required',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $data = ProductCategory::find($id);
        $data->name = $request->name;
        $data->description = $request->description;
        if($request->file('image')){
            $data->image = imageUpload($request->file('image'), 'product_category' ,false);
        }
        $data->save();

        return redirect()->route('product-category.index')->with('success', 'Product category updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductCategory::destroy($id);
        return redirect()->route('product-category.index')->with('success', 'Product category deleted successfully !!');
    }

    public function featureUpdate($id)
    {
        $data = ProductCategory::find($id);
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
        $data = ProductCategory::find($id);
        if($data->status == 1){
            $data->status = 0;
        }elseif($data->status == 0){
            $data->status = 1;
        }
        $data->save();

        return $data->status;
    }

}
