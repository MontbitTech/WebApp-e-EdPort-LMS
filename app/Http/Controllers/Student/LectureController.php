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
        $pastClassData = DateClass::whereIn('class_id', $stundent_data)
            ->where('class_date', '>', DateUtility::getPastDate(2))
            ->where('class_date', '<', DateUtility::getDate())
            ->orderBy('from_timing', 'desc')
            ->get();
        $futureClassData = DateClass::whereIn('class_id', $stundent_data)
            ->where('class_date', '<', DateUtility::getFutureDate(2))
            ->Where('class_date', '>', DateUtility::getDate())
            ->orderBy('class_date', 'asc')
            ->orderBy('from_timing', 'asc')
            ->get();

        return view('student.lecture', compact('TodayLiveData', 'pastClassData', 'futureClassData'));
    }
}
