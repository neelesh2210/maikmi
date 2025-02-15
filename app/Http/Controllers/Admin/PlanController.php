<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{

    public function index(Request $request){
        $search_status = $request->search_status;
        $search_key = $request->search_key;

        $plans = Plan::when($search_status,function($query) use ($search_status){
            $query->where('is_active',$search_status);
        })->when($search_key,function($query) use ($search_key){
            $query->where('title','LIKE','%'.$search_key.'%')->orWhere('duration','<=',$search_key);
        })->latest()->paginate(10);

        return view('admin.plan.index',compact('search_status','search_key','plans'),['page_title'=>'Plan List']);
    }

    public function create(){
        return view('admin.plan.create',['page_title'=>'Add Plan']);
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required',
            'price'=>'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'discounted_price'=>'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0|max:'.$request->price,
            'duration'=>'required|numeric'
        ]);

        $plan = new Plan;
        $plan->title = $request->title;
        $plan->price = $request->price;
        $plan->discounted_price = $request->discounted_price;
        $plan->duration = $request->duration;
        $plan->description = $request->description;
        $plan->term_and_condition = $request->term_and_condition;
        $plan->save();

        return redirect()->route('plan.index')->with('success','Plan Added Successfully!');
    }

    public function show(Plan $plan){
        if($plan->is_active == '1'){
            $plan->is_active = '0';
        }elseif($plan->is_active == '0'){
            $plan->is_active = '1';
        }
        $plan->save();

        return $plan->is_active;
    }

    public function edit(Plan $plan){
        return view('admin.plan.edit',compact('plan'),['page_title'=>'Add Plan']);
    }

    public function update(Request $request,Plan $plan){
        $request->validate([
            'title'=>'required',
            'price'=>'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'discounted_price'=>'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0|max:'.$request->price,
            'duration'=>'required|numeric'
        ]);

        $plan->title = $request->title;
        $plan->price = $request->price;
        $plan->discounted_price = $request->discounted_price;
        $plan->duration = $request->duration;
        $plan->description = $request->description;
        $plan->term_and_condition = $request->term_and_condition;
        $plan->save();

        return redirect()->route('plan.index')->with('success','Plan Updated Successfully!');
    }

    public function destroy(Plan $plan){
        $plan->delete();

        return back()->with('error','Plan Deleted Successfully!');
    }

}
