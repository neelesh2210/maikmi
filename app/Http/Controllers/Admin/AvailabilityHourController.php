<?php

namespace App\Http\Controllers\Admin;

use App\Models\Salon;
use Illuminate\Http\Request;
use App\Models\AvailabilityHour;
use App\Http\Controllers\Controller;

class AvailabilityHourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Salon::find($id);
        return view('admin.salon.availability_hour', ['page_title' => $data->name.' - Availability Hour'], compact('data'));
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
        return $input = $request->all();
        $salonData = Salon::find($id);
        foreach($request->days as $key => $day){
            $data = AvailabilityHour::where('salon_id', $id)->where('day', $day)->first();
            if(!$data){
                $data = new AvailabilityHour;
            }
            $data->user_id = $salonData->user_id;
            $data->salon_id = $id;
            $data->day = $day;
            $data->start_at = $request->start_at?$request->start_at[$key]:NULL;
            $data->end_at = $request->end_at?$request->end_at[$key]:NULL;
            $data->status = isset($input[$day.'_status']) ? $input[$day.'_status']: 0;
            $data->save();
        }
        return redirect()->route('salon.index')->with('success','Salon availability hour updated successfully !!');
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
}
