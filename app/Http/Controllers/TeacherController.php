<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;
use Session;
use Validator;
use App\Http\Helpers\CommonHelper;
use App\Teacher;
use Illuminate\Support\Facades\Log;
use Tzsk\Sms\Facade\Sms;
use App\Http\Helpers\CustomHelper;
use App\ClassTiming;
use App\DateClass;
use App\ClassWork;

class TeacherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        //$this->middleware('auth');
        //  return Auth::guard('admin');
    }


    /**
     * Show the application dashboard.|min:8
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addTeacher (Request $request)
    {
        $logged_admin = Session::get('admin_session');
        $logged_admin_email = $logged_admin['admin_email'];

        $domain = CustomHelper::getDomain();

        if ( $request->isMethod('post') ) {
           
            $request->validate([
                'fname' => 'required|max:100|regex:/^[a-zA-Z ]*$/',
                // 'lname' => 'required|max:100|alpha_num',
                'email' => 'required|email|ends_with:' . $domain->value . '|max:100|unique:tbl_techers',
                'phone' => 'required|numeric|digits:10|unique:tbl_techers',
                // 'pin' => 'required|min:4|unique:tbl_techers',
            ], [
                'fname.regex' => 'The name must be letters.',
                //'lname.alpha_num'=>'The Last name may only contain letters and numbers.',

            ]);

            if ( Teacher::count() >= config('app.teacher_uppercap') ) {
                return back()->with('error','Maximum limit of ' . env('TEACHER_UPPERCAP') . 'teacher reached.
                        Contact administrator for extending limit');
            }
            
            $data = array("name"          => array(
                "familyName" => "Teacher",//$request->fname,
                "givenName"  => $request->fname,
                "fullName"   => $request->fname,//.' '.$request->lname
            ),
                          "password"      => 't#' . $request->phone,
                          "primaryEmail"  => $request->email,
                          "recoveryEmail" => $logged_admin_email,
            );
            $data = json_encode($data);

            $token = CommonHelper::varify_Admintoken(); // verify admin token

            $responce = CommonHelper::create_new_user($token, $data);  // access Google api craete user
            $resData = array('error' => '');

            if ( $responce == 101 ) {
                return back()->with('error', Config::get('constants.WebMessageCode.119'));
            } else {
                $resData = array_merge($resData, json_decode($responce, true));
                if ( $resData['error'] ) {
                    Log::error($resData['error']['message']);
                    if ( $resData['error']['message'] == 'Invalid Credentials' ) {
                        return redirect()->route('admin.logout');
                    } else {
                        return redirect()->route('admin.dashboard')->with('error', $resData['error']['message']);
                    }
                } else {
                    $teacher = new Teacher;
                    $teacher->name = $request->fname;
                    //$teacher->last_name = $request->lname;
                    $teacher->email = $request->email;
                    $teacher->phone = $request->phone;
                    $teacher->g_user_id = $resData['id'];
                    $teacher->g_customer_id = $resData['customerId'];
                    $teacher->g_response = $responce;
                    // $teacher->password = Hash::make($request->pin);
                    $teacher->save();

                    /// Send SMS to Teacher for assigned new Class
                    $phone = $request->phone;
                    $email = $request->email;
                    if ( strlen($phone) <= 10 ) {
                        $number = '91' . $phone;
                    } else {
                        $number = $phone;
                    }

                    $message = "Your school created an account for you. Gmail ID: $email and  “t#” followed by phone number as password..";

                    $s = CommonHelper::send_sms($number, $message);


                    return redirect()->route('admin.dashboard')->with('success', Config::get('constants.WebMessageCode.100'));
                }
            }
        }
        // $pin = Helper::getRandomPin();
        //return view('admin.teacher.add',compact('pin'));

        return view('admin.teacher.add', compact('domain'));
    }

    public function editTeacher (Request $request, $id)
    {
        $domain = CustomHelper::getDomain();
        $logged_admin = Session::get('admin_session');
        $logged_admin_email = $logged_admin['admin_email'];
        $datetime = date('H-m-y H:i:s');
        if ( $request->isMethod('post') ) {
            $request->validate([
                'fname'      => 'required|max:100|regex:/^[a-zA-Z ]*$/',
                // 'lname' => 'required|max:100|alpha_num',
                'email'      => 'required|email|ends_with:' . $domain->value . '|max:100|unique:tbl_techers,email,' . $id,
                'phone'      => 'required|numeric|digits:10',
            ], [
                'fname.regex' => 'The name must be letters.',
                //'lname.alpha_num'=>'The Last name may only contain letters and numbers.',

            ]);

            $teacher = Teacher::find($id);

            if($request->g_meet_url != $teacher->g_meet_url)
            {
                $this->validate($request, [          
                     'g_meet_url' => "url|unique:tbl_techers",
                ]);
            }

            $TeacherExist = Teacher::where('email', $request->email)->where('id', $id)->get()->first();
            if ( $TeacherExist ) {
                $teacher = Teacher::find($id);
                $teacher->name = $request->fname;
                //$teacher->last_name = $request->lname;
                $teacher->email = $request->email;
                $teacher->phone = $request->phone;
                //$teacher->g_response = $responce;
                $teacher->g_meet_url = $request->g_meet_url;
                $teacher->g_meet_datetime = $datetime;
                $teacher->save();

                return redirect()->route('admin.dashboard')->with('success', Config::get('constants.WebMessageCode.101'));
            } else {
                $data = array(
                    "name"          => array(
                        "familyName" => $request->fname,
                        "givenName"  => '',
                        "fullName"   => $request->fname, //.' '.$request->lname
                    ),
                    // "password"=> $request->phone,
                    "primaryEmail"  => $request->email,
                    "recoveryEmail" => $logged_admin_email,
                );
                $data = json_encode($data);

                $userKey = $request->user_gid;    // for update user in google user

                $token = CommonHelper::varify_Admintoken(); // verify admin token
                if ( $userKey ) {
                    $responce = CommonHelper::update_user($token, $data, $userKey);  // access Google api Update user
                } else {
                    $responce = 101;
                }

                $resData = array('error' => '');
                if ( $responce == 101 ) {
                    return back()->with('error', Config::get('constants.WebMessageCode.119'));
                } else {
                    $resData = array_merge($resData, json_decode($responce, true));
                    //$resData = json_decode($responce,true);
                    if ( $resData['error'] ) {
                        Log::error($resData['error']['message']);
                        if ( $resData['error']['message'] == 'Invalid Credentials' ) {
                            return redirect()->route('admin.logout');
                        } else {
                            return redirect()->route('admin.dashboard')->with('error', $resData['error']['message']);
                        }
                    } else {
                        $teacher = Teacher::find($id);
                        $teacher->name = $request->fname;
                        //$teacher->last_name = $request->lname;
                        $teacher->email = $request->email;
                        $teacher->phone = $request->phone;
                        $teacher->g_response = $responce;
                        $teacher->g_meet_url = $request->g_meet_url;
                        $teacher->g_meet_datetime = $datetime;
                        $teacher->save();

                        return redirect()->route('admin.dashboard')->with('success', Config::get('constants.WebMessageCode.101'));
                    }
                }
            }
        }
        $id = decrypt($id);
        $teacher = Teacher::find($id);

        return view('admin.teacher.edit', compact('teacher', 'domain'));
    }

    public function deleteTeacher (Request $request, $id)
    {
        //$id = $request->user_id;
        if ( $request->delete == 'Delete' || $request->delete == 'delete' ) {


            if ( $id != '' ) {
                $classTimingExist = ClassTiming::where('teacher_id', $id)->get()->first();

                $dateClassExist = DateClass::where('teacher_id', $id)->get()->first();

                $classWorkExits = ClassWork::where('teacher_id', $id)->get()->first();

                if ( $classTimingExist ) {
                    return back()->with('error', "you cannot delete this teacher! it's associated with class....");
                } else if ( $dateClassExist ) {
                    return back()->with('error', "you cannot delete this teacher! it's associated with class....");
                } else if ( $classWorkExits ) {
                    return back()->with('error', "you cannot delete this teacher! it's associated with class....");
                } else {
                    $user = Teacher::find($id);
                    $userKey = $user->g_user_id;    // for update user in google user
                    $token = CommonHelper::varify_Admintoken(); // verify admin token

                    //dd($token);

                    $responce = CommonHelper::user_delete($token, $userKey);  // access Google api Delete user
                    $resData = array('error' => '');

                    if ( $responce == '' ) {
                        $user->delete();

                        return redirect()->route('admin.dashboard')->with('success', Config::get('constants.WebMessageCode.102'));
                    }

                    if ( $responce == 101 ) {
                        return back()->with('error', Config::get('constants.WebMessageCode.119'));
                    } else {
                        $resData = array_merge($resData, json_decode($responce, true));
                        //$resData = json_decode($responce,true);
                        if ( $resData['error'] ) {
                            //Log::error($resData['error']['message']);
                            if ( $resData['error']['message'] == 'Invalid Credentials' ) // || $resData['error']['message'] == 'Resource Not Found: userKey')
                            {
                                return redirect()->route('admin.logout');
                            } else {
                                return redirect()->route('admin.dashboard')->with('error', $resData['error']['message']);
                            }
                        } else {
                            $user->delete();

                            return redirect()->route('admin.dashboard')->with('success', Config::get('constants.WebMessageCode.102'));
                        }
                    }
                }
            }
        } else {
            return redirect()->back()->with('error', "Type delete to confirm");
        }
    }

    public function sampleTeacherDownload (Request $request)
    {
        $path = public_path('teacher-excels') . '/sample/Sample-Teacher-format.csv';

        return response()->download($path);
    }


    /*Import no of Teacher in a class*/
    public function importClassTeacher (Request $request)
    {
        $domain = CustomHelper::getDomain();
        $logged_admin = Session::get('admin_session');
        $logged_admin_email = $logged_admin['admin_email'];
        if ( Request()->post() ) {
            $request->validate([
                'file' => 'required',
            ]);
            try {

                $extensions = array("csv", "xlsx");
                $file_validate = strtolower($request->file('file')->getClientOriginalExtension());

                if ( !in_array($file_validate, $extensions) ) {
                    return back()->with('error', sprintf(Config::get('constants.WebMessageCode.103'), implode(",", $extensions)));
                }

                $file = $request->file('file');
                $destinationPath = public_path('teacher-excels');

                $filename = $file->getClientOriginalName();

                if ( file_exists($destinationPath . '/' . $filename) )
                    unlink($destinationPath . '/' . $filename);

                $file->move($destinationPath, $filename);


                $path = $destinationPath . '/' . $filename;
                $headerMissing = array();
                $supplierAdded = 0;
                $i = 1;
                $error = '';
                $errorString = '';
                $rows = "";

                $collection = ( new FastExcel )->import($path);

                if ( !isset($collection[0]) ) {
                    return back()->with('error', Config::get('constants.WebMessageCode.104'));
                }
                $numbers = array();

                Log::info('Filename processing - ' . $filename);


                foreach ( $collection as $key => $reader ) {
                    if ( Teacher::count() >= config('app.teacher_uppercap') ) {
                        return back()->with('error',
                            'Maximum limit of ' . env('TEACHER_UPPERCAP') . 'teacher reached.
                                Contact administrator for extending limit');
                    }
                    if ( !isset($reader["name"]) || !isset($reader["email"]) || !isset($reader["phone"]) ) {
                        $error = "Header mismatch";
                        Log::error('Header mismatch!!');
                    } else if ( $reader["name"] == "" || $reader["email"] == "" || $reader["phone"] == "" ) {
                        Log::error('Teacher details missing : ROW - ' . $i);
                        $errorString = 'Teacher details missing : ROW - ' . $i;
                        $error = 'found';
                        $rows .= $i . ",";
                    } else if ( $reader["email"] == "" && $reader["phone"] == "" ) {
                        Log::error('Teacher details missing for Registration : ROW - ' . $i);
                        $errorString = 'Teacher details missing for Registration : ROW - ' . $i;
                        $error = 'found';
                        $rows .= $i . ",";
                    } else if ( $reader["email"] == "" ) {
                        Log::error('Teacher email missing : ROW - ' . $i);
                        $errorString = 'Teacher email missing : ROW - ' . $i;
                        $error = 'found';
                        $rows .= $i . ",";
                    } else if ( $reader["phone"] == "" ) {
                        Log::error('Teacher phone number missing : ROW - ' . $i);
                        $errorString = 'Teacher phone number missing : ROW - ' . $i;
                        $error = 'found';
                        $rows .= $i . ",";
                    } else if ( !preg_match("/^[a-zA-Z0-9 ]*$/", $reader['name']) ) {
                        Log::error('Teacher name must contain only charachters : ROW - ' . $i);
                        $errorString = 'Teacher name must contain only charachters : ROW - ' . $i;
                        $error = 'found';
                        $rows .= $i . ",";
                    } else if ( !preg_match("/^[0-9]{10}$/", $reader['phone']) ) {
                        Log::error('Phone number must have 10 digits only : ROW - ' . $i);
                        $errorString = 'Phone number must have 10 digits only : ROW - ' . $i;
                        $error = 'found';
                        $rows .= $i . ",";
                    } else if ( !CustomHelper::is_email($reader['email']) ) {
                        Log::error('Invalid Email : ROW - ' . $i);
                        $errorString = 'Invalid Email : ROW - ' . $i;
                        $error = 'found';
                        $rows .= $i . ",";
                    } else if ( CustomHelper::getDomainFromEmail($reader['email']) != $domain->value ) {
                        Log::error('Email with invalid domain : ROW - ' . $i);
                        $errorString = 'Email with invalid domain : ROW - ' . $i;
                        $error = 'found';
                        $rows .= $i . ",";
                    } else {
                        $TeacherExist = Teacher::where('name', $reader["name"])->where('email', $reader["email"])->where('phone', $reader['phone'])->get()->first();

                        $TeacherEmailExist = Teacher::where('email', $reader["email"])->get()->first();
                        $TeacherPhoneExist = Teacher::where('phone', $reader['phone'])->get()->first();

                        $name = $reader["name"];
                        $email = $reader["email"];
                        $phone = $reader["phone"];

                        if ( $TeacherExist ) {
                            Log::error('Teacher already register : ROW - ' . $i);
                            $errorString = 'Teacher already register : ROW - ' . $i;
                            $error = 'found';
                            $rows .= $i . ",";
                        } else if ( $TeacherEmailExist ) {
                            Log::error('Teacher email already exists : ROW - ' . $i);
                            $errorString = 'Teacher email already exists : ROW - ' . $i;
                            $error = 'found';
                            $rows .= $i . ",";
                        } else if ( $TeacherPhoneExist ) {
                            Log::error('Teacher phone already exists : ROW - ' . $i);
                            $errorString = 'Teacher phone already exists : ROW - ' . $i;
                            $error = 'found';
                            $rows .= $i . ",";
                        } else {
                            $data = array(
                                "name"          => array(
                                    "familyName" => "Teacher",
                                    "givenName"  => $name,
                                    "fullName"   => $name, //.' '.$request->lname
                                ),
                                "password"      => 't#' . $phone,
                                "primaryEmail"  => $email,
                                "recoveryEmail" => $logged_admin_email,
                            );
                            $data = json_encode($data);

                            $token = CommonHelper::varify_Admintoken(); // verify admin token

                            $responce = CommonHelper::create_new_user($token, $data);  // access Google api craete user
                            $resData = array('error' => '');


                            if ( $responce == 101 ) {
                                Log::error('Teacher not created in Gsuite : ROW - ' . $i . '.Something went wrong! Please Try again!');
                                $errorString = 'Teacher not created in Gsuite : ROW - ' . $i . '.Something went wrong! Please Try again!';
                                $error = 'found';
                                $rows .= $i . ",";
                                //return back()->with('error', );
                            } else {
                                $resData = array_merge($resData, json_decode($responce, true));
                                Log::info($responce);

                                if ( $resData['error'] ) {
                                    Log::error($resData['error']['message'] . " Something went wrong with : ROW - " . $i);
                                    $errorString = $resData['error']['message'] . " Something went wrong with : ROW - " . $i;
                                    $error = 'found';
                                    //return back()->with('error', $resData['error']['message']." Something went wrong with : ROW - " . $i );
                                    if ( $resData['error']['message'] == 'Invalid Credentials') {
                                        Log::error($resData['error']['message']);
                                        return redirect()->route('admin.logout');
                                    } else {
                                        return redirect()->route('admin.dashboard')->with('error', $resData['error']['message']);
                                    }
                                }



                                if ( $resData['error'] ) {
                                    Log::error($resData['error']['message'] . " Something went wrong with : ROW - " . $i);
                                    $errorString = $resData['error']['message'] . " Something went wrong with : ROW - " . $i;
                                    $error = 'found';
                                    //return back()->with('error', $resData['error']['message']." Something went wrong with : ROW - " . $i );
                                    if ( $resData['error']['message'] == 'Invalid Credentials' ) {
                                        return redirect()->route('admin.logout');
                                    } else {
                                        return redirect()->route('admin.dashboard')->with('error', $resData['error']['message']);
                                    }
                                } else {
                                    $teacher = new Teacher;
                                    $teacher->name = $name;
                                    //$teacher->last_name = $request->lname;
                                    $teacher->email = $email;
                                    $teacher->phone = $phone;
                                    $teacher->g_user_id = $resData['id'];
                                    $teacher->g_customer_id = $resData['customerId'];
                                    $teacher->g_response = $responce;
                                    // $teacher->password = Hash::make($request->pin);
                                    $teacher->save();


                                    if ( strlen($phone) <= 10 ) {
                                        $number = '91' . $phone;
                                    } else {
                                        $number = $phone;
                                    }

                                    $message = "Your school created an account for you. Gmail ID: $email and  “t#” followed by phone number as password..";

                                    $s = CommonHelper::send_sms($number, $message);


                                    Log::error(Config::get('constants.WebMessageCode.100') . " : ROW - " . $i);
                                }
                            }
                        }
                    }
                    $i += 1;
                }
                Log::info('File processing done ');
                @unlink($path);
                if ( $error == 'found' ) {
                    return back()->with('error', 'Teacher details processed, ' . $errorString . ', errors in rows - ' . $rows);
                } else {
                    return back()->with('success', 'Teacher details processed successfully.');
                }
            } catch ( \Exception $e ) {

                if ( $error == "Header mismatch" ) {
                    return back()->with('error', 'CSV file Header/(1st line) mismatch!!, check the file format!!');
                } else {
                    return back()->with('error', Config::get('constants.WebMessageCode.121'));
                }
                @unlink($path);
            }
        }

        return view('admin.teacher.import'); //,compact('student_class'));
    }
}
