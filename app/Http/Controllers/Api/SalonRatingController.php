<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\SalonRating;
use Illuminate\Http\Request;
use App\Models\ServiceBooking;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\SalonRatingResource;

class SalonRatingController extends Controller
{

    public function salonRating(Request $request){
        $this->validate($request,[
            'salon_id'=>'required|exists:salons,id',
            'rating'=>'required|between:1,5',
            'comment'=>'nullable|max:200'
        ]);

        $service_booking = ServiceBooking::where('booked_by',Auth::user()->id)->where('salon_id',$request->salon_id)->where('status','completed')->first();

        if($service_booking){
            $salon_rating = SalonRating::where('user_id',Auth::user()->id)->where('salon_id',$request->salon_id)->first();
            if(!$salon_rating){
                $salon_rating = new SalonRating;
                $salon_rating->user_id = Auth::user()->id;
                $salon_rating->salon_id = $request->salon_id;
            }
            $salon_rating->rating = $request->rating;
            $salon_rating->comment = $request->comment;
            $salon_rating->save();

            return response()->json(['message'=>'Rating Submitted Successfully!','status'=>200],200);
        }else{
            return response()->json(['message'=>'You have no booking at this salon','status'=>401],401);
        }
    }

    public function salonRatingList($salon_id){
        return response()->json(['rating_list'=>SalonRatingResource::collection(SalonRating::where('salon_id',$salon_id)->with('user.userDetail')->get()),'status'=>200],200);
    }

}
