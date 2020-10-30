<?php

namespace App\libraries\Utility;

use App\Http\Helpers\CommonHelper;
use App\Http\Helpers\CustomHelper;
use App\Models\Attendance;

/**
 * Class ClassWorkUtility
 * @package App\libraries\Utility
 */
class ClassWorkUtility
{

    public static function listCourseWorkSubmissions ($classroomId, $courseWorkId,$token, $refreshToken)
    {
        // $token = CommonHelper::varify_Teachertoken();
        $url = "https://classroom.googleapis.com/v1/courses/" . $classroomId . "/courseWork/" . $courseWorkId . "/studentSubmissions";

        $headers = array(
            "Authorization: Bearer $token",
            "Content-Type: application/json",
        );

        $response = RemoteRequest::getJsonRequest($url, $headers);
        if ( !$response['success'] && isset($response['data']->status) ) {
            if ( $response['data']->status == 'UNAUTHENTICATED' ) {
                // $token = CustomHelper::get_refresh_teacher_token();
                $headers = array(
                    "Authorization: Bearer " . $refreshToken['access_token'],
                    "Content-Type: application/json",
                );
                $response = RemoteRequest::getJsonRequest($url, $headers);

            }
        }

        return $response;
    }

    public static function calculateGrade ($classWorks, $verifyToken, $refreshToken){    
        foreach ( $classWorks as $classWork ) {
            $response = ClassWorkUtility::listCourseWorkSubmissions($classWork->g_class_id, $classWork->google_classwork_id,$verifyToken, $refreshToken);
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

    public static function calculateAttedance ($classrooms)
    {
        $attendanceAverage = array();
        foreach ( $classrooms as $classroom ) {
            $presentStudent = $totalAttendance = 0;

            foreach ( $classroom->dateClass as $dateClass ) {
                $totalAttendance += Attendance::where('dateclass_id', $dateClass->id)->count();
                $presentStudent += Attendance::present()->where('dateclass_id', $dateClass->id)->count();
            }

            if ( $totalAttendance ) {
                $attendanceAverage[ $classroom->id ] = number_format(( $presentStudent / $totalAttendance ) * 100, 2);
            } else {
                $attendanceAverage[ $classroom->id ] = 0;
            }
        }

        return $attendanceAverage;
    }
}