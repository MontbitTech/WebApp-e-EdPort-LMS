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

    public static function checkClassroomAndCreate ($row, $subjectName)
    {
        $classroomsExist = StudentClass::with('studentSubject')->where('class_name', $row['division'])
            ->where('section_name', $row['section'])
            ->whereHas('studentSubject', function ($q) use ($subjectName) {
                $q->where('subject_name', $subjectName);
            })
            ->first();

        if ( $classroomsExist )
            return failure_message('Classroom already Exist :' . $row['division'] . ' ' . $row['section'] . ' ' . $subjectName);

        $subject = StudentSubject::firstOrCreate(['subject_name' => $subjectName]);

        $class = ClassSection::firstOrCreate([
            'class_name'   => $row['division'],
            'section_name' => $row['section'],
        ]);

        $response = self::createGoogleClassroom($row['division'], $row['section'], $subjectName);

        if ( !$response['success'] )
            return $response;

        return success_message(Classroom::createClassroom([
            'class_name'   => $row['division'],
            'section_name' => $row['section'],
            'subject_id'   => $subject->id,
            'g_class_id'   => $response['data']->id,
            'g_link'       => $response['data']->alternateLink,
            'g_response'   => serialize($response['data']),
        ]));
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
                CustomHelper::get_refresh_token();
                $token = CommonHelper::varify_Admintoken(); // verify admin token

                $response = CommonHelper::create_class($token, $data); // access Google api craete Cource
            }
        }

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