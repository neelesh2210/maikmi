<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProfileResource;
use App\Http\Resources\Api\SalonProfileResource;

class ProfileController extends Controller
{
    public function getProfile(){
        $profile = new ProfileResource(auth()->user());
        $shop_detail = null;
        if(Auth::user()->type == 'vendor'){
            $shop_detail = new SalonProfileResource(auth()->user());
        }

        return response()->json([
            'profile' => $profile,
            'shop_detail' => $shop_detail,
            'message' => 'Profile Retrive Successfully!',
            'status' => 200,
        ], 200);

    }

    public function updateProfile(Request $request){
        $user = User::where('id',Auth::user()->id)->first();
        if($user->type == 'user'){
            $this->validate($request,[
                'name'=>'required',
                'phone'=>["required","digits:10",Rule::unique('users','phone')->where('type','user')->ignore(Auth::user()->id)],
                'email'=>["nullable","email",Rule::unique('users','email')->where('type','user')->ignore(Auth::user()->id)],
                'gender'=>'required|in:Male,Female,Other',
                'dob'=>'date_format:Y-m-d'
            ]);
        }elseif($user->type == 'vendor'){
            $this->validate($request,[
                'name'=>'required',
                'phone'=>["required","digits:10",Rule::unique('users','phone')->where('type','vendor')->ignore(Auth::user()->id)],
                'email'=>["nullable","email",Rule::unique('users','email')->where('type','vendor')->ignore(Auth::user()->id)],
                'gender'=>'required|in:Male,Female,Other',
                'dob'=>'date_format:Y-m-d'
            ]);
        }else{
            return response()->json(['message'=>'Invalid User!','status'=>422],422);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        $user_detail = UserDetail::where('user_id',Auth::user()->id)->first();
        if(!$user_detail){
            $user_detail = new UserDetail;
            $user_detail->user_id = Auth::user()->id;
        }
        $user_detail->dob = $request->dob;
        $user_detail->gender = $request->gender;
        $user_detail->save();

        return response()->json([
            'message'   => 'Profile updated successfully.',
            'status' => 200,
        ], 200);
    }

    public function updateAvatar(Request $request){
        $this->validate($request,[
            'image'=>'required|mimes:png,jpg,jpeg,webp,svg'
        ]);
        $user_detail = UserDetail::where('user_id',Auth::user()->id)->first();
        if(!$user_detail){
            $user_detail = new UserDetail;
            $user_detail->user_id = Auth::user()->id;
        }
        $user_detail->photo = imageUpload($request->file('image'), true);
        $user_detail->save();

        return response()->json(['message'=>'Photo Updated Successfully!','status'=>200],200);
    }
}
