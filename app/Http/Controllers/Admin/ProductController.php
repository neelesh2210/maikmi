<?php

namespace App\Http\Controllers\Admin;

use App\Models\Salon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Product::orderBy('id', 'desc')->paginate(20);
        return view('admin.product.index', compact('list'), ['page_title' => 'Product List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategoryList = ProductCategory::orderBy('id', 'desc')->get();
        $salonList = Salon::orderBy('id', 'desc')->get();
        return view('admin.product.create', compact('productCategoryList', 'salonList'), ['page_title' => 'Product Create']);
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
            'name'          => 'required',
            'category_ids'  => 'required',
            'salon_id'      => 'required',
            'price'         => 'required',
            'discount_price'=> 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $data = new Product;
        $data->salon_id = $request->salon_id;
        $data->user_id = Salon::find($request->salon_id)->user_id;
        $data->product_category_ids = $request->category_ids;
        $data->product_subcategory_ids = ProductSubCategory::whereIn('product_category_id', $request->category_ids)->pluck('id')->toArray();
        $data->name = $request->name;
        $data->price = $request->price;
        $data->discount_price = $request->discount_price;
        $data->image = imageUpload($request->file('image'), true);
        $data->description = $request->description;
        $data->featured = $request->featured ? 1 : 0;
        $data->available = $request->available ? 1 : 0;
        $data->save();

        return redirect()->route('products.index')->with('success', 'Product added successfully !!');
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
        $data = Product::find($id);
        $productCategoryList = ProductCategory::orderBy('id', 'desc')->get();
        $salonList = Salon::orderBy('id', 'desc')->get();
        return view('admin.product.edit', compact('data', 'productCategoryList', 'salonList'), ['page_title' => 'Product Edit']);
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
            'name'          => 'required',
            'category_ids'  => 'required',
            'salon_id'      => 'required',
            'price'         => 'required',
            'discount_price'=> 'required',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $data = Product::find($id);
        $data->salon_id = $request->salon_id;
        $data->user_id = Salon::find($request->salon_id)->user_id;
        $data->product_category_ids = $request->category_ids;
        $data->product_subcategory_ids = ProductSubCategory::whereIn('product_category_id', $request->category_ids)->pluck('id')->toArray();
        $data->name = $request->name;
        $data->price = $request->price;
        $data->discount_price = $request->discount_price;
        if($request->file('image')){
            $data->image = imageUpload($request->file('image'), true);
        }
        $data->description = $request->description;
        $data->featured = $request->featured ? 1 : 0;
        $data->available = $request->available ? 1 : 0;
        $data->is_ban = $request->is_ban ? 1 : 0;
        $data->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully !!');
    }
}
