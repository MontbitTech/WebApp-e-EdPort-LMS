<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;

class QuizController extends Controller
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

       /*  $classes_data = array();
        $upcoming_current_day_classes = Helper::getLiveQuiz();
        $j = 0;
        if(count($upcoming_current_day_classes) > 0)
        {
            
            foreach($upcoming_current_day_classes as $key => $class_datas)
            {                
                foreach($class_datas as $upcoming)
                {
                    //dd($upcoming);
                    $classes_data[$j]['class_date'] = date('d M',strtotime($key));
                    $classes_data[$j]['class_from'] = date('H:i A',strtotime($upcoming->from_timing));
                    $classes_data[$j]['class_to'] = date('H:i A',strtotime($upcoming->to_timing));
                    $classes_data[$j]['class_name'] = Helper::addOrdinalNumberSuffix($upcoming->studentClass->class_name). ' Std';
                    $classes_data[$j]['class_number'] = $upcoming->studentClass->class_name;
                    $classes_data[$j]['class_section'] = $upcoming->studentClass->section_name;
                    $classes_data[$j]['class_id'] = $upcoming->studentClass->id;
                    $classes_data[$j]['class_description'] = '';
                    $classes_data[$j]['subject_id'] = $upcoming->studentSubject->id;
                    $classes_data[$j]['subject'] = $upcoming->studentSubject->subject_name;
                    $classes_data[$j]['from_datetime'] = date("Y-m-d H:i:s",strtotime($key." ".$upcoming->from_timing));
                    $classes_data[$j]['to_datetime'] = date("Y-m-d H:i:s",strtotime($key." ".$upcoming->to_timing));
                    $j++;
                }
            } 
        }
        $upcoming_classes = $classes_data;
        //echo "<pre>";print_r($upcoming_classes);exit;
        $subjects = \App\StudentSubject::orderBy('subject_name','asc')->get();
        $classes = \App\StudentClass::select('class_name')->groupBy('class_name')->orderBy('class_name','asc')->get();
    	return view('quiz.index',compact('upcoming_classes','subjects','classes')); */
    	return view('teacher.quiz.index'); 
    }
}
