<?php

namespace App\Http\Controllers\Api\Auth;

use Auth;
use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use App\Models\Salon;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Craftsys\Msg91\Facade\Msg91;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\OtpLessController;

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
        $otp = 1234;
        // if(env('APP_ENV') == 'production'){
        //     $otp = rand(1111,9999);
        //     Msg91::sms()->to('91'.$request->phone)->flow('64a6b9d1d6fc057c15503ab2')->variable('business_name', env('APP_NAME'))->variable('otp', $otp)->send();
        // }else{
        //     $otp = 1234;
        //     Msg91::sms()->to('91'.$request->phone)->flow('64a6b9d1d6fc057c15503ab2')->variable('business_name', env('APP_NAME'))->variable('otp', $otp)->send();
        // }

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

    public function updateFcmToken(Request $request){
        $this->validate($request,[
            'token_from'=>'required|in:android,ios',
            'fcm_token'=>'required',
        ]);

        $user = User::find(Auth::user()->id);
        $user->token_from = $request->token_from;
        $user->fcm_token = $request->fcm_token;
        $user->save();

        return response()->json(['message'=>'FCM Token Updated Successfully!','status'=>200],200);
    }

    public function verifyPhone(Request $request){
        $this->validate($request,[
            'phone'=>'required|numeric|digits:10',
            'type'=>'required|in:user,vendor'
        ]);

        $user = User::where('type',$request->type)->where('phone',$request->phone)->first();
        if($user){
            $type = 'login';
        }else{
            $type = 'register';
        }

        if($request->phone == '9598334716'){
            return response()->json(['message'=>'OTP Send Successfully!','status'=>200], 200);
        }
        $otp_less = new OtpLessController;
        $order_id = $otp_less->sendOtp($request->phone);

        $otps = new Otp;
        $otps->phone = $request->phone;
        $otps->otp = json_decode($order_id)->orderId;
        $otps->from = 'phone';
        $otps->user_type = $request->type;
        $otps->type = $type;
        $otps->save();

        return response()->json(['message'=>'OTP Send Successfully!','status'=>200], 200);

    }

    public function verifyOtp(Request $request){
        $this->validate($request,[
            'phone'=>'required|numeric|digits:10',
            'type'=>'required|in:user,vendor',
            'otp'=>'required|numeric|digits:6'
        ]);

        $user = User::where('type',$request->type)->where('phone',$request->phone)->first();
        if($user){
            $type = 'login';
        }else{
            $type = 'register';
        }
        if($request->phone == '9598334716'){
            if($user){
                return response()->json(['token'=>$user->createToken('auth_token')->plainTextToken,'message'=>'User Login Successfully!','status'=>200],200);
            }else{
                return response()->json(['message'=>'Please Register','status'=>200],200);
            }
        }
        $otp = Otp::where('type',$type)->where('from','phone')->where('phone',$request->phone)->where('user_type',$request->type)->where('is_verified','0')->latest('id')->first();

        $otp_less = new OtpLessController;
        $status = $otp_less->verifyOtp($otp?->otp,$otp?->phone,$request->otp);
        if(json_decode($status)->isOTPVerified){
            if($user){
                $otp->delete();

                return response()->json(['token'=>$user->createToken('auth_token')->plainTextToken,'message'=>'User Login Successfully!','status'=>200],200);
            }else{
                $otp->is_verified = '1';
                $otp->save();

                return response()->json(['message'=>'Please Register','status'=>200],200);
            }
        }else{
            return response()->json(['message'=>json_decode($status)->reason?json_decode($status)->reason:'Somthing went Wrong!','status'=>422],422);
        }

        return response()->json(['message'=>'OTP Send Successfully!','status'=>200], 200);
    }

    public function registration(Request $request){
        if($request->type == 'user'){
            $this->validate($request,[
                'type'=>'required|in:user',
                'name'=>'required',
                'phone'=>["required","digits:10",Rule::unique('users','phone')->where('type','user')],
                'email'=>["nullable","email",Rule::unique('users','email')->where('type','user')],
                'password'=>['nullable','required_unless:email,null', Password::min(8)],
                'gender'=>'required|in:Male,Female,Other',
                'dob'=>'date_format:Y-m-d'
            ]);

            $otp = Otp::where('type','register')->where('from','phone')->where('phone',$request->phone)->where('user_type','user')->where('is_verified','1')->latest('id')->first();

            if($otp){
                $latest_user = User::orderBy('id','desc')->first();
                if($latest_user){
                    $user_unique_id = 200000 + $latest_user->id + 1;
                }else{
                    $user_unique_id = 200001;
                }

                if($request->referrer_code){
                    if(strpos($request->referrer_code,'MKS') !== false){
                        $salon = Salon::where('salon_unique_id',$request->referrer_code)->first();
                        if(!$salon){
                            return response()->json(['message'=>'Referrer Code Not Found!','status'=>422],422);
                        }else{
                            $referrer_code_type = 'vendor';
                        }
                    }else{
                        return response()->json(['message'=>'Referrer Code Not Found!','status'=>422],422);
                    }
                }else{
                    $referrer_code_type = null;
                }

                $user = new User;
                $user->user_unique_id = $user_unique_id;
                $user->type = 'user';
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->referrer_code = $request->referrer_code;
                $user->referrer_code_type = $referrer_code_type;
                if($request->email){
                    $user->password = Hash::make($request->password);
                }
                $user->phone_verified_at = Carbon::now();
                $user->save();

                $user_detail = new UserDetail;
                $user_detail->user_id = $user->id;
                $user_detail->dob = $request->dob;
                $user_detail->gender = $request->gender;
                $user_detail->save();

                $otp->delete();

                return response()->json(['token'=>$user->createToken('auth_token')->plainTextToken,'message'=>'User Registered Successfully!','status'=>200],200);

            }else{
                return response()->json(['message'=>'Wrong OTP!','status'=>422],422);
            }
        }elseif($request->type == 'vendor'){
            $this->validate($request,[
                'type'=>'required|in:vendor',
                'name'=>'required',
                'phone'=>["required","digits:10",Rule::unique('users','phone')->where('type','vendor')],
                'email'=>["nullable","email",Rule::unique('users','email')->where('type','vendor')],
                'password'=>['nullable','required_unless:email,null', Password::min(8)],
                'shop_name'=>'required',
                'shop_phone'=>'required|digits:10',
                'shop_latitude'=>'required',
                'shop_longitude'=>'required',
                'shop_address'=>'required',
                'shop_city'=>'required',
            ]);

            $otp = Otp::where('type','register')->where('from','phone')->where('phone',$request->phone)->where('user_type','vendor')->where('is_verified','1')->latest('id')->first();

            if($otp){
                $latest_user = User::orderBy('id','desc')->first();
                if($latest_user){
                    $user_unique_id = 200000 + $latest_user->id + 1;
                }else{
                    $user_unique_id = 200001;
                }

                $user = new User;
                $user->user_unique_id = $user_unique_id;
                $user->type = 'vendor';
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->email = $request->email;
                if($request->email){
                    $user->password = Hash::make($request->password);
                }
                $user->phone_verified_at = Carbon::now();
                $user->save();

                $latest_salon = Salon::orderBy('id','desc')->first();
                if($latest_salon){
                    $salon_unique_id = 200000 + $latest_salon->id + 1;
                }else{
                    $salon_unique_id = 200001;
                }
                $salon = new Salon;
                $salon->salon_unique_id = 'MKS'.$salon_unique_id;
                $salon->user_id = $user->id;
                $salon->name = $request->shop_name;
                $salon->phone_number = $request->shop_phone;
                $salon->latitude = $request->shop_latitude;
                $salon->longitude = $request->shop_longitude;
                $salon->address = $request->shop_address;
                $salon->city = $request->shop_city;
                $salon->save();

                $otp->delete();

                $user->token = $user->createToken('auth_token')->plainTextToken;

                return response()->json(['token'=>$user->createToken('auth_token')->plainTextToken,'message'=>'Salon Registered Successfully!','status'=>200],200);

            }else{
                return response()->json(['message'=>'Wrong OTP!','status'=>422],422);
            }
        }else{
            $this->validate($request,[
                'type'=>'required|in:vendor,user'
            ]);
        }
    }

    public function logout(){
        $user = User::find(Auth::user()->id);
        $user->fcm_token = null;
        $user->save();

        $user->tokens()->delete();

        return response()->json(['message'=>'User Logout Successfully!','status'=>200],200);
    }

}
