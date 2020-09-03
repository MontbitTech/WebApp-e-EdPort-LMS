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
        $attendance = Attendance::where('dateclass_id',$request->dateclass_id)->get();

        if(count($attendance))
            return back()->with('error','Attendance has been submitted for this class already.');

        $data = array();
        $count = 1;
        foreach($request->attendance as $key => $value){
            $data[$count]['student_id'] = $key;
            $data[$count]['dateclass_id'] = $request->dateclass_id;
            $data[$count]['status'] = $value;
            $count++;
        }

        $attendance = Attendance::insert($data);

        return back()->with('success', 'Attendance added successfully');
    }

    public function update(Request $request)
    {
        $attendance = Attendance::where('student_id',$request->student_id)->where('dateclass_id',$request->dateclass_id)->get();
        $attendance->status = $request->status;
        $attendance->save();

        return back()->with('student', $attendance);
    }
}
