<?php

namespace App\libraries\Utility;

use App\Models\Examination\ClassroomExaminationMapping;
use App\Models\Examination\ExaminationQuestionMapping;
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


    public static function calculateResult ($examinationId, $classroomId, $studentId)
    {
        $classroomExaminationMappig = ClassroomExaminationMapping::where('examination_id', $examinationId)
            ->where('classroom_id', $classroomId)->get();

        $examinationQuestionMapping = ExaminationQuestionMapping::where('examination_id', $examinationId)
            ->where('classroom_id', $classroomId)->get();

        $totalMarks = $examinationQuestionMapping->sum('marks');

//        $studentResponse = StudentAnswer::where('examination_question_mapping_id',$examinationQuestionMapping)->


    }

    public static function calculateMarks ($examQuestionMapping, $answer, $classroomExamProperties = null)
    {
        if($examQuestionMapping->question->answer == $answer){
            return $examQuestionMapping->marks;
        }else{
            
        }
    }
}