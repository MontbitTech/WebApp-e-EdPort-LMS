<?php

namespace App\Http\Controllers;

use App\ClassTiming;
use App\libraries\Availability;
use App\StudentClass;
use App\StudentSubject;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test (Request $request)
    {

//        $timeTable = ClassTiming::find($request->timeTableId);
        $timeTableId = $request->timeTableId;
        $day = $request->day;
        $timings = explode('-', $request->timings);

        $availabilityData['teacher'] = Availability::getAvailableTeacher($timings, $day);
        $availabilityData['subject'] = Availability::getAvailableSubject($timeTableId);


       return \response()->json(array('status' => 'success', 'data' => $availabilityData));


//        return \response()->json(['success' => 'true', 'message' => 'rest in peace bro...', 'data' => $availableSubjects, 'count' => count($availableSubjects)]);
    }
}
