<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentAttendanceController;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Session;

class ProfileController extends Controller
{
    public function index()
    {
        $student_id = 1;
        $attendances = Attendance::with('dateclass', 'dateclass.studentClass')
            ->where('student_id', $student_id)
            ->get();
        // dd($data);
        return view('student.profile', compact('attendances'));
    }
}
