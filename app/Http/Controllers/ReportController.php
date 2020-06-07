<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    public function index(){
        /* $past_class_data = \App\PastClass::with('class','subject','teacher')->where('is_past',1)->where('class_date','<',date('Y-m-d'))->get();
        //dd($past_class_data); 
    	return view('report.index',['report_data' => $past_class_data]); */
    	return view('teacher.report.index'); 
    }
}
