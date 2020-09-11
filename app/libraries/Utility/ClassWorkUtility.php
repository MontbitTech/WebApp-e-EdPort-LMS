<?php

namespace App\libraries\Utility;

use App\Http\Helpers\CommonHelper;
use App\Http\Helpers\CustomHelper;

/**
 * Class ClassWorkUtility
 * @package App\libraries\Utility
 */
class ClassWorkUtility
{

    public static function listCourseWorkSubmissions ($classroomId, $courseWorkId)
    {
        $token = CommonHelper::varify_Teachertoken();
        $url = "https://classroom.googleapis.com/v1/courses/" . $classroomId . "/courseWork/" . $courseWorkId . "/studentSubmissions";

        $headers = array(
            "Authorization: Bearer $token",
            "Content-Type: application/json",
        );

        $response = RemoteRequest::getJsonRequest($url, $headers);
        if ( !$response['success'] && isset($response['data']->status) ) {
            if ( $response['data']->status == 'UNAUTHENTICATED' ) {
                $token = CustomHelper::get_refresh_teacher_token();
                $headers = array(
                    "Authorization: Bearer " . $token['access_token'],
                    "Content-Type: application/json",
                );
                $response = RemoteRequest::getJsonRequest($url, $headers);

            }
        }

        return $response;
    }

    public static function calculateGrade ($classWorks)
    {
        foreach ( $classWorks as $classWork ) {
            $response = ClassWorkUtility::listCourseWorkSubmissions($classWork->g_class_id, $classWork->google_classwork_id);
            if ( isset($response['data']->studentSubmissions) ) {
                foreach ( $response['data']->studentSubmissions as $submission ) {
                    if ( isset($submission->draftGrade) ) {
                        $maxPoints = $classWork->g_points ? $classWork->g_points :
                            $submission->submissionHistory[ count($submission->submissionHistory) - 1 ]->gradeHistory->maxPoints;
                        $grades[ $classWork->studentClass->id ][] = number_format(( $submission->draftGrade / $maxPoints ) * 100, 2);
                    }
                }
            }
        }

        $averageOfClasses = array();
        if ( isset($grades) ) {
            foreach ( $grades as $classId => $classGrades ) {
                $averageOf = array();
                foreach ( $classGrades as $classGrade ) {
                    $averageOf[] = $classGrade;
                }
                $averageOfClasses[ $classId ] = array_sum($averageOf) / count($averageOf);
            }
        }

        return $averageOfClasses;
    }
}