<?php

namespace App\libraries\Utility;

use App\Http\Helpers\CommonHelper;
use App\Http\Helpers\CustomHelper;
use App\Teacher;
use Illuminate\Support\Facades\Log;

/**
 * Class TeacherUtility
 * @package App\libraries\Utility
 */
class TeacherUtility
{
    /**
     * @param $parameters
     * @return bool
     */
    public static function createTeacher ($parameters)
    {
        $teacher = new Teacher();
        foreach ( $parameters as $key => $value ) {
            $teacher->$key = $value;
        }

        return $teacher->save();
    }

    /**
     * @param $token
     * @param $data
     * @return array|mixed
     */
    public static function createTeacherInGoogleClassroom ($token, $data)
    {
        $url = "https://www.googleapis.com/admin/directory/v1/users";
        $headers = array(
            "Authorization: Bearer " . $token['access_token'],
            "Content-Type: application/json",
        );

        $response = RemoteRequest::postJsonRequest($url, $headers, $data);

        if ( !$response['success'] && isset($response['data']->status) ) {
            Log::error($response);
            if ( $response['data']->status == 'UNAUTHENTICATED' ) {
                $token = CustomHelper::get_refresh_token($token);
                Log::info($response['data']->status);
                $response = self::createTeacherInGoogleClassroom($token, $data); // access Google api craete Cource
            }
        }

        return $response;
    }

    /**
     * @param $notificationMessage
     * @param $googleClassroomId
     */
    public static function createAnnouncementInClassroom ($notificationMessage, $googleClassroomId)
    {
        $token = CommonHelper::varify_Teachertoken();
        $data = array(
            'text' => $notificationMessage,
        );

        CommonHelper::createAnnouncement($token, $googleClassroomId, json_encode($data));
    }
}