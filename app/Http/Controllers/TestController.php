<?php

namespace App\Http\Controllers;

use App\Http\Helpers\CommonHelper;
use App\Http\Helpers\CustomHelper;
use App\libraries\Utility\RemoteRequest;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function test (Request $request, $data = null)
    {
        return \response()->json(['success' => 'true', 'message' => 'rest in peace bro...','data'=>$data]);
    }

    public function deleteAllClassroomsFromGoogle(Request $request, $data=null)
    {
        set_time_limit(0);
        $token = Session::get('access_token');
        $response = Self::listGoogleClassrooms($token);
        if(isset($response['data']->courses))
            foreach($response['data']->courses as $class){
            $data[] = CommonHelper::delete_class($token['access_token'],$class->id);
            return \response()->json(['success' => 'true', 'message' => 'rest in peace bro...','data'=>$data]);;
            }
        return \response()->json(['success' => 'true', 'message' => 'rest in peace bro...','data'=>$data]);
    }

    public static function listGoogleClassrooms($token)
    {
        $url = "https://classroom.googleapis.com/v1/courses";
        $headers = array(
            "Authorization: Bearer ".$token['access_token'],
        );

        $response = RemoteRequest::getJsonRequest($url, $headers);

        if (!$response['success'] && isset($response['data']->status)) {
            if ($response['data']->status == 'UNAUTHENTICATED') {
                $token = CustomHelper::get_refresh_token($token);
                Log::info($response['data']->status);
                $response = self::listGoogleClassrooms($token); // access Google api craete Cource
            }
        }
        return $response;
    }
}
