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
use App\Models\ClassSection;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Http\Helpers\CustomHelper;
use Mail;


class ImportStudentsController extends Controller
{

    public function addStudent (Request $request)
    {


        $domain = CustomHelper::getDomain();
        $from = CustomHelper::getFromMail();
        $domain_name = $domain->value;

        if ( $request->isMethod('post') ) {
            $request->validate([
                'fname'   => 'required|max:100|regex:/^[a-zA-Z ]*$/',
                // 'lname' => 'required|max:100|alpha_num',
                'class'   => 'required',
                'section' => 'required',
                'email'   => 'required|email',
                'phone'   => 'required|numeric|digits:10',
                // 'pin' => 'required|min:4|unique:tbl_techers',
            ], [
                'fname.regex' => 'The name must be letters.',
                //'lname.alpha_num'=>'The Last name may only contain letters and numbers.',

            ]);
            //dd($request->all());
            if ( $request->notify == true ) {
                if ( isset($request->phone) || isset($request->email) )
                    $n = "yes";
                else
                    return back()->with('error', Config::get('constants.WebMessageCode.132'));
            } else
                $n = "no";

            if ( isset($request->phone) && $request->phone > 0 && strlen($request->phone) != 10 )
                return back()->with('error', Config::get('constants.WebMessageCode.133'));

            $student = \DB::table('tbl_classes')->where('class_name', $request->class)->where('section_name', $request->section)->pluck('id');

            if ( count($student) <= 0 ) {
                return back()->with('error', Config::get('constants.WebMessageCode.120'));
            }

            $obj_class = StudentClass::where('class_name', $request->class)->where('section_name', $request->section)->get();


            if ( count($obj_class) > 0 ) {
                $token = CommonHelper::varify_Admintoken(); // verify admin token
                foreach ( $obj_class as $row ) {

                    $g_class_id = $row->g_class_id;

                    //	dd($g_class_id);

                    $inv_data = array(
                        "courseId" => $g_class_id,
                        "role"     => "STUDENT",
                        "userId"   => $request->email,

                    );
                    $inv_data = json_encode($inv_data);
                    $inv_responce = CommonHelper::teacher_invitation_forClass($token, $inv_data); // Invite Student
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
                        }
                    }
                }
                \DB::insert('insert into tbl_students (name, class_id, phone, email, notify) values (?, ?, ?, ?, ?)', [$request->fname, $student[0], $request->phone, $request->email, $n]);

                $class = encrypt($request->class);
                $section = encrypt($request->section);

                $timeTable_url = env('APP_URL') . "/timeTable/" . $class . "/" . $section . "";

                $data_mail = array('name' => $request->fname, 'timetable_url' => $timeTable_url);
                $email = $request->email;

                Mail::send('mail.mail_timetable', $data_mail, function ($message) use ($email, $from) {
                    $message->to($email);
                    $message->subject('New Time Table');
                    //$message->from('noreply@montbit.com','MontBIt');
                    $message->from($from->value, 'MontBIt');
                });


                return redirect()->route('adminlist.students')->with('success', 'Added Successfully');
            } else {
                return redirect()->route('student.add')->with('error', "Selected Class is not created.");
            }
        }

        $data['section'] = \DB::table('tbl_classes')->select('section_name')->distinct()->get()->pluck('section_name', 'section_name');
        $data['class'] = \DB::table('tbl_classes')->select('class_name')->distinct()->get()->pluck('class_name', 'class_name');
        $data['class']->prepend('Select Class', '');
        $data['section']->prepend('Select Section', '');

        return view('admin.numbers.add', compact('data', $data));
    }

    public function editStudent (Request $request, $id)
    {

        if ( $request->isMethod('post') ) {
            $request->validate([
                'fname'   => 'required|max:100|regex:/^[a-zA-Z ]*$/',
                // 'lname' => 'required|max:100|alpha_num',
                'id'      => 'required|numeric',
                'class'   => 'required',
                'section' => 'required',
                'phone'   => 'required|numeric|digits:10',
                'email'   => 'required|email',
            ], [
                'fname.regex' => 'The name must be letters only.',
                //'lname.alpha_num'=>'The Last name may only contain letters and numbers.',

            ]);

            if ( $request->notify == true ) {
                if ( isset($request->phone) || isset($request->email) )
                    $n = "yes";
                else
                    return back()->with('error', Config::get('constants.WebMessageCode.132'));
            } else
                $n = "no";

            if ( isset($request->phone) && !is_numeric($request->phone) && str_len($request->phone) != 10 )
                return back()->with('error', Config::get('constants.WebMessageCode.133'));

            $sid = decrypt($id);
            $student = \DB::table('tbl_students')->where('id', $sid)->update(array('phone' => $request->phone, 'email' => $request->email, 'notify' => $n));

            return redirect()->route('adminlist.students')->with('success', Config::get('constants.WebMessageCode.112'));
        }

        $id = decrypt($id);

        $student = \DB::select('select s.id, s.name, s.phone, s.email, s.notify, c.class_name, c.section_name from tbl_students s, tbl_classes c
								where c.id = s.class_id and s.id=?', [$id]);


        return view('admin.numbers.edit', compact('student'));
    }

    public function deleteStudent (Request $request, $id)
    {
        if ( $request->delete == 'Delete' || $request->delete == 'delete' ) {
            $sid = $request->txt_student_id;

            /**/

            $student = \DB::select('select class_name, section_name, email from tbl_students s, tbl_classes c where s.class_id = c.id and s.id=' . $sid);

            if ( count($student) > 0 ) {
                $student = $student[0];

                $obj_class = StudentClass::where('class_name', $student->class_name)->where('section_name', $student->section_name)->get();

                $token = CommonHelper::varify_Admintoken(); // verify admin token
                foreach ( $obj_class as $row ) {

                    $inv_responce = CommonHelper::student_course_delete($token, $student->email, $row->g_class_id); // Invite Student

                    $inv_resData = array('error' => '');
                    if ( $inv_responce == 101 ) {
                        return back()->with('error', Config::get('constants.WebMessageCode.119'));
                    } else {
                        $inv_resData = array_merge($inv_resData, json_decode($inv_responce, true));
                        if ( $inv_resData['error'] != '' ) {

                            if ( $inv_resData['error']['status'] == 'UNAUTHENTICATED' ) {
                                return redirect()->route('admin.logout');
                            }
                        }
                    }
                }
            }
            /**/
            $student = Student::find($sid);
            $student->delete();

            $lists = \DB::select('select s.id, s.name, s.email, s.phone, s.notify, c.class_name, c.section_name from tbl_students s left join tbl_classes c on c.id = s.class_id');

            return redirect()->route('adminlist.students')->with('success', Config::get('constants.WebMessageCode.139'));
        } else {
            return redirect()->back()->with('error', "Type delete to confirm");
        }
    }

    public function listStudents ()
    {
        $classes = ClassSection::select('class_name')->distinct()->get();
        $sections = ClassSection::select('section_name')->distinct()->get();

        return view('admin.numbers.index', compact('classes', 'sections'));
    }

    public function filterStudent (Request $request)
    {
        $class_name = $request->txtSerachClass;
        $section_name = $request->txtSerachSection;
        if ( !empty($request->txtSerachClass && $request->txtSerachSection) ) {
            $getResult = \DB::select("SELECT s.id, s.name, s.email, s.phone, s.notify, c.class_name, c.section_name from tbl_students s left join tbl_classes c on c.id = s.class_id where c.class_name=? and c.section_name=?", [$class_name, $section_name]);
        } else $getResult = "";

        return view('admin.numbers.filter-student', compact('getResult'));
    }

    public function sampleStudentsDownload (Request $request)
    {
        $path = public_path('student-excels/sample') . '/Sample-Students-format.csv';

        return response()->download($path);
    }


    /*Import no of students in a class*/
    public function importClassStudentNumber (Request $request)
    {


        $domain = CustomHelper::getDomain();
        $from = CustomHelper::getFromMail();
        $domain_name = $domain->value;

        $student_class = \App\StudentClass::all();
        $error = "";
        $rows = "";

        if ( Request()->post() ) {
            try {
                $request->validate([
                    'file' => 'required'
                    //   'class' => 'required'
                ]);

                $extensions = array("csv", "xlsx");
                $file_validate = strtolower($request->file('file')->getClientOriginalExtension());

                if ( !in_array($file_validate, $extensions) ) {
                    return back()->with('error', sprintf(Config::get('constants.WebMessageCode.103'), implode(",", $extensions)));
                }

                $file = $request->file('file');
                $destinationPath = public_path('student-excels');

                $filename = $file->getClientOriginalName();

                if ( file_exists($destinationPath . '/' . $filename) )
                    unlink($destinationPath . '/' . $filename);

                $file->move($destinationPath, $filename);

                $path = $destinationPath . '/' . $filename;

                $headerMissing = array();
                $supplierAdded = 0;
                $i = 1;
                $collection = ( new FastExcel )->import($path);


                //
                if ( !isset($collection[0]) ) {
                    return back()->with('error', Config::get('constants.WebMessageCode.104'));
                }
                $numbers = array();

                Log::info('Filename processing - ' . $filename);
                foreach ( $collection as $key => $reader ) {
                    if ( !isset($reader["class"]) || !isset($reader["name"]) || !isset($reader["phone"]) || !isset($reader["email"]) || !isset($reader["class"]) ) {
                        $error = "Header mismatch";
                        Log::error('Header mismatch!!');
                        //return back()->with('error',Config::get('constants.WebMessageCode.137'));
                    } elseif ( $reader["name"] == "" || $reader["class"] == "" || $reader["section"] == "" || $reader["email"] == "" || $reader["phone"] == "" ) {
                        Log::error('Student details missing : ROW - ' . $i);
                        $error = "true";
                        $rows .= $i . ",";
                    } elseif ( $reader["phone"] == "" && $reader["email"] == "" && $reader["notify"] == "yes" ) {
                        Log::error('Student details missing for notification : ROW - ' . $i);
                        $rows .= $i . ",";
                        $error = "true";
                    } else if ( !preg_match("/^[a-zA-Z\s]*$/", $reader['name']) ) {
                        Log::error('Student name must contain only charachters : ROW - ' . $i);
                        $error = 'found';
                        $rows .= $i . ",";
                    } else if ( !preg_match("/^[0-9]{10}$/", $reader['phone']) ) {
                        Log::error('Phone number must have 10 digits : ROW - ' . $i);
                        $error = 'found';
                        $rows .= $i . ",";
                    } else if ( !CustomHelper::is_email($reader['email']) ) {
                        Log::error('Invalid Email : ROW - ' . $i);
                        $error = 'found';
                        $rows .= $i . ",";
                    } else {
                        $studentClassExist = \DB::select('select id from tbl_classes where class_name="' . $reader["class"] . '" and section_name="' . $reader["section"] . '"');


                        $obj_class = StudentClass::where('class_name', $reader["class"])->where('section_name', $reader["section"])->get();


                        if ( count($obj_class) > 0 ) {
                            $class_id = $studentClassExist[0]->id;

                            $studenExist = \DB::select('select * from tbl_students where email="' . $reader["email"] . '" and phone="' . $reader["phone"] . '" and name="' . $reader["name"] . '" and class_id="' . $class_id . '"');

                            if ( count($studenExist) > 0 ) {
                                Log::error('Duplicate entry : ROW - ' . $i);
                                $rows .= $i . ",";
                                $error = "true";
                            } else {
                                $token = CommonHelper::varify_Admintoken(); // verify admin token
                                foreach ( $obj_class as $row ) {

                                    $g_class_id = $row->g_class_id;
                                    $inv_data = array(
                                        "courseId" => $g_class_id,
                                        "role"     => "STUDENT",
                                        "userId"   => $reader["email"],
                                    );
                                    $inv_data = json_encode($inv_data);
                                    $inv_responce = CommonHelper::teacher_invitation_forClass($token, $inv_data); // Invite Student
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
                                        }
                                    }
                                }
                                $s = \DB::table('tbl_students')->insert([
                                    ['name' => $reader["name"], 'class_id' => $class_id, 'email' => $reader["email"], 'phone' => $reader["phone"], 'notify' => $reader["notify"]],
                                ]);

                                $c = $reader["class"];
                                $s = $reader["section"];

                                $class = encrypt($c);
                                $section = encrypt($s);

                                $name = $reader["name"];
                                $email = $reader["email"];

                                $timeTable_url = env('APP_URL') . "/timeTable/" . $class . "/" . $section . "";

                                $data_mail = array('name' => $name, 'timetable_url' => $timeTable_url);

                                Mail::send('mail.mail_timetable', $data_mail, function ($message) use ($email, $from) {
                                    $message->to($email);
                                    $message->subject('New Time Table');
                                    //$message->from('noreply@montbit.com','MontBIt');
                                    $message->from($from->value, 'MontBIt');
                                });


                                Log::error(Config::get('constants.WebMessageCode.130') . " : ROW - " . $i);
                            }
                        } else {
                            Log::error('Class not found : ROW - ' . $i);
                            $rows .= $i . ",";
                            $error = "true";
                        }
                    }
                    $i += 1;
                }
                Log::info('File processing done ');

                if ( $error == "" )
                    return back()->with('success', 'Student details uploaded successfully!!');
                else
                    return back()->with('error', 'Student details processed, check log file, error in rows - ' . $rows);
            } catch ( \Exception $e ) {
                if ( $error == "Header mismatch" ) {
                    return back()->with('error', 'CSV file Header/(1st line) mismatch!!, check the file format!!');
                } else {
                    return back()->with('error', Config::get('constants.WebMessageCode.136'));
                }
            }
            @unlink($path);
        }

        return view('admin.numbers.import', compact('student_class'));
    }
}
