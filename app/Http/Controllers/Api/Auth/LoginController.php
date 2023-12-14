<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Craftsys\Msg91\Facade\Msg91;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function verifyLoginPhone(Request $request){
        if($request->type == 'vendor'){
            $this->validate($request,[
                'phone'=>["required","digits:10",Rule::exists('users','phone')->where('type','vendor')],
            ]);
        }elseif($request->type == 'user'){
            $this->validate($request,[
                'phone'=>["required","digits:10",Rule::exists('users','phone')->where('type','user')],
            ]);
        }else{
            return response()->json(['message'=>'Invalid Type!','status'=>422],422);
        }

        if(env('APP_ENV') == 'production'){
            $otp = rand(1111,9999);
            Msg91::sms()->to('91'.$request->phone)->flow('64a6b9d1d6fc057c15503ab2')->variable('business_name', env('APP_NAME'))->variable('otp', $otp)->send();
        }else{
            $otp = 1234;
            Msg91::sms()->to('91'.$request->phone)->flow('64a6b9d1d6fc057c15503ab2')->variable('business_name', env('APP_NAME'))->variable('otp', $otp)->send();
        }

        $otps = new Otp;
        $otps->phone = $request->phone;
        $otps->otp = $otp;
        $otps->from = 'phone';
        $otps->type = 'login';
        $otps->save();

        return response()->json(['message'=>'OTP Sent Successfully!','status'=>200],200);
    }

    public function loginWithOtp(Request $request){
        if($request->type == 'vendor'){
            $this->validate($request,[
                'phone'=>["required","digits:10",Rule::exists('users','phone')->where('type','vendor')],
            ]);
        }elseif($request->type == 'user'){
            $this->validate($request,[
                'phone'=>["required","digits:10",Rule::exists('users','phone')->where('type','user')],
            ]);
        }else{
            return response()->json(['message'=>'Invalid Type!','status'=>422],422);
        }

        $otp = Otp::where('type','login')->where('from','phone')->where('phone',$request->phone)->orderBy('id','desc')->first();
        if($otp->otp == $request->otp){
            $user = User::where('type',$request->type)->where('phone',$request->phone)->first();

            return response()->json(['token'=>$user->createToken('auth_token')->plainTextToken,'message'=>'User Login Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'Invalid OTP!','status'=>422],422);
        }
    }

    public function loginWithEmail(Request $request){
        if($request->type == 'vendor'){
            $this->validate($request,[
                'email'=>["required","email",Rule::exists('users','email')->where('type','vendor')],
            ]);
        }elseif($request->type == 'user'){
            $this->validate($request,[
                'email'=>["required","email",Rule::exists('users','email')->where('type','user')],
            ]);
        }else{
            return response()->json(['message'=>'Invalid Type!','status'=>422],422);
        }

        $user = User::where('type',$request->type)->where('email',$request->email)->first();
        if($user->email_verified_at){
            if(Hash::check($request->password,$user->password)){
                return response()->json(['token'=>$user->createToken('auth_token')->plainTextToken,'message'=>'User Login Successfully!','status'=>200],200);
            }else{
                return response()->json(['message'=>'Invalid Credential!','status'=>422],422);
            }
        }else{
            return response()->json(['message'=>'Your Email is Not Verified!','status'=>422],422);
        }

    }

}
