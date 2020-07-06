<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Classroom;
use Google_Service_Classroom_Course;
use Exception;
use Google_Service_Sheets;
use Google_Service_Drive;
use Session;
use Google_Service_Classroom_Teacher;
use Helper;
use PDF;
use App\Http\Helpers\CustomHelper;
use Mail;

class GtestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        echo "Success";
    }

	
	public function downloadPDF() {
       
		
		$support_help = \App\SupportHelp::where('read_status',0)->update(['read_status' => 1]);
    	$support_help = \App\SupportHelp::orderBy('status','DESC')->get();
		//return view('admin.sample_pdf',compact('support_help'))->with('i',0);
		
        $pdf = PDF::loadView('admin.sample_pdf', compact('support_help'));
        $file_name = "Class 6-A.pdf";
        return $pdf->download($file_name);
	}
	
	
    public function create_class()
    {
        $client = new Google_Client();
        $client->setAuthConfig('../credentials.json');

      /*   $data = file_get_contents('../credentials.json');
         echo  $data;
        exit; */
      //  $client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
       // $client->addScope('https://www.googleapis.com/auth/classroom.courses');
        $session_token = Session::get('access_token');

      //Session::forget('access_token');
        
       /*  echo "<pre>";
        print_r($session_token);
        echo "</pre>";
        exit;  */

        if (isset($session_token['access_token']) && $session_token['access_token']) {
         
        $client->setAccessToken($session_token['access_token']);
		$service = new Google_Service_Classroom($client); 
       // $client->addScope($session_token['scope']);


         /*  $drive = new Google_Service_Drive($client);
          $files = $drive->files->listFiles(array())->getItems();
          echo json_encode($files); */
          
           $service = new Google_Service_Classroom($client);  
          $course = new Google_Service_Classroom_Course(array(
            'name' => '101 Grade Biology',
            'section' => 'Period 1',
            'descriptionHeading' => 'Welcome to 10th Grade Biology',
            'description' => 'We\'ll be learning about about the structure of living ' .
                             'creatures from a combination of textbooks, guest ' .
                             'lectures, and lab work. Expect to be excited!',
            'room' => '301',
            'ownerId' => '103666456079001911888',
			
            'courseState' => 'PROVISIONED'
          ));
          $course = $service->courses->create($course);
             echo $course->id ." => ".$course->name; 
			 
			/*  $courseId = '95715084659';
			$teacherEmail = 'test@montbit.tech';
			$teacher = new Google_Service_Classroom_Teacher(array(
			  'userId' => $teacherEmail
			));
			try {
			  $teacher = $service->courses_teachers->create($courseId, $teacher);
			  print_r("User '%s' was added as a teacher to the course with ID '%s'.\n",
				  $teacher->profile->name->fullName, $courseId);
			} catch (Google_Service_Exception $e) {
			  if ($e->getCode() == 409) {
				print_r("User '%s' is already a member of this course.\n", $teacherEmail);
			  } else {
				throw $e;
			  }
			} */
			 
			 


       
        } else {
          //$redirect_uri = 'http://127.0.0.1:8000/get_token';
         // header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));

            $res = Helper::get_token_forClass();
                
            return redirect()->route('admin.dashboard');

        }
          
    }

     public function get_token(Request $request)
    {
        
        $client = new Google_Client();
        $client->setAuthConfigFile('../credentials.json');
        $client->setRedirectUri('http://lms.schooltimes.ca/public/get_token');
        
       $client->addScope('https://www.googleapis.com/auth/classroom.courses');
       $client->addScope('https://www.googleapis.com/auth/classroom.coursework.students');
       $client->addScope('https://www.googleapis.com/auth/classroom.rosters');
       $client->addScope('https://www.googleapis.com/auth/admin.directory.user');
       $client->addScope('https://www.googleapis.com/auth/userinfo.email');
       $client->addScope('https://www.googleapis.com/auth/classroom.topics');

        if (! isset($_GET['code'])) 
        {
            $auth_url = $client->createAuthUrl();
            //echo filter_var($auth_url, FILTER_SANITIZE_URL);
            return redirect($auth_url);
           //header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
        } 
        else 
        {

            $client->authenticate($_GET['code']);

           /*  echo '<pre>';  
            print_r($client);//->getAccessToken());
            echo '</pre>';   */
   

            Session::put('access_token',$client->getAccessToken());
            print_r(Session::get('access_token'));
            exit;
            //$redirect_uri = 'http://127.0.0.1:8000';
            //header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
         //  return redirect()->route('/');
        }
    }


    public function get_course()
    {
        $pageToken = NULL;
        $courses = array();
        $client = new Google_Client();
       
        do {
        $params = array(
            'pageSize' => 100,
            'pageToken' => $pageToken
        );

        $session_token = Session::get('access_token');
        $client->setAccessToken($session_token['access_token']);
        $service = new Google_Service_Classroom($client);  
        $response = $service->courses->listCourses($params);
        $courses = array_merge($courses, $response->courses);
        $pageToken = $response->nextPageToken;
        } while (!empty($pageToken));

        if (count($courses) == 0) {
        print "No courses found.\n";
        } else {
        print "Courses:\n";
        foreach ($courses as $course) {
            printf("%s (%s)\n", $course->name, $course->id);
        }
        }
    }

    public function create_teacher()
    {
            $courseId = '95258942413';
            $teacherEmail = 'socialpilgrim@gmail.com';
            $client = new Google_Client();
            $session_token = Session::get('access_token');
            $client->setAccessToken($session_token['access_token']);
            $service = new Google_Service_Classroom($client);  

            $teacher = new Google_Service_Classroom_Teacher(array(
            'userId' => $teacherEmail
            ));
            try {
            $teacher = $service->courses_teachers->create($courseId, $teacher);
            printf("User '%s' was added as a teacher to the course with ID '%s'.\n",
                $teacher->profile->name->fullName, $courseId);
            } catch (Google_Service_Exception $e) {
            if ($e->getCode() == 409) {
                printf("User '%s' is already a member of this course.\n", $teacherEmail);
            } else {
                throw $e;
            }
            }
    }
	
	public function create_user()
	{
		$session_token = Session::get('access_token');
		$token = $session_token['access_token'];
		
		$data = array( "name"=> array(
							"familyName"=> "test3",
							"givenName"=> "user3",
							"fullName"=> "test user 3"
						  ),
						  "password"=> "12345678",
						  "primaryEmail"=> "patel@montbit.tech"
						);	
				$data = json_encode($data);
		

				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://www.googleapis.com/admin/directory/v1/users",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$data,
				  CURLOPT_HTTPHEADER => array(
					"Authorization: Bearer $token",
					"Content-Type: application/json"
				  ),
				));

				$response = curl_exec($curl);

				curl_close($curl);
				echo $response;

	}

    public function set_course()
    {

        
        $client = new Google_Client();

		$service = new Google_Service_Classroom($client);

       /* echo '<pre>';    
        print_r($service);
        echo '</pre>'; */

        $course = new Google_Service_Classroom_Course(array(
            'name' => '10th Grade Biology',
            'section' => 'Period 2',
            'descriptionHeading' => 'Welcome to 10th Grade Biology',
            'description' => 'We\'ll be learning about about the structure of living ' .
                             'creatures from a combination of textbooks, guest ' .
                             'lectures, and lab work. Expect to be excited!',
            'room' => '301',
            'ownerId' => 'me',
            'courseState' => 'PROVISIONED'
          ));
          $course = $service->courses->create($course);
          echo $course->id ." => ".$course->name;
          // print_r("Course created: %s (%s)\n", $course->name, $course->id);

        
    }
	public function test_user_permission(Request $request)
	{
		
		$id = $request->get('id');
		$session_token = Session::get('access_token');
		$token = $session_token['access_token'];
		$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://classroom.googleapis.com/v1/userProfiles/$id",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			    CURLOPT_HTTPHEADER => array(
					"Authorization: Bearer $token"
				  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			
			echo $response;
	}
	
	
	
	public function TestFilterTimetable($class,$section)
	{
		$class_name = decrypt($class);//$request->txtclass;
		$section_name = decrypt($section);// $request->txtsubject;
		
		/* echo $class_name;
		echo $section_name;
		exit;
		 */
		$i = 1;
		$p = 1;
		$html = "";
		
		$cl = $class_name." ".$section_name;
		
		$ttime = \DB::select ('SELECT DISTINCT from_timing FROM `tbl_class_timings` ORDER by from_timing');
		
		
		$days = "";
		$htmla = "";
		$html = "
		
		<style type='text/css'>
			body {
				background-color: #f6f6ff;
				font-family: Calibri, Myriad;
			}

			table.timecard {
				margin: auto;
				width: 1400px;
				border-collapse: collapse;
				border: 1px solid #fff; /*for older IE*/
				border-style: hidden;
			}

			.caption {
				background-color: #f79646;
				color: #fff;
				font-size: 32px;
				font-weight: bold;
				letter-spacing: .3em;
				line-height:2.5em;
			}

			table.timecard thead th {
				padding: 8px;
				background-color: #fde9d9;
				font-size: large;
			}

			table.timecard thead th#thDay {
				width: 40%;	
			}

			.special {
				background:#222 !important;
				color:#fff;	
				font-size:25px !important;
				font-weight:600;
			}

			table.timecard thead th#thRegular, table.timecard thead th#thOvertime, table.timecard thead th#thTotal {
				width: 20%;
			}

			.odd{
			background:#fff !important;
			}

			.even{
			background:#eee !important;
			}

			table.timecard th, table.timecard td {
				padding: 3px;
				border-width: 1px;
				border-style: solid;
				border-color: #f79646 #ccc;
			}

			table.timecard td {
				text-align: center;
				height:2.5em;
			}

			table.timecard tbody th {
				text-align: left;
				font-weight: normal;
			}

			table.timecard tfoot {
				font-weight: bold;
				font-size: large;
				background-color: #687886;
				color: #fff;
			}

			table.timecard tr.even {
				background-color: #fde9d9;
			}
		</style>";
		
		$html .= "<table class='timecard'>
					<tbody>
						<tr><td colspan=8 class='caption'>TimeTable 2020-21</td></tr>
						<tr style='font-weight:900;font-size:22px;'>
							<td class='special'>CLASS $cl</td><td >Time</td><td>Monday</td><td>Tuesday</td><td>Wednesday</td> <td>Thursday</td><td>Friday</td><td>Saturday</td>
						</tr>";
						
		$htmla .= "<table id='teacherlist' class='table table-sm table-bordered display' style='width:100%' data-page-length='25' data-order='[[ 2, &quot;asc&quot; ]]' data-col1='60' data-collast='120' data-filterplaceholder='Search Records ...'>
					<tbody>
						<tr><td colspan=8>TimeTable 2020-21</td></tr>
						<tr style='font-weight:600;font-size:14px;'>
							<td style='width:120px;background:#222 !important;color:white;font-size:20px;'>CLASS $cl</td><td>Time</td><td>Monday</td><td>Tuesday</td><td>Wednesday</td> <td>Thursday</td><td>Friday</td><td>Saturday</td>
						</tr>";
		
						foreach($ttime as $t)
						{
							$days = \DB::select ("SELECT t.from_timing, t.to_timing, r.name, s.subject_name , t.is_lunch, r.g_meet_url
													FROM tbl_class_timings t
													left join tbl_student_subjects s on s.id = t.subject_id
													left join tbl_student_classes c on c.id = t.class_id
													left join tbl_techers r on r.id = t.teacher_id
													where c.class_name = ? and c.section_name=?
													and from_timing = ?", [$class_name , $section_name, $t->from_timing]);
					
							if(count($days) > 0)
							{			
								foreach($days as $d)
								{
									if($p % 2 == 0)
										$x = "even";
									else
										$x = "odd";
									
									if($i == 1)
									{
										$html .= "<tr class='$x'><td><strong>Period $p</strong></td><td>".date('H:i',strtotime($d->from_timing))."-".date('H:i',strtotime($d->to_timing))."</td>";
										$htmla .= "<tr class='$x'><td>Period $p</td><td style='width:100px;'>".date('H:i',strtotime($d->from_timing))."-".date('H:i',strtotime($d->to_timing))."</td>";
									}
									
									if(empty($d->g_meet_url))
										$e  =  $d->name."(<strong>".$d->subject_name ."</strong>)";
									else
										$e  =  "<a target='_blank' href='".$d->g_meet_url."'>".$d->name."(<strong>".$d->subject_name ."</strong>)</a>";
									
									$html .= "<td>".($d->is_lunch == 1 ? "LUNCH" : $e )."</td>";
									$htmla .= "<td>".($d->is_lunch == 1 ? "LUNCH" : $e)."</td>";
									//$html .= "<td>".$d->name."</td>";
									$i++;
								}
								$p++;
								$i = 1;
								$html .= "</tr>";
								$htmla .= "</tr>";
							}
						}
		
		$html .= "</tbody></table>";
		$htmla .= "</tbody></table>";
		
		//echo($html);
		//Log::error($html);
		
		
		
		
		$name = public_path('dl-timetable')."/".$class_name."_".$section_name."_timetable.pdf";
		
		if(file_exists($name))
			unlink($name);
		
		//$pdf = PDF::loadHTML($html);
		$pdf = PDF::loadHTML($html)->setPaper('a3', 'landscape')->setWarnings(false)->save($name);

		return response()->download($name);
	}
	
	public function send_email_timeTable()
	{
		$domain = CustomHelper::getDomain();
		$from = CustomHelper::getFromMail();
		$domain_name = $domain->value;
		
		$s = 'A';
		$c = 10;
		$class = encrypt($c);
		$section = encrypt($s);
		
		$timeTable_url = "http://lms.".$domain_name."/public/timeTable/".$class."/".$section."";
		
		$name = "RITESH";
		$data_mail = array('name'=>$name,'timetable_url'=>$timeTable_url);
		$email = "ritesh696@gmail.com";
					
					 Mail::send('mail.mail_timetable', $data_mail, function($message) use($email,$from) 
					 {
						 $message->to($email);
						 $message->subject('New Time Table');
						 //$message->from('noreply@montbit.com','MontBIt');
						 $message->from($from->value,'MontBIt');
					  });
					  
				if( count(Mail::failures()) > 0 ) 
				{
				   foreach(Mail::failures as $email_address) {
					  $er .= $email_address;
					}

				} else {
					$er= "Notification sent successfully!";
				}
				
				
				echo $er;
				exit;
				
		
	}
	
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function quickstart()
    {
        
      
            $client = new Google_Client();
           // $client->setAuthConfig(__DIR__.'\credentials.json');
           // $client->setApplicationName('Quickstart');
          //  $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
            
            echo '<pre>'; 
            print_r($client);
            echo '</pre>';
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
