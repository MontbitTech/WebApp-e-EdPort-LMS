<?php

namespace App\Http\Controllers\Examination;

use App\Http\Controllers\Controller;
use App\libraries\Utility\DateUtility;
use App\Models\Examination\ClassroomExaminationMapping;
use App\Models\Examination\ExaminationLogs;
use App\Models\Examination\ExaminationQuestionMapping;
use App\Models\Examination\StudentAnswer;
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

        $this->post($request);

        foreach ( $request->questions as $questionId => $answer ) {
            $examQuestionMappingId = ExaminationQuestionMapping::where('examination_id', $classroomExaminationMapping->examination_id)
                ->where('classroom_id', $classroomExaminationMapping->classroom_id)->where('question_id', $questionId)->pluck('id')->first();

            $studentAnswer = new StudentAnswer();
            $studentAnswer->student_id = $request->student_id;
            $studentAnswer->examination_question_mapping_id = $examQuestionMappingId;
            $studentAnswer->answer = $answer;
            $studentAnswer->save();
        }
    }
}
