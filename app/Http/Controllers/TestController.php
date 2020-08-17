<?php

namespace App\Http\Controllers;

use App\Http\Helpers\CommonHelper;
use App\libraries\Classroom;
use App\Models\ClassSection;
use Session;
use Illuminate\Http\Request;

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
        $response = Classroom::listGoogleClassrooms($token);
        if(isset($response['data']->courses))
            foreach($response['data']->courses as $class){
            $data[] = CommonHelper::delete_class($token['access_token'],$class->id);
            }
        return \response()->json(['success' => 'true', 'message' => 'rest in peace bro...','data'=>$data]);
    }
}
