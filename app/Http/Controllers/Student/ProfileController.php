<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentAttendanceController;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Session;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $attendances = Attendance::with('dateclass', 'dateclass.studentClass')
            ->where('student_id', Session::get('student_session')['student']->id)
            ->get();

        return view('student.profile', compact('attendances'));
    }
}
