<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\CustomerExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class UserManagementController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:user-list', ['only' => ['index','store']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = '';
        $status = '';
        $list = User::where('type', 'user');
        if($request->search){
            $search = $request->search;
            $list = $list->where('name', 'like', '%' . $search. '%')->orWhere('phone', $search);
        }
        if($request->status){
            $status = $request->status;
            $list = $list->where('is_active', $status);
        }
        if($request->has('export')){
            $list = $list->latest()->get();

            return Excel::download(new CustomerExport($list), 'customers.xlsx');
        }
        $list = $list->with(['userDetail', 'getDefaultAddress'])->orderBy('id', 'desc')->paginate(20);
        return view('admin.user.index', compact('list', 'search', 'status'), ['page_title' => 'User List']);
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

    public function statusUpdate($id)
    {
        $data = User::find($id);
        if($data->is_active == "active"){
            $data->is_active = "deactivate";
        }elseif($data->is_active == "deactivate"){
            $data->is_active = "active";
        }
        $data->save();

        return $data->is_active;
    }

    public function featureUpdate($id)
    {
        $data = User::find($id);
        if($data->is_featured == 1){
            $data->is_featured = 0;
        }elseif($data->is_featured == 0){
            $data->is_featured = 1;
        }
        $data->save();

        return $data->is_featured;
    }
}
