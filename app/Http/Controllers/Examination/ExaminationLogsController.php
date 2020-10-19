<?php

namespace App\Http\Controllers\Examination;

use App\Http\Controllers\Controller;
use App\libraries\Utility\DateUtility;
use Response;
use App\libraries\Utility\ExaminationUtility;
use App\Models\Examination\ClassroomExaminationMapping;
use App\Models\Examination\ExaminationLogs;
use Illuminate\Http\Request;

class ExaminationLogsController extends Controller
{
    public function get (Request $request)
    {
        $logs = ExaminationLogs::query();

        foreach ( $request->all() as $key => $value ) {
            $logs = $logs->where($key, $value);
        }

        return $logs->get();
    }

    public function post (Request $request)
    {
        $logs = new ExaminationLogs();
        $logs->classroom_examination_mapping_id = $request->classroom_examination_mapping_id;
        $logs->student_id = $request->student_id;

        $logs->remaining_time = $request->remaining_time;
        $logs->logs = $request->logs;
        $logs->disconnected_count = $request->disconnected_count;
        $logs->save();

        return $logs;
    }

    public function saveExamLogs (Request $request)
    {
        $classroomExaminationMapping = ClassroomExaminationMapping::find($request->classroom_examination_mapping_id);

        if ( $classroomExaminationMapping->start_time > DateUtility::getDateTime() )
            return Response::json(['success' => false, 'response' => 'Please wait till the start time of the exam']);

//        $logs = $this->post($request);
        if ( $request->questionResponses )
            ExaminationUtility::saveStudentAnswers($request, $classroomExaminationMapping);
            
        ExaminationUtility::calculateResult($request->classroom_examination_mapping_id, $request->student_id);

        return Response::json(['success' => true, 'response' => 'Response saved']);
    }
}
