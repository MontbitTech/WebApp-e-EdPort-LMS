<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;
use Auth;
use Validator;
use App\Http\Helpers\CommonHelper;
use App\Teacher;
use App\StudentClass;
use App\StudentSubject;
use App\ClassTiming;
use App\InvitationClass;
use PDF;
use DB;
use Log;
use App\DateClass;

class ImportTimetableController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        //$this->middleware('auth');
        // return Auth::guard('admin');
    }

    /**
     * Show the application dashboard.|min:8
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function editTimetable (Request $request)
    {
        //dd($request->all());
        /*  if($request->isMethod('post'))
         {
               $request->validate([
             'tid' => 'required',
             'sel_teacher' => 'required',
             'sel_subject' => 'required',
             'radio' => 'required',
           ]); */
        $timeTableID = $request->tid;
        $option_val = $request->radio;

        $teacher_id = $request->sel_teacher;
        $subject_id = $request->sel_subject;

        $obj_timeTable = ClassTiming::where('id', $timeTableID)->get()->first();

        $cur_class_ID = $obj_timeTable->class_id;
        $cur_teacher_id = $obj_timeTable->teacher_id;
        $cur_subject_id = $obj_timeTable->subject_id;

        $cur_from_timing = $obj_timeTable->from_timing;
        $cur_to_timing = $obj_timeTable->to_timing;


        $obj_class = StudentClass::where('id', $cur_class_ID)->get()->first();

        $cur_class_name = $obj_class->class_name;
        $cur_section_name = $obj_class->section_name;
        $cur_g_class_id = $obj_class->g_class_id;


        if ( $teacher_id != null || $teacher_id != '' ) {

            $obj_teacher = Teacher::where('id', $teacher_id)->get()->first();

            $g_teacher_id = $obj_teacher['g_user_id'];
            $phone = $obj_teacher['phone'];

            $subject_name = StudentSubject::where('id', $cur_subject_id)->get()->first();

            $sub_name = $subject_name['subject_name'];


            $teacherTimeExist = ClassTiming::where('teacher_id', $teacher_id)->where('from_timing', $cur_from_timing)->get()->first();


            //$dateClassTeacherExist = DateClass::where('teacher_id',$teacher_id)->where('from_timing',$cur_from_timing)->get()->first();
            //	dd($dateClassTeacherExist);

            if ( $teacherTimeExist ) {
                return back()->with('error', "Teacher have already assigned lecture at selected time.");
            } /* else if($dateClassTeacherExist)
			{
				return back()->with('error',"Teacher have already assigned lecture at selected time.");
			} */
            else {
                $prve_g_code = '';
                // Previous Teacher Data
                $obj_prev_teacher = InvitationClass::where('class_id', $cur_class_ID)->where('subject_id', $cur_subject_id)->where('teacher_id', $teacher_id)->get()->first();
                $token = CommonHelper::varify_Admintoken(); // verify admin token
                if ( $obj_prev_teacher ) {
                    $prve_g_code = $obj_prev_teacher->g_code;

                    if ( $prve_g_code != '' ) {
                        $inv_delete = CommonHelper::teacher_invitation_delete($token, $prve_g_code); // cancel invitation
                    }
                }
                /// Send SMS to Teacher for assigned new Class
                if ( strlen($phone) <= 10 ) {
                    $number = '91' . $phone;
                } else {
                    $number = $phone;
                }

                $message = "You are invited for a new class $cur_class_name - $cur_section_name - $sub_name.";

                $s = CommonHelper::send_sms($number, $message);


                $inv_data = array(
                    "courseId" => $cur_g_class_id,
                    "role"     => "TEACHER",
                    "userId"   => $g_teacher_id,

                );
                $inv_data = json_encode($inv_data);
                $inv_responce = CommonHelper::teacher_invitation_forClass($token, $inv_data); // Invite teacher

                $inv_resData = array('error' => '');

                if ( $inv_responce == 101 ) {
                    return back()->with('error', Config::get('constants.WebMessageCode.119'));
                } else {
                    $inv_resData = array_merge($inv_resData, json_decode($inv_responce, true));
                    //dd($inv_responce);

                    if ( $inv_resData['error'] != '' ) {

                        if ( $inv_resData['error']['status'] == 'UNAUTHENTICATED' ) {
                            return redirect()->route('admin.logout');
                        } else if ( $inv_resData['error']['status'] == 'FAILED_PRECONDITION' ) {
                            return back()->with('error', 'The requested user\'s account is disabled or if the user already has this role');
                        } else {
                            //Log::error($inv_resData['error']['message']);
                            return back()->with('error', $inv_resData['error']['message']);
                        }
                    } else {

                        $inv_res_code = $inv_resData['id'];
                        $obj_inv = new InvitationClass;
                        $obj_inv->class_id = $cur_class_ID;
                        $obj_inv->subject_id = $cur_subject_id;
                        $obj_inv->teacher_id = $teacher_id;
                        $obj_inv->g_code = $inv_res_code;
                        //$obj_inv->g_responce = '';
                        //$obj_inv->is_accept = 0;
                        $obj_inv->save();

                        // Update All Record in time table
                        $obj = ClassTiming::where('subject_id', $cur_subject_id)->where('class_id', $cur_class_ID)->where('teacher_id', $cur_teacher_id)->where('from_timing', $cur_from_timing)->update(['teacher_id' => $teacher_id]);

                        //$objD = DateClass::where('subject_id',$cur_subject_id)->where('class_id',$cur_class_ID)->where('teacher_id',$cur_teacher_id)->update(['teacher_id'=>$teacher_id]);    just now i commented

                        return back()->with('success', "TimeTable updated successfully..");
                    }
                }
            }
        }

        if ( $subject_id != null || $subject_id != '' ) {
            $studentClassExist = StudentClass::where('class_name', $cur_class_name)->where('section_name', $cur_section_name)->where('subject_id', $subject_id)->get()->first();

            if ( !$studentClassExist ) {
                return back()->with('error', "Selected subject class does not exists...");
            } else {

                $subject_name = StudentSubject::where('id', $subject_id)->get()->first();

                $sub_name = $subject_name['subject_name'];

                $obj_curTeacher = Teacher::where('id', $cur_teacher_id)->get()->first();

                $g_teacher_id = $obj_curTeacher['g_user_id'];
                $phone = $obj_curTeacher['phone'];

                $class_id = $studentClassExist->id;
                $g_class_id = $studentClassExist->g_class_id;

                /// Send SMS to Teacher for assigned new Class
                if ( strlen($phone) <= 10 ) {
                    $number = '91' . $phone;
                } else {
                    $number = $phone;
                }

                $message = "You are invited for a new class $cur_class_name - $cur_section_name - $sub_name.";

                $s = CommonHelper::send_sms($number, $message);

                $token = CommonHelper::varify_Admintoken(); // verify admin token
                $inv_data = array(
                    "courseId" => $g_class_id,
                    "role"     => "TEACHER",
                    "userId"   => $g_teacher_id,

                );
                $inv_data = json_encode($inv_data);
                $inv_responce = CommonHelper::teacher_invitation_forClass($token, $inv_data); // Ivite teacher

                //	$inv_delete = CommonHelper::teacher_invitation_delete($token,$prve_g_code); // cancel invitation

                $inv_resData = array('error' => '');

                if ( $inv_responce == 101 ) {
                    return back()->with('error', Config::get('constants.WebMessageCode.119'));
                } else {
                    $inv_resData = array_merge($inv_resData, json_decode($inv_responce, true));
                    if ( $inv_resData['error'] != '' ) {

                        if ( $inv_resData['error']['status'] == 'UNAUTHENTICATED' ) {
                            return redirect()->route('admin.logout');
                        } else {
                            //Log::error($inv_resData['error']['message']);
                            return back()->with('error', $inv_resData['error']['message']);
                        }
                    } else {

                        $inv_res_code = $inv_resData['id'];
                        $obj_inv = new InvitationClass;
                        $obj_inv->class_id = $class_id;
                        $obj_inv->subject_id = $subject_id;
                        $obj_inv->teacher_id = $cur_teacher_id;
                        $obj_inv->g_code = $inv_res_code;
                        //$obj_inv->g_responce = '';
                        //$obj_inv->is_accept = 0;
                        $obj_inv->save();

                        // Update All Record in time table
                        $obj = ClassTiming::where('subject_id', $cur_subject_id)->where('class_id', $cur_class_ID)->where('teacher_id', $cur_teacher_id)->update(['class_id' => $class_id, 'subject_id' => $subject_id]);

                        return back()->with('success', "TimeTable updated successfully..");
                    }
                }


            }
        }

    }


    public function timeTableImport (Request $request)
    {
        $g_class_id = '';
        $g_teacher_id = '';
        $class_name = '';
        $section_name = '';
        if ( $request->isMethod('post') ) {
            try {
                $request->validate([
                    'file' => 'required',
                ]);
                $extensions = array("csv", "xls", "xlsx");
                $file_validate = strtolower($request->file('file')->getClientOriginalExtension());
                if ( !in_array($file_validate, $extensions) ) {
                    return back()->with('error', sprintf(Config::get('constants.WebMessageCode.103'), implode(",", $extensions)));
                }
                $file = $request->file('file');
                $destinationPath = public_path('timetable-excels');
                $filename = $file->getClientOriginalName();


                if ( file_exists($destinationPath . '/' . $filename) )
                    unlink($destinationPath . '/' . $filename);
                $file->move($destinationPath, $filename);
                $path = $destinationPath . '/' . $filename;

                $headerMissing = array();
                $supplierAdded = 0;
                $ipAdded = 0;
                $collection = ( new FastExcel )->import($path);
                /*
                   echo "<pre>";
                  print_r($collection);
                  exit; */
                if ( !isset($collection[0]) ) {
                    return back()->with('error', Config::get('constants.WebMessageCode.104'));
                }
                $teacher_subjects = array();
                $teacher_classes = array();

                $token = CommonHelper::varify_Admintoken(); // verify admin token
                Log::info('Filename processing - ' . $filename);
                foreach ( $collection as $key => $reader ) {
                    // echo "<pre>";
                    $reader_keys = array_keys($reader);
                    $reader_values = array_values($reader);
                    $j = 0;
                    $error = '';
                    $rows = '';
                    $error_message = '';
                    for ( $i = 0; $i < 8; $i++ ) {
                        $j++;
                        $class_section_str = $reader_keys[0];
                        $time = $reader_values[1];
                        $period = $reader_values[0];

                        $time_splitted_arr = explode("-", $time);
                        $start_time = isset($time_splitted_arr[0]) ? trim($time_splitted_arr[0]) : '';   // Start Time
                        $end_time = isset($time_splitted_arr[1]) ? trim($time_splitted_arr[1]) : '';     // End Time


                        if ( $i == 0 ) {
                            if ( $period == '' ) {
                                Log::error('Period Name missing : ROW - ' . $j);
                                $error_message = 'Period Name missing : ROW - ' . $j;
                                $error = 'found';
                                $rows .= $j . ",";
                            }
                        }
                        if ( $i == 1 ) {

                            if ( $start_time == '' ) {
                                Log::error('Start time missing : ROW - ' . $period);
                                $error_message = 'Start time missing : ROW - ' . $period;
                                $error = 'found';
                                $rows .= $j . ",";
                            } else if ( $end_time == '' ) {
                                Log::error('End time missing : ROW - ' . $period);
                                $error_message = 'End time missing : ROW - ' . $period;
                                $error = 'found';
                                $rows .= $j . ",";
                            } else if ( strtotime($start_time) > strtotime($end_time) ) {
                                Log::error('End time is earlier than start time : ROW - ' . $period);
                                $error_message = 'End time is earlier than start time : ROW - ' . $period;
                                $error = 'found';
                                $rows .= $j . ",";
                            }
                        }
                        if ( $i > 1 ) {
                            $day_array = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday");
                            $teacher_subjects_arr = explode("/", $reader_values[ $i ]);
                            $teacher_name = isset($teacher_subjects_arr[0]) ? trim($teacher_subjects_arr[0]) : '';   // Teacher Name
                            $subject_name = isset($teacher_subjects_arr[1]) ? trim($teacher_subjects_arr[1]) : '';     // subject_name
                            if ( strtolower($teacher_name) != 'lunch' ) {
                                if ( $reader_keys[ $i ] == '' ) {
                                    Log::error('Day missing : ROW - ' . $period);
                                    $error_message = 'Day missing : ROW - ' . $period;
                                    $error = 'found';
                                    $rows .= $j . ",";
                                } else if ( !in_array(strtolower($reader_keys[ $i ]), $day_array) ) {
                                    Log::error('Invalid Day Name : ROW - ' . $period);
                                    $error_message = 'Invalid Day Name : ROW - ' . $period;
                                    $error = 'found';
                                    $rows .= $j . ",";
                                } else if ( $teacher_name == '' ) {
                                    Log::error('Teacher Name missing : ROW - ' . $period);
                                    $error_message = 'Teacher Name missing : ROW - ' . $period;
                                    $error = 'found';
                                    $rows .= $j . ",";
                                } else if ( $subject_name == '' ) {
                                    Log::error('Subject Name missing : ROW - ' . $period);
                                    $error_message = 'Subject Name missing : ROW - ' . $period;
                                    $error = 'found';
                                    $rows .= $j . ",";
                                }

                                $studentSubjectExist = StudentSubject::where('subject_name', $subject_name)->first();
                                if ( !$studentSubjectExist ) {

                                    Log::error('Invalid Subject Name or Not Found : ROW - ' . $period);
                                    $error_message = 'Invalid Subject Name or Not Found : ROW - ' . $period;
                                    $error = 'found';
                                    $rows .= $j . ",";

                                }
                                $teacherExist = Teacher::where('name', $teacher_name)->first();

                                if ( !$teacherExist ) {
                                    Log::error('Invalid Teacher Name or Not Found : ROW - ' . $period);
                                    $error_message = 'Invalid Teacher Name or Not Found : ROW - ' . $period;
                                    $error = 'found';
                                    $rows .= $j . ",";
                                }
                            }
                            $period_array[] = $period . ',' . $reader_keys[ $i ] . ',' . $teacher_name . ',' . $subject_name . ',' . $start_time . ',' . $end_time;
                        }
                    }

                    if ( $error == "found" ) {
                        return back()->with('error', 'Import time table has not processed, ' . $error_message);
                        exit;
                    }

                }


                if ( $class_section_str != '' ) {
                    $class_spliited_arr = explode(":", $class_section_str);

                    $class_section_name = isset($class_spliited_arr[1]) ? $class_spliited_arr[1] : '';

                    $class_section_array = explode(" ", $class_section_name);

                    $class_name = isset($class_section_array[0]) ? trim($class_section_array[0]) : '';
                    $section_name = isset($class_section_array[1]) ? trim($class_section_array[1]) : '';
                    if ( $class_name == '' || $section_name == '' ) {
                        return back()->with('error', Config::get('constants.WebMessageCode.120'));
                    }
                } else {
                    return back()->with('error', Config::get('constants.WebMessageCode.120'));
                }


                if ( count($period_array) > 0 ) {
                    $rows_period = '';
                    $error_msg = '';
                    $g_live_link = '';
                    foreach ( $period_array as $period ) {

                        //echo $period;
                        //print_r(explode(",",$period));
                        $period = explode(",", $period);
                        $period_name = $period[0];
                        $day = $period[1];

                        /* $teacher_spillted_arr = $period[2];
                        $teacher_subjects_arr = explode("/",$teacher_spillted_arr); */

                        $teacher_name = $period[2];///isset($teacher_subjects_arr[0])?trim($teacher_subjects_arr[0]):'';   // Teacher Name
                        $subject_name = $period[3];//isset($teacher_subjects_arr[1])?trim($teacher_subjects_arr[1]):'';     // subject_name

                        /* $time_array = $period[3];
                        $time_splitted_arr = explode("-",$time_array); */

                        $start_time = $period[4];//isset($time_splitted_arr[0])?trim($time_splitted_arr[0]):'';   // Start Time
                        $end_time = $period[5];//isset($time_splitted_arr[1])?trim($time_splitted_arr[1]):'';     // End Time

                        if ( strtolower($teacher_name) != 'lunch' ) {
                            //Check Subject
                            $studentSubjectExist = StudentSubject::where('subject_name', $subject_name)->first();
                            if ( $studentSubjectExist ) {
                                $studentSubjectDetail = $studentSubjectExist;
                            } else {
                                // $studentSubjectDetail = new StudentSubject;
                                Log::error('Invalid subject name in ROW -  ' . $period_name);
                                $error = "found";
                                $rows_period .= $period_name . ",";
                                $error_msg = 'Invalid subject name in ROW -  ' . $period_name;

                            }
                            //$studentSubjectDetail->subject_name = $subject_name;
                            //$studentSubjectDetail->save();
                            $subject_id = $studentSubjectDetail->id;        //----------------------------Subject ID


                            $teacherExist = Teacher::where('name', $teacher_name)->first();
                            if ( $teacherExist ) {
                                $user = $teacherExist;

                            } else {
                                Log::error('Teacher does not exist For ROW - ' . $period_name);
                                $error = "found";
                                $rows_period .= $period_name . ",";
                                $error_msg = 'Teacher does not exist For ROW - ' . $period_name;
                                // return back()->with('error',Config::get('constants.WebMessageCode.126'));
                            }


                            $phone = $user->phone;
                            $teacher_id = $user->id;            // --------------------------Teacher ID
                            $g_teacher_id = $user->g_user_id; //--------------------------------- Google USer ID


                            //---------------------------- Check Class exits or not
                            $studentClassExist = StudentClass::where('class_name', $class_name)->where('section_name', $section_name)->where('subject_id', $subject_id)->first();
                            if ( $studentClassExist ) {
                                $studentClassDetail = $studentClassExist;
                                $class_id = $studentClassDetail->id;                        //-----------------------------Class Id
                                $g_class_id = $studentClassDetail->g_class_id;            //-----------------------------Google Class ID

                            } else {

                                $studentClassDetail = new StudentClass;

                                //---------------------------- Google Create class api
                                $data = array(
                                    "name"               => $class_name . ' ' . $subject_name,
                                    "section"            => $section_name,
                                    "descriptionHeading" => "",
                                    "description"        => "",
                                    "room"               => "",
                                    "ownerId"            => "me",
                                    "courseState"        => "ACTIVE",

                                );
                                $data = json_encode($data);

                                $response = CommonHelper::create_class($token, $data); //------------------------------------access Google api craete Cource
                                $resData = array('error' => '');

                                if ( !$response['success'] ) {
                                    Log::error('Class has not create in Google ClassRoom for ROW -  ' . $period_name);
                                    $error = "found";
                                    $rows_period .= $period_name . ",";
                                    $error_msg = 'Class has not create in Google ClassRoom for ROW -  ' . $period_name;

                                    if ( $response['data']->status == 'UNAUTHENTICATED' )
                                        return redirect()->route('admin.logout');
                                } else {
                                    $resData = array_merge($resData, json_decode($response, true));

                                    $g_class_id = $resData['id'];                //-----------------------------Google Class ID
                                    $g_live_link = $resData['alternateLink'];
                                    $studentClassDetail->class_name = $class_name;
                                    $studentClassDetail->section_name = $section_name;
                                    $studentClassDetail->subject_id = $subject_id;
                                    $studentClassDetail->g_class_id = $g_class_id;
                                    $studentClassDetail->g_link = $resData['alternateLink'];
                                    $studentClassDetail->g_response = serialize($response['data']);
                                    $studentClassDetail->save();
                                    $class_id = $studentClassDetail->id;        //------------------------------Class ID
                                }
                            }


                            // Teacher availability Check
                            $from_timing = date("H:i:s", strtotime($start_time));

                            $teacherTimeExist = ClassTiming::where('teacher_id', $teacher_id)->where('class_day', $day)->where('from_timing', $from_timing)->get()->first();


                            //dd($teacherTimeExist);

                            if ( !$teacherTimeExist ) {
                                // Invitation send to teacher for class
                                $inviteExist = InvitationClass::where('class_id', $class_id)->where('subject_id', $subject_id)->where('teacher_id', $teacher_id)->get()->first();
                                if ( $inviteExist ) {
                                    $obj_inv = $inviteExist;
                                } else {
                                    $inv_data = array(
                                        "courseId" => $g_class_id,
                                        "role"     => "TEACHER",
                                        "userId"   => $g_teacher_id,
                                    );

                                    $inv_data = json_encode($inv_data);
                                    $inv_responce = CommonHelper::teacher_invitation_forClass($token, $inv_data); // access Google api craete Cource

                                    $inv_resData = array('error' => '');


                                    if ( $inv_responce == 101 ) {
                                        ////return back()->with('error',"Error 03");// Config::get('constants.WebMessageCode.119'));
                                        Log::error('Invitation has not send to teacher for class, Error In ROW - ' . $period_name);
                                        $error = "found";
                                        //$rows_period .= $period_name . ",";
                                        $error_msg = 'Invitation has not send to teacher for class, Error In ROW - ' . $period_name;
                                    } else {
                                        $inv_resData = array_merge($inv_resData, json_decode($inv_responce, true));
                                        if ( $inv_resData['error'] != '' ) {
                                            //return back()->with('error', "error 04");//Config::get('constants.WebMessageCode.119'));
                                            Log::error('Invitation has not send to teacher for class, Error In ROW - ' . $period_name);
                                            $error = "found";
                                            $rows_period .= $period_name . ",";
                                            $error_msg = 'Invitation has not send to teacher for class, ' . $inv_resData['error']['message'] . ' Error In ROW - ' . $period_name;

                                        } else {
                                            $inv_res_code = $inv_resData['id'];
                                            $obj_inv = new InvitationClass;
                                            $obj_inv->class_id = $class_id;
                                            $obj_inv->teacher_id = $teacher_id;
                                            $obj_inv->subject_id = $subject_id;
                                            $obj_inv->g_code = $inv_res_code;
                                            $obj_inv->g_responce = '';
                                            $obj_inv->is_accept = 0;
                                            $obj_inv->save();


                                        }
                                    }

                                    /// Send SMS to Teacher for assigned new Class
                                    if ( strlen($phone) <= 10 ) {
                                        $number = '91' . $phone;
                                    } else {
                                        $number = $phone;
                                    }

                                    $message = "You are invited for a new class $class_name - $section_name - $subject_name.";

                                    $s = CommonHelper::send_sms($number, $message);


                                }
                            } else {
                                Log::error('Teacher have already assigned lecture at selected time, for  ROW - ' . $period_name);
                                $error = "found";
                                $rows_period .= $period_name . ",";
                                $error_msg = 'Teacher have already assigned lecture at selected time, for  ROW - ' . $period_name;
                            }


                        } else {
                            $teacher_id = 0;
                        }


                        if ( !$teacherTimeExist )         // check teacher availability
                        {
                            if ( $class_id > 0 && $subject_id > 0 && $error == '' ) {
                                //Adding or updating timetable
                                //$day = date("l",strtotime($day));
                                $from_timing = date("H:i:s", strtotime($start_time));
                                $to_timing = date("H:i:s", strtotime($end_time));

                                // Class availability Check

                                $studentTimingExist = ClassTiming::where('class_day', $day)->where('class_id', $class_id)->where('from_timing', $from_timing)->get()->first();


                                $lunch = 0;
                                if ( $teacher_id == 0 ) {
                                    $lunch = 1;
                                }

                                if ( $studentTimingExist ) {
                                    //$studentTimingDetail = $studentTimingExist;
                                    Log::error('Class have already assigned lecture at selected time, for  ROW - ' . $period_name);
                                    $error = "found";
                                    $rows_period .= $period_name . ",";
                                    $error_msg = 'Class have already assigned lecture at selected time, for  ROW - ' . $period_name;

                                } else {
                                    $studentTimingDetail = new ClassTiming;
                                    $studentTimingDetail->class_id = $class_id;
                                    $studentTimingDetail->subject_id = $subject_id;
                                    $studentTimingDetail->teacher_id = $teacher_id;
                                    $studentTimingDetail->class_day = $day;
                                    $studentTimingDetail->from_timing = $from_timing;
                                    $studentTimingDetail->to_timing = $to_timing;
                                    $studentTimingDetail->is_lunch = $lunch;
                                    $studentTimingDetail->save();

                                    $timetableId = $studentTimingDetail->id;

                                    // Today's  Lecture add on dateClass table
                                    $Tdays = date('l');
                                    $todaysDate = date("Y-m-d");
                                    if ( $Tdays == $day ) {
                                        $obj_dataClass = new DateClass;

                                        $obj_dataClass->class_id = $class_id;
                                        $obj_dataClass->subject_id = $subject_id;
                                        $obj_dataClass->teacher_id = $teacher_id;
                                        $obj_dataClass->from_timing = $from_timing;
                                        $obj_dataClass->to_timing = $to_timing;
                                        $obj_dataClass->class_date = $todaysDate;
                                        $obj_dataClass->timetable_id = $timetableId;
                                        $obj_dataClass->live_link = $g_live_link;
                                        $obj_dataClass->save();

                                    }
                                }
                            } else {
                                Log::error('Something went wrong while Createting time table for  ROW - ' . $period_name);
                                $error = "found";
                                $rows_period .= $period_name . ",";
                                //$error_msg = 'Something went wrong while Createting time table for  ROW - ' .$period_name;
                                ///return back()->with('error',Config::get('constants.WebMessageCode.121'));
                            }
                        }
                        if ( $error == "found" ) {
                            return back()->with('error', $error_msg);
                        }
                    }
                }
                Log::info('File processing done ');
                if ( $error == "found" )
                    return back()->with('error', 'Import time table processed, check log file, errors in rows - ' . $period_name);
                else
                    return back()->with('success', Config::get('constants.WebMessageCode.122'));


            } catch ( \Exception $e ) {
                //dd($e);
                return back()->with('error', $e->getMessage() . '  check log file, errors in rows - ' . $period_name);
            }
            @unlink($path);

            //return redirect()->route('list.timetable')->with('success',Config::get('constants.WebMessageCode.122'));


        }

        return view('admin.timetable.import');
    }

    public function filterTimetable (Request $request)  // if any update in this function, then same changes we have to update in download_Timetable function
    {
        $class_name = $request->txtclass;
        $section_name = $request->txtsubject;
        $i = 1;
        $p = 1;
        $html = "";

        $cl = $class_name . " " . $section_name;

        $ttime = \DB::select('SELECT DISTINCT from_timing FROM `tbl_class_timings` ORDER by from_timing');


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

        foreach ( $ttime as $t ) {
            $days = \DB::select("SELECT t.id, t.from_timing, t.to_timing, t.class_day, r.name, s.subject_name , t.is_lunch, r.g_meet_url
													FROM tbl_class_timings t
													left join tbl_student_subjects s on s.id = t.subject_id
													left join tbl_student_classes c on c.id = t.class_id
													left join tbl_techers r on r.id = t.teacher_id
													where c.class_name = ? and c.section_name=?
													and from_timing = ?", [$class_name, $section_name, $t->from_timing]);

            if ( count($days) > 0 ) {
                foreach ( $days as $d ) {
                    if ( $p % 2 == 0 )
                        $x = "even";
                    else
                        $x = "odd";

                    if ( $i == 1 ) {
                        $html .= "<tr class='$x'><td><strong>Period $p</strong></td><td>" . date('H:i', strtotime($d->from_timing)) . "-" . date('H:i', strtotime($d->to_timing)) . "</td>";
                        $htmla .= "<tr class='$x'><td>Period $p</td><td style='width:100px;'>" . date('H:i', strtotime($d->from_timing)) . "-" . date('H:i', strtotime($d->to_timing)) . "</td>";
                    }

                    if ( empty($d->g_meet_url) )
                        $e = $d->name . " (<strong>" . $d->subject_name . "</strong>)";
                    else
                        $e = "<a target='_blank' href='" . $d->g_meet_url . "'>" . $d->name . " (<strong>" . $d->subject_name . "</strong>)</a>";

                    $cc = array();
                    parse_str("details=" . $d->id . "/" . $d->name . "/" . $d->subject_name . "/" . $d->class_day . "/" . date('H:i', strtotime($d->from_timing)) . "-" . date('H:i', strtotime($d->to_timing)), $cc);

                    //dd($cc);

                    $ed = "<br><a 
									data-id='" . $d->id . "' 
									data-tname='" . $d->name . "' 
									data-subject_name='" . $d->subject_name . "' 
									data-class_day='" . $d->class_day . "' 
									data-timing='" . date('H:i', strtotime($d->from_timing)) . "-" . date('H:i', strtotime($d->to_timing)) . "' 
									data-deleteModal=" . $d->id . "
									href='javascript:void(0)' onclick='editTimetable(" . $d->id . "," . json_encode($cc) . ")'>Edit</a>";

                    $html .= "<td>" . ( $d->is_lunch == 1 ? "LUNCH" : $e ) . "</td>";
                    $htmla .= "<td>" . ( $d->is_lunch == 1 ? "LUNCH" : $e ) . $ed . "</td>";
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


        $name = public_path('dl-timetable') . "/" . $class_name . "_" . $section_name . "_timetable.pdf";

        if ( file_exists($name) )
            unlink($name);

        //$pdf = PDF::loadHTML($html);
        $pdf = PDF::loadHTML($html)->setPaper('a3', 'landscape')->setWarnings(false)->save($name);

        return array("html" => $htmla, "data" => $days);
    }

    public function listTimetable ()
    {
        $timetables = ClassTiming::join('tbl_techers', 'tbl_techers.id', '=', 'tbl_class_timings.teacher_id')->get();

        $ar["class"] = \DB::table('tbl_student_classes')->distinct()->get(['class_name']);
        $ar["sname"] = \DB::table('tbl_student_classes')->distinct()->get(['section_name']);
        $ar["tname"] = \DB::table('tbl_techers')->get(['id', 'name']);
        $ar["subname"] = \DB::table('tbl_student_classes as c')
            ->join('tbl_student_subjects as s', 'c.subject_id', 's.id')
            ->where('s.subject_name', '<>', 'Lunch')
            ->get(['s.id', 's.subject_name']);

        $ar["timing"] = \DB::table('tbl_class_timings')->distinct()->pluck('from_timing', 'to_timing');

        return view('admin.timetable.index', compact('timetables', 'ar'));
    }

    public function addExtraClass (Request $request)
    {

        if ( $request->isMethod('post') ) {


            $request->validate([
                'class_id'   => 'required',
                'teacher'    => 'required',
                'class_date' => 'required',
                'start_time' => 'required',
                'end_time'   => 'required',

            ]);

            $class_id = $request->class_id;
            $teacher_id = $request->teacher;

            $obj_teacher = Teacher::where('id', $request->teacher)->get()->first();

            $g_teacher_id = $obj_teacher['g_user_id'];
            $phone = $obj_teacher['phone'];

            $obj_class = StudentClass::where('id', $class_id)->get()->first();

            $g_class_id = $obj_class['g_class_id'];
            $g_live_link = $obj_class['g_link'];
            $subject_id = $obj_class['subject_id'];
            $class_name = $obj_class['class_name'];
            $section_name = $obj_class['section_name'];

            $subject_name = StudentSubject::where('id', $subject_id)->get()->first();

            $sub_name = $subject_name['subject_name'];


            /* if($request->islunch == 1){
            $islunch = $request->islunch;
            } */
            //$allocate_email = $obj_teacher[0]['email'];

            $class_date = date("Y-m-d", strtotime($request->class_date));
            $from_time = str_replace(" : ", ":", $request->start_time);
            $from_time = date("H:i:s", strtotime($from_time));
            $to_time = str_replace(" : ", ":", $request->end_time);
            $to_time = date("H:i:s", strtotime($to_time));
            $class_day = date("l", strtotime($request->class_date));
            $today = date("Y-m-d");


            $TimeTableExist = ClassTiming::where('class_id', $class_id)->where('teacher_id', $teacher_id)->where('subject_id', $subject_id)->where('class_day', $class_day)->where('from_timing', $from_time)->get()->first();

            $classTimingExist = ClassTiming::where('class_id', $class_id)->where('class_day', $class_day)->where('from_timing', $from_time)->get()->first();

            $teacherTimeExist = ClassTiming::where('teacher_id', $teacher_id)->where('class_day', $class_day)->where('from_timing', $from_time)->get()->first();


            $dateClassExist = DateClass::where('class_id', $class_id)->where('teacher_id', $teacher_id)->where('subject_id', $subject_id)->where('class_date', $class_date)->where('from_timing', $from_time)->get()->first();

            $dateClassTimeExist = DateClass::where('class_id', $class_id)->where('class_date', $class_date)->where('from_timing', $from_time)->get()->first();

            $dateClassTeacherExist = DateClass::where('teacher_id', $teacher_id)->where('class_date', $class_date)->where('from_timing', $from_time)->get()->first();

            if ( $TimeTableExist ) {
                return back()->with('error', "Class already allocated to selected teacher at selected time!.");
            } else if ( $classTimingExist ) {
                return back()->with('error', "Class have already assigned lecture at selected time.");
            } else if ( $teacherTimeExist ) {
                return back()->with('error', "Teacher have already assigned lecture at selected time.");
            } else if ( $dateClassExist ) {
                return back()->with('error', "Class already allocated to selected teacher at selected time!.");
            } else if ( $dateClassTimeExist ) {
                return back()->with('error', "Class have already assigned lecture at selected time.");
            } else if ( $dateClassTeacherExist ) {
                return back()->with('error', "Teacher have already assigned lecture at selected time.");
            } else {

                /* $obj_time = new ClassTiming;
                $obj_time->class_id = $class_id;
                $obj_time->teacher_id = $teacher_id;
                $obj_time->subject_id = $subject_id;
                $obj_time->class_day = $days;
                $obj_time->from_timing = $from_time;
                $obj_time->to_timing = $to_time;
                $obj_time->is_lunch = $islunch;
                $obj_time->save();  */


                $pastClassDetail = new DateClass;
                $pastClassDetail->class_id = $class_id;
                $pastClassDetail->subject_id = $subject_id;
                $pastClassDetail->teacher_id = $teacher_id;
                $pastClassDetail->from_timing = $from_time;
                $pastClassDetail->to_timing = $to_time;

                $pastClassDetail->class_date = $class_date;
                //$pastClassDetail->class_description = $description;
                //$pastClassDetail->class_student_msg = $class_student_msg;
                $pastClassDetail->live_link = $g_live_link;
                //$pastClassDetail->g_meet_url = $class_liveurl;
                $pastClassDetail->save();


                /// Send SMS to Teacher for assigned new Class
                if ( strlen($phone) <= 10 ) {
                    $number = '91' . $phone;
                } else {
                    $number = $phone;
                }

                $message = "You are invited for a new class $class_name - $section_name - $sub_name.";

                $s = CommonHelper::send_sms($number, $message);

                $token = CommonHelper::varify_Admintoken(); // verify admin token
                $inv_data = array(
                    "courseId" => $g_class_id,
                    "role"     => "TEACHER",
                    "userId"   => $g_teacher_id,

                );
                $inv_data = json_encode($inv_data);
                $inv_responce = CommonHelper::teacher_invitation_forClass($token, $inv_data); // access Google api craete Cource
                $inv_resData = array('error' => '');


                if ( $inv_responce == 101 ) {
                    return back()->with('error', Config::get('constants.WebMessageCode.119'));
                } else {
                    $inv_resData = array_merge($inv_resData, json_decode($inv_responce, true));
                    if ( $inv_resData['error'] != '' ) {

                        if ( $inv_resData['error']['status'] == 'UNAUTHENTICATED' ) {
                            return redirect()->route('admin.logout');
                        } else {
                            //Log::error($inv_resData['error']['message']);
                            return back()->with('error', $inv_resData['error']['message']);
                        }
                    } else {

                        $inv_res_code = $inv_resData['id'];
                        $obj_inv = new InvitationClass;
                        $obj_inv->class_id = $class_id;
                        $obj_inv->subject_id = $subject_id;
                        $obj_inv->teacher_id = $teacher_id;
                        $obj_inv->g_code = $inv_res_code;
                        //$obj_inv->g_responce = '';
                        //$obj_inv->is_accept = 0;
                        $obj_inv->save();
                    }
                }

                return redirect()->route('add.extracalss')->with('success', "Extra class created successfully.");

            }


        }

        $data['classData'] = DB::table('tbl_student_classes as c')->select('c.id', 'c.class_name', 'c.section_name', 'c.subject_id', 's.subject_name')->join('tbl_student_subjects as s', 'c.subject_id', 's.id')->get();
        $data['teacher'] = DB::table('tbl_techers')->select('id', DB::raw("name AS full_name"))->get()->pluck('full_name', 'id');
        //$data['teacher'] = DB::table('tbl_techers')->select('id', DB::raw("CONCAT(first_name,' ',last_name) AS full_name"))->get()->pluck('full_name', 'id');
        $data['teacher']->prepend('Select Teacher', '');
        $days = array(
            ''          => 'Select Days',
            'Monday'    => 'Monday',
            'Tuesday'   => 'Tuesday',
            'Wednesday' => 'Wednesday',
            'Thrusday'  => 'Thrusday',
            'Friday'    => 'Friday',
            'Saturday'  => 'Saturday',
        );

        return view('admin.timetable.addPeriod', compact('data'))->with('days', $days);
    }


    public function sampleDownload (Request $request)
    {
        $path = public_path('timetable-excels/sample/') . '/Sample-TimeTable-format.csv';

        return response()->download($path);
    }

    /*Import no of students in a class*/
    public function importClassStudentNumber (Request $request)
    {
        $student_class = \App\StudentClass::all();
        if ( Request()->post() ) {
            try {
                $request->validate([
                    'file'  => 'required',
                    'class' => 'required',
                ]);
                $extensions = array("csv", "xlsx");
                $file_validate = strtolower($request->file('file')->getClientOriginalExtension());
                if ( !in_array($file_validate, $extensions) ) {
                    return back()->with('error', sprintf(Config::get('constants.WebMessageCode.103'), implode(",", $extensions)));
                }
                $file = $request->file('file');
                $destinationPath = public_path('studentnumber-excels');
                $filename = $file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                $path = $destinationPath . '/' . $filename;

                $headerMissing = array();
                $supplierAdded = 0;
                $ipAdded = 0;
                $collection = ( new FastExcel )->import($path);
                if ( !isset($collection[0]) ) {
                    return back()->with('error', Config::get('constants.WebMessageCode.104'));
                }
                $numbers = array();
                foreach ( $collection as $key => $reader ) {
                    if ( !ctype_digit(array_values($reader)[0]) ) {
                        continue;
                    }
                    $numbers[] = array_values($reader);
                }
                if ( count($numbers) > 0 ) {
                    $mobile_numbers = implode(',', array_unique(array_merge(...$numbers)));
                    $studentClass = \App\StudentClass::where('id', $request->class)->update(['student_numbers' => $mobile_numbers]);
                } else {
                    return back()->with('error', Config::get('constants.WebMessageCode.104'));
                }

                return back()->with('success', Config::get('constants.WebMessageCode.112'));
            } catch ( \Exception $e ) {
                return back()->with('error', Config::get('constants.WebMessageCode.121'));
            }
            @unlink($path);
        }

        return view('admin.class.import_student', compact('student_class'));
    }


    //DownLoad Time table same funciton as time table filter
    public function download_Timetable ($class, $section)
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

        $cl = $class_name . " " . $section_name;

        $ttime = \DB::select('SELECT DISTINCT from_timing FROM `tbl_class_timings` ORDER by from_timing');


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

        foreach ( $ttime as $t ) {
            $days = \DB::select("SELECT t.from_timing, t.to_timing, r.name, s.subject_name , t.is_lunch, r.g_meet_url
													FROM tbl_class_timings t
													left join tbl_student_subjects s on s.id = t.subject_id
													left join tbl_student_classes c on c.id = t.class_id
													left join tbl_techers r on r.id = t.teacher_id
													where c.class_name = ? and c.section_name=?
													and from_timing = ?", [$class_name, $section_name, $t->from_timing]);

            if ( count($days) > 0 ) {
                foreach ( $days as $d ) {
                    if ( $p % 2 == 0 )
                        $x = "even";
                    else
                        $x = "odd";

                    if ( $i == 1 ) {
                        $html .= "<tr class='$x'><td><strong>Period $p</strong></td><td>" . date('H:i', strtotime($d->from_timing)) . "-" . date('H:i', strtotime($d->to_timing)) . "</td>";
                        $htmla .= "<tr class='$x'><td>Period $p</td><td style='width:100px;'>" . date('H:i', strtotime($d->from_timing)) . "-" . date('H:i', strtotime($d->to_timing)) . "</td>";
                    }

                    if ( empty($d->g_meet_url) )
                        $e = $d->name . "(<strong>" . $d->subject_name . "</strong>)";
                    else
                        $e = "<a target='_blank' href='" . $d->g_meet_url . "'>" . $d->name . "(<strong>" . $d->subject_name . "</strong>)</a>";

                    $html .= "<td>" . ( $d->is_lunch == 1 ? "LUNCH" : $e ) . "</td>";
                    $htmla .= "<td>" . ( $d->is_lunch == 1 ? "LUNCH" : $e ) . "</td>";
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


        $name = public_path('dl-timetable') . "/" . $class_name . "_" . $section_name . "_timetable.pdf";

        if ( file_exists($name) )
            unlink($name);

        //$pdf = PDF::loadHTML($html);
        $pdf = PDF::loadHTML($html)->setPaper('a3', 'landscape')->setWarnings(false)->save($name);

        return response()->download($name);
    }


}
