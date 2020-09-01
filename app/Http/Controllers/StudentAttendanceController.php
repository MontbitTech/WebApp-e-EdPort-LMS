<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $attendance = Attendance::where('dateclass_id',$request->dateclass_id)->get();
        
        return $attendance;
    }

    public function store(Request $request)
    {
        $data = array();
        foreach($request->student_ids as $key => $value){
            $data['student_id'] = $key;
            $data['dateclass_id'] = $request->dateclass_id;
            $data['status'] = $value;
        }

        $attendance = Attendance::insert($data);

        return back()->with('student', $attendance);
    }

    public function update(Request $request)
    {
        $attendance = Attendance::where('student_id',$request->student_id)->where('dateclass_id',$request->dateclass_id)->get();
        $attendance->status = $request->status;
        $attendance->save();

        return back()->with('student', $attendance);
    }

    
}
