<?php

namespace App\Http\Controllers;

use App\libraries\Availability;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function availableClasses (Request $request)
    {
        $day = date('l', strtotime($request->date));
        $startTime = date('H:i:s', strtotime($request->startTime));
        $endTime = date('H:i:s', strtotime($request->endTime));

        return json_encode(array('status'  => 'success',
                                 'message' => Availability::getAvailableClasses($day, $startTime, $endTime)));
    }

    public function availableTeacherAndSubject (Request $request)
    {
        $availabilityData['teacher'] = Availability::getAvailableTeacher(explode('-', $request->timings), $request->day);
        $availabilityData['subject'] = Availability::getAvailableSubject($request->timeTableId);

        return \response()->json(array('status' => 'success', 'data' => $availabilityData));
    }
}
