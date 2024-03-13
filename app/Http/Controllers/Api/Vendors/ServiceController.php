<?php

namespace App\Http\Controllers\Api\Vendors;

use Auth;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Models\Admin\ImageUpload;
use App\Http\Controllers\Controller;
use App\Models\Admin\ServiceCatelog;
use App\Http\Resources\Api\ServiceResource;

class ServiceController extends Controller
{

    public function index(){
        $services = ServiceResource::collection(Service::where('user_id',Auth::user()->id)->get());

        return response()->json(['services'=>$services,'message'=>'Service List Retrive Successfully!','status'=>200],200);
    }

    public function store(Request $request){
        $service_categories = ServiceCategory::where('status',1)->pluck('id')->toArray();
        $image_uploads = ImageUpload::pluck('id')->toArray();

        $this->validate($request,[
            'name'              =>              'required',
            'category_ids.*'    =>              'required|distinct',
            'category_ids'      =>              'required|array|in:'.implode(',',$service_categories),
            'image'             =>              'nullable|in:'.implode(',',$image_uploads),
            'price'             =>              'required|numeric|gt:0',
            'discounted_price'  =>              'required|numeric|gt:0',
            'duration'          =>              'required|numeric|gt:0',
            'gender'            =>              'required|in:male,female'
        ]);

        if(optional(Auth::user()->getSalon)->id){
            $service = new Service;
            $service->user_id = Auth::user()->id;
            $service->salon_id = Auth::user()->getSalon->id;
            $service->service_category_ids = $request->category_ids;
            $service->name = $request->name;
            $service->price = $request->price;
            $service->discount_price = $request->discounted_price;
            $service->duration = $request->duration;
            $service->image = $request->image;
            $service->description = $request->description;
            $service->available = 1;
            $service->gender = $request->gender;
            $service->save();

            return response()->json(['message'=>'Service Added Successfully!','status'=>200],200);
        }else{
            return response()->json(['error'=>'User Have No Salon!','status'=>422],422);
        }
    }

    public function update(Request $request,$id){
        $service_categories = ServiceCategory::where('status',1)->pluck('id')->toArray();
        $image_uploads = ImageUpload::pluck('id')->toArray();

        $this->validate($request,[
            'name'              =>              'required',
            'category_ids.*'    =>              'required|distinct',
            'category_ids'      =>              'required|array|in:'.implode(',',$service_categories),
            'image'             =>              'nullable|in:'.implode(',',$image_uploads),
            'price'             =>              'required|numeric|gt:0',
            'discounted_price'  =>              'required|numeric|gt:0',
            'duration'          =>              'required|numeric|gt:0',
            'gender'            =>              'required|in:male,female'
        ]);

        if(optional(Auth::user()->getSalon)->id){
            $service = Service::where('user_id',Auth::user()->id)->where('id',$id)->first();
            if($service){
                $service->service_category_ids = $request->category_ids;
                $service->name = $request->name;
                $service->price = $request->price;
                $service->discount_price = $request->discounted_price;
                $service->duration = $request->duration;
                if($request->image){
                    $service->image = $request->image;
                }
                $service->description = $request->description;
                $service->gender = $request->gender;
                $service->save();

                return response()->json(['message'=>'Service Updated Successfully!','status'=>200],200);
            }else{
                return response()->json(['error'=>'Invalid Serivce!','status'=>422],422);
            }
        }else{
            return response()->json(['error'=>'User Have No Salon!','status'=>422],422);
        }
    }

    public function serviceCatelog($category_id){
        $catelogs = ServiceCatelog::where('category_id',$category_id)->get(['name','image','description']);
        foreach ($catelogs as $catelog) {
            $catelog->image_url = $catelog->image?imageUrl($catelog->image):asset('admin_css/no-pictures.png');
        }
        return response()->json(['catelogs'=>$catelogs,'status'=>200],200);
    }

}
