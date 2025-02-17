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
        $search_status = $request->search_status;
        $search_salon = $request->salon_id;
        $search_date = $request->search_date;

        $list = ServiceBooking::orderBy('id', 'desc')->with(['getSalon', 'getBookedBy']);
        if($search_salon){
            $list = $list->where('salon_id', $search_salon);
        }
        if($request->has('export')){
            $list = $list->latest()->get();

            return Excel::download(new ServiceBookingExport($list), 'service_bookings.xlsx');
        }
        $list = $list->when($search_status, function($query) use ($search_status){
            $query->where('status', $search_status);
        })->when($search_date, function($query) use ($search_date){
            $start_date = explode(' to ', $search_date)[0];
            $end_date = explode(' to ', $search_date)[1];
            $query->whereBetween('created_at',[$start_date, $end_date]);
        })->paginate('20');
        return view('admin.service_booking.index', compact('list','search_status','search_salon','search_date'), ['page_title' => 'Service Booking List']);
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
