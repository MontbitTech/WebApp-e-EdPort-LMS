<?php
namespace App\Http\Helpers;
use Google_Client;
use Session;
use App\ClassTopic;
use App\DateClass;
use DB;
class CustomHelper
{
	
	public static function addOrdinalNumberSuffix($num) {
	    if (!in_array(($num % 100),array(11,12,13))){
	      switch ($num % 10) {
	        // Handle 1st, 2nd, 3rd
	        case 1:  return $num.'st';
	        case 2:  return $num.'nd';
	        case 3:  return $num.'rd';
	      }
	    }
	    return $num.'th';
	}
    public static function get_user_from_token($id_token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.googleapis.com/oauth2/v1/tokeninfo?id_token=$id_token",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return $response;
        
    }
     public static function set_token_admin()
    {
        
       $client = new Google_Client();
       $client->setAuthConfigFile('../credentials.json');
       $client->addScope('https://www.googleapis.com/auth/classroom.courses');
       $client->addScope('https://www.googleapis.com/auth/classroom.coursework.students');
       $client->addScope('https://www.googleapis.com/auth/classroom.rosters');
       $client->addScope('https://www.googleapis.com/auth/admin.directory.user');
       $client->addScope('https://www.googleapis.com/auth/userinfo.email');
       $client->addScope('https://www.googleapis.com/auth/classroom.topics');
     
       //$client->setRedirectUri('http://lms.schooltimes.ca/public/admin/login');

        $auth_url = $client->createAuthUrl();
      
        return $auth_url;
      
    } 
       
        
    public static function get_token_admin($code)
    {

        $client = new Google_Client();
        $client->setAuthConfigFile('../credentials.json');
        $client->addScope('https://www.googleapis.com/auth/classroom.courses');
        $client->addScope('https://www.googleapis.com/auth/classroom.coursework.students');
        $client->addScope('https://www.googleapis.com/auth/classroom.rosters');
        $client->addScope('https://www.googleapis.com/auth/admin.directory.user');
        $client->addScope('https://www.googleapis.com/auth/userinfo.email');
		 $client->addScope('https://www.googleapis.com/auth/classroom.topics');
        
       $client->authenticate($code);
	//dd($client->getAccessToken());
        Session::put('access_token',$client->getAccessToken());
        return true;//redirect()->route('/');
    }
 
    // For Teacher get/set  auth token
    public static function set_token_teacher()
    {
        
       $client = new Google_Client();
       $client->setAuthConfigFile('../credentials_teacher.json');
       $client->addScope('https://www.googleapis.com/auth/classroom.courses');
       $client->addScope('https://www.googleapis.com/auth/classroom.coursework.students');
       $client->addScope('https://www.googleapis.com/auth/classroom.rosters');
       $client->addScope('https://www.googleapis.com/auth/admin.directory.user');
       $client->addScope('https://www.googleapis.com/auth/userinfo.email');
       $client->addScope('https://www.googleapis.com/auth/classroom.topics');
       
      // $client->setRedirectUri('http://lms.schooltimes.ca/public/teacher/login');

        $auth_url = $client->createAuthUrl();
      
        return $auth_url;
      
    } 
       
        
    public static function get_token_teacher($code)
    {

        $c = new Google_Client();
        $c->setAuthConfigFile('../credentials_teacher.json');


       /*  $data = file_get_contents('../credentials_teacher.json');
         echo  $data;
        exit;  */
        $c->addScope('https://www.googleapis.com/auth/classroom.courses');
        $c->addScope('https://www.googleapis.com/auth/classroom.coursework.students');
        $c->addScope('https://www.googleapis.com/auth/classroom.rosters');
        $c->addScope('https://www.googleapis.com/auth/admin.directory.user');
        $c->addScope('https://www.googleapis.com/auth/userinfo.email');
        $c->addScope('https://www.googleapis.com/auth/classroom.topics');
        
       $c->authenticate($code);


        Session::put('access_token_teacher',$c->getAccessToken());
        return true;//redirect()->route('/');
    } 


	public static function getCMSTopics($class_id,$subject_id)
	{
		
		$cmsData=\DB::select('select * from tbl_cmslinks where class="'.$class_id.'" and subject="'.$subject_id.'"');
		return $cmsData;//ClassTopic::where(['class_id'=>$class_id])->get();
	}

	public static function getTopicById($id)
	{
		return ClassTopic::with('classwork')->find($id);
	}

	public static function getCurrentYear()
	{
		$year = \DB::table('tbl_settings')->where('item','year')->get();
		return $year;
	}
	
	
	public static function getDomain()
	{
		$domain = \DB::table('tbl_settings')->where('item','domain')->get()->first();
		return $domain;
	}

	public static function getSchool()
	{
		$school = \DB::table('tbl_settings')->where('item','like','school%')->get();
		
		return $school;
	}
	
	public static function getFromMail()
	{
		$mailfrom = \DB::table('tbl_settings')->where('item','mailfrom')->get()->first();
		return $mailfrom;
	}
	
	
	public static function getDomainFromEmail($email_address)
	{
		$email_parts = explode( '@', $email_address );
		$domain = array_pop( $email_parts );
		return $domain;
	}
	public static function is_email($email_address) 
	{
		if ( filter_var ( $email_address, FILTER_VALIDATE_EMAIL ) ) {
		  return true;
		}
		return false;
	}
	
	public static function is_url($url) 
	{
		$path = parse_url($url, PHP_URL_PATH);
		$encoded_path = array_map('urlencode', explode('/', $path));
		$url = str_replace($path, implode('/', $encoded_path), $url);

		return filter_var($url, FILTER_VALIDATE_URL) ? true : false;
	}
	
	public static function enableOptions()
	{
		$s = array();
		
		$s["teacher"] = \DB::table('tbl_techers')->get()->count();
		$s["classes"] = \DB::table('tbl_student_classes')->get()->count();
		$s["timetable"] = \DB::table('tbl_class_timings')->get()->count();
		$s["student"] = \DB::table('tbl_students')->get()->count();
		$s["cmslinks"] = \DB::table('tbl_cmslinks')->get()->count();
		$s["support"] = \DB::table('tbl_support_help')->get()->count();

		return $s;
	}
	
		
	public static function latestTicket()
	{
		$s = \DB::select("select t.name,t.phone, s.description, s.class_join_link 
							from tbl_support_help s, tbl_techers t 
							where t.id = s.teacher_id 
								and s.status='1' 
								order by s.updated_at 
								desc limit 1");
		
		return $s;
	}
	
	public static function onGoingClasses()
	{
		$s = \DB::select("SELECT d.class_date,  d.from_timing , d.to_timing, t.g_meet_url, s.subject_name,  t.name, c.class_name, c.section_name
							FROM tbl_dateclass d, tbl_techers t, tbl_student_subjects s, tbl_student_classes c
							where d.class_date = CURDATE()
							and d.subject_id = s.id
							and d.teacher_id = t.id
							and c.id = d.class_id
							order by d.from_timing");
		return $s;
	}
		
}
