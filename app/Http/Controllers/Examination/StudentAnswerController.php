<?php

namespace App\Http\Controllers\Examination;

use App\Http\Controllers\Controller;
use App\Models\Examination\StudentAnswer;
use Illuminate\Http\Request;

class StudentAnswerController extends Controller
{
    public function get (Request $request)
    {
        $answers = StudentAnswer::query();

        foreach ( $request->all() as $key => $value ) {
            $answers = $answers->where($key, $value);
        }

        return $answers->get();
    }

    public function post (Request $request)
    {
        $studentAnswer = StudentAnswer::firstOrNew([
            'student_id'                      => $request->student_id,
            'examination_question_mapping_id' => $request->examination_question_mapping_id,
        ]);

        $studentAnswer->answer = $request->answer;
        $studentAnswer->marks = $request->marks;
        $studentAnswer->save();

        return $studentAnswer;
    }
}
