<?php

namespace App\Http\Controllers;

use App\libraries\Utility\DateUtility;
use App\Teacher;
use App\Teacher_Class;
use Illuminate\Http\Request;
use App\StudentClass;
use App\ClassTiming;
use App\DateClass;
use Session;
use App\Http\Helpers\CommonHelper;
use App\Http\Helpers\CustomHelper;
use App\StudentSubject;
use Illuminate\Support\Facades\Config;
use App\InvitationClass;
use Mail;
use Validator;

class TeacherClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function html_email ()
    {
        $data = array('name' => "Virat Gandhi");
        Mail::send('mail.mail', $data, function ($message) {
            $message->to('ritesh696@gmail.com', 'Tutorials Point')
                ->subject('Laravel HTML Testing Mail');
            $message->from('xyz@gmail.com', 'Virat Gandhi');
        });
        echo "HTML Email Sent. Check your inbox.";
    }

    public function notifyStudents (Request $request)
    {


        $logged_teacher = Session::get('teacher_session');
        $logged_teacher_id = $logged_teacher['teacher_id'];
        $logged_teacher_name = $logged_teacher['teacher_name'];
        $logged_teacher_phone = $logged_teacher['teacher_phone'];
        $from = CustomHelper::getFromMail();
        $comm = "";
        $er = "";
        $number = array();


        if ( Request()->post() || Request()->ajax() ) {
            $class_id = $request->class_id;
            $subject_id = $request->subject_id;
            $class_join_link = $request->g_meet_url;

            $dateClass_id = $request->dateClass_id;

            $class_timing = DateClass::where('id', $dateClass_id)->get()->first();
            //$class_join_link = $class_timing->g_meet_url;
            $start_time = $class_timing->from_timing;
            $std_message = $class_timing->class_student_msg;


            $subject_name = StudentSubject::where('id', $request->subject_id)->get()->first();
            $sub_name = $subject_name->subject_name;

            $class_name = StudentClass::where('id', $request->class_id)->get()->first();
            $cls_name = $class_name->class_name;
            $section_name = $class_name->section_name;

            //dd($class_name);
            $classData = \DB::table('tbl_classes')->select('id')->where('class_name', $cls_name)->where('section_name', $section_name)->get()->first();
            $c_id = $classData->id;


            $student_phone = \DB::table('tbl_students')->select('name', 'email', 'phone')->where('class_id', $c_id)->where('notify', 'yes')->get(); // Phone Number
            $student_email = \DB::table('tbl_students')->select('name', 'email', 'phone')->where('class_id', $c_id)->get(); // email

            foreach ( $student_phone as $p ) {
                $number[] = $p->phone;
            }

            if ( count($student_phone) > 0 ) {
                $numbers = implode(",", $number);
                $msg = "You have $sub_name class at $start_time. Join using $class_join_link.";

                $s = CommonHelper::send_sms($numbers, $msg);
                $comm = "SMS ";
            }

            if ( count($student_email) > 0 ) {
                foreach ( $student_email as $e ) {
                    //$email[] = $e->email;
                    $data_mail = array('name' => $e->name, 'subject' => $sub_name, 'start_time' => $start_time, 'class_url' => $class_join_link);

                    Mail::send('mail.mail', $data_mail, function ($message) use ($e, $from) {    //dd($message);
                        $message->to($e->email)
                            ->subject('Invitation to join live class');
                        //$message->from('noreply@montbit.com','MontBIt');
                        $message->from($from->value, 'MontBIt');
                    });

                }
                if ( $comm == "SMS " )
                    $comm .= "and Email ";
                else
                    $comm = "Email ";


                if ( count(Mail::failures()) > 0 ) {
                    foreach ( Mail::failures as $email_address ) {
                        $er .= $email_address;
                    }

                } else {
                    $er = "Notification sent successfully!";
                }
            }
            //$emails = implode(",",$email);


            if ( $comm == "" )
                echo json_encode(array('status' => 'error', 'message' => "No SMS / Email present for notification!!"));
            else
                echo json_encode(array('status' => 'success', 'message' => $er));
        } else {
            echo json_encode(array('status' => 'error', 'message' => "Notification sent successfully"));
        }

    }

    public function addClass (Request $request)
    {

        $logged_teacher = Session::get('teacher_session');
        $teacher_id = $logged_teacher['teacher_id'];
        $logged_teacher_name = $logged_teacher['teacher_name'];
        $logged_teacher_phone = $logged_teacher['teacher_phone'];

        $class_date = date("Y-m-d", strtotime($request->class_date));
        $from_time = str_replace(" : ", ":", $request->start_time);
        $from_time = date("H:i:s", strtotime($from_time));
        $to_time = str_replace(" : ", ":", $request->end_time);
        $to_time = date("H:i:s", strtotime($to_time));
        $class_day = date("l", strtotime($request->class_date));
        $class_id = $request->class_id;


        $request->validate([
            'class_date'        => 'required',
            'start_time'        => 'required',
            'end_time'          => 'required',
            'notify_stdMessage' => 'required|max:255',
        ], [

            'class_date.required'        => 'Class date required',
            'start_time.required'        => 'Class start time required',
            'end_time.required'          => 'Class end time required',
            'notify_stdMessage.required' => 'Notify Student Message required',
            //'notify_stdMessage.regex' => 'Notify Student Message must be letters and numbers.',

        ]);

        $dtime = ( strtotime($to_time) - strtotime($from_time) ) / 60; // find time difference , it can't be -ive

        if ( $dtime <= 0 )
            return back()->with('error', "Class end-time can't be before/equal to class start-time.");

        $class_student_msg = isset($request->notify_stdMessage) ? $request->notify_stdMessage : '';
        /* $class_liveurl = isset($request->join_liveUrl)?$request->join_liveUrl:'';

       if(!filter_var($class_liveurl, FILTER_VALIDATE_URL)){
           return back()->with('error','Please add valid live url.');
       }  */

        if ( $class_date == date('Y-m-d') && date('h:i', strtotime($from_time)) <= date('h:i') )
            return back()->with('error', "You can't add a class in the past. Class date time should not be less than current date and time.");

        $obj_class = StudentClass::where('id', $class_id)->get()->first();

        $g_class_id = $obj_class['g_class_id'];
        $g_live_link = $obj_class['g_link'];
        $subject_id = $obj_class['subject_id'];
        $class_name = $obj_class['class_name'];
        $section_name = $obj_class['section_name'];

        $subject_name = StudentSubject::where('id', $subject_id)->get()->first();

        $sub_name = $subject_name['subject_name'];


        $g_teacher_data = Teacher::find($teacher_id);

        $g_teacher_id = $g_teacher_data->g_user_id;

        $TimeTableExist = ClassTiming::where('class_id', $class_id)
            ->where('teacher_id', $teacher_id)
            ->where('subject_id', $subject_id)
            ->where('class_day', $class_day)
            ->where('from_timing', '<=', DateUtility::getPastTime(1, $to_time))
            ->where('to_timing', '>=', DateUtility::getFutureTime(1, $from_time))
            ->first();

        $classTimingExist = ClassTiming::where('class_id', $class_id)->where('class_day', $class_day)->where('from_timing', $from_time)->get()->first();

        $teacherTimeExist = ClassTiming::where('teacher_id', $teacher_id)->where('class_day', $class_day)->where('from_timing', $from_time)->get()->first();


        $dateClassExist = DateClass::where('class_id', $class_id)
            ->where('teacher_id', $teacher_id)
            ->where('subject_id', $subject_id)
            ->where('class_date', $class_date)
            ->where('from_timing', '<=', DateUtility::getPastTime(1, $to_time))
            ->where('to_timing', '>=', DateUtility::getFutureTime(1, $from_time))
            ->get()->first();

        $dateClassTimeExist = DateClass::where('class_id', $class_id)->where('class_date', $class_date)->where('from_timing', $from_time)->get()->first();

        $dateClassTeacherExist = DateClass::where('teacher_id', $teacher_id)->where('class_date', $class_date)->where('from_timing', $from_time)->get()->first();

        if ( $TimeTableExist ) {
            return back()->with('error', "You have already assigned class at selected time!.");
        } else if ( $classTimingExist ) {
            return back()->with('error', "Class have already assigned lecture at selected time.");
        } else if ( $teacherTimeExist ) {
            return back()->with('error', "You have already assigned lecture at selected time.");
        } else if ( $dateClassExist ) {
            return back()->with('error', "You have already assigned class at selected time!.");
        } else if ( $dateClassTimeExist ) {
            return back()->with('error', "Class have already assigned lecture at selected time.");
        } else if ( $dateClassTeacherExist ) {
            return back()->with('error', "You have already assigned lecture at selected time.");
        } else {


            // Invitation for class

            /* $obj_inv = new InvitationClass;
                    $obj_inv->class_id = $class_id;
                    $obj_inv->teacher_id = $teacher_id;
                    $obj_inv->subject_id = $subject_id;
                    $obj_inv->g_code = '';
                    $obj_inv->g_responce = '';
                    $obj_inv->is_accept = 0;
                    $obj_inv->save(); */


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

            $s = CommonHelper::send_sms($support_numbers, $message);


            return back()->with('success', Config::get('constants.WebMessageCode.125'));
        }


        //  return redirect()->route('home')->with('success',sprintf(Config::get('constants.WebMessageCode.123'), 'added'));
    }

    public function ajaxSaveLiveClass (Request $request)
    {


        $logged_teacher = Session::get('teacher_session');
        $teacher_id = $logged_teacher['teacher_id'];

        $dateClass_id = $request->txt_datecalss_id;

        $request->validate([
            'edit_notify_stdMessage' => 'required|max:255',
            'edit_description'       => 'required|max:255',

        ], [
            'edit_notify_stdMessage.required' => 'Notify Message required.',
            //'edit_notify_stdMessage.regex'=>'Notify Message must be letters and numbers.',
            'edit_description.required'       => 'The Description required.',
        ]);


        $notify_stdMessage = $request->edit_notify_stdMessage;
        $class_description = isset($request->edit_description) ? $request->edit_description : '';
        /*     $class_liveurl = isset($request->edit_join_liveUrl)?$request->edit_join_liveUrl:'';
           if($class_liveurl!=''){

                if(!filter_var($class_liveurl, FILTER_VALIDATE_URL)){
                     return back()->with('error', 'Please Add Valid URL.');
                }
            }
         */

        $pastClassDetail = DateClass::find($dateClass_id);

        $pastClassDetail->class_description = $class_description;
        // $pastClassDetail->g_meet_url = $class_liveurl;
        $pastClassDetail->class_student_msg = $notify_stdMessage;
        $pastClassDetail->save();

        return back()->with('success', sprintf(Config::get('constants.WebMessageCode.123'), 'Updated'));
    }

    public function ajaxSavePastClass (Request $request)
    {


        $logged_teacher = Session::get('teacher_session');
        $teacher_id = $logged_teacher['teacher_id'];

        $dateClass_id = $request->dateClass_id;

        $validator = Validator::make($request->all(), [
            'description' => 'required|max:100',
            'rec_url'     => 'required',

        ], [
            'description.required' => 'The Description required.',
            'rec_url.required'     => 'Recording URL required.',
        ]);

        if ( !$validator->passes() ) {
            //return response()->json(['status'=>'error','message'=>]);
            return json_encode(array('status' => 'error', 'message' => $validator->errors()->all()));
        }

        $class_description = isset($request->description) ? $request->description : '';
        $class_rec_url = isset($request->rec_url) ? $request->rec_url : '';


        if ( $class_rec_url != '' ) {

            if ( !filter_var($class_rec_url, FILTER_VALIDATE_URL) ) {

                return json_encode(array('status' => 'error', 'message' => 'Please Add Valid URL.'));
            }
        } else {
            return json_encode(array('status' => 'error', 'message' => 'Please Enter Class Recording URL.'));
        }


        $pastClassDetail = DateClass::find($dateClass_id);

        $pastClassDetail->class_description = $class_description;
        $pastClassDetail->recording_url = $class_rec_url;
        $pastClassDetail->save();

        return json_encode(array('status' => 'success', 'rec_url' => $class_rec_url, 'message' => 'Past Class Updated Successfully.'));
    }


    public function ajaxAcceptClass ()
    {

        $logged_teacher = Session::get('teacher_session');
        $logged_teacher_id = $logged_teacher['teacher_id'];
        /*  $InvData = InvitationClass::where('teacher_id',$logged_teacher_id)->where('is_accept',0)->get()->toArray();
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

         }
         else{
            echo "Norecord";
         }

         echo "EXIT";
         print_r($responce);
         exit;  */
        /* if(Request()->post() || Request()->ajax())
        {


                $accept_id = $request->id;
                $code = $request->g_code;

                $token = CommonHelper::varify_Teachertoken(); // verify admin token
                $responce = CommonHelper::acceptClassInvitation($token,$code); // access Google api craete Cource
                $resData = array('error'=> '');

                if($responce == 101)
                {
                    return back()->with('error',"1");//Config::get('constants.WebMessageCode.119'));
                }
                else
                {
                    $resData = array_merge($resData,json_decode($responce,true));

                     if($resData['error'])
                    {
                        if($resData['error']['status'] == 'UNAUTHENTICATED')
                        {
                            return redirect()->route('teacher.logout');
                        }
                        else
                        {
                            return back()->with('error',$resData['error']['message']);
                        }
                    }
                    else
                    {

                                $resData = InvitationClass::find($accept_id);
                                $resData->g_code = '';
                                $resData->is_accept = 1;
                                $resData->save();

                                echo json_encode(array('status'=>'success','message'=> "Invitation Accepted."));
                    }
                }
        }  */


    }


    public function index ()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Teacher_Class $teacher_Class
     * @return \Illuminate\Http\Response
     */
    public function show (Teacher_Class $teacher_Class)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Teacher_Class $teacher_Class
     * @return \Illuminate\Http\Response
     */
    public function edit (Teacher_Class $teacher_Class)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Teacher_Class $teacher_Class
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Teacher_Class $teacher_Class)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Teacher_Class $teacher_Class
     * @return \Illuminate\Http\Response
     */
    public function destroy (Teacher_Class $teacher_Class)
    {
        //
    }

    public function availableClasses (Request $request)
    {
        $day = date('l', strtotime($request->date));
        $startTime = date('H:i:s', strtotime($request->startTime));
        $endTime = date('H:i:s', strtotime($request->endTime));

        $occupiedClassTiminngs = ClassTiming::with('StudentClass')
            ->where('from_timing', '<=', $endTime)
            ->where('to_timing', '>=', $startTime)
            ->where('class_day', '=', $day)
            ->get()->pluck('class_id');

        $availableClasses = StudentClass::with('studentSubject')->whereNotIn('id', $occupiedClassTiminngs)->get();


        return json_encode(array('status' => 'success', 'message' => $availableClasses));
//        ClassTiming::where()
    }
}
