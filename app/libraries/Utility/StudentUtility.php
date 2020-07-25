<?php

namespace App\libraries\Utility;

use App\Http\Helpers\CommonHelper;
use App\Models\Student;
use App\StudentClass;

/**
 * Class StudentUtility
 * @package App\libraries\Utility
 */
class StudentUtility
{
    public static function createStudent ($parameters)
    {
        $student = new Student();
        foreach ( $parameters as $key => $value ) {
            $student->$key = $value;
        }
        $student->save();

        return $student;
    }

    public static function removeStudentsFromClassroom ($students)
    {
        $token = CommonHelper::varify_Admintoken();
        foreach ( $students as $student ) {
            $invitationResponse = CommonHelper::teacher_invitation_delete($token, $student->invitation_code);

            $studentClasses = StudentClass::where('class_name', $student->class_name)->where('section_name', $student->section_name)->get();

            foreach ( $studentClasses as $studentClass ) {
                $inv_responce = CommonHelper::student_course_delete($token, $student->email, $studentClass->g_class_id);
            }

            $student->delete();
        }
    }

}