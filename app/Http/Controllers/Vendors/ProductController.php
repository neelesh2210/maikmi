<?php

namespace App\Http\Controllers\Vendors;

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
    public function index()
    {
        $list = Product::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(20);
        return view('vendors.product.index', compact('list'), ['page_title' => 'Product List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategoryList = ProductCategory::orderBy('id', 'desc')->get();
        return view('vendors.product.create', compact('productCategoryList'), ['page_title' => 'Product Create']);
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
            'price'         => 'required',
            'discount_price'=> 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $data = new Product;
        $data->salon_id = auth()->user()->getSalon->id;
        $data->user_id = auth()->user()->id;
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

        return redirect()->route('vendors.products.index')->with('success', 'Product added successfully !!');
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
        return view('vendors.product.edit', compact('data', 'productCategoryList'), ['page_title' => 'Product Edit']);
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
            'price'         => 'required',
            'discount_price'=> 'required',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $data = Product::find($id);
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
        $data->save();

        return redirect()->route('vendors.products.index')->with('success', 'Product updated successfully !!');
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
        return redirect()->route('vendors.products.index')->with('success', 'Product deleted successfully !!');
    }
}
