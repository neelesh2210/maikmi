<?php

namespace App\Http\Controllers\Api\Users;

use Auth;
use App\Models\Story;
use App\Models\StoryView;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoryController extends Controller
{

    public function view(Request $request){
        $request->validate([
            'story_id' => 'required|exists:stories,id'
        ]);

        $story_view = StoryView::where('story_id',$request->story_id)->where('user_id',Auth::user()->id)->first();

        if(!$story_view){
            $story_view = new StoryView;
            $story_view->story_id = $request->story_id;
            $story_view->user_id = Auth::user()->id;
            $story_view->save();

            $story = Story::where('id',$request->story_id)->first();
            $story->total_view_count = $story->total_view_count + 1;
            $story->save();

            return response()->json([
                'message' => 'Story viewed successfully',
                'total_views' => StoryView::where('story_id',$request->story_id)->count()
            ]);
        }

        return response()->json([
            'message' => 'Story already viewed',
            'total_views' => StoryView::where('story_id',$request->story_id)->count()
        ]);
    }

}
