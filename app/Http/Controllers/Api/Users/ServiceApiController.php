<?php

namespace App\Http\Controllers\Api\Users;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\ServiceResource;

class ServiceApiController extends Controller
{
    public function service(Request $request)
    {
        $this->validate($request,[
            'salon_id'  => 'required'
        ]);

        return response([
            'success'       => true,
            'services'      => ServiceResource::collection(Service::where('salon_id', $request->salon_id)->where('available', 1)->where('is_ban', 0)->orderBy('name', 'asc')->get())
        ], 200);
    }
}
