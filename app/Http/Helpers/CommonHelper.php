<?php

namespace App\Http\Helpers;

use App\libraries\Utility\RemoteRequest;
use Google_Client;
use Session;

use Google_Service_Classroom;
use Google_Service_Classroom_Course;
use App\Admin;
use Illuminate\Support\Facades\Log;

class CommonHelper
{

    public function __construct ()
    {

//        parent::__construct();

    }

    public static function get_support_number ()
    {
        $admin_data = Admin::all();
        if ( count($admin_data) > 0 ) {
            foreach ( $admin_data as $val ) {
                $phone = $val->phone;

                if ( strlen($phone) <= 10 ) {
                    $number = '91' . $phone;
                } else {
                    $number = $phone;
                }

                $numbers[] = $number;
            }
        }

        return implode(",", $numbers);
    }

    public static function get_assignment_data ($dateClass_id)
    {
        $assignmentData = \DB::select('select tbl_classwork.g_live_link,tbl_classwork.g_title,tbl_classwork.id from tbl_classwork_dateclass JOIN tbl_classwork ON tbl_classwork_dateclass.classwork_id=tbl_classwork.id where tbl_classwork_dateclass.dateclass_id =' . $dateClass_id);

        return $assignmentData;

    }

    public static function send_sms ($number, $message)
    {
        $apiKey = 'X98eAxQtlzQ-fh6xx0z9wJbd4jmMfq8vo2tEro7c8w';//env( 'TEXTLOCAL_APIKEY' );
        $txt_sender = 'TXTLCL';//env( 'TEXTLOCAL_SENDER' );
        //$support_number = env( 'SUPPORT_NUMBER' );
        $sender = urlencode($txt_sender);

        $data = array('apikey' => $apiKey, 'numbers' => $number, "sender" => $sender, "message" => $message);

        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        // Process your response here
        $result = json_decode($response);
        if ( $result->status == 'success' ) {
            return true;
        } else {
            return false;
        }
    }


    public static function varify_Admintoken ()
    {
        $session_token = Session::get('access_token');
        if ( isset($session_token['access_token']) && $session_token['access_token'] ) {
            $token = $session_token['access_token'];

            return $token;
        } else {
            return redirect(url('/'));//->route('/');
        }
    }

    public static function create_new_user ($token, $data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://www.googleapis.com/admin/directory/v1/users",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => $data,
            CURLOPT_HTTPHEADER     => array(
                "Authorization: Bearer $token",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if ( $response === false ) {
            return 101;
        }
        
        if(isset(json_decode($response)->error) && isset(json_decode($response)->error->status)){
            if(json_decode($response)->error->status == 'UNAUTHENTICATED'){
                $token = CustomHelper::get_refresh_token();

                $response =  CommonHelper::create_new_user($token['access_token'], $data);
            }
        }

        return $response;
    }

    public static function update_user ($token, $data, $userKey)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://www.googleapis.com/admin/directory/v1/users/$userKey",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "PUT",
            CURLOPT_POSTFIELDS     => $data,
            CURLOPT_HTTPHEADER     => array(
                "Authorization: Bearer $token",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if ( $response === false ) {
            return 101;
        }

        if(isset(json_decode($response)->error) && isset(json_decode($response)->error->status)){
            if(json_decode($response)->error->status == 'UNAUTHENTICATED'){
                $token = CustomHelper::get_refresh_token();

                $response =  CommonHelper::update_user($token['access_token'], $data, $userKey);
            }
        }

        return $response;
    }

    public static function user_delete ($token, $userKey)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://www.googleapis.com/admin/directory/v1/users/$userKey",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "DELETE",
            CURLOPT_HTTPHEADER     => array(
                "Authorization: Bearer $token",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if ( $response === false ) {
            return 101;
        }

        if(isset(json_decode($response)->error) && isset(json_decode($response)->error->status)){
            if(json_decode($response)->error->status == 'UNAUTHENTICATED'){
                $token = CustomHelper::get_refresh_token();

                $response =  CommonHelper::user_delete($token['access_token'], $userKey);
            }
        }

        return $response;

    }

    public static function create_class ($token, $data)
    {
        $url = "https://classroom.googleapis.com/v1/courses";
        $headers = array(
            "Authorization: Bearer $token",
            "Content-Type: application/json",
        );

        $response = RemoteRequest::postJsonRequest($url, $headers, $data);

        if (!$response['success'] && isset($response['data']->status)) {
            if ($response['data']->status == 'UNAUTHENTICATED') {
                $token = CustomHelper::get_refresh_token();

                $response = CommonHelper::create_class($token['access_token'], $data); // access Google api craete Cource
                //                        return redirect()->route('admin.logout');
            }
        }
        return $response;
//				$curl = curl_init();
//
//				curl_setopt_array($curl, array(
//				  CURLOPT_URL => "https://classroom.googleapis.com/v1/courses",
//				  CURLOPT_RETURNTRANSFER => true,
//				  CURLOPT_ENCODING => "",
//				  CURLOPT_MAXREDIRS => 10,
//				  CURLOPT_TIMEOUT => 0,
//				  CURLOPT_FOLLOWLOCATION => true,
//				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//				  CURLOPT_CUSTOMREQUEST => "POST",
//				  CURLOPT_POSTFIELDS =>$data,
//				  CURLOPT_HTTPHEADER => array(
//					"Authorization: Bearer $token",
//					"Content-Type: application/json"
//				  ),
//				));
//
//				$response = curl_exec($curl);
//				if($response === false)
//				{
//					return 101;
//				}
//			curl_close($curl);
    }

    public static function delete_class ($token, $g_id)
    {
        $url = "https://classroom.googleapis.com/v1/courses/$g_id";
        $headers = array(
            "Authorization: Bearer $token",
        );

        $response = RemoteRequest::deleteJsonRequest($url, $headers);

        if (!$response['success'] && isset($response['data']->status)) {
            if ($response['data']->status == 'UNAUTHENTICATED') {
                $token = CustomHelper::get_refresh_token();

                $response = CommonHelper::delete_class($token['access_token'], $g_id); // access Google api craete Cource
            }
        }

        return $response;
//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL            => "https://classroom.googleapis.com/v1/courses/$g_id",
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING       => "",
//            CURLOPT_MAXREDIRS      => 10,
//            CURLOPT_TIMEOUT        => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST  => "DELETE",
//            CURLOPT_HTTPHEADER     => array(
//                "Authorization: Bearer $token",
//            ),
//        ));
//
//        $response = curl_exec($curl);
//        if ( $response === false ) {
//            return 101;
//        }
//        curl_close($curl);
//
//        return $response;
    }

    public static function teacher_invitation_forClass ($token, $inv_data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://classroom.googleapis.com/v1/invitations",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => $inv_data,
            CURLOPT_HTTPHEADER     => array(
                "Authorization: Bearer $token",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if ( $response === false ) {
            return 101;
        }

        if(isset(json_decode($response)->error) && isset(json_decode($response)->error->status)){
            if(json_decode($response)->error->status == 'UNAUTHENTICATED'){
                $token = CustomHelper::get_refresh_token();

                $response =  CommonHelper::teacher_invitation_forClass($token['access_token'], $inv_data);
            }
        }

        return $response;

    }


    public static function student_course_delete ($token, $student, $class_g_code)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://classroom.googleapis.com/v1/courses/$class_g_code/students/$student",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "DELETE",
            CURLOPT_HTTPHEADER     => array(
                "Authorization: Bearer $token",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if ( $response === false ) {
            return 101;
        }

        if(isset(json_decode($response)->error) && isset(json_decode($response)->error->status)){
            if(json_decode($response)->error->status == 'UNAUTHENTICATED'){
                $token = CustomHelper::get_refresh_token();

                $response =  CommonHelper::student_course_delete($token['access_token'], $student, $class_g_code);
            }
        }

        return $response;
    }

    public static function teacher_invitation_delete ($token, $prve_g_code)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://classroom.googleapis.com/v1/invitations/$prve_g_code",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "DELETE",
            CURLOPT_HTTPHEADER     => array(
                "Authorization: Bearer $token",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if ( $response === false ) {
            return 101;
        }

        if(isset(json_decode($response)->error) && isset(json_decode($response)->error->status)){
            if(json_decode($response)->error->status == 'UNAUTHENTICATED'){
                $token = CustomHelper::get_refresh_token();

                $response =  CommonHelper::teacher_invitation_delete($token['access_token'], $prve_g_code);
            }
        }

        return $response;
    }

    // used in teacher module

    public static function varify_Teachertoken ()
    {
        $session_token = Session::get('access_token_teacher');
        if ( isset($session_token['access_token']) && $session_token['access_token'] ) {
            $token = $session_token['access_token'];

            return $token;
        } else {
            return redirect(url('/'));//->route('/');
        }
    }

    public static function create_topic ($token, $g_class_id, $data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://classroom.googleapis.com/v1/courses/$g_class_id/topics",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => $data,
            CURLOPT_HTTPHEADER     => array(
                "Authorization: Bearer $token",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if ( $response === false ) {
            return 101;
        }
        
        if(isset(json_decode($response)->error) && isset(json_decode($response)->error->status)){
            if(json_decode($response)->error->status == 'UNAUTHENTICATED'){
                $token = CustomHelper::get_refresh_teacher_token();

                $response =  CommonHelper::create_topic($token['access_token'], $g_class_id, $data);
            }
        }

        return $response;
    }

    public static function create_courcework ($token, $g_class_id, $data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://classroom.googleapis.com/v1/courses/$g_class_id/courseWork",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => $data,
            CURLOPT_HTTPHEADER     => array(
                "Authorization: Bearer $token",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if ( $response === false ) {
            return 101;
        }

        if(isset(json_decode($response)->error) && isset(json_decode($response)->error->status)){
            if(json_decode($response)->error->status == 'UNAUTHENTICATED'){
                $token = CustomHelper::get_refresh_token();

                $response =  CommonHelper::create_courcework($token['access_token'], $g_class_id, $data);
            }
        }

        return $response;
    }

    public static function acceptClassInvitation ($token, $code)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://classroom.googleapis.com/v1/invitations/$code:accept",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_HTTPHEADER     => array(
                "Authorization: Bearer $token",
                'Content-Length: 0',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if ( $response === false ) {
            return 101;
        }
        
        if(isset(json_decode($response)->error) && isset(json_decode($response)->error->status)){
            if(json_decode($response)->error->status == 'UNAUTHENTICATED'){
                $token = CustomHelper::get_refresh_teacher_token();

                $response =  CommonHelper::acceptClassInvitation($token['access_token'], $code);
            }
        }

        return $response;
    }

    public static function createAnnouncement($token, $classId, $data){

        $url = 'https://classroom.googleapis.com/v1/courses/'.$classId.'/announcements';
        $headers = array(
            "Authorization: Bearer $token",
            "Content-Type: application/json",
        );

        $response = RemoteRequest::postJsonRequest($url, $headers,$data);

        if (!$response['success'] && isset($response['data']->status)) {
            if ($response['data']->status == 'UNAUTHENTICATED') {
                $token = CustomHelper::get_refresh_teacher_token();

                $response = CommonHelper::createAnnouncement($token['access_token'], $classId, $data); // access Google api craete Cource
            }
        }

        return $response;
    }
}