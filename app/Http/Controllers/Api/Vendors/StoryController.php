<?php

namespace App\Http\Controllers\Api\Vendors;

use Auth;
use Carbon\Carbon;
use App\Models\Story;
use App\Models\StoryView;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoryController extends Controller
{

    public function index() {
        $stories = Story::where('salon_id', Auth::user()->getSalon->id)->where('created_at', '>=', Carbon::now()->subDay())->latest()->get();

        foreach ($stories as $key => $story) {
            $story->image = $story->image ? imageUrl($story->image) : asset('admin_css/no-pictures.png');
            $story->date = $story->created_at->format('d M Y h:i A');

            $users = StoryView::where('story_id', $story->id)->with('user.userDetail')->get();

            foreach ($users as $user) {
                $user->user->userDetail->photo = $user->user->userDetail->photo ? imageUrl($user->user->userDetail->photo) : asset('admin_css/no-pictures.png');
                $user->date = $user->created_at->format('d M y h:i A');
            }

            $story->users = $users;
        }

        return response()->json(['status' => 'success', 'stories' => $stories]);
    }

    public function store(Request $request) {
        $story = new Story;
        $story->salon_id = Auth::user()->getSalon->id;
        if($request->hasFile('image')){
            $story->image = imageUpload($request->file('image'), true);
        }
        $story->caption = $request->caption;
        $story->save();

        return response()->json(['status' => 'success']);
    }

    public function destroy(Request $request) {
        $story = Story::where('salon_id', Auth::user()->getSalon->id)->where('id',$request->id)->delete();

        return response()->json(['status' => 'success']);
    }

}
