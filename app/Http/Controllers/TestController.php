<?php

namespace App\Http\Controllers;

use App\Http\Helpers\CommonHelper;
use App\libraries\Classroom;
use App\libraries\Utility\DateUtility;
use App\Models\ClassSection;
use App\Http\Helpers\CustomHelper;
use App\libraries\Utility\RemoteRequest;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function test (Request $request, $data = null)
    {
        $token = CommonHelper::varify_Admintoken();
        $mail = "krtrth.bilory@gmail.com";
        $url = "https://classroom.googleapis.com/v1/courses/153740616138/courseWork/154091399099/studentSubmissions";
        $headers = array(
            "Authorization: Bearer $token",
            "Content-Type: application/json",
        );

//        $params = array(
//            "userId" => $mail,
//        );
//        $params = json_encode($params);
        $data = RemoteRequest::getJsonRequest($url, $headers);
        if ( !$data['success'] && isset($data['data']->status) ) {
            if ( $data['data']->status == 'UNAUTHENTICATED' ) {
                $token = CustomHelper::get_refresh_token();
                $headers = array(
                    "Authorization: Bearer " . $token['access_token'],
                    "Content-Type: application/json",
                );
                $data = RemoteRequest::getJsonRequest($url, $headers); // access Google api craete Cource
                //                        return redirect()->route('admin.logout');
            }
        }
//        $timestamp = strtotime($data['data']->studentSubmissions[0]->submissionHistory[0]->stateHistory->stateTimestamp);
//        dd(DateUtility::getDateTime($timestamp), $data['data']->studentSubmissions[0]->submissionHistory[0]->stateHistory->stateTimestamp);

        return \response()->json(['success' => 'true', 'message' => 'rest in peace bro...', 'data' => $data]);
    }

    public function deleteAllClassroomsFromGoogle (Request $request, $data = null)
    {
        set_time_limit(0);
        $token = Session::get('access_token');
        $response = Classroom::listGoogleClassrooms($token);
        if ( isset($response['data']->courses) )
            foreach ( $response['data']->courses as $class ) {
                $data[] = CommonHelper::delete_class($token['access_token'], $class->id);
            }

        return \response()->json(['success' => 'true', 'message' => 'rest in peace bro...', 'data' => $data]);
    }
}
