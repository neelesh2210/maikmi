<?php

namespace App\Http\Controllers\Api\Users\Auth;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Users\Auth\LoginResource;

class AuthApiController extends Controller
{
    public function login(Request $request){

        $this->validate($request, [
            'phone'     => 'required|numeric',
        ]);

        $user = User::where('phone', $request->phone)->where('type', 'user')->first();
        if($user){

            if($user->is_active == 'active'){

                Auth::login($user);

                $otp = rand(1111, 9999);
                // if(config('app.env') == 'production' && $user->phone != "8920976591"){
                //     Msg91::sms()->to('91'.$user->phone)->flow('61fbb9f27ca7fa28af01f169')->variable('user', $user->name)->variable('business_name', config('app.name'))->variable('otp', $otp)->send();
                // }

                return response([
                    'success'   => true,
                    'token'     => $user->createToken('auth_token')->plainTextToken,
                    'message'   => 'You are successfully login.',
                    'otp'       => $otp,
                    'data'      => new LoginResource($user),
                ],200);

            }else{

                return response([
                    'success' => false,
                    'message' => 'Your account has been deactivated.',
                ],400);

            }

        }else{

            $otp = rand(1111, 9999);
            // if(config('app.env') == 'production' && $request->phone != "8920976591"){
            //     Msg91::sms()->to('91'.$request->phone)->flow('61fbb9f27ca7fa28af01f169')->variable('user', 'User')->variable('business_name', config('app.name'))->variable('otp', $otp)->send();
            // }

            return response([
                'success'   => true,
                'token'     => null,
                'message'   => 'Please register your account.',
                'otp'       => $otp,
                'data'      => null,
            ],200);

        }
    }

    public function register(Request $request){

        $this->validate($request, [
            'name'            => 'required',
            'phone'  => [
                'required',
                Rule::unique('users')->where(function ($query) use ($request) {

                    return $query
                        ->where('type', "user")
                        ->where('phone', $request->phone);
                }),
            ],
        ]);

        $user = new User;
        $user->type = "user";
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->phone);
        $user->save();

        $userDetails = new UserDetail;
        $userDetails->user_id  = $user->id;
        $userDetails->save();

        Auth::login($user);

        $otp = rand(1111, 9999);

        return response([
            'success'   => true,
            'token'     => $user->createToken('auth_token')->plainTextToken,
            'message'   => 'You are successfully login.',
            'otp'       => $otp,
            'data'      => new LoginResource($user),
        ],200);
    }
}
