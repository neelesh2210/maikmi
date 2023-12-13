<?php

namespace App\Http\Controllers\Vendors;

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
        $data = auth()->user()->getSalon;
        return view('vendors.availability_hour.index', compact('data'), ['page_title' => 'Availability Hour']);
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
        $input = $request->all();
        $salonData = auth()->user()->getSalon;
        foreach($request->days as $key => $day){
            $data = AvailabilityHour::where('salon_id', $salonData->id)->where('day', $day)->first();
            if(!$data){
                $data = new AvailabilityHour;
            }
            $data->user_id = auth()->id();
            $data->salon_id = $salonData->id;
            $data->day = $day;
            $data->start_at = $request->start_at?$request->start_at[$key]:NULL;
            $data->end_at = $request->end_at?$request->end_at[$key]:NULL;
            $data->status = isset($input[$day.'_status']) ? $input[$day.'_status']: 0;
            $data->save();
        }
        return redirect()->route('vendors.availability-hour.index')->with('success','Salon availability hour updated successfully !!');
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
        //
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
        //
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
