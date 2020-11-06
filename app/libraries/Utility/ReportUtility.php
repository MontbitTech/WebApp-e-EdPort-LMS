<?php

namespace App\libraries\Utility;

use App\ClassWork;
use App\StudentClass;
use App\Http\Helpers\CommonHelper;
use App\Http\Helpers\CustomHelper;
use App\Models\ClassSection;

/**
 * Class ReportUtility
 * @package App\libraries\Utility
 */
class ReportUtility
{
    /**
     * @param $teacherId
     * @return array
     */
    public static function getAssignmentSubmissionGrades ($teacherId)
    {
        $verifyToken = CommonHelper::varify_Teachertoken();
        $refreshToken = CustomHelper::get_refresh_teacher_token();

        $classWorks = ClassWork::with('studentClass', 'studentClass.dateClass')
            ->whereHas('studentClass.dateClass', function ($q) use ($teacherId) {
                $q->where('teacher_id', $teacherId);
            })
            ->get();
        $isStudentGrade = false;

        return ClassWorkUtility::calculateGrade($classWorks,$isStudentGrade, $verifyToken , $refreshToken);
    }

    public static function getAssignmentSubmissionGradesAdmin ($isStudentGrade)
    {
        $verifyToken = CommonHelper::varify_Admintoken();
        $refreshToken = CustomHelper::get_refresh_token();
        $classWorks = ClassWork::with('studentClass', 'studentClass.dateClass','student')->get();

        return ClassWorkUtility::calculateGrade($classWorks, $isStudentGrade,$verifyToken , $refreshToken);
    }

    /**
     * @param $teacherId
     * @return array
     */
    public static function getAttedanceAverage ($teacherId)
    {
        $classrooms = StudentClass::with('dateClass')->whereHas('dateClass', function ($q) use ($teacherId) {
            $q->where('teacher_id', $teacherId);
        })->get();

        return ClassWorkUtility::calculateAttedance($classrooms);
    }

    public static function getClassAttedanceAverage ()
    {
        $classrooms = StudentClass::with('dateClass')->get();
        return ClassWorkUtility::calculateAttedance($classrooms);
    }
}