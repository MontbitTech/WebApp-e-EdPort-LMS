<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
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
use Illuminate\Support\Facades\Auth; 
use App\User;


class TeacherLoginController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
	
   
      public function teacher_login_get(Request $request)
      {
		 $id_token = $request->header('idToken');
		 
		
		 $array = array('error'=>'');
	
		  $responce = CustomHelper::get_user_from_token($id_token);  
		  
		  
		  if(!is_array(json_decode($responce,true)))
		  {
			   return $this->sendError('Invalid Token');    
		  }
		 /*  print_r($responce);
		  exit;  */
		   $resData = array_merge($array,json_decode($responce,true));
		

		if($resData['error'] != '')
		{
			 return $this->sendError('Invalid Token');    
		}
		else
		{
			$credentials = $resData['email'];
			$user = User::where('email',$credentials)->first();
			    if (!empty($user))
				{  
					
					$hasToken = $user->createToken('MyApp')-> accessToken;		
					$user->hasToken = $hasToken;
					$user->save();
					return $this->sendResponse($user, 'Valid user.');   
				  }
			    else
				{
					return $this->sendError('Teacher not found.');       
				}
		}
		
	
	  }
	  
	   public function details() 
        { 
            $user = Teacher::all(); 
            return response()->json(['success' => $user], $this-> successStatus); 
        } 
	  
       public function teacherDashboard(Request $request)
      {
		/*   $header = $request->header('id');
			$access_token = $request->header('token');
		 */
		 if($request->teacher_id != '')
		 {		
				$logged_teacher_id = $request->teacher_id;
				 // CLass invitation accept
					/* $InvData = InvitationClass::where('teacher_id',$logged_teacher_id)->where('is_accept',0)->get()->toArray();
					 if($InvData){
						foreach($InvData as $key){
							
							$code = $key['g_code'];
							$accept_id = $key['id'];
							$token = CommonHelper::varify_Teachertoken(); // verify admin token 
							$responce = CommonHelper::acceptClassInvitation($token,$code); // access Google api craete Cource
							if($responce){
											$obj = InvitationClass::find($accept_id);
											$obj->g_code = '';
											$obj->is_accept = 1;
											$obj->save();
											//echo json_encode(array('status'=>'success','message'=> "Invitation Accepted."));
							} 
						}
					 } */
				 // End
				 
				$current_date = date("Y-m-d H:i:s");
				$currentTime = date("H:i:s",strtotime($current_date));
				$currentDay = date("Y-m-d",strtotime($current_date)); 
				
				 
				 $responce['TodayLiveData'] = DateClass::with('studentClass','studentSubject','cmsLink')->where('teacher_id',$logged_teacher_id)
																					->where(function($query) use($currentTime,$currentDay) {
																						//$query->where('to_timing','>',$currentTime);
																						$query->where('class_date','=',$currentDay);
																					})->orderBy('from_timing','asc')
																					->get()->toArray();
				 
				$responce['pastClassData'] = DateClass::with('studentClass','studentSubject','cmsLink')->where('teacher_id',$logged_teacher_id)
														/* ->where(function($query) use($currentTime,$currentDay) {
															$query->where('to_timing','<',$currentTime);
															$query->where('class_date','=',$currentDay);
														}) */
														->Where('class_date','<',$currentDay)
														->orderBy('from_timing','asc')
														->limit(20)
														->get()->toArray();
					
				$responce['inviteClassData'] = InvitationClass::with('studentClass','studentSubject')->where('teacher_id',$logged_teacher_id)->orderBy('id','DESC')->get()->toArray();
				
				return $this->sendResponse($responce, 'Teacher Live/Past/inviteClass Data');   
				
		 }
		 else
		 {
			  return $this->sendError('Teacher id Required.');      
		 }
      } 
	public function teacherLiveClass(Request $request)
	{
		if($request->teacher_id != '')
		{		
			$logged_teacher_id = $request->teacher_id;
			$current_date = date("Y-m-d H:i:s");
			$currentTime = date("H:i:s",strtotime($current_date));
			$currentDay = date("Y-m-d",strtotime($current_date)); 
			
			 
			 $TodayLiveData = DateClass::with('studentClass','studentSubject','cmsLink')->where('teacher_id',$logged_teacher_id)
																				->where(function($query) use($currentTime,$currentDay) {
																					//$query->where('to_timing','>',$currentTime);
																					$query->where('class_date','=',$currentDay);
																				})->orderBy('from_timing','asc')
																				->get()->toArray();
			return $this->sendResponse($TodayLiveData, 'Teacher Live Class Data');   
		}
		else
		{
			return $this->sendError('Teacher id Required.');      
		}
		
	}
	public function teacherPastClass(Request $request)
	{
		if($request->teacher_id != '')
		{		
			$logged_teacher_id = $request->teacher_id;
			$current_date = date("Y-m-d H:i:s");
			$currentTime = date("H:i:s",strtotime($current_date));
			$currentDay = date("Y-m-d",strtotime($current_date)); 
			
			 
			$pastClassData = DateClass::with('studentClass','studentSubject','cmsLink')->where('teacher_id',$logged_teacher_id)
														/* ->where(function($query) use($currentTime,$currentDay) {
															$query->where('to_timing','<',$currentTime);
															$query->where('class_date','=',$currentDay);
														}) */
														->Where('class_date','<',$currentDay)
														->orderBy('from_timing','asc')
														->limit(20)
														->get()->toArray();
			return $this->sendResponse($pastClassData, 'Teacher Past Class Data');   
		}
		else
		{
			return $this->sendError('Teacher id Required.');      
		}
		
	}
	public function teacherAssignedClass(Request $request)
	{
		if($request->teacher_id != '')
		{		
			$logged_teacher_id = $request->teacher_id;
	
			$AssignedClassData = InvitationClass::with('studentClass','studentSubject')->where('teacher_id',$logged_teacher_id)->orderBy('id','DESC')->get()->toArray();
			return $this->sendResponse($AssignedClassData, 'Teacher Assigned Class Data');   
		}
		else
		{
			return $this->sendError('Teacher id Required.');      
		}
		
	}
	
		
	
	
      public function logout(Request $request) 
      {
			Session::forget('access_token_teacher');
			Session::forget('teacher_session');
			return redirect(url('/teacher'));
      }

	


	/* 
	 // Dropdown fill for subject
		$data['subject'] = StudentSubject::orderBy('subject_name', 'ASC')->pluck('subject_name', 'id');
		$data['subject']->prepend('Select Subject',''); 
		
		// For Extra class Drop down fill
		$data['classData'] = DB::table('tbl_student_classes as c')->select('c.id','c.class_name','c.section_name','c.subject_id','s.subject_name')->join('tbl_student_subjects as s','c.subject_id','s.id')->join('tbl_class_timings as ct','ct.class_id','c.id')->where('ct.teacher_id',$logged_teacher_id)->get()->unique();  */
	
   
}
