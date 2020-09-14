<?php

namespace App\Http\Controllers;

use App\HelpTicketCategory;
use App\Http\Helpers\CustomHelper;
use App\libraries\Utility\DateUtility;
use Illuminate\Support\Facades\Config;
use App\Teacher;
use Illuminate\Http\Request;
use Google_Client;
use Session;
use App\DateClass;
use App\StudentSubject;
use App\Models\Student;
use App\Models\ClassSection;
use DB;
use App\InvitationClass;
use App\Http\Helpers\CommonHelper;
use App\CmsLink;
use App\Models\Attendance;
use Response;


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
        if (isset($session_token['access_token_teacher']) && $session_token['access_token_teacher']) {
            $res = $this->verify_email_DB();
            if ($res == 101) {
                return back()->with('error', Config::get('constants.WebMessageCode.118'));
                $this->logout();
            } else if ($res == 102) {
                return back()->with('error', "Invalid Token");
                $this->logout();
            } else {
                return redirect()->route('teacher.dashboard');
            }
        } else {
            $auth_url = CustomHelper::set_token_teacher();

            return redirect($auth_url);
        }
    }

    public function teacher_login_get()
    {

        if (!isset($_GET['code'])) {
            $auth_url = CustomHelper::set_token_teacher();

            return redirect($auth_url);
        } else {
            $code = $_GET['code'];

            CustomHelper::get_token_teacher($code);

            $res = $this->verify_email_DB();

            // print_r($res);
            //  echo $code;
            //echo  $responce->email;

            if ($res == 101) {
                return back()->with('error', Config::get('constants.WebMessageCode.118'));
                $this->logout();
            } else if ($res == 102) {
                return back()->with('error', "Invalid Token");
                $this->logout();
            } else {
                return redirect()->route('teacher.dashboard');
            }
            //print_r($responce);
            //echo $responce['email'];

        }
    }

    public function teacherDashboard(Request $request)
    {
        $logged_teacher = Session::get('teacher_session');
        // CLass invitation accept
        $InvData = InvitationClass::where('teacher_id', $logged_teacher['teacher_id'])->where('is_accept', 0)->get()->toArray();
        if ($InvData) {
            foreach ($InvData as $key) {

                $code = $key['g_code'];
                $accept_id = $key['id'];
                $token = CommonHelper::varify_Teachertoken(); // verify admin token
                $responce = CommonHelper::acceptClassInvitation($token, $code); // access Google api craete Cource
                if ($responce) {
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
        $currentTime = date("H:i:s", strtotime($current_date));
        $currentDay = date("Y-m-d", strtotime($current_date));

        $schoollogo = \DB::table('tbl_settings')->get()->keyBy('item');
        $TodayLiveData = DateClass::with('studentClass', 'studentSubject', 'cmsLink')->where('teacher_id', $logged_teacher['teacher_id'])
            ->where(function ($query) use ($currentTime, $currentDay) {
                //$query->where('to_timing','>',$currentTime);
                $query->where('class_date', '=', $currentDay);
            })->orderBy('from_timing', 'desc')
            ->get();

        $todaysDate = date("d M");

        $data['subject'] = StudentSubject::orderBy('subject_name', 'ASC')->pluck('subject_name', 'id');
        $data['subject']->prepend('Select Subject', '');
        $data['classData'] = DB::table('tbl_student_classes as c')->select('c.id', 'c.class_name', 'c.section_name', 'c.subject_id', 's.subject_name')->join('tbl_student_subjects as s', 'c.subject_id', 's.id')->join('tbl_class_timings as ct', 'ct.class_id', 'c.id')->where('ct.teacher_id', $logged_teacher['teacher_id'])->get()->unique();

        $pastClassData = DateClass::with('studentClass', 'studentSubject', 'cmsLink')->where('teacher_id', $logged_teacher['teacher_id'])
            ->where('class_date', '>', DateUtility::getPastDate(2))
            ->Where('class_date', '<', DateUtility::getDate())
            ->orderBy('from_timing', 'desc')
            ->get();
        $pastDates = DB::table('tbl_dateclass')->select('class_date')->where('teacher_id', $logged_teacher['teacher_id'])
            ->where('class_date', '>', DateUtility::getPastDate(7))
            ->Where('class_date', '<', DateUtility::getDate())
            ->orderBy('class_date', 'asc')
            ->limit(7)
            ->distinct('class_date')
            ->get()->unique();
        $futureDates = DB::table('tbl_dateclass')->select('class_date')->where('teacher_id', $logged_teacher['teacher_id'])
            ->where('class_date', '<', DateUtility::getFutureDate(7))
            ->Where('class_date', '>', DateUtility::getDate())
            ->orderBy('class_date')
            ->limit(7)
            ->distinct('class_date')
            ->get()->unique();
        $futureClassData = DateClass::with('studentClass', 'studentSubject', 'cmsLink')->where('teacher_id', $logged_teacher['teacher_id'])
            ->where('class_date', '<', DateUtility::getFutureDate(2))
            ->Where('class_date', '>', DateUtility::getDate())
            ->orderBy('class_date', 'asc')
            ->orderBy('from_timing', 'asc')
            ->get();

        $inviteClassData = InvitationClass::with('studentClass', 'studentSubject')->where('teacher_id', $logged_teacher['teacher_id'])->orderBy('id', 'DESC')->get();


        $teacherData = Teacher::where('id', $logged_teacher['teacher_id'])->get()->first();

        $helpCategories = HelpTicketCategory::get();

        $chapters   = CmsLink::orderBy('chapter', 'asc')->get();

        return view('teacher.dashboard', compact('TodayLiveData', 'todaysDate', 'data', 'pastClassData', 'pastDates', 'inviteClassData', 'teacherData', 'helpCategories', 'schoollogo', 'futureClassData', 'futureDates', 'chapters'));
    }

    public function viewPastClass(Request $request)
    {
        $class_date = date("D, d M", strtotime($request->class_date));
        $logged_teacher   = Session::get('teacher_session');
        $schoollogo = \DB::table('tbl_settings')->get()->keyBy('item');
        $pastClassData = DateClass::with('studentClass', 'studentSubject', 'cmsLink')->where('class_date', $request->class_date)
            ->orderBy('from_timing', 'desc')
            ->get();
        $pastDates = DB::table('tbl_dateclass')->select('class_date')->where('teacher_id', $logged_teacher['teacher_id'])
            ->where('class_date', '>', DateUtility::getPastDate(7))
            ->Where('class_date', '<', DateUtility::getDate())
            ->orderBy('class_date', 'asc')
            ->limit(7)
            ->distinct('class_date')
            ->get()->unique();

        return view('teacher.getPastClass', compact('pastDates',  'pastClassData', 'schoollogo', 'class_date'));
    }
    public function viewFutureClass(Request $request)
    {
        $class_date = date("D, d M", strtotime($request->class_date));
        $logged_teacher   = Session::get('teacher_session');
        $schoollogo = \DB::table('tbl_settings')->get()->keyBy('item');
        $futureClassData = DateClass::with('studentClass', 'studentSubject', 'cmsLink')->where('class_date', $request->class_date)
            ->orderBy('from_timing', 'asc')
            ->orderBy('class_date', 'asc')
            ->get();
        $futureDates = DB::table('tbl_dateclass')->select('class_date')->where('teacher_id', $logged_teacher['teacher_id'])
            ->where('class_date', '<', DateUtility::getFutureDate(7))
            ->Where('class_date', '>', DateUtility::getDate())
            ->orderBy('class_date')
            ->limit(7)
            ->distinct('class_date')
            ->get()->unique();

        return view('teacher.getfutureClass', compact('futureDates', 'futureClassData', 'schoollogo', 'class_date'));
    }

    public function getTopic(Request $request)
    {
        if ($request->chapter && $request->class && $request->subject) {
            $getdata   = CmsLink::where('chapter', $request->chapter)->where('class', $request->class)->where('subject', $request->subject)->pluck('topic', 'id');
            echo $getdata;
        }
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

        $array = array('error' => '');

        $responce = CustomHelper::get_user_from_token($session_token['id_token']);
        $resData = array_merge($array, json_decode($responce, true));

        if ($resData['error'] != '') {
            return 102;
        } else {
            $credentials = $resData['email'];;
            $teacher = Teacher::where('email', $credentials)->first();;
            if (!empty($teacher)) {
                $name = $teacher['name']; //.' '.$teacher['last_name'];
                Session::put('teacher_session', array('teacher_id' => $teacher['id'], 'teacher_email' => $teacher['email'], 'teacher_name' => $name, 'teacher_phone' => $teacher['phone']));

                return 100;
            } else {
                return 101;
            }
        }
    }

    public function getStudent(Request $request)
    {
        $dateClass = DateClass::with('studentClass')->find($request->dateclass_id);

        $students = Student::with('class')
            ->with(['attendance' => function ($q) use ($request) {
                $q->where('dateclass_id', $request->dateclass_id);
            }])
            ->whereHas('class', function ($q) use ($dateClass) {
                $q->where('class_name', $dateClass->studentClass->class_name);
                $q->where('section_name', $dateClass->studentClass->section_name);
            })->get();
        $presentCount = Attendance::present()->where('dateclass_id', $dateClass->id)->count();
        $absentCount = Attendance::absent()->where('dateclass_id', $dateClass->id)->count();

        return view('teacher.getStudents', compact('students', 'dateClass', 'presentCount', 'absentCount'));
    }
}
