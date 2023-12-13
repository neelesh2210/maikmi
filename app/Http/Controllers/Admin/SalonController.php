<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class SalonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Salon::orderBy('id', 'desc')->with(['getOwner', 'getServiceBooking'])->paginate(20);
        return view('admin.salon.index', compact('list'), ['page_title' => 'Salon List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.salon.create', ['page_title' => 'Add Salon']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();

        $this->validate($request, [
            'name'                  => 'required',
            'phone_number'          => 'required|unique:salons,phone_number',
            'latitude'              => 'required',
            'longitude'             => 'required',
            'city'                  => 'required',
            'address'               => 'required',
            'availability_range'    => 'required',
            'description'           => 'required',
            'image'                 => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'owner_name'            => 'required',
            'phone'  => [
                'required',
                Rule::unique('users')->where(function ($query) use ($request) {

                    return $query
                        ->where('type', "vendor")
                        ->where('phone', $request->phone);
                }),
            ],
        ]);

        $user = new User;
        $user->type = "vendor";
        $user->name = $request->owner_name;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->phone);
        $user->save();

        $salon = new Salon;
        $salon->user_id = $user->id;
        $salon->name = $request->name;
        $salon->phone_number = $request->phone_number;
        $salon->latitude = $request->latitude;
        $salon->longitude = $request->longitude;
        $salon->city = $request->city;
        $salon->address = $request->address;
        $salon->availability_range = $request->availability_range;
        $salon->description = $request->description;
        $salon->image = imageUpload($request->file('image'), 'salon', true);
        $salon->added_by = auth()->id();
        $salon->save();

        return redirect()->route('salon.index')->with('success','Salon created successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Salon::with('getOwner')->find($id);
        return view('admin.salon.show', compact('data'), ['page_title' => $data->name.' View']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Salon::with('getOwner')->find($id);
        return view('admin.salon.edit', compact('data'), ['page_title' => 'Edit Salon']);
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
        $salon = Salon::with('getOwner')->find($id);
        $this->validate($request, [
            'name'                  => 'required',
            'phone_number'          => 'required|unique:salons,phone_number,'.$id,
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
                })->ignore($salon->getOwner->id),
            ],
        ]);

        $user = $salon->getOwner;
        $user->name = $request->owner_name;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->phone);
        $user->save();

        $salon->name = $request->name;
        $salon->phone_number = $request->phone_number;
        $salon->latitude = $request->latitude;
        $salon->longitude = $request->longitude;
        $salon->city = $request->city;
        $salon->address = $request->address;
        $salon->availability_range = $request->availability_range;
        $salon->description = $request->description;
        if($request->file('image')){
            $salon->image = imageUpload($request->file('image'), 'salon', true);
        }
        $salon->save();

        return redirect()->route('salon.index')->with('success','Salon updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function availableUpdate($id)
    {
        $data = Salon::find($id);
        if($data->available == 1){
            $data->available = 0;
        }elseif($data->available == 0){
            $data->available = 1;
        }
        $data->save();

        return $data->available;
    }

    public function featureUpdate($id)
    {
        $data = Salon::find($id);
        if($data->featured == 1){
            $data->featured = 0;
        }elseif($data->featured == 0){
            $data->featured = 1;
        }
        $data->save();

        return $data->featured;
    }
}
