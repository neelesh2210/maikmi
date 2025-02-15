<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SendNotificationController extends Controller
{

    public function index(){
        return view('admin.send_notification.index',['page_title'=>'Send Notification']);
    }

    public function store(Request $request){
        $request->validate([
            'title'     =>  'required',
            'body'      =>  'required',
            'to_send'   =>  'required|in:customer,salon,all',
        ]);

        if($request->to_send == 'customer'){
            $users = User::where('type','user')->get();
        }elseif($request->to_send == 'salon'){
            $users = User::where('type','vendor')->get();
        }else{
            $users = User::all();
        }

        foreach ($users as $user) {
            ini_set('max_execution_time', 3600); // 3600 seconds = 60 minutes
            set_time_limit(3600);
            sendNotification($request->title, $request->body, $user->fcm_token);

            $notification = new Notification;
            $notification->user_id = $user->id;
            $notification->title = $request->title;
            $notification->body = $request->body;
            $notification->save();
        }

        return back()->with('success','Notification Send Successfully!');
    }

}
