<?php

namespace App\Http\Controllers\Student;

use App\Classes;
use App\DateClass;
use App\Http\Controllers\Controller;
use App\libraries\Utility\DateUtility;
use App\Models\Student;
use App\StudentClass;
use Illuminate\Http\Request;
use Session;

class LectureController extends Controller
{
    public function index()
    {
        $current_date = date("Y-m-d H:i:s");
        $currentTime = date("H:i:s", strtotime($current_date));
        $currentDay = date("Y-m-d", strtotime($current_date));
        $student_id = 1;
        $student = Student::find($student_id);
        // dd($class_id_data->class_name);
        $class_id_data = Classes::find($student->class_id);

        // dd($class_id_data->class_name);
        $stundent_aa = StudentClass::where('id', $class_id_data->id);
        // ->where('section_name', $class_id_data->section_name);
        dd($stundent_aa);
        $TodayLiveData = DateClass::with('studentClass', 'studentSubject', 'teacher')->where('class_id', $student->class_id)
            ->where(function ($query) use ($currentTime, $currentDay) {
                //$query->where('to_timing','>',$currentTime);
                $query->where('class_date', '=', $currentDay);
            })
            ->orderBy('from_timing', 'desc')
            ->get();
        // dd($TodayLiveData);
        // $pastClassData = DateClass::with('studentClass', 'studentSubject', 'teacher')->where('class_id', $student->class_id)
        //     ->where('class_date', '>', DateUtility::getPastDate(2))
        //     ->Where('class_date', '<', DateUtility::getDate())
        //     ->orderBy('from_timing', 'desc')
        //     ->get();
        return view('student.lecture', compact('TodayLiveData'));
    }
}
