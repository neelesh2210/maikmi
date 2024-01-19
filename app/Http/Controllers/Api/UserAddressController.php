<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserAddressResource;

class UserAddressController extends Controller
{

    public function index(){
        $addresses = UserAddressResource::collection(UserAddress::where('user_id',Auth::user()->id)->latest()->get());

        return response()->json(['addresses'=>$addresses,'message'=>'Address List Retrive Succesfully!','status'=>200],200);
    }

    public function store(Request $request){
        $this->validate($request,[
            'country'=>'required',
            'state'=>'required',
            'city'=>'required',
            'pincode'=>'required',
            'first_address'=>'required',
            'name'=>'required',
            'phone'=>'required|digits:10',
            'type'=>'required|in:home,workplace,other',
            'is_default'=>'required|in:1,0',
        ]);

        if($request->is_default == '1'){
            UserAddress::where('user_id',Auth::user()->id)->update(['is_default'=>'0']);
        }

        $user_address = new UserAddress;
        $user_address->user_id = Auth::user()->id;
        $user_address->country = $request->country;
        $user_address->state = $request->state;
        $user_address->city = $request->city;
        $user_address->pincode = $request->pincode;
        $user_address->first_address = $request->first_address;
        $user_address->second_address = $request->second_address;
        $user_address->name = $request->name;
        $user_address->phone = $request->phone;
        $user_address->type = $request->type;
        $user_address->is_default = $request->is_default;
        $user_address->save();

        return response()->json(['message'=>'Address Added Successfully!','status'=>200],200);
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'country'=>'required',
            'state'=>'required',
            'city'=>'required',
            'pincode'=>'required',
            'first_address'=>'required',
            'name'=>'required',
            'phone'=>'required|digits:10',
            'type'=>'required|in:home,workplace,other',
            'is_default'=>'required|in:1,0',
        ]);

        if($request->is_default == '1'){
            UserAddress::where('user_id',Auth::user()->id)->update(['is_default'=>'0']);
        }

        $user_address = UserAddress::find($id);
        $user_address->country = $request->country;
        $user_address->state = $request->state;
        $user_address->city = $request->city;
        $user_address->pincode = $request->pincode;
        $user_address->first_address = $request->first_address;
        $user_address->second_address = $request->second_address;
        $user_address->name = $request->name;
        $user_address->phone = $request->phone;
        $user_address->type = $request->type;
        $user_address->is_default = $request->is_default;
        $user_address->save();

        return response()->json(['message'=>'Address Updated Successfully!','status'=>200],200);
    }

    public function destroy($id){
        UserAddress::where('id',$id)->delete();

        return response()->json(['message'=>'Address Deleted Successfully!','status'=>200],200);
    }

}
