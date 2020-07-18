<?php

namespace App\Http\Controllers;

use App\ClassTiming;
use App\StudentClass;
use App\Teacher;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function availableClasses (Request $request)
    {
        $day = date('l', strtotime($request->date));
        $startTime = date('H:i:s', strtotime($request->startTime));
        $endTime = date('H:i:s', strtotime($request->endTime));

        $occupiedClassTiminngs = ClassTiming::with('StudentClass')
            ->where('from_timing', '<=', $endTime)
            ->where('to_timing', '>=', $startTime)
            ->where('class_day', '=', $day)
            ->get()->pluck('class_id');

        $availableClasses = StudentClass::with('studentSubject')->whereNotIn('id', $occupiedClassTiminngs)->get();


        return json_encode(array('status' => 'success', 'message' => $availableClasses));
    }

    public function availableTeacher (Request $request)
    {
        $day = $request->day;
        $timings = explode('-', $request->timings);

        $availableTeacher = Teacher::whereDoesntHave('class_timing', function ($q) use ($timings, $day) {
            $q->where('from_timing', '<=', $timings[1]);
            $q->where('to_timing', '>=', $timings[0]);
            $q->where('class_day', '=', $day);
        })->get();

        return json_encode(array('status' => 'success', 'message' => $availableTeacher));
    }
}
