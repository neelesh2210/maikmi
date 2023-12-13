<?php

namespace App\Http\Controllers\Vendors;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCoupon;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class ProductCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = ProductCoupon::whereJsonContains('salons_ids', ''.auth()->user()->getSalon->id)->orderBy('id', 'desc')->paginate(10);
        return view('vendors.product_coupon.index', compact('list'), ['page_title' => 'Product Coupon List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productsList = Product::where('user_id', auth()->id())->get();
        $categoryList = ProductCategory::get();
        return view('vendors.product_coupon.create', compact('productsList', 'categoryList'), ['page_title' => 'Create Product Coupon']);
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
            'code'              => 'required|unique:product_coupons,code',
            'discount_type'     => 'required',
            'discount'          => 'required',
            'description'       => 'required',
            'products_ids'      => 'required',
            'categories_ids'    => 'required',
            'dates'             => 'required',
        ]);

        $data = new ProductCoupon;
        $data->code = $request->code;
        $data->discount_type = $request->discount_type;
        $data->discount = $request->discount;
        $data->products_ids = $request->products_ids;
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

        return redirect()->route('vendors.product-coupon.index')->with('success', 'Coupon added successfully !!');
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
        $data = ProductCoupon::find($id);
        $productsList = Product::where('user_id', auth()->id())->get();
        $categoryList = ProductCategory::get();
        return view('vendors.product_coupon.edit', compact('data', 'productsList', 'categoryList'), ['page_title' => 'Update Product Coupon']);
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
            'products_ids'      => 'required',
            'categories_ids'    => 'required',
            'dates'             => 'required',
        ]);

        $data = ProductCoupon::find($id);
        $data->code = $data->code;
        $data->discount_type = $request->discount_type;
        $data->discount = $request->discount;
        $data->products_ids = $request->products_ids;
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

        return redirect()->route('vendors.product-coupon.index')->with('success', 'Coupon upated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductCoupon::destroy($id);
        return redirect()->route('vendors.product-coupon.index')->with('success', 'Coupon deleted successfully !!');
    }

    public function statusUpdate($id)
    {
        $data = ProductCoupon::find($id);
        if($data->status == 1){
            $data->status = 0;
        }elseif($data->status == 0){
            $data->status = 1;
        }
        $data->save();

        return $data->status;
    }
}
