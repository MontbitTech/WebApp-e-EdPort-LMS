<?php

namespace App\Http\Controllers\Student;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Helpers\CustomHelper;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LoginCotroller extends Controller
{
    public function index()
    {
        return view('student.welcome');
    }

    public function studentLoginPost(Request $request)
    {
        $session_token = Session::get('access_token');

        if (isset($session_token['access_token']) && $session_token['access_token']) {
            $res = $this->verify_email_DB($request);
            if ($res == 101) {
                return back()->with('error', Config::get('constants.WebMessageCode.118'));
                $this->logout($request);
            } else if ($res == 102) {
                return back()->with('error', "Invalid Token");
                $this->logout($request);
            } else {
                return redirect()->route('student.dashboard');
            }
        } else {
            $auth_url = CustomHelper::set_token_student();

            return redirect($auth_url);
        }
    }

    public function studentLoginGet(Request $request)
    {
        if (!isset($_GET['code'])) {
            $auth_url = CustomHelper::set_token_student();

            return redirect($auth_url);
        } else {
            $code = $_GET['code'];
            CustomHelper::get_token_student($code);

            $res = $this->verify_email_DB($request);

            if ($res == 101) {
                return back()->with('error', Config::get('constants.WebMessageCode.118'));
                $this->logout($request);
            } else if ($res == 102) {
                return back()->with('error', "Invalid Token");
                $this->logout($request);
            } else {
  
                return redirect()->route('student.dashboard');
            }
        }
    }

    public function verify_email_DB(Request $request)
    {
        $session_token = Session::get('access_token');

        $array = array('error' => '');

        $responce = CustomHelper::get_user_from_token($session_token['id_token']);

        $resData = array_merge($array, json_decode($responce, true));

        if ($resData['error'] != '') 
            return 102;

        $student = Student::where('email', $resData['email'])->first();
        if (empty($student))
            return 101;

        Session::put('student_session', array('student_id' => $student['id'], 'student_email' => $student['email']));
        Auth::login($student);

        return 100;
    }

    public function logout(Request $request)
    {
        $request->session()->forget('access_token');
        $request->session()->forget('student_session');

        Auth::logout();
        return redirect(url('/student'));
    }
}
