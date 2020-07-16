<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
//use Auth;
use Validator;
use App\Http\Helpers\CommonHelper;
use App\StudentClass;
use App\StudentSubject;
use App\Teacher;
use DB;
use App\ClassTiming;
use App\InvitationClass;
use App\DateClass;
use App\ClassWork;
use App\Models\ClassSection;

class ClassController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
      //  return Auth::guard('admin');
    }

    /**
     * Show the application dashboard.|min:8
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	 
	public function list_class()
	{
		$classes = ClassSection::select('class_name')->distinct()->get();
		$section = ClassSection::select('section_name')->distinct()->get();
		return view('admin.class.list_class',compact('classes','section'));	
	} 


	public function filterSubject(Request $request, StudentClass $StudentClass)
	{
		$rec = $StudentClass->newQuery();
		if(!empty($request->txtSerachByClass && $request->txtSerachBySection)){
			if( $request->txtSerachByClass && $request->txtSerachBySection == 'all'){
				$getResult = $rec->where('class_name', $request->txtSerachByClass)->get();
			}
			else{	
			$getResult = $rec->where('class_name', $request->txtSerachByClass)->where('section_name', $request->txtSerachBySection)->get();
		    }
		}
	    else $getResult="";
	    return view('admin.class.filter-subject',compact('getResult'));
	}
	 
     public function addClasses(Request $request)
    {
		
          if($request->isMethod('post')) {
			  
			  $allocate_email = "me";
            $request->validate([ 
              'class_name' => 'required|max:100',
              'subject' => 'required',
              'section' => 'required|max:100',
            ]);
			
			
			$subject_id = $request->subject;
			$class_name = $request->class_name;
			$section_name = $request->section;
			
			$subject_name = StudentSubject::where('id',$request->subject)->get();
			$sub_name = $subject_name[0]['subject_name'];
			$classExist = StudentClass::where('class_name',$class_name)->where('section_name',$section_name)->where('subject_id',$subject_id)->get()->first();
			if($classExist)
			{
				return redirect()->route('classes.add')->with('error',"Class Already Exists !.");
			}
			else
			{
			
						$data = array( 
										  "name"=> $class_name.' '.$sub_name,
										  "section"=> $section_name,
										  "descriptionHeading"=> "",
										  "description"=> "",
										  "room"=> "",
										  "ownerId"=> "me",
										  "courseState"=> "ACTIVE"

									);	
						$data = json_encode($data);
							
						$token = CommonHelper::varify_Admintoken(); // verify admin token 
						
					
						$responce = CommonHelper::create_class($token,$data); // access Google api craete Cource
						$resData = array('error'=> '');
									
						if($responce == 101)
						{
							return back()->with('error', Config::get('constants.WebMessageCode.119'));
						}
						else
						{
							$resData = array_merge($resData,json_decode($responce,true));
							
						
							 if($resData['error'])
							{
								if($resData['error']['status'] == 'UNAUTHENTICATED')  
								{
									return redirect()->route('admin.logout');
								}
								else
								{
									return redirect()->route('classes.add')->with('error',$resData['error']['message']);
								}
								
							}
							else
							{  
							
								$g_class_id = $resData['id'];
								$obj = new StudentClass;
								$obj->class_name = $class_name;
								$obj->section_name = $section_name;
								$obj->subject_id = $subject_id;
								
								$obj->g_class_id = $g_class_id;
								$obj->g_link = $resData['alternateLink'];
								$obj->g_response = $responce;
								$obj->save();
							

								return redirect()->route('admin.listClass')->with('success',Config::get('constants.WebMessageCode.125'));
							}
							
						}
			}
			
        } 
	
		$data['subject'] = StudentSubject::orderBy('subject_name', 'ASC')->pluck('subject_name', 'id');
		$data['subject']->prepend('Select Subject','');
		$data['section'] = DB::table('tbl_classes')->select('section_name')->distinct()->get()->pluck('section_name','section_name');
		$data['class'] = DB::table('tbl_classes')->select('class_name')->distinct()->get()->pluck('class_name','class_name');
		$data['class']->prepend('Select Class','');
		$data['section']->prepend('Select Section','');
		
		return view('admin.class.add',compact('data',$data));
    }
	
	public function deleteClasses(Request $request)
	{
	
		$id = $request->txt_class_id;
		
	
		
		if($id != '')
		{
					$classTimingExist = ClassTiming::where('class_id',$id)->get()->first();
					
					$dateClassExist = DateClass::where('class_id',$id)->get()->first();
					
					$classWorkExits = ClassWork::where('class_id',$id)->get()->first();
					
					if($classTimingExist)
					{
						return redirect()->route('admin.listClass')->with('error', "you cannot delete this class! it's associated with Teacher,Assignent....");
					}
					else if($dateClassExist)
					{
						return redirect()->route('admin.listClass')->with('error', "you cannot delete this class! it's associated with Teacher,Assignent....");
					}
					else if($classWorkExits)
					{
						return redirect()->route('admin.listClass')->with('error', "you cannot delete this class! it's associated with Assignent....");
					}
					else
					{
						$classes = StudentClass::find($id);
						
						 $g_class_id = $classes->g_class_id;
						
						
							$token = CommonHelper::varify_Admintoken(); // verify admin token 
									
								
							$responce = CommonHelper::delete_class($token,$g_class_id); // access Google api delete Cource
							
						
							
							if($responce)// || $responce == '' || $responce == null)
							{
								$classes->delete();
								return redirect()->route('admin.listClass')->with('success',"Class Deleted Successfully.");
									
							}
					
						
							$resData = array('error'=> '');
										
							if($responce == 101)
							{
								return redirect()->route('admin.listClass')->with('error', Config::get('constants.WebMessageCode.119'));
							}
							else
							{
								$resData = array_merge($resData,json_decode($responce,true));
								if($resData['error'])
								{
									if($resData['error']['status'] == 'UNAUTHENTICATED')  
									{
										return redirect()->route('admin.logout');
									}
									else
									{
										return redirect()->route('admin.listClass')->with('error',$resData['error']['message']);
									}
									
								}
								
							}
					}
		}
		else{
			return redirect()->route('admin.listClass');
		}
	}
		
		
	/*  public function addClasses(Request $request)
    {
		$teacher_id = '';
		$g_teacher_id = '';
		$islunch = 0;
	
          if($request->isMethod('post')) {
			  
			  $allocate_email = "me";
              $request->validate([ 
              'class_name' => 'required|max:100',
              'subject' => 'required',
              'section' => 'required|max:100',
              'class_heading' => 'required|max:100',
              'description' => 'required|max:100',
              'room' => 'required|numeric',
			   'days' => 'required',
			  'start_time' => 'required',
			  'end_time' => 'required'
             
            ]);
			
		
				
				$obj_teacher = Teacher::where('id',$request->teacher)->get();
				
				$g_teacher_id = $obj_teacher[0]['g_user_id'];
				$phone = $obj_teacher[0]['phone'];
				
				$teacher_id = $request->teacher;
				if($request->islunch == 1){
				$islunch = $request->islunch;
				}
				//$allocate_email = $obj_teacher[0]['email'];
			
			$class_date = date("Y-m-d");//,strtotime($request->class_date));
			$from_time = str_replace(" : ", ":", $request->start_time);
			$from_time = date("H:i:s",strtotime($from_time));
			$to_time = str_replace(" : ", ":", $request->end_time);
			$to_time = date("H:i:s",strtotime($to_time));
			
			$days = $request->days;
			$todays = date("l");
			$subject_id = $request->subject;
			$description = $request->description;
			$class_name = $request->class_name;
			$section_name = $request->section;
			$subject_name = StudentSubject::where('id',$request->subject)->get();
			
			$sub_name = $subject_name[0]['subject_name'];
		
			
		 	$data = array( 
							  "name"=> $request->class_name.' '.$sub_name,
							  "section"=> $request->section,
							  "descriptionHeading"=> $request->class_heading,
							  "description"=> $description,
							  "room"=> $request->room,
							  "ownerId"=> "me",
							  "courseState"=> "PROVISIONED"

						);	
			$data = json_encode($data);
				
			$token = CommonHelper::varify_Admintoken(); // verify admin token 
			
		
			$responce = CommonHelper::create_class($token,$data); // access Google api craete Cource
			$resData = array('error'=> '');
						
			if($responce == 101)
			{
				return back()->with('error', Config::get('constants.WebMessageCode.119'));
			}
			else
			{
				$resData = array_merge($resData,json_decode($responce,true));
				
			
				 if($resData['error'])
				{
					return redirect()->route('classes.add')->with('error',$resData['error']['message']);//Config::get('constants.WebMessageCode.119'));
				}
				else
				{  
					$g_class_id = $resData['id'];
					 $obj = new StudentClass;
					$obj->class_name = $request->class_name;
					$obj->section_name = $request->section;
					$obj->subject_id = $subject_id;
					
					$obj->g_class_id = $g_class_id;
					$obj->g_link = $resData['alternateLink'];
					$obj->g_response = $responce;
					$obj->save();
					$class_id = $obj->id; 
				//	if($request->teacher != '' && $request->teacher != null)
				//	{
						 
						$obj_time = new ClassTiming;
						$obj_time->class_id = $class_id;
						$obj_time->teacher_id = $teacher_id;
						$obj_time->subject_id = $subject_id;
						$obj_time->class_day = $days;
						$obj_time->from_timing = $from_time;
						$obj_time->to_timing = $to_time;
						$obj_time->is_lunch = $islunch;
						
						$obj_time->save(); 
					
						if($days == $todays)
						{
							$pastClassDetail = new DateClass;
							$pastClassDetail->class_id = $class_id;
							$pastClassDetail->subject_id = $subject_id;
							$pastClassDetail->teacher_id = $teacher_id;
							$pastClassDetail->from_timing = $from_time;
							$pastClassDetail->to_timing = $to_time;

							$pastClassDetail->class_date = $class_date;
							$pastClassDetail->class_description = $description;
							//$pastClassDetail->class_student_msg = $class_student_msg;
							$pastClassDetail->live_link = $resData['alternateLink'];
							//$pastClassDetail->g_meet_url = $class_liveurl;
							
							$pastClassDetail->save(); 
						}
					
					
						/// Send SMS to Teacher for assigned new Class
						 if(strlen($phone) <= 10){
								$number = '91'.$phone;
							}else{
								$number = $phone;
							} 
						 
							$message = "You are invited for a new class $class_name - $section_name - $sub_name.";
							
							$s = CommonHelper::send_sms($number,$message);
					
					
						 	 $inv_data = array( 
									  "courseId"=>$g_class_id,
									  "role"=> "TEACHER",
									  "userId" => $g_teacher_id

									);	
							$inv_data = json_encode($inv_data);
							$inv_responce = CommonHelper::teacher_invitation_forClass($token,$inv_data); // access Google api craete Cource
							$inv_resData = array('error'=> '');
							
							
							if($inv_responce == 101)
							{
								return back()->with('error', Config::get('constants.WebMessageCode.119'));
							}
							else
							{
								$inv_resData = array_merge($inv_resData,json_decode($inv_responce,true));
								if($inv_resData['error'] != '')
								{
									return back()->with('error', Config::get('constants.WebMessageCode.119'));
								}
								else
								{	
										$inv_res_code = $inv_resData['id'];
										
										$obj_inv = new InvitationClass;
										$obj_inv->class_id = $class_id;
										$obj_inv->subject_id = $request->subject;
										$obj_inv->teacher_id = $teacher_id;
										$obj_inv->g_code = $inv_res_code;
										$obj_inv->g_responce = '';
										$obj_inv->is_accept = 0;
										$obj_inv->save();
								}
							}  
						
					//}
					
					return redirect()->route('classes.add')->with('success',Config::get('constants.WebMessageCode.125'));
				}
				
			}
			
			
        } 
		// $pin = Helper::getRandomPin();
        //return view('admin.teacher.add',compact('pin'));  
		
		$data['subject'] = StudentSubject::orderBy('subject_name', 'ASC')->pluck('subject_name', 'id');
		//$data['teacher'] = Teacher::pluck('email', 'id');
		$data['teacher'] = DB::table('tbl_techers')->select('id', DB::raw("name AS full_name"))->get()->pluck('full_name', 'id');
		//$data['teacher'] = DB::table('tbl_techers')->select('id', DB::raw("CONCAT(first_name,' ',last_name) AS full_name"))->get()->pluck('full_name', 'id');
		$data['teacher']->prepend('Select Teacher','');
		$data['subject']->prepend('Select Subject','');
		
		$data['class'] = DB::table('tbl_classes')->select('class_name')->distinct()->get()->pluck('class_name','class_name');
		$data['section'] = DB::table('tbl_classes')->select('section_name')->distinct()->get()->pluck('section_name','section_name');
		$data['class']->prepend('Select Class','');
		$data['section']->prepend('Select Section','');
		
		
		
		$days = array(
								''=>'Select Days',
								'Monday'=>'Monday',
								'Tuesday'=>'Tuesday',
								'Wednesday'=>'Wednesday',
								'Thrusday'=>'Thrusday',
								'Friday'=>'Friday',
								'Saturday'=>'Saturday'
							);
		return view('admin.class.add',compact('data',$data))->with('days',$days);
    } */
	

}
