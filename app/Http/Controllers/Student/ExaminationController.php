<?php

namespace App\Http\Controllers\Student;

use App\Classes;
use App\Http\Controllers\Controller;
use App\libraries\Utility\DateUtility;
use App\Models\Examination\ClassroomExaminationMapping;
use App\Models\Examination\ExaminationResult;
use App\Models\Student;
use App\StudentClass;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    public function index()
    {
        $student_id = 1;
        $student = Student::find($student_id);
        $class_id_data = Classes::find($student->class_id);
        $stundent_data = StudentClass::where('class_name', $class_id_data->class_name)
            ->where('section_name', $class_id_data->section_name)
            ->pluck('id');

        $examination = ClassroomExaminationMapping::with('examination', 'classroom')
            ->whereIn('classroom_id', $stundent_data)
            ->where('end_time', '>=', DateUtility::getDateTime())
            ->get();
        // dd($examination);
        $performance = ExaminationResult::where('student_id', $student_id)
            ->get();
        //dd($performance);
        return view('student.examination', compact('examination', 'performance'));
    }

    public function performance(Request $request)
    {
        $student_id = 1;
        $performances = ExaminationResult::with('examination', 'classroom')
            ->where('classroom_id', $request->classroom_id)
            ->where('student_id', $student_id)
            ->get();
        //dd($performances);
        return json_encode(array('status' => 'success', 'data' => $performances));
    }
}
