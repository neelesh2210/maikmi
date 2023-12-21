<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{

    public function upload(Request $request){
        $this->validate($request,[
            'image'=>'required|mimes:png,jpg,jpeg,webp,svg'
        ]);
        $image_id = imageUpload($request->file('image'), true);

        return response()->json(['image_id'=>$image_id,'message'=>'Image Uploaded Successfully!','status'=>200],200);

    }

}
