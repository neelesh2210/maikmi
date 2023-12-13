<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnquiryController extends Controller
{
    public function index()
    {
       $list = ContactUs::orderBy('id','desc')->paginate(10);
       return view('backend.enquiry.index',compact('list'), ['page_title' => 'All Enquiry']);
    }
}
