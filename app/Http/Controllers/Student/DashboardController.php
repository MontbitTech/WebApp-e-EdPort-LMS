<?php

namespace App\Http\Controllers\Student;

use App\Classes;
use App\DateClass;
use App\Http\Controllers\Controller;
use App\libraries\Utility\DateUtility;
use App\Models\Student;
use App\StudentClass;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $student_id = 1;
        $student = Student::find($student_id);
        $class_id_data = Classes::find($student->class_id);
        $stundent_data = StudentClass::where('class_name', $class_id_data->class_name)
            ->where('section_name', $class_id_data->section_name)
            ->pluck('id');
        $TodayLiveData = DateClass::with('studentClass', 'studentSubject', 'teacher')
            ->whereIn('class_id', $stundent_data)
            ->where('class_date', '=', DateUtility::getDate())
            ->orderBy('from_timing', 'desc')
            ->get();
        $LiveClass = DateClass::with('studentClass', 'studentSubject', 'teacher')
            ->whereIn('class_id', $stundent_data)
            ->where('class_date', '=', DateUtility::getDate())
            ->where('from_timing', '<=', date('H:i'))
            ->where('to_timing', '>=', date('H:i'))
            ->orderBy('from_timing', 'desc')
            ->get();
        //dd($LiveClass[0]);
        // $LiveClass =  date('H:i', strtotime($TodayLiveData->from_timing)) <= date('H:i')
        //     & (date('H:i') <= date('H:i', strtotime($TodayLiveData->to_timing)));
        // dd($LiveClass);
        return view('student.dashboard', compact('TodayLiveData', 'LiveClass'));
    }
}
