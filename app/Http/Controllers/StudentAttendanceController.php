<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

/**
 * Class StudentAttendanceController
 * @package App\Http\Controllers
 */
class StudentAttendanceController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index (Request $request)
    {
        $attendance = Attendance::where('dateclass_id', $request->dateclass_id)->get();

        return $attendance;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store (Request $request)
    {
        Attendance::where('dateclass_id', $request->dateclass_id)->delete();

        $data = array();
        $count = 1;
        foreach ( $request->attendance as $key => $value ) {
            $data[ $count ]['student_id'] = $key;
            $data[ $count ]['dateclass_id'] = $request->dateclass_id;
            $data[ $count ]['status'] = $value;
            $count++;
        }

        Attendance::insert($data);

        return back()->with('success', 'Attendance added successfully');
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function update (Request $request)
    {
        $attendance = Attendance::where('student_id', $request->student_id)->where('dateclass_id', $request->dateclass_id)->first();
        if ( !$attendance ) {
            $attendance = new Attendance();
            $attendance->student_id = $request->student_id;
            $attendance->dateclass_id = $request->dateclass_id;
        }

        $attendance->status = $request->status;
        $attendance->save();

        return json_encode(array('status' => 'success', 'data' => $attendance, 'message' => 'Attendance updated successfully'));
    }
}
