<?php

namespace App\Http\Controllers\Api\Users;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\ProfileResource;

class ProfileApiController extends Controller
{
    public function getProfile(){

        return response()->json([
            'success' => true,
            'profile' => new ProfileResource(auth()->user()),
        ], 200);

    }

    public function updateProfile(Request $request){
        $this->validate($request, [
            'name'  => 'required',
            'phone'  => [
                'required',
                Rule::unique('users')->where(function ($query) use ($request) {

                    return $query
                        ->where('type', "user")
                        ->where('phone', $request->phone);
                })->ignore(auth()->id()),
            ],
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->phone);
        $user->save();

        return response()->json([
            'success'   => true,
            'message'   => 'Profile updated successfully.',
            'profile'   => new ProfileResource($user),
        ], 200);
    }
}
