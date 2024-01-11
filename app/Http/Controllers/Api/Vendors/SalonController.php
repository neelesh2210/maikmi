<?php

namespace App\Http\Controllers\Api\Vendors;

use Auth;
use App\Models\Salon;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SalonResource;
use App\Http\Resources\Api\SalonDetailResource;

class SalonController extends Controller
{

    public function show($id){
        $salon = Salon::whereHas('getOwner',function($query){
                    $query->where('is_active','active');
                })->where('available','1')->where('id',$id)->first();

        if($salon){
            return response()->json(['salon'=>new SalonDetailResource($salon),'message'=>'Salon Detail Retrived Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'Salon Not Found!','status'=>422],422);
        }
    }

    public function update(Request $request){
        if($request->has('image')){
            $this->validate($request,[
                'image'=>'required|mimes:png,jpg,jpeg,webp,svg'
            ]);
            $salon = Salon::where('user_id',Auth::user()->id)->first();
            if($salon){
                $salon->image = imageUpload($request->file('image'), true);
                $salon->save();

                return response()->json(['message'=>'Salon Image Updated Successfully!','status'=>200],200);
            }else{
                return response()->json(['message'=>'Invalid User!','status'=>422],422);
            }
        }else{
            $this->validate($request,[
                'name'=>'required',
                'phone'=>'required|digits:10',
                'city'=>'required',
                'address'=>'required',
                'latitude'=>'required',
                'longitude'=>'required',
            ]);
            $salon = Salon::where('user_id',Auth::user()->id)->first();
            if($salon){
                $salon->name = $request->name;
                $salon->phone_number = $request->phone;
                $salon->city = $request->city;
                $salon->address = $request->address;
                $salon->latitude = $request->latitude;
                $salon->longitude = $request->latitude;
                $salon->save();

                return response()->json(['message'=>'Salon Updated Successfully!','status'=>200],200);
            }else{
                return response()->json(['message'=>'Invalid User!','status'=>422],422);
            }
        }

    }

    public function salonList($service_name){
        $salon_ids = Service::where('is_ban',0)->where('available',1)->where('available',1)->where('name','LIKE','%'.$service_name.'%')->groupBy('salon_id')->pluck('salon_id');

        $salons = SalonResource::collection(Salon::whereIn('id',$salon_ids)->whereHas('getOwner',function($query){
            $query->where('is_active','active');
        })->where('available','1')->take(10)->get());

        return response()->json(['salons'=>$salons,'message'=>'Salon Retrived Successfully!','status'=>200],200);
    }

}
