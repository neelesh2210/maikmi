<?php

namespace App\Http\Controllers\Api\Auth;

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

class RegisterController extends Controller
{

    public function verifyRegistration(Request $request){
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
            if($request->referrer_code){
                if(strpos($request->referrer_code,'MKS') !== false){
                    $salon = Salon::where('salon_unique_id',$request->referrer_code)->first();
                    if(!$salon){
                        return response()->json(['message'=>'Referrer Code Not Found!','status'=>422],422);
                    }
                }else{
                    return response()->json(['message'=>'Referrer Code Not Found!','status'=>422],422);
                    // $user = User::where('user_unique_id',$request->referrer_code)->first();
                    // if(!$user){
                    //     return response()->json(['message'=>'Referrer Code Not Found!','status'=>422],422);
                    // }
                }
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
        }else{
            $this->validate($request,[
                'type'=>'required|in:vendor,user'
            ]);
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
        $otps->type = 'register';
        $otps->save();

        return response()->json(['message'=>'OTP Sent Successfully!','status'=>200],200);
    }

    public function register(Request $request){
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

            $otp = Otp::where('type','register')->where('from','phone')->where('phone',$request->phone)->orderBy('id','desc')->first();

            if($otp->otp == $request->otp){
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
                        // $user = User::where('user_unique_id',$request->referrer_code)->first();
                        // if(!$user){
                        //     return response()->json(['message'=>'Referrer Code Not Found!','status'=>422],422);
                        // }else{
                        //     $referrer_code_type = 'user';
                        // }
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

            $otp = Otp::where('type','register')->where('from','phone')->where('phone',$request->phone)->orderBy('id','desc')->first();

            if($otp->otp == $request->otp){
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

}
