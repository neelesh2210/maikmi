<?php

namespace App\Http\Controllers\Api\Users;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\AddressResource;

class AddressApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response([
            'success'       => true,
            'address_list'  => AddressResource::collection(UserAddress::where('user_id', auth()->id())->get())
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'latitude'      => 'required',
            'longitude'     => 'required',
            'address'       =>  'required',
            'type'          =>  'required',
        ]);

        UserAddress::where('user_id', auth()->id())->update(['is_default' => false]);

        $data = new UserAddress;
        $data->user_id = auth()->id();
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;
        $data->address = $request->address;
        $data->type = $request->type;
        $data->is_default = true;
        $data->save();

        return response([
            'success'   => true,
            'message'   => 'Address add successfully',
            'data'      => new AddressResource($data),
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        UserAddress::where('user_id', auth()->id())->update(['is_default' => false]);
        UserAddress::find($id)->update(['is_default' => true]);
        return response([
            'success'   => true,
            'message'   => 'Address default set successfully',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'latitude'      => 'required',
            'longitude'     => 'required',
            'address'       =>  'required',
            'type'          =>  'required',
        ]);

        $data = UserAddress::find($id);
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;
        $data->address = $request->address;
        $data->type = $request->type;
        $data->save();

        return response([
            'success'   => true,
            'message'   => 'Address update successfully',
            'data'      => new AddressResource($data),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserAddress::destroy($id);
        return response([
            'success'   => true,
            'message'   => 'Address delete successfully',
        ], 200);
    }
}
