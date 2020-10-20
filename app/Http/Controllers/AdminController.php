<?php

namespace App\Http\Controllers;

use App\Http\Helpers\CustomHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Google_Client;
use Session;
use App\Admin;
use App\Teacher;
use App\StudentClass;
use App\InvitationClass;
use App\libraries\Utility\ReportUtility;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.welcome');
    }

    public function updateSchoolLogo(Request $request)
    {
        try {
            if ($request->file('profile_picture')) {
                $image = $request->file('profile_picture');
                $ext = $image->getClientOriginalExtension();
                $name = $image->getClientOriginalName();

                $supportedFileTypes = array('gif', 'jpeg', 'png', 'jpg');

                if (in_array(strtolower($ext), $supportedFileTypes)) {
                    $destinationPath = public_path('/images');

                    if (file_exists($destinationPath . "/" . $name))
                        unlink($destinationPath . "/" . $name);

                    $sst = $image->move($destinationPath, $name);
                    $a = asset("images/" . $name);


                    $st = \DB::table('tbl_settings')->where('item', 'schoollogo')->update(["value" => $a]);

                    return back()->with('success', Config::get('constants.WebMessageCode.112'));
                }
            }
        } catch (\Exception $e) {
            return back()->with('error', Config::get('constants.WebMessageCode.121'));
        }
    }

    public function addSetting(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'item'   => 'required',
                'ivalue' => 'required',
            ]);

            $settings = \DB::table('tbl_settings')->where('item', $request->item);

            if ($settings->count() > 0) {
                return redirect()->route('setting.add')->with('error', "Item already exists !.");
            } else {
                $settings = \DB::table('tbl_settings')->insert(['item' => $request->item, 'value' => $request->ivalue]);

                return redirect()->route('setting.add')->with('success', 'Item added successfully!!');
            }
        }

        return view('admin.settings.add');
    }

    public function editSetting(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $id = decrypt($id);

            $setting = \DB::table('tbl_settings')->find($id);
            if (str_contains($setting->item, 'year'))
                $request->ivalue = date('Y');
            $settings = \DB::table('tbl_settings')->where('id', $id)->update(["value" => $request->ivalue]);

            return redirect()->route('admin.settings')->with('success', "Updated successfully !.");
        }

        $id = decrypt($request->id);
        $settings = \DB::table('tbl_settings')->where('id', $id)->get()->first();

        return view('admin.settings.edit', compact('settings'));
    }

    public function deleteSetting(Request $request)
    {
        $id = $request->txt_setting_id;
        //dd($id);
        \DB::table('tbl_settings')->delete($id);

        return redirect()->route('admin.settings')->with('success', "Item deleted successfully !.");
    }

    public function listSetting(Request $request)
    {
        $settings = \DB::table('tbl_settings')->get()->keyBy('item');
        //dd($settings);
        return view('admin.settings.list_settings', compact('settings'));
        // $settings = \DB::select('SELECT * FROM `tbl_settings` ORDER BY `id` ASC');

        // return view('admin.settings.list_settings', compact('settings'));
    }


    public function admin_login_post(Request $request)
    {
        $session_token = Session::get('access_token');

        if (isset($session_token['access_token']) && $session_token['access_token']) {
            $res = $this->verify_email_DB();
            if ($res == 101) {
                return back()->with('error', Config::get('constants.WebMessageCode.118'));
                $this->logout();
            } else if ($res == 102) {
                return back()->with('error', "Invalid Token");
                $this->logout();
            } else {
                return redirect()->route('admin.dashboard');
            }
        } else {
            $auth_url = CustomHelper::set_token_admin();

            return redirect($auth_url);
        }
    }

    public function admin_login_get()
    {
        if (!isset($_GET['code'])) {
            $auth_url = CustomHelper::set_token_admin();

            return redirect($auth_url);
        } else {
            $code = $_GET['code'];
            CustomHelper::get_token_admin($code);

            $res = $this->verify_email_DB();

            // print_r($res);
            /*  echo $code;*/
            //echo  $responce->email;

            if ($res == 101) {
                return back()->with('error', Config::get('constants.WebMessageCode.118'));
                $this->logout();
            } else if ($res == 102) {
                return back()->with('error', "Invalid Token");
                $this->logout();
            } else {
                //$teacher = Teacher::all();
                //return view('admin.dashboard',compact('teacher'))->with('i', 0);
                return redirect()->route('admin.dashboard');
            }
            //print_r($responce);
            //echo $responce['email'];


        }
    }

    public function adminDashboard(Request $request)
    {
        $teacher = Teacher::all();
        $currentYear = CustomHelper::getCurrentYear()->pluck('value');
        $onGoingClasses = CustomHelper::onGoingClasses();

        return view('admin.dashboard', compact('teacher', 'currentYear', 'onGoingClasses'))->with('i', 0);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('access_token');
        $request->session()->forget('admin_session');
        // Session::forget('access_token');
        // Session::forget('admin_session');
        Auth::logout();
        return redirect(url('/admin'));
    }

    public function adminProfile(Request $request)
    {
        $admin_id = Session::get('admin_session');
        if (Request()->post()) {
            $request->validate([
                'fname' => 'required|max:100|regex:/^[a-zA-Z ]*$/',
                'lname' => 'required|max:100|regex:/^[a-zA-Z ]*$/',
                // 'email' => 'required',
            ]);
            if ($request->input('phone_no')) {
                $request->validate([
                    'phone_no' => 'numeric|digits:10',
                ]);
            }

            $obj = Admin::find($admin_id['admin_id']);
            $obj->first_name = $request->input('fname');
            $obj->last_name = $request->input('lname');
            $obj->phone = $request->input('phone_no');
            // $obj->email = $request->input('email');
            $obj->save();

            return back()->with('success', Config::get('constants.WebMessageCode.124'));
        }
        $admin = Admin::find($admin_id['admin_id']);
        $data = ['first_name' => $admin->first_name, 'last_name' => $admin->last_name, 'email' => $admin->email, 'phone_no' => $admin->phone];

        return view('admin.profile', $data);
    }

    public function verify_email_DB()
    {
        $session_token = Session::get('access_token');

        $array = array('error' => '');

        $responce = CustomHelper::get_user_from_token($session_token['id_token']);
        //$responce = json_decode($responce,true);
        $resData = array_merge($array, json_decode($responce, true));

        if ($resData['error'] != '') {
            return 102;
        } else {

            $credentials = $resData['email'];
            $admin = Admin::where('email', $credentials)->first();
            if (!empty($admin)) {
                Session::put('admin_session', array('admin_id' => $admin['id'], 'admin_email' => $admin['email']));
                Auth::loginUsingId($admin->id);
                return 100;
            } else {
                return 101;
            }
        }
    }


    public function reports(Request $request)
    {

        $totalClassesOfClassrooms = StudentClass::with('dateClass')->get()->pluck('dateClass.*', 'id');

        $cancelledClassesOfClassrooms = StudentClass::with(['dateClass' => function ($q) {
            $q->where('cancelled', 1);
        }])->get()->pluck('dateClass.*', 'id');


        $inviteClassData = InvitationClass::with('studentClass', 'studentSubject')
            ->orderBy('id', 'DESC')
            ->get();

        $attendanceAverage = ReportUtility::getClassAttedanceAverage();
        // $gradeAverage = ReportUtility::getAssignmentSubmissionGrades($loggedTeacher['teacher_id']);

        return view('admin.reports.index', compact('inviteClassData', 'totalClassesOfClassrooms', 'cancelledClassesOfClassrooms', 'attendanceAverage'));
    }

}
