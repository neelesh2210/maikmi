<?php

namespace App\Http\Controllers\Api\Vendors;

use Auth;
use App\Models\Salon;
use Illuminate\Http\Request;
use App\Models\Admin\ImageUpload;
use App\Http\Controllers\Controller;

class KycDocumentController extends Controller
{

    public function store(Request $request){
        $image_uploads = ImageUpload::pluck('id')->toArray();
        $this->validate($request,[
            'kyc_document_type'=>'required|in:pan,aadhar',
            'aadhar_front_image'=>'nullable|required_if:kyc_document_type,aadhar|in:'.implode(',',$image_uploads),
            'aadhar_back_image'=>'nullable|required_if:kyc_document_type,aadhar|in:'.implode(',',$image_uploads),
            'pan_image'=>'nullable|required_if:kyc_document_type,pan',
        ]);

        $salon = Salon::where('user_id',Auth::user()->id)->first();
        if($salon->kyc_status == '1'){
            return response()->json(['message'=>'You Can not change KYC Document','status'=>422],422);
        }else{
            $salon->kyc_document_type = $request->kyc_document_type;
            if($request->kyc_document_type == 'aadhar'){
                $salon->kyc_document = json_encode(['aadhar_front_image'=>$request->aadhar_front_image,'aadhar_back_image'=>$request->aadhar_back_image]);
            }elseif($request->kyc_document_type == 'pan'){
                $salon->kyc_document = json_encode(['pan_image'=>$request->pan_image]);
            }
            $salon->save();

            return response()->json(['message'=>'KYC Document Updated Successfully!','status'=>200],200);
        }
    }

}
