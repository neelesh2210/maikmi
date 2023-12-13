<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppBanner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppBannerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:banner-list', ['only' => ['index', 'store', 'edit']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = AppBanner::orderBy('id', 'desc')->get();
        return view('admin.app_banner.index', compact('list'), ['page_title' => 'App Banner']);
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
        $this->validate($request,[
            'banner'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = AppBanner::find(1);
        if(!$data){
            $data = new AppBanner;
        }
        $data->banner = imageUpload($request->file('banner'), false);
        $data->status = 1;
        $data->save();
        return redirect()->route('app_banners.index')->with('success', 'App Banner Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = AppBanner::find($id);
        if($data->status == 1){
            $data->status = 0;
        }elseif($data->status == 0){
            $data->status = 1;
        }
        $data->save();
        return 1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list = AppBanner::orderBy('id', 'desc')->get();
        $edit_data =  AppBanner::find($id);
        return view('admin.app_banner.index', compact('list','edit_data'), ['page_title' => 'App Banner']);
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
            'banner'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = AppBanner::find($id);
        $data->banner = imageUpload($request->file('banner'), false);
        $data->save();
        return redirect()->route('app_banners.index')->with('success', 'App Banner updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AppBanner::find($id)->delete();
        return redirect()->route('app_banners.index')->with('error', 'App Banner Deleted Successfully');
    }
}
