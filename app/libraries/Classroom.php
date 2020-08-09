<?php

namespace App\libraries;

use App\Http\Helpers\CommonHelper;
use App\Http\Helpers\CustomHelper;
use App\Models\ClassSection;
use App\StudentClass;
use App\StudentSubject;
use Illuminate\Support\Facades\Log;

/**
 * Class Classroom
 * @package App\libraries
 */
class Classroom
{
    public static function createClassroom ($parameters)
    {
        $classroom = new StudentClass();
        foreach ( $parameters as $key => $value ) {
            $classroom->$key = $value;
        }

        return $classroom->save();
    }

    public static function validateClassroom ($row, $subjectName)
    {
        $classroomsExist = StudentClass::with('studentSubject')->where('class_name', $row['division'])
            ->where('section_name', $row['section'])
            ->whereHas('studentSubject', function ($q) use ($subjectName) {
                $q->where('subject_name', $subjectName);
            })
            ->first();

        if ( $classroomsExist )
            return failure_message('Classroom already Exist :' . $row['division'] . ' ' . $row['section'] . ' ' . $subjectName);

        if($subjectName == '')
            return failure_message('Please add subject');

        if($row['division'] == '' && $row['section'] == '')
            return failure_message('Please add division and section');

        return success_message('validated successfully');
    }

    public static function createSubject ($params)
    {
        $subject = new StudentSubject();
        foreach ( $params as $key => $value ) {
            $subject->$key = $value;
        }

        return $subject->save();
    }

    public static function createClass ($params)
    {
        $subject = new ClassSection();
        foreach ( $params as $key => $value ) {
            $subject->$key = $value;
        }

        return $subject->save();
    }

    public static function createGoogleClassroom ($className, $sectionName, $subjectName)
    {

        $data = array(
            "name"               => $className . ' ' . $subjectName,
            "section"            => $sectionName,
            "descriptionHeading" => "",
            "description"        => "",
            "room"               => "",
            "ownerId"            => "me",
            "courseState"        => "ACTIVE",

        );
        $data = json_encode($data);

        $token = CommonHelper::varify_Admintoken();

        $response = CommonHelper::create_class($token, $data); // access Google api craete Cource

        if ( !$response['success'] ) {
            if ( $response['data']->status == 'UNAUTHENTICATED' ) {
                Log::error($response['data']->message);

                return failure_message('UNAUTHENTICATED');
            }
            Log::error($response['data']->message);

            return $response;
        }

        return $response;
    }
}