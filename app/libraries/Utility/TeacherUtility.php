<?php

namespace App\libraries\Utility;

use App\Http\Helpers\CustomHelper;
use App\Teacher;
use Illuminate\Support\Facades\Log;

/**
 * Class TeacherUtility
 * @package App\libraries\Utility
 */
class TeacherUtility
{
   public static function createTeacher($parameters)
   {
       $teacher = new Teacher();
       foreach($parameters as $key => $value){
            $teacher->$key = $value;
       }

       return $teacher->save();
   }

   public static function createTeacherInGoogleClassroom($token, $data)
   {
    $url = "https://www.googleapis.com/admin/directory/v1/users";
    $headers = array(
        "Authorization: Bearer ".$token['access_token'],
        "Content-Type: application/json",
    );

    $response = RemoteRequest::postJsonRequest($url, $headers, $data);

    if (!$response['success'] && isset($response['data']->status)) {
        Log::error($response);
        if ($response['data']->status == 'UNAUTHENTICATED') {
            $token = CustomHelper::get_refresh_token($token);
            Log::info($response['data']->status);
            $response = self::createTeacherInGoogleClassroom($token, $data); // access Google api craete Cource
        }
    }
    return $response;
   }
}