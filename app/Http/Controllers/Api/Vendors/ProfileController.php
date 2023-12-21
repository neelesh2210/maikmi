<?php

namespace App\Http\Controllers\Api\Vendors;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProfileResource;

class ProfileController extends Controller
{
    public function getProfile(){

        return response()->json([
            'message' => 'Profile Retrive Successfully!',
            'status' => 200,
            'profile' => new ProfileResource(auth()->user()),
        ], 200);

    }

    public function updateProfile(Request $request){
        $salon = auth()->user()->getSalon;
        $this->validate($request, [
            'salon_name'            => 'required',
            'phone_number'          => 'required|unique:salons,phone_number,'.$salon->id,
            'latitude'              => 'required',
            'longitude'             => 'required',
            'city'                  => 'required',
            'address'               => 'required',
            'availability_range'    => 'required',
            'description'           => 'required',
            'owner_name'            => 'required',
            'image'                 => 'image|mimes:jpeg,png,jpg,gif,svg',
            'phone'  => [
                'required',
                Rule::unique('users')->where(function ($query) use ($request) {

                    return $query
                        ->where('type', "vendor")
                        ->where('phone', $request->phone);
                })->ignore(auth()->id()),
            ],
        ]);

        $user = auth()->user();
        $user->name = $request->owner_name;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->phone);
        $user->save();

        $salon->name = $request->salon_name;
        $salon->phone_number = $request->phone_number;
        $salon->latitude = $request->latitude;
        $salon->longitude = $request->longitude;
        $salon->city = $request->city;
        $salon->address = $request->address;
        $salon->availability_range = $request->availability_range;
        $salon->description = $request->description;
        if($request->file('image')){
            $salon->image = imageUpload($request->file('image'), true);
        }
        $salon->save();

        return response()->json([
            'success' => true,
            'message'   => 'Profile updated successfully.',
            'profile'   => new ProfileResource($user),
        ], 200);
    }
}
