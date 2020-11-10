<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    public function index()
    {
        $examination= ClassroomExaminationMapping::all()
        dd($examination);
        return view('student.examination');
    }

}
