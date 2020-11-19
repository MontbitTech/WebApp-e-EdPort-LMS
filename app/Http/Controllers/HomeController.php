<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Session;
use DateTime;


class HomeController extends Controller
{
    public function ex()
    {
        return view('extra');
    }
    public function index()
    {
        return view('welcome');
    }


    public function updateName(Request $request)
    {
        if (Request()->post() || Request()->ajax()) {
            $request->validate([
                'name' => 'required|max:100|regex:/^[a-zA-Z0-9 ]*$/'
            ]);
            try {
                $logged_teacher = Session::get('teacher_session');
                $logged_teacher_id = $logged_teacher['teacher_id'];
                $user = \App\Teacher::find($logged_teacher_id);
                $user->name = ucwords($request->name);
                $user->save();
                echo json_encode(array('status' => 'success', 'message' => Config::get('constants.WebMessageCode.112')));
            } catch (\Exception $e) {
                echo json_encode(array('status' => 'error', 'message' => Config::get('constants.WebMessageCode.121')));
            }
        }
    }
    public function updateProfilePicture(Request $request)
    {
        try {
            $logged_teacher = Session::get('teacher_session');
            $logged_teacher_id = $logged_teacher['teacher_id'];

            if ($request->file('profile_picture')) {
                $image = $request->file('profile_picture');
                $ext = $image->getClientOriginalExtension();

                $supportedFileTypes = array('gif', 'jpeg', 'png', 'jpg');
                if (in_array(strtolower($ext), $supportedFileTypes)) {
                    $name = time() . '_' . $logged_teacher_id . '.' . $ext;
                    $destinationPath = public_path('/images/teacher');

                    $image->move($destinationPath, $name);


                    $user = \App\Teacher::find($logged_teacher_id);
                    $user->photo = $name;
                    $user->save();
                    return back()->with('success', Config::get('constants.WebMessageCode.112'));
                }
            }
        } catch (\Exception $e) {
            return back()->with('error', Config::get('constants.WebMessageCode.121'));
        }
    }
}
