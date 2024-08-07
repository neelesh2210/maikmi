<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ServiceBooking;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ServiceBookingExport;

class ServiceBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = ServiceBooking::orderBy('id', 'desc')->with(['getSalon', 'getBookedBy']);
        if($request->salon_id){
            $list = $list->where('salon_id', $request->salon_id);
        }
        if($request->has('export')){
            $list = $list->latest()->get();

            return Excel::download(new ServiceBookingExport($list), 'service_bookings.xlsx');
        }
        $list = $list->paginate('20');
        return view('admin.service_booking.index', compact('list'), ['page_title' => 'Service Booking List']);
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
