<?php

namespace App\Http\Controllers;

use App\HelpTicketCategory;
use App\Http\Helpers\CustomHelper;
use App\libraries\Utility\DateUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\Log;
use Session;
use App\Http\Helpers\CommonHelper;
use App\ClassTopic;
use App\ClassWork;
use App\ClassTiming;
use App\DateClass;
use Validator;

class ClassWorkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct ()
    {
    }

    public function index ()
    {

        $logged_teacher = Session::get('teacher_session');
        $logged_teacher_id = $logged_teacher['teacher_id'];


        $class_list = ClassTiming::with('studentClass', 'studentSubject')->where('teacher_id', $logged_teacher_id)->get();

        $links = array();
        foreach ( $class_list as $value ) {
            $assignment = ClassWork::where('class_id', $value->class_id)->where('subject_id', $value->subject_id)->where('teacher_id', $logged_teacher_id)->first();

            $links[ $value->class_id ][ $value->subject_id ]['id'] = ( !empty($assignment) ) ? $assignment->id : '';
            $links[ $value->class_id ][ $value->subject_id ]['g_live_link'] = ( !empty($assignment) ) ? $assignment->g_live_link : '';
            // $links[$value->class_id][$value->subject_id]['g_class_id'] = (!empty($assignment))? $assignment->g_class_id:'';

        }

        $cmsclass = \DB::select('select distinct class from tbl_cmslinks order by class');

        $helpCategories = HelpTicketCategory::get();

        return view('teacher.assignment.index', compact('class_list', 'links', 'cmsclass', 'helpCategories'));
    }

    public function ajaxLinks (Request $request)
    {
        $links = \DB::select('select assignment_link,link from tbl_cmslinks where class=? and subject=? and topic=?', [$request->class_id, $request->subject_id, $request->topic_id]);
        $val = array();

        foreach ( $links as $linkd ) {
            //$sname = \DB::select('SELECT subject_name FROM `tbl_student_subjects` where id <> 5 and id=?',[$request->subject_id]);

            //if(count($sname) > 0)
            $val[] = array("id" => $linkd->assignment_link, "name" => $linkd->assignment_link);
        }

        return json_encode(array('status' => 'success', 'data' => $val));
    }

    public function ajaxTopics (Request $request)
    {
        $topics = \DB::select('select topic from tbl_cmslinks where class=? and subject=?', [$request->class_id, $request->subject_id]);
        $val = array();

        foreach ( $topics as $topic => $sub ) {
            //$sname = \DB::select('SELECT subject_name FROM `tbl_student_subjects` where id <> 5 and id=?',[$request->subject_id]);

            //if(count($sname) > 0)
            $val[] = array("id" => $sub->topic, "name" => $sub->topic);
        }

        return json_encode(array('status' => 'success', 'data' => $val));
    }

    public function ajaxSubjects (Request $request)
    {
        $subjects = \DB::select('select distinct subject from tbl_cmslinks where class=?', [$request->class_id]);
        $val = array();

        foreach ( $subjects as $subject => $sub ) {
            $sname = \DB::select('SELECT subject_name FROM `tbl_student_subjects` where id <> 5 and  id=?', [$sub->subject]);

            if ( count($sname) > 0 )
                $val[] = array("id" => $sub->subject, "name" => $sname[0]->subject_name);
        }

        return json_encode(array('status' => 'success', 'data' => $val));
    }

    public function ajaxCreateAssignment (Request $request)
    {

        $logged_teacher = Session::get('teacher_session');
        $logged_teacher_id = $logged_teacher['teacher_id'];

        $validator = Validator::make($request->all(), [
            //  'txt_topic_name' => 'required|max:100|regex:/^[a-zA-Z0-9 ]*$/',
            'assignment_title' => 'required|max:100|regex:/^[a-zA-Z0-9 ]*$/',
        ], [
            //	'txt_topic_name.regex'=>'The topic name must be letters and numbers.',
            'assignment_title.regex' => 'The Title must be letters and numbers.',
            //'lname.alpha_num'=>'The Last name may only contain letters and numbers.',
        ]);

        if ( !$validator->passes() ) {
            //return response()->json(['status'=>'error','message'=>]);
            return json_encode(array('status' => 'error', 'message' => $validator->errors()->all()));
        }

        $class_id = $request->class_id;
        $subject_id = $request->subject_id;
        $g_class_id = $request->g_class_id;
        $topic_name = $request->txt_topic_name;
        $sel_topic_id = $request->sel_topic_name;
        $title = $request->assignment_title;
        $dateClass_id = $request->dateClass_id;

        $g_topic_id = '';

        if ( $topic_name == '' && $sel_topic_id == '' ) {
            return json_encode(array('status' => 'error', 'message' => 'Topic Name Required.'));
        }
        if ( $title == '' ) {
            return json_encode(array('status' => 'error', 'message' => 'Assignment Title Required.'));
        }

        if ( $topic_name != '' && $sel_topic_id != '' ) {
            return json_encode(array('status' => 'error', 'message' => 'Either select a topic or give a new topic fill both.'));
        }

        $token = CommonHelper::varify_Teachertoken(); // verify Teacher token
        if ( ( $topic_name == '' && $sel_topic_id != '' ) || ( $topic_name != '' && $sel_topic_id != '' ) ) {
            $topic_id = $sel_topic_id;

            $topicExists = ClassTopic::where('id', $topic_id)->get()->first();
            $g_topic_id = $topicExists->g_topic_id;
        }
        if ( $topic_name != '' && $sel_topic_id == '' ) {
            $data = array("name" => $topic_name);
            $data = json_encode($data);

            $responce = CommonHelper::create_topic($token, $g_class_id, $data); // access Google api craete Topic

            $resData = array('error' => '');

            if ( $responce == 101 ) {
                return json_encode(array('status' => 'error', 'message' => Config::get('constants.WebMessageCode.119')));
            } else {
                $resData = array_merge($resData, json_decode($responce, true));

                if ( $resData['error'] != '' ) {
                    if ( $resData['error']['status'] == 'UNAUTHENTICATED' ) {
                        Log::error($resData['error']['status']);
                        CustomHelper::get_refresh_token();
                        $token = CommonHelper::varify_Admintoken(); // verify admin token

                        $responce = CommonHelper::create_topic($token, $g_class_id, $data); // access Google api craete Topic
                        $resData = array('error' => '');
                        $resData = array_merge($resData, json_decode($responce, true));
                    }
                }

                if ( $resData['error'] != '' ) {
                    if ( $resData['error']['status'] == 'UNAUTHENTICATED' ) {
                        return redirect()->route('teacher.logout');
                    } else {
                        return json_encode(array('status' => 'error', 'message' => $resData['error']['message']));
                    }
                } else {

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
            "title"       => $title,
            "workType"    => "ASSIGNMENT",
            "state"       => "PUBLISHED",
            "topicId"     => $g_topic_id,
            "description" => "Open 3 dots in right side and click edit",
        );

        $array_data = json_encode($array_data);

        $work_response = CommonHelper::create_courcework($token, $g_class_id, $array_data);
        $w_resData = array('error' => '');

        if ( $work_response == 101 ) {
            return json_encode(array('status' => 'error', 'message' => Config::get('constants.WebMessageCode.119')));
        } else {
            $w_resData = array_merge($w_resData, json_decode($work_response, true));

            if ( $w_resData['error'] != '' ) {
                if ( $w_resData['error']['status'] == 'UNAUTHENTICATED' ) {
                    Log::error($w_resData['error']['status']);
                    CustomHelper::get_refresh_token();
                    $token = CommonHelper::varify_Admintoken(); // verify admin token

                    $work_response = CommonHelper::create_courcework($token, $g_class_id, $array_data);
                    $w_resData = array('error' => '');
                    $w_resData = array_merge($w_resData, json_decode($work_response, true));
                }
            }

            if ( $w_resData['error'] != '' ) {

                if ( $w_resData['error']['status'] == 'UNAUTHENTICATED' ) {
                    return redirect()->route('teacher.logout');
                } else {
                    return json_encode(array('status' => 'error', 'message' => $w_resData['error']['message']));
                }
            } else {

                $cource_url = $w_resData['alternateLink'];

                $classWork = new ClassWork;
                $classWork->class_id = $class_id;
                $classWork->g_live_link = $w_resData['alternateLink'];
                $classWork->g_class_id = $g_class_id;
                $classWork->classwork_type = $w_resData['workType'];
                $classWork->topic_id = $topic_id;
                /* $classWork->g_points = '';
                                    $classWork->g_status = '';
                                    $classWork->g_action = ''; */
                $classWork->g_title = $w_resData['title'];
                //$classWork->g_due_date = '';
                $classWork->teacher_id = $logged_teacher_id;
                //$classWork->timetable_id = $timing_id;
                $classWork->subject_id = $subject_id;
                $classWork->save();
                $classWork_id = $classWork->id;  // Last Insert Id

                if ( $dateClass_id != '' ) {
                    $obj = DateClass::find($dateClass_id);
                    $obj->topic_id = $topic_id;
                    //$obj->ass_live_url = $w_resData['alternateLink'];
                    $obj->save();


                    $s = \DB::table('tbl_classwork_dateclass')->insert(
                        ['dateclass_id' => $dateClass_id, 'classwork_id' => $classWork_id]
                    );
                }


                return json_encode(array('status' => 'success', 'cource_url' => $cource_url, 'message' => Config::get('constants.WebMessageCode.127')));
            }
        }
    }

    public function ajaxGetAssignment (Request $request)
    {
        $logged_teacher = Session::get('teacher_session');
        $logged_teacher_id = $logged_teacher['teacher_id'];

        $class_id = $request->class_id;
        $subject_id = $request->subject_id;

        $getAssignment = ClassWork::select('id', 'g_title', 'g_live_link')->where('class_id', $class_id)->where('subject_id', $subject_id)->where('teacher_id', $logged_teacher_id)->where('classwork_type', 'ASSIGNMENT')->get();

        $get_topic = ClassTopic::where('class_id', $class_id)->get();

        return json_encode(array('status' => 'success', 'data' => $getAssignment, 'topics' => $get_topic));
    }

    public function ajaxGiveAssignment (Request $request)
    {
        $logged_teacher = Session::get('teacher_session');
        $logged_teacher_id = $logged_teacher['teacher_id'];

        /*   $class_id = $request->class_id;
        $subject_id = $request->subject_id;
        $a_live_url = $request->a_live_url; */
        $dateClass_id = $request->dateClass_id;
        $classwork_id = $request->classwork_id;
        if ( !$dateClass_id ) {
            return json_encode(array('status' => 'error', 'message' => Config::get('constants.WebMessageCode.113')));
            exit;
        }

        $assignmentExist = \DB::table('tbl_classwork_dateclass')->where('dateclass_id', $dateClass_id)->where('classwork_id', $classwork_id)->get()->first();
        if ( $assignmentExist ) {
            return json_encode(array('status' => 'error', 'message' => "Assignment already allocated to this class."));
            exit;
        } else {
            $s = \DB::table('tbl_classwork_dateclass')->insert(
                ['dateclass_id' => $dateClass_id, 'classwork_id' => $classwork_id]
            );
        }

        /* $res = DateClass::where('class_id',$class_id)->where('subject_id',$subject_id)->where('teacher_id',$logged_teacher_id)->where('id',$dateClass_id)->first();

        $res->ass_live_url = $a_live_url;
        $res->save(); */


        return json_encode(array('status' => 'success', 'message' => 'Assignment Successfully Assign.'));
        exit;
    }

    public function classTopicUpdate (Request $request)
    {

        $dateWork_id = $request->id;
        if ( !$dateWork_id ) {
            return json_encode(array('status' => 'error', 'message' => Config::get('constants.WebMessageCode.113')));
            exit;
        }
        $logged_teacher = Session::get('teacher_session');
        $logged_teacher_id = $logged_teacher['teacher_id'];
        $topic_id = $request->topic_id;

        $res = \DB::select('select * from tbl_cmslinks where id="' . $topic_id . '"');

        if ( count($res) > 0 ) {
            foreach ( $res as $val ) {
                $res_link = $val->link;
                $youtube_link = $val->youtube;
                $khan_academy = $val->khan_academy;
                $others = $val->others;
            }

            $obj = DateClass::find($dateWork_id);
            $obj->topic_id = $topic_id;
            $obj->save();


            return json_encode(array('status' => 'success', 'topic_link' => $res_link, 'youtube_link' => $youtube_link, 'academy_link' => $khan_academy, 'wikipedia_link' => $others, 'message' => Config::get('constants.WebMessageCode.131')));
            exit;
        } else {
            return json_encode(array('status' => 'error', 'message' => Config::get('constants.WebMessageCode.113')));
            exit;
        }
        //return json_encode(array('status'=>'error','message'=> Config::get('constants.WebMessageCode.121'))); exit;

    }

    public function ajaxUpdateClassNotes (Request $request)
    {
        $logged_teacher = Session::get('teacher_session');
        $logged_teacher_id = $logged_teacher['teacher_id'];
        if ( Request()->post() || Request()->ajax() ) {

            $desc = $request->description;
            $dateClass_id = $request->dateClass_id;

            if ( strlen($desc) > 255 ) {
                return json_encode(array('status' => 'error', 'message' => 'Maximum Character Exceeded.'));
            }
            /* else if(!preg_match("/^[a-zA-Z0-9 ]*$/", $desc))
                {
                    return json_encode(array('status'=>'error', 'message'=> "Class Note must be letter and numbers."));
                }  */


            $res = DateClass::find($dateClass_id);
            $res->class_description = $request->description;
            $res->save();
            echo json_encode(array('status' => 'success', 'message' => "Class Note has been saved!"));
        } else {
            echo json_encode(array('status' => 'error', 'message' => Config::get('constants.WebMessageCode.121')));
        }
    }

    public function addData_DateClass (Request $request) // Cron JOb Function add data timing table to Past Class
    {
        $teacherData = ClassTiming::with('studentClass')->where('class_day', DateUtility::getDay())->get();

        if ( !count($teacherData) )
            return back()->with('error', 'No record found on class timming.');

        foreach ( $teacherData as $value ) {
            $pastClassExist = DateClass::where('class_date', DateUtility::getDate())->where('from_timing', $value->from_timing)->where('to_timing', $value->to_timing)->where('class_id', $value->class_id)->where('subject_id', $value->subject_id)->where('teacher_id', $value->teacher_id)->first();

            if ( !$pastClassExist ) {
                $obj_dataClass = new DateClass;

                $obj_dataClass->class_id = $value->class_id;
                $obj_dataClass->subject_id = $value->subject_id;
                $obj_dataClass->teacher_id = $value->teacher_id;
                $obj_dataClass->from_timing = $value->from_timing;
                $obj_dataClass->to_timing = $value->to_timing;
                $obj_dataClass->class_date = DateUtility::getDate();
                $obj_dataClass->timetable_id = $value->id;
                $obj_dataClass->live_link = $value->studentClass->g_link;
                $obj_dataClass->save();
            }
        }

        return back()->with('success', "Time table for today's class reloaded successfully.");
    }

    public function getClassAssignments (Request $request)
    {
        $assignments = CommonHelper::get_assignment_data($request->class_id);

        return json_encode(array('status' => 'success', 'data' => $assignments));
    }
}
