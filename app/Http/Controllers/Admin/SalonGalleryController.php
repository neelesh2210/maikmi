<?php

namespace App\Http\Controllers\Admin;

use App\Models\Salon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalonGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $imageId = imageUpload($request->file('file'), 'salon_gallery', true);

        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        return response()->json([
            'id'            => $imageId,
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);

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
        return view('admin.salon.gallery', ['page_title' => $data->name.' Gallery'], compact('data'));
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
        $this->validate($request, [
            'gallery'   => 'required'
        ]);
        $data = Salon::find($id);
        $data->gallery = $request->gallery;
        $data->save();

        return redirect()->route('salon.index')->with('success','Salon gallery updated successfully !!');
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
