<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Http\Controllers\Controller;

class ProductSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = ProductSubCategory::orderBy('id', 'desc')->paginate(10);
        $categoryList = ProductCategory::where('status', '1')->orderBy('id', 'desc')->get();
        return view('admin.product_subcategory.index', compact('list', 'categoryList'), ['page_title' => 'Product Sub Category']);
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
            'product_category_id'   => 'required',
            'name'                  => 'required|unique:product_sub_categories,name',
            'description'           => 'required',
            'image'                 => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $data = new ProductSubCategory;
        $data->product_category_id = $request->product_category_id;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->image = imageUpload($request->file('image'), 'product_sub_category', false);
        $data->save();

        return redirect()->route('product-subcategory.index')->with('success', 'Product subcategory added successfully !!');
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
        $categoryList = ProductCategory::where('status', '1')->orderBy('id', 'desc')->get();
        $list = ProductSubCategory::orderBy('id', 'desc')->paginate(10);
        $edit_data = ProductSubCategory::find($id);
        return view('admin.product_subcategory.index', compact('list', 'edit_data', 'categoryList'), ['page_title' => 'Product Sub Category']);
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
            'product_category_id'   => 'required',
            'name'                  => 'required|unique:product_sub_categories,name,'.$id,
            'description'           => 'required',
            'image'                 => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $data = ProductSubCategory::find($id);
        $data->product_category_id = $request->product_category_id;
        $data->name = $request->name;
        $data->description = $request->description;
        if($request->file('image')){
            $data->image = imageUpload($request->file('image'), 'product_sub_category', false);
        }
        $data->save();

        return redirect()->route('product-subcategory.index')->with('success', 'Product subcategory updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductSubCategory::destroy($id);
        return redirect()->route('product-subcategory.index')->with('success', 'Product subcategory deleted successfully !!');
    }

    public function featureUpdate($id)
    {
        $data = ProductSubCategory::find($id);
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
        $data = ProductSubCategory::find($id);
        if($data->status == 1){
            $data->status = 0;
        }elseif($data->status == 0){
            $data->status = 1;
        }
        $data->save();

        return $data->status;
    }
}
