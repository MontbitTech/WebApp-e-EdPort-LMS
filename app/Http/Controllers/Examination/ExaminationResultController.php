<?php

namespace App\Http\Controllers\Examination;

use App\Http\Controllers\Controller;
use App\Models\Examination\ExaminationResult;
use Illuminate\Http\Request;
use Response;

class ExaminationResultController extends Controller
{
    public function get (Request $request)
    {
        $results = ExaminationResult::with('examination', 'student', 'classroom', 'classroom.studentSubject');

        foreach ( $request->all() as $key => $value ) {
            $results = $results->where($key, $value);
        }

        return Response::json(['success' => true, 'response' => $results->get()]);
    }

    public function post (Request $request)
    {
        $examinationResult = ExaminationResult::firstOrNew([
            'examination_id' => $request->examination_id,
            'student_id'     => $request->student_id,
        ]);
        $examinationResult->total_marks = $request->total_marks;
        $examinationResult->marks_obtained = $request->marks_obtained;
        $examinationResult->save();

        return $examinationResult;
    }
}
