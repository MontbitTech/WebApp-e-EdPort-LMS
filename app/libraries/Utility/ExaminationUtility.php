<?php

namespace App\libraries\Utility;

use App\Models\Examination\ClassroomExaminationMapping;
use App\Models\Examination\ExaminationQuestionMapping;
use App\Models\Examination\ExaminationResult;
use App\Models\Examination\StudentAnswer;

/**
 * Class ExaminationUtility
 * @package App\libraries\Utility
 */
class ExaminationUtility
{
    public static function createClassroomExaminationMapping ($params)
    {
        $classroomExaminationMapping = new ClassroomExaminationMapping();

        foreach ( $params as $key => $value ) {
            $classroomExaminationMapping->$key = $value;
        }

        $classroomExaminationMapping->save();

        return $classroomExaminationMapping;
    }


    public static function calculateResult ($classroomExaminationMappingId, $studentId)
    {
        $classroomExaminationMapping = ClassroomExaminationMapping::find($classroomExaminationMappingId);

        $examinationQuestionMapping = ExaminationQuestionMapping::with(['answers' => function ($query) use ($studentId) {
            $query->where('student_id', $studentId);
        }])->where('examination_id', $classroomExaminationMapping->examination_id)
            ->where('classroom_id', $classroomExaminationMapping->classroom_id)->get();

        $totalMarks = $examinationQuestionMapping->sum('marks');

        $obtainnedMarks = StudentAnswer::whereIn('examination_question_mapping_id', $examinationQuestionMapping)
                        ->where('student_id', $studentId)->sum('marks');

        $examinationResult = ExaminationResult::firstOrCreate([
            'student_id'     => $studentId,
            'examination_id' => $classroomExaminationMapping->examination_id,
            'classroom_id'   => $classroomExaminationMapping->classroom_id
        ]);

        $examinationResult->total_marks = $totalMarks;
        $examinationResult->marks_obtained = $obtainnedMarks;
        $examinationResult->save();
    }

    public static function saveStudentAnswers ($request, $classroomExaminationMapping)
    {
        foreach ( $request->questionResponses as $questionId => $answerIds ) {
            $examQuestionMapping = ExaminationQuestionMapping::where('examination_id', $classroomExaminationMapping->examination_id)
                ->where('classroom_id', $classroomExaminationMapping->classroom_id)->where('question_id', $questionId)->first();

            if ( !$examQuestionMapping )
                continue;

            $studentAnswer = StudentAnswer::firstOrCreate([
                'student_id'                      => $request->student_id,
                'examination_question_mapping_id' => $examQuestionMapping->id,
            ]);
            $studentAnswer->answer = $answerIds;

            if ( $examQuestionMapping->question )
                $studentAnswer->marks = self::calculateMarks($examQuestionMapping, $answerIds);
            $studentAnswer->save();
        }
    }

    public static function calculateMarks ($examQuestionMapping, $answerIds, $classroomExamProperties = null)
    {
        $answers = self::getAnswers($examQuestionMapping->question, $answerIds);

        if ( $examQuestionMapping->question->type_of_question == 'multiple_choice' ) {
            $rightAnswers = explode(',',$examQuestionMapping->question->answer);
            if ( count($rightAnswers) < $answers )
                return 0;
            $studentCorrectResponses = array_intersect($answers, $rightAnswers);
            $perRightOptionMarks = $examQuestionMapping->marks / $rightAnswers;

            return $studentCorrectResponses * $perRightOptionMarks;

        } else {
            if ( $examQuestionMapping->question->answer == $answers ) {
                return $examQuestionMapping->marks;
            } else {
                return 0;
            }
        }
    }

    public static function getAnswers ($question, $answerIds)
    {
        $answer = '';
        $answerIds = explode(',', $answerIds);
        if ( count($answerIds) > 1 ) {
            foreach ( $answerIds as $answerId ) {
                $answers[] = $question->options[ $answerId - 1 ];
                $answer = implode(',', $answers);
            }
        } else
            $answer = $question->options[ $answerIds[0] - 1 ];

        return $answer;
    }
}