<?php

namespace App\Http\Controllers\Api\Vendors;

use Auth;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Admin\ImageUpload;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductResource;

class ProductController extends Controller
{

    public function index(){
        $products = ProductResource::collection(Product::where('user_id',Auth::user()->id)->get());

        return response()->json(['products'=>$products,'message'=>'Product List Retrive Successfully!','status'=>200],200);
    }

    public function store(Request $request){
        $product_categories = ProductCategory::where('status',1)->pluck('id')->toArray();
        $image_uploads = ImageUpload::pluck('id')->toArray();

        $this->validate($request,[
            'name'                      =>              'required',
            'product_category_ids.*'    =>              'required|distinct',
            'product_category_ids'      =>              'required|array|in:'.implode(',',$product_categories),
            'image'                     =>              'nullable|in:'.implode(',',$image_uploads),
            'price'                     =>              'required|numeric|gt:0',
            'discounted_price'          =>              'required|numeric|gt:0'
        ]);

        if(optional(Auth::user()->getSalon)->id){
            $product = new Product;
            $product->user_id = Auth::user()->id;
            $product->salon_id = Auth::user()->getSalon->id;
            $product->product_category_ids = $request->product_category_ids;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->discount_price = $request->discounted_price;
            $product->image = $request->image;
            $product->description = $request->description;
            $product->save();

            return response()->json(['message'=>'Product Added Successfully!','status'=>200],200);
        }else{
            return response()->json(['error'=>'User Have No Salon!','status'=>422],422);
        }
    }

    public function update(Request $request,$id){
        $product_categories = ProductCategory::where('status',1)->pluck('id')->toArray();
        $image_uploads = ImageUpload::pluck('id')->toArray();

        $this->validate($request,[
            'name'                      =>              'required',
            'product_category_ids.*'    =>              'required|distinct',
            'product_category_ids'      =>              'required|array|in:'.implode(',',$product_categories),
            'image'                     =>              'nullable|in:'.implode(',',$image_uploads),
            'price'                     =>              'required|numeric|gt:0',
            'discounted_price'          =>              'required|numeric|gt:0'
        ]);

        if(optional(Auth::user()->getSalon)->id){
            $product = Product::find($id);
            if($product){
                $product->user_id = Auth::user()->id;
                $product->salon_id = Auth::user()->getSalon->id;
                $product->product_category_ids = $request->product_category_ids;
                $product->name = $request->name;
                $product->price = $request->price;
                $product->discount_price = $request->discounted_price;
                if($request->image){
                    $product->image = $request->image;
                }
                $product->description = $request->description;
                $product->save();

                return response()->json(['message'=>'Product Updated Successfully!','status'=>200],200);
            }else{
                return response()->json(['error'=>'Product not Found!','status'=>422],422);
            }
        }else{
            return response()->json(['error'=>'User Have No Salon!','status'=>422],422);
        }
    }

}
