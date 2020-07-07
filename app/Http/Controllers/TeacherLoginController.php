<?php

namespace App\Http\Controllers;
use App\HelpTicketCategory;
use App\Http\Helpers\CustomHelper;
use Illuminate\Support\Facades\Config;
use App\Teacher;
use Illuminate\Http\Request;
use Google_Client;
use Session;
use App\DateClass;
use App\StudentSubject;
use DB;
use App\InvitationClass;
use App\Http\Helpers\CommonHelper;

class TeacherLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teacher.welcome');
    }
	
    public function teacher_login_post(Request $request)
    {
         $session_token = Session::get('access_token_teacher');
        if (isset($session_token['access_token_teacher']) && $session_token['access_token_teacher'])
          {
              $res = $this->verify_email_DB();
			   if($res == 101 )
			   {
					 return back()->with('error', Config::get('constants.WebMessageCode.118'));
					 $this->logout();
				} 
				else if($res == 102 )
			   {
					 return back()->with('error', "Invalid Token");
					 $this->logout();
				} 
				else
				{
					return redirect()->route('teacher.dashboard');
				} 
               
    
          }
          else
          {
              $auth_url = CustomHelper::set_token_teacher();
              return redirect($auth_url);
          }
    
    
      }
      public function teacher_login_get()
      {
	
		if (!isset($_GET['code'])) 
			{
				$auth_url = CustomHelper::set_token_teacher();
				return redirect($auth_url);
			}
			else
			{
				$code = $_GET['code'];
			   
				CustomHelper::get_token_teacher($code);
				
			   $res = $this->verify_email_DB();

			  // print_r($res);
			   //  echo $code;
			   //echo  $responce->email;
			  
				if($res == 101 )
				{
					 return back()->with('error', Config::get('constants.WebMessageCode.118'));
					 $this->logout();
				} 
				else if($res == 102 )
			   {
					 return back()->with('error', "Invalid Token");
					 $this->logout();
				} 
				else
				{
					return redirect()->route('teacher.dashboard');
				} 
				//print_r($responce); 
				//echo $responce['email']; 
			
			}
      }
       public function teacherDashboard(Request $request)
      {
         $logged_teacher = Session::get('teacher_session');
		 $logged_teacher_id = $logged_teacher['teacher_id'];
		 // CLass invitation accept
			$InvData = InvitationClass::where('teacher_id',$logged_teacher_id)->where('is_accept',0)->get()->toArray();
			 if($InvData){
				foreach($InvData as $key){
					
					$code = $key['g_code'];
					$accept_id = $key['id'];
					$token = CommonHelper::varify_Teachertoken(); // verify admin token 
					$responce = CommonHelper::acceptClassInvitation($token,$code); // access Google api craete Cource
					if($responce){
									$obj = InvitationClass::find($accept_id);
									//$obj->g_code = '';
									$obj->is_accept = 1;
									$obj->save();
									//echo json_encode(array('status'=>'success','message'=> "Invitation Accepted."));
					} 
				}
			 }
		 // End
		 
		$current_date = date("Y-m-d H:i:s");
		$currentTime = date("H:i:s",strtotime($current_date));
		$currentDay = date("Y-m-d",strtotime($current_date)); 
		
		 
		 $TodayLiveData = DateClass::with('studentClass','studentSubject','cmsLink')->where('teacher_id',$logged_teacher_id)
																			->where(function($query) use($currentTime,$currentDay) {
																				//$query->where('to_timing','>',$currentTime);
																				$query->where('class_date','=',$currentDay);
																			})->orderBy('from_timing','asc')
																			->get();
		 
		 $todaysDate = date("d M");
		 
		 
		$data['subject'] = StudentSubject::orderBy('subject_name', 'ASC')->pluck('subject_name', 'id');
		$data['subject']->prepend('Select Subject',''); 
		
		
		$data['classData'] = DB::table('tbl_student_classes as c')->select('c.id','c.class_name','c.section_name','c.subject_id','s.subject_name')->join('tbl_student_subjects as s','c.subject_id','s.id')->join('tbl_class_timings as ct','ct.class_id','c.id')->where('ct.teacher_id',$logged_teacher_id)->get()->unique();
		 
		$pastClassData = DateClass::with('studentClass','studentSubject','cmsLink')->where('teacher_id',$logged_teacher_id)
												/* ->where(function($query) use($currentTime,$currentDay) {
													$query->where('to_timing','<',$currentTime);
													$query->where('class_date','=',$currentDay);
												}) */
												->Where('class_date','<',$currentDay)
												->orderBy('class_date','desc')
												->orderBy('from_timing','desc')
												->limit(20)
												->get();
		
		$inviteClassData = InvitationClass::with('studentClass','studentSubject')->where('teacher_id',$logged_teacher_id)->orderBy('id','DESC')->get();
		
		
		$teacherData = Teacher::where('id',$logged_teacher_id)->get()->first();

		$helpCategories = HelpTicketCategory::get();
		
        return view('teacher.dashboard', compact('TodayLiveData','todaysDate','data','pastClassData','inviteClassData','teacherData','helpCategories'));
      } 
    
      public function logout(Request $request) 
      {
			Session::forget('access_token_teacher');
			Session::forget('teacher_session');
			return redirect(url('/teacher'));
      }

	public function verify_email_DB()
	{

		 $session_token = Session::get('access_token_teacher');
		 
		 
		//print_r($session_token);	exit;
		/*    $token = $session_token['id_token'];
				dd($token);   */
		 
		 $array = array('error'=>'');
	
		  $responce = CustomHelper::get_user_from_token($session_token['id_token']);  
		   $resData = array_merge($array,json_decode($responce,true));
	
		if($resData['error'] != '')
		{
			return 102;
			
		}
		else
		{
			$credentials = $resData['email'];;
			$teacher = Teacher::where('email',$credentials)->first();;
			if (!empty($teacher)) { 
					$name = $teacher['name'];//.' '.$teacher['last_name'];
				 Session::put('teacher_session',array('teacher_id' => $teacher['id'],'teacher_email' =>$teacher['email'],'teacher_name'=>$name,'teacher_phone'=>$teacher['phone']));
				return 100;
		   }else{
				return 101;
			  }
		}		
	}


	
   
}
