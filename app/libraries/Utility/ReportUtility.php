<?php

namespace App\libraries\Utility;

use App\ClassWork;
use App\StudentClass;
use App\Models\Student;
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
        $classWorks = ClassWork::with('studentClass', 'studentClass.dateClass')
            ->whereHas('studentClass.dateClass', function ($q) use ($teacherId) {
                $q->where('teacher_id', $teacherId);
            })
            ->get();
        return ClassWorkUtility::calculateGrade($classWorks, $verifyToken);
    }

    public static function getAssignmentSubmissionGradesAdmin ()
    {
        $verifyToken = CommonHelper::varify_Admintoken();
        $classWorks = ClassWork::with('studentClass', 'studentClass.dateClass')->get();

        return ClassWorkUtility::calculateGrade($classWorks,$verifyToken);
    }

    public static function getClassAssignmentSubmissionGrades()
    {
        $classWorks = ClassWork::with('studentClass', 'studentClass.dateClass')->get();

        return ClassWorkUtility::calculateGrade($classWorks);
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