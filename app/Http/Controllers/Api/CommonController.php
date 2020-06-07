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
use App\ClassTiming;
use App\StudentSubject;
use App\StudentClass;
use DB;
use App\InvitationClass;
use App\Http\Helpers\CommonHelper;
use Validator;
use App\SupportHelp;

class CommonController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
	 
	 
	 
	public function getClasswiseAssignment(Request $request)
	{
		   $dateClass_ID = $request->dateClass_id;
			if($dateClass_ID)
			{
			   
				$assignmentData = CommonHelper::get_assignment_data($dateClass_ID);
			
				return $this->sendResponse($assignmentData, 'Class wise assignment data from dateClass ');  
			}
			else
			{
				 return $this->sendError('DateClass Id Required.');      
			}
	}
	public function fill_dropDown(Request $request)
	{
		 // For Extra class Drop down fill
	   $logged_teacher_id = $request->teacher_id;
		if($logged_teacher_id != '')
		{			
			$classData = DB::table('tbl_student_classes as c')->select('c.id','c.class_name','c.section_name','c.subject_id','s.subject_name')->join('tbl_student_subjects as s','c.subject_id','s.id')->join('tbl_class_timings as ct','ct.class_id','c.id')->where('ct.teacher_id',$logged_teacher_id)->get()->unique();
			
			return $this->sendResponse($classData, 'Assigned Class data from student class');  
		}
		else
		{
			 return $this->sendError('Teacher id Required.');      
		}
	}
	public function get_subject(Request $request)
	{
		$subject = StudentSubject::select('id','subject_name')->orderBy('subject_name', 'ASC')->get()->toArray();
		return $this->sendResponse($subject, 'Subject List');  
	}
	public function get_cmsLink(Request $request)
	{
		$subject_id = $request->subject_id;
		$class_name = $request->class_name;
		if($subject_id !=  '' && $class_name != '')
		{	
			$topics = \DB::select('select * from tbl_student_subjects s, tbl_cmslinks c where c.subject = s.id and c.subject=? and c.class = ?', [$subject_id, $class_name]);
			return $this->sendResponse($topics, 'CMS Topic '); 
		}
		else
		{
			return $this->sendError('Class name and subject id Required.');      
		}
	}
	
	 public function classTopicUpdate(Request $request)
    {
       
        $dateWork_id = $request->dateClass_id;
       // $teacher_id = $request->teacher_id;
        $topic_id = $request->topic_id;
        if($dateWork_id != '' && $topic_id != '')
		{
		  
				$res = \DB::select('select * from tbl_cmslinks where id="'.$topic_id.'"');

				if(count($res)>0)
				{
					foreach($res as $val)
					{
						$res_link = $val->link;	
					}
					
					$obj = DateClass::find($dateWork_id);
					$obj->topic_id = $topic_id;
					$obj->save();
				   return $this->sendResponse($res_link, 'Update CMS Topic successfully.'); 
				}
				else
				{
					 return $this->sendError('Topic not found');  
				}
	
        }
		else
		{
			return $this->sendError('Date Class id and Topic id Required.');  
			
        }
    }
	 public function addClass(Request $request)
    {
	
		$teacher_id = $request->teacher_id;
		  
        $class_date = date("Y-m-d",strtotime($request->class_date));
        $from_time = str_replace(" : ", ":", $request->start_time);
        $from_time = date("H:i:s",strtotime($from_time));
        $to_time = str_replace(" : ", ":", $request->end_time);
        $to_time = date("H:i:s",strtotime($to_time));
		$class_day = date("l",strtotime($request->class_date));
        $class_id = $request->class_id;
      
	  $validator = Validator::make($request->all(), [
	  
				'teacher_id'=>'required',
				'class_id'=>'required',
				'class_date' => 'required',
				'start_time' => 'required',
				'end_time' => 'required',
				'notify_stdMessage' => 'required|max:255',
				
             
            ],[
			
				'teacher_id.required' => 'Teacher id required',
				'class_id.required' => 'Class id required',
				'class_date.required' => 'Class date required',
				'start_time.required' => 'Class start time required',
				'end_time.required' => 'Class end time required',
				'notify_stdMessage.required' => 'Notify Student Message required',
				//'notify_stdMessage.regex' => 'Notify Student Message must be letters and numbers.',
				
			]);
		
		if (!$validator->passes()) {
			return $this->sendError($validator->errors()->all());
		}
	  
	  
		$class_student_msg = isset($request->notify_stdMessage)?$request->notify_stdMessage:'';
     
		
		$obj_class = StudentClass::where('id',$class_id)->get()->first();
			
				$g_class_id = $obj_class['g_class_id'];
				$g_live_link = $obj_class['g_link'];
				$subject_id = $obj_class['subject_id'];
				$class_name = $obj_class['class_name'];
				$section_name = $obj_class['section_name'];
				
				$subject_name = StudentSubject::where('id',$subject_id)->get()->first();
			
				$sub_name = $subject_name['subject_name'];
		
		
		
		$g_teacher_data = Teacher::find($teacher_id);
		
		$g_teacher_id = $g_teacher_data->g_user_id;
		$logged_teacher_name = $g_teacher_data->name;
		$logged_teacher_phone = $g_teacher_data->phone;
		 
		
	  
			$TimeTableExist = ClassTiming::where('class_id',$class_id)->where('teacher_id',$teacher_id)->where('subject_id',$subject_id)->where('class_day',$class_day)->where('from_timing',$from_time)->get()->first();
			
			$classTimingExist = ClassTiming::where('class_id',$class_id)->where('class_day',$class_day)->where('from_timing',$from_time)->get()->first();
			
			$teacherTimeExist = ClassTiming::where('teacher_id',$teacher_id)->where('class_day',$class_day)->where('from_timing',$from_time)->get()->first();
			
			
			$dateClassExist = DateClass::where('class_id',$class_id)->where('teacher_id',$teacher_id)->where('subject_id',$subject_id)->where('class_date',$class_date)->where('from_timing',$from_time)->get()->first();
			
			$dateClassTimeExist = DateClass::where('class_id',$class_id)->where('class_date',$class_date)->where('from_timing',$from_time)->get()->first();
			
			$dateClassTeacherExist = DateClass::where('teacher_id',$teacher_id)->where('class_date',$class_date)->where('from_timing',$from_time)->get()->first();
			
			if($TimeTableExist)
			{
				return $this->sendError('You have already assigned class at selected time!.');  
			}
			else if($classTimingExist)
			{
				return $this->sendError('Class have already assigned lecture at selected time.');  
			}
			else if($teacherTimeExist)
			{
				return $this->sendError('You have already assigned lecture at selected time.');  
			}
			
			else if($dateClassExist)
			{
				return $this->sendError('You have already assigned class at selected time!.');  
			}
			else if($dateClassTimeExist)
			{
				return $this->sendError('Class have already assigned lecture at selected time.');  
			}
			else if($dateClassTeacherExist)
			{
				return $this->sendError('You have already assigned lecture at selected time.');  
			}
			else
			{				
 
						$pastClassDetail = new DateClass;
						$pastClassDetail->class_id = $class_id;
						$pastClassDetail->subject_id = $subject_id;
						$pastClassDetail->teacher_id = $teacher_id;
						$pastClassDetail->from_timing = $from_time;
						$pastClassDetail->to_timing = $to_time;

						$pastClassDetail->class_date = $class_date;
						//$pastClassDetail->class_description = $class_description;
						$pastClassDetail->class_student_msg = $class_student_msg;
						$pastClassDetail->live_link = $g_live_link;
						//$pastClassDetail->g_meet_url = $class_liveurl;
						
						$pastClassDetail->save(); 
				
				
				// SMS 
					$support_numbers = CommonHelper::get_support_number();
	
					$message = "$logged_teacher_name - $logged_teacher_phone have created new class $class_name - $section_name with $sub_name";
							
					$s = CommonHelper::send_sms($support_numbers,$message);
				
					  return $this->sendResponse("", 'Class add successfully...'); 
			}		
			
	}
	// Edit Live Class
	 public function editLiveClass(Request $request)
    {   
			
		  $validator = Validator::make($request->all(), [
					'teacher_id' => 'required',
					'dateClass_id' => 'required',
					'notify_stdMessage' => 'required|max:255',
					'description' => 'required|max:255|regex:/^[a-zA-Z0-9 ]*$/',
				 
				],[
					'teacher_id.required' => 'Teacher id required',
					'dateClass_id.required' => 'Date Class id required',
					'notify_stdMessage.required'=>'Notify Message required.',
					//'edit_notify_stdMessage.regex'=>'Notify Message must be letters and numbers.',
					'description.required'=>'The Description required.',
					'description.regex'=>'The Description must be letters and numbers.',
					
				]);
				if (!$validator->passes()) {
					return $this->sendError($validator->errors()->all());
				}	
			
				$teacher_id = $request->teacher_id;
				$dateClass_id = $request->dateClass_id;
				$notify_stdMessage = $request->notify_stdMessage;
				$class_description = isset($request->description)?$request->description:'';
		
				$liveClassDetail = DateClass::find($dateClass_id);
				
				$liveClassDetail->class_description = $class_description;
				$liveClassDetail->class_student_msg = $notify_stdMessage;
				$liveClassDetail->save();

				 return $this->sendResponse("", 'Live Class updated successfully...'); 
    }
	 public function editPastClass(Request $request)
    {   
			
			$validator = Validator::make($request->all(), [
					'teacher_id' => 'required',
					'dateClass_id' => 'required',
					'description' => 'required|max:100|regex:/^[a-zA-Z0-9 ]*$/',
					'recording_url' => 'required',
				 
				],[
					'teacher_id.required' => 'Teacher id required',
					'dateClass_id.required' => 'Date Class id required',
					'description.required'=>'The Description required.',
					'description.regex'=>'Description must be letters and numbers.',
					'recording_url.required'=>'Recording URL required.',
				]);
			
			if (!$validator->passes()) {
				return $this->sendError($validator->errors()->all());	
			}
			
			$teacher_id = $request->teacher_id;
			$dateClass_id = $request->dateClass_id;
			$class_description = isset($request->description)?$request->description:'';
			$class_rec_url = isset($request->recording_url)?$request->recording_url:'';
		   
		 	
			if($class_rec_url!=''){
				
				if(!filter_var($class_rec_url, FILTER_VALIDATE_URL)){
					 
					  return $this->sendError('Please Add Valid Recording URL.');
				}
			} 
			
		  
			$pastClassDetail = DateClass::find($dateClass_id);
			
			$pastClassDetail->class_description = $class_description;
			$pastClassDetail->recording_url = $class_rec_url;
			$pastClassDetail->save();

			return $this->sendResponse("", 'Past Class updated successfully...'); 
    }
	public function generateHelpTicket(Request $request)
	{
		
			$validator = Validator::make($request->all(), [
					'teacher_id' => 'required',
					'dateClass_id' => 'required',
				 
				],[
					'teacher_id.required' => 'Teacher id required',
					'dateClass_id.required' => 'Date Class id required',
				]);
			
			if (!$validator->passes()) {
				return $this->sendError($validator->errors()->all());	
			}
		
		
			$teacher_id = $request->teacher_id;
			$dateClass_id = $request->dateClass_id;
			// Teacher Detail
			$g_teacher_data = Teacher::find($teacher_id);
			$g_teacher_id = $g_teacher_data->g_user_id;
			$teacher_name = $g_teacher_data->name;
			$teacher_phone = $g_teacher_data->phone;
			$class_liveurl = $g_teacher_data->g_meet_url;
				
			// Class id and subject id form dateClass 	
			$dateClass_data = DateClass::find($dateClass_id);
			$class_id = $dateClass_data->class_id;
			$subject_id = $dateClass_data->subject_id;
		 
			$help_type = 2;
			$support_help = new SupportHelp;
			$support_help->teacher_id =  $teacher_id;
			$support_help->help_type = $help_type;
			$support_help->class_id = $class_id;
			$support_help->subject_id = $subject_id;
			$support_help->read_status = 0;
			$support_help->class_join_link = $class_liveurl;
			$support_help->save();
			
			
			
			$subject_name = StudentSubject::where('id',$subject_id)->get();
			$sub_name = $subject_name[0]['subject_name'];						
			
			$class_name = StudentClass::where('id',$class_id)->get();
			$cls_name = $class_name[0]['class_name'];						
			$section_name = $class_name[0]['section_name'];						
			
			$support_numbers = CommonHelper::get_support_number();
			
			$message = "$teacher_name - $teacher_phone have requested support for class : $cls_name - $section_name - $sub_name.";
					
			$s = CommonHelper::send_sms($support_numbers,$message);
			
			return $this->sendResponse("","Help ticket generated successfully.");

    }
	public function genericHelpTicket(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'teacher_id' => 'required',
				'description' => 'required',
		    ],[
			
				'teacher_id.required' => 'Teacher Id required',
				'description.required' => 'Message required',
			]);
		
		  if (!$validator->passes()) {
				return $this->sendError($validator->errors()->all());	
			}
		   
		   	$teacher_id = $request->teacher_id;
			$description = $request->description;
			$help_type = 1;
			// Teacher Detail
			$g_teacher_data = Teacher::find($teacher_id);
			
			$teacher_name = $g_teacher_data->name;
			$teacher_phone = $g_teacher_data->phone;
		   
			$support_help = new SupportHelp;
			$support_help->teacher_id =  $teacher_id;
			$support_help->description = $description;
			$support_help->help_type = $help_type;
		  
			$support_help->read_status = 0;
		 
			$support_help->save();
			
			
			$support_numbers = CommonHelper::get_support_number();
			
			$message = "$teacher_name - $teacher_phone have requested support.";
					
			$s = CommonHelper::send_sms($support_numbers,$message);
		
			return $this->sendResponse("","Help ticket generated successfully.");
	}
	
	public function UpdateClassNotes(Request $request)
	{
			$validator = Validator::make($request->all(), [
				'teacher_id' => 'required',
				'dateClass_id' => 'required',
				'description' => 'required',
		    ],[
			
				'teacher_id.required' => 'Teacher Id required',
				'dateClass_id.required' => 'DateClass Id required',
				'description.required' => 'Class Description required',
			]);
		
		  if (!$validator->passes()) {
				return $this->sendError($validator->errors()->all());	
			}
		   	
			$desc = $request->description;
			$dateClass_id = $request->dateClass_id;
			
			
			
			$res = DateClass::find($dateClass_id);
			$res->class_description = $request->description;
			$res->save();
			return $this->sendResponse("","Class Note has been saved!");
	}
	public function getAssignment(Request $request)
	{
			$validator = Validator::make($request->all(), [
				'teacher_id' => 'required',
		    ],[
			
				'teacher_id.required' => 'Teacher Id required',
			]);
		
		  if (!$validator->passes()) {
				return $this->sendError($validator->errors()->all());	
			}
		$teacher_id = $request->teacher_id;
		
		$response['class_list'] = ClassTiming::with('studentClass','studentSubject')->where('teacher_id',$teacher_id)->get();

        $links = array();
        foreach ($class_list as $value) {
            $assignment =  ClassWork::where('class_id', $value->class_id)->where('subject_id',$value->subject_id)->where('teacher_id',$teacher_id)->first();
            
                $links[$value->class_id][$value->subject_id]['id'] = (!empty($assignment))? $assignment->id:'';
                $links[$value->class_id][$value->subject_id]['g_live_link'] = (!empty($assignment))? $assignment->g_live_link:'';
               // $links[$value->class_id][$value->subject_id]['g_class_id'] = (!empty($assignment))? $assignment->g_class_id:'';
				
        }
		$response['link'] = $link;
	//	
		return  $this->sendResponse($response,"Assingment Data");
    }
	public function getAll_cmsLink(Request $request)
	{
		$cmsclass = \DB::select('select distinct class from tbl_cmslinks order by class');
		return  $this->sendResponse($cmsclass,"All CMS link Record.");
		
	}
	public function notifyStudents(Request $request)
	{
		
		
			$validator = Validator::make($request->all(), [
					'teacher_id' => 'required',
					'dateClass_id' => 'required',
				 
				],[
					'teacher_id.required' => 'Teacher id required',
					'dateClass_id.required' => 'Date Class id required',
				]);
			
			if (!$validator->passes()) {
				return $this->sendError($validator->errors()->all());	
			}
		
		
			$teacher_id = $request->teacher_id;
			$dateClass_id = $request->dateClass_id;
			// Teacher Detail
			$g_teacher_data = Teacher::find($teacher_id);
			$class_join_link = $g_teacher_data->g_meet_url;
		
		
			$from = CustomHelper::getFromMail();
			$comm = "";
			$er = "";
			$number = array();
			 
			$class_timing = DateClass::where('id',$dateClass_id)->get()->first();
			$class_id = $class_timing->class_id;
			$subject_id = $class_timing->subject_id;
			$start_time = $class_timing->from_timing;
			$std_message = $class_timing->class_student_msg;
			
			
			$subject_name = StudentSubject::where('id',$request->subject_id)->get()->first();
			$sub_name = $subject_name->subject_name;						
			
			$class_name = StudentClass::where('id',$request->class_id)->get()->first();
			$cls_name = $class_name->class_name;						
			$section_name = $class_name->section_name;						
			
			//dd($class_name);
			$classData = \DB::table('tbl_classes')->select('id')->where('class_name',$cls_name)->where('section_name',$section_name)->get()->first();
			$c_id = $classData->id;
			
			
			$student_phone = \DB::table('tbl_students')->select('name','email','phone')->where('class_id',$c_id)->where('notify','yes')->get(); // Phone Number
			$student_email = \DB::table('tbl_students')->select('name','email','phone')->where('class_id',$c_id)->get(); // email 
			
			foreach($student_phone as $p)
			{
				$number[] = $p->phone;
			}
			
			if(count($student_phone) > 0)
			{
				$numbers = implode(",",$number);
				$msg = "You have $sub_name class at $start_time. Join using $class_join_link.";
						
				$s = CommonHelper::send_sms($numbers,$msg);
				$comm = "SMS ";
			}
			
			if(count($student_email) > 0)
			{
				foreach($student_email as $e)
				{
					//$email[] = $e->email;
					$data_mail = array('name'=>$e->name,'subject'=>$sub_name,'start_time'=>$start_time,'class_url'=>$class_join_link);
					
					 Mail::send('mail.mail', $data_mail, function($message) use($e, $from) 
					 {	//dd($message);
						 $message->to($e->email)
						 ->subject('Invitation to join live class');
						 //$message->from('noreply@montbit.com','MontBIt');
						 $message->from($from->value,'MontBIt');
					  });
					
				}
				if($comm == "SMS ")
					$comm .= "and Email ";
				else
					$comm = "Email ";
				
				
				if( count(Mail::failures()) > 0 ) 
				{
				   foreach(Mail::failures as $email_address) {
					  $er .= $email_address;
					}

				} else {
					$er= "Notification sent successfully!";
				}
			}
			//$emails = implode(",",$email);
			
			
			
			if($comm == "")
				return $this->sendError("No SMS / Email present for notification!!");
			else
				return $this->sendResponse("",$er);
		
		
	}
	public function CreateAssignment(Request $request)
    {   
	
		$validator = Validator::make($request->all(), [
				'teacher_id' => 'required',
				'dateClass_id' => 'required',
				'assignment_title' => 'required|max:100|regex:/^[a-zA-Z0-9 ]*$/',
            ],[
				'teacher_id.required' => 'Teacher id required',
				'dateClass_id.required' => 'Date Class id required',
				'assignment_title.required'=>'Assingment Title Required.',
				'assignment_title.regex'=>'Assingment Title must be letters and numbers.',
			]);
		
		if (!$validator->passes()) {
			return $this->sendError($validator->errors()->all());
		}
		
					$teacher_id = $request->teacher_id;
					
					$topic_name = $request->txt_topic_name;
					$sel_topic_id = $request->sel_topic_name;
					$title = $request->assignment_title;
					$dateClass_id = $request->dateClass_id;
			
					$class_timing = DateClass::where('id',$dateClass_id)->get()->first();
					$class_id = $class_timing->class_id;
					$subject_id = $class_timing->subject_id;
					
					
					$class_name = StudentClass::where('id',$class_id)->get()->first();
					$g_class_id = $class_name->g_class_id;						
					
					$g_topic_id = '';
					
					if($topic_name == '' && $sel_topic_id == '' ){
						return $this->sendError('Topic Name Required.');
					}
		// Access token get from google 
					$token = $request->header('accessToken'); // 	
					
					
					if(($topic_name == '' && $sel_topic_id != '') || ($topic_name != '' && $sel_topic_id != ''))
					{
						$topic_id = $sel_topic_id;
						
						$topicExists = ClassTopic::where('id',$topic_id)->get()->first();
						$g_topic_id = $topicExists->g_topic_id;
						
					}
					if($topic_name != '' && $sel_topic_id == '') 
					{
						$data = array( "name" => $topic_name );
						$data = json_encode($data);
						
							$responce = CommonHelper::create_topic($token,$g_class_id,$data); // access Google api craete Topic
						
							$resData = array('error'=> '');
						
							if($responce == 101)
							{
								return $this->sendError(Config::get('constants.WebMessageCode.119'));
							}
							else
							{	
								$resData = array_merge($resData,json_decode($responce,true));
								if($resData['error'] != '')
								{
									if($resData['error']['status'] == 'UNAUTHENTICATED')  
									{
										return $this->sendError("Token Expired. You have to ligin again");
									}
									else
									{
										return $this->sendError($resData['error']['message']);
									}
									
								}	
								else
								{
									
									$g_topic_id = $resData['topicId'];
									
									$obj_topic = new ClassTopic;
									$obj_topic->topicname = $topic_name;
									$obj_topic->class_id = $class_id;
									$obj_topic->g_topic_id = $g_topic_id;
									
									$obj_topic->save();
									$topic_id = $obj_topic->id;  // Last Insert Id 
								}
							}
						
					}
					
					
					$array_data = array(
											"title" => $title,
										  "workType" => "ASSIGNMENT",
										  "state" => "PUBLISHED",
										  "topicId"=> $g_topic_id,
										  "description" => "Open 3 dots in right side and click edit"
												);
				
					$array_data = json_encode($array_data);
					
					$work_response = CommonHelper::create_courcework($token,$g_class_id,$array_data);
					$w_resData = array('error'=> '');
							
					if($work_response == 101)
						{
							return $this->sendError(Config::get('constants.WebMessageCode.119'));
						}
						else
						{
							$w_resData = array_merge($w_resData,json_decode($work_response,true));
							if($w_resData['error'] != '')
							{
								
								if($w_resData['error']['status'] == 'UNAUTHENTICATED')  
								{
									return $this->sendError("Token Expired. You have to ligin again");
								}
								else
								{
									return $this->sendError($w_resData['error']['message']);
								}
							}	
							else
							{
									$cource_url = $w_resData['alternateLink'];
									
									$classWork = new ClassWork;
									$classWork->class_id = $class_id;
									$classWork->g_live_link = $w_resData['alternateLink'];
									$classWork->g_class_id = $g_class_id;
									$classWork->classwork_type = $w_resData['workType'];
									$classWork->topic_id = $topic_id;
									$classWork->g_title = $w_resData['title'];
									$classWork->teacher_id = $teacher_id;
									$classWork->subject_id = $subject_id;
									$classWork->save();
									
									$classWork_id = $classWork->id;  // Last Insert Id 
								
									if($dateClass_id != '') 
									{
										$obj = DateClass::find($dateClass_id);
										$obj->topic_id = $topic_id;
										//$obj->ass_live_url = $w_resData['alternateLink'];
										$obj->save();


										
												$s = \DB::table('tbl_classwork_dateclass')->insert(
													['dateclass_id' => $dateClass_id, 'classwork_id' => $classWork_id]
												);
										
										
									}
								
								$responce = array('cource_url'=>$cource_url);
								
								return $this->sendResponse($responce, Config::get('constants.WebMessageCode.127'));
							}
						}
	} 
	public function GetAssignmentByClass(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'teacher_id' => 'required',
				'class_id' => 'required',
				'subject_id' => 'required',
		    ],[
			
				'teacher_id.required' => 'Teacher Id required',
				'class_id.required' => 'Class Id required',
				'subject_id.required' => 'Subject Id required',
			]);
		
		  if (!$validator->passes()) {
				return $this->sendError($validator->errors()->all());	
			}
		
		$teacher_id = $request->teacher_id;
	    $class_id = $request->class_id;
        $subject_id = $request->subject_id;
       
	   $getAssignment = ClassWork::select('id','g_title','g_live_link')->where('class_id',$class_id)->where('subject_id',$subject_id)->where('teacher_id',$logged_teacher_id)->where('classwork_type','ASSIGNMENT')->get();
	   
		//$get_topic = ClassTopic::where('class_id',$class_id)->get();
	   
		return $this->sendResponse($getAssignment,"Created Assingment for class");
	   
	   
	}
	public function GetTopicByClass(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'teacher_id' => 'required',
				'class_id' => 'required',
		    ],[
			
				'teacher_id.required' => 'Teacher Id required',
				'class_id.required' => 'Class Id required',
			]);
		
		  if (!$validator->passes()) {
				return $this->sendError($validator->errors()->all());	
			}
		
		$teacher_id = $request->teacher_id;
	    $class_id = $request->class_id;
       
		$get_topic = ClassTopic::where('class_id',$class_id)->get();
	   
		return $this->sendResponse($get_topic,"Created Topic for class");
	   
	   
	}
		
	public function GiveAssignmentFromCreated(Request $request)
	{
		
		$validator = Validator::make($request->all(), [
				'teacher_id' => 'required',
				'dateClass_id' => 'required',
				'classWork_id' => 'required',
		    ],[
			
				'teacher_id.required' => 'Teacher Id required',
				'dateClass_id.required' => 'Date Class Id required',
				'classWork_id.required' => 'Class Work Id required',
			]);
		
		  if (!$validator->passes()) {
				return $this->sendError($validator->errors()->all());	
			}
		
		
		$teacher_id = $$request->teacher_id;
		$dateClass_id = $request->dateClass_id;
		$classwork_id = $request->classwork_id;
		
		
		$assignmentExist = \DB::table('tbl_classwork_dateclass')->where('dateclass_id',$dateClass_id)->where('classwork_id',$classwork_id)->get()->first();
		if($assignmentExist){
			return $this->sendError("Assignment already allocated to this class.");
		}	
		else{
			$s = \DB::table('tbl_classwork_dateclass')->insert(
											['dateclass_id' => $dateClass_id, 'classwork_id' => $classwork_id]
										); 
		}
		return $this->sendResponse("",'Assignment Successfully Assign.');
	   
		
	}

   
   
}
