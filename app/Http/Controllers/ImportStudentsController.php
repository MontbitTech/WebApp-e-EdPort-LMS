<?php

namespace App\Http\Controllers;

use App\libraries\Utility\StudentUtility;
use App\Models\StudentCourseInvitation;
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
use App\Jobs\CreateStudentJob;
use App\libraries\EventManager;
use App\libraries\Utility\Utility;
use Mail;
use Session;


class ImportStudentsController extends Controller
{

    public function addStudent(Request $request)
    {
        $from = CustomHelper::getFromMail();

        if ($request->isMethod('post')) {
            $request->validate([
                'fname'   => 'required|max:100|regex:/^[a-zA-Z ]*$/',
                // 'lname' => 'required|max:100|alpha_num',
                'class'   => 'required',
                'section' => 'required',
                'email'   => 'required|email|unique:tbl_students|ends_with:gmail.com',
                'phone'   => 'required|numeric|digits:10|unique:tbl_students',
                // 'pin' => 'required|min:4|unique:tbl_techers',
            ], [
                'fname.regex' => 'The name must be letters.',
                //'lname.alpha_num'=>'The Last name may only contain letters and numbers.',

            ]);

            if ($request->notify == true) {
                if (isset($request->phone) || isset($request->email))
                    $n = "yes";
                else
                    return back()->with('error', Config::get('constants.WebMessageCode.132'));
            } else
                $n = "no";

            if (isset($request->phone) && $request->phone > 0 && strlen($request->phone) != 10)
                return back()->with('error', Config::get('constants.WebMessageCode.133'));

            $student = \DB::table('tbl_classes')->where('class_name', $request->class)->where('section_name', $request->section)->pluck('id');

            if (count($student) <= 0) {
                return back()->with('error', Config::get('constants.WebMessageCode.120'));
            }

            $obj_class = StudentClass::where('class_name', $request->class)->where('section_name', $request->section)->get();

            $inv_responce = null;
            if (count($obj_class) > 0) {
                $token = CommonHelper::varify_Admintoken(); // verify admin token
                foreach ($obj_class as $row) {

                    $g_class_id = $row->g_class_id;
                    
                    $inv_data = array(
                        "courseId" => $g_class_id,
                        "role"     => "STUDENT",
                        "userId"   => $request->email,

                    );
                    $inv_data = json_encode($inv_data);
                    $inv_responce = CommonHelper::teacher_invitation_forClass($token, $inv_data); // Invite Student
                    $inv_resData = array('error' => '');
                    if ($inv_responce == 101) {
                        return back()->with('error', Config::get('constants.WebMessageCode.119'));
                    } else {
                        $inv_resData = array_merge($inv_resData, json_decode($inv_responce, true));
                        if ($inv_resData['error'] != '') {

                            if ($inv_resData['error']['status'] == 'UNAUTHENTICATED') {
                                return redirect()->route('admin.logout');
                            } else {
                                //Log::error($inv_resData['error']['message']);
                                return back()->with('error', $inv_resData['error']['message']);
                            }
                        } else {
                            $inv_res_code = $inv_resData['id'];
                        }
                    }

                    $courseInvitation = new StudentCourseInvitation();
                    $courseInvitation->course_code = $g_class_id;
                    $courseInvitation->invitation_code = $inv_resData['id'];
                    $courseInvitation->student_email = $request->email;
                    $courseInvitation->save();
                }

               $student = StudentUtility::createStudent([
                    'name'     => $request->fname,
                    'class_id' => $student[0],
                    'phone'    => $request->phone,
                    'email'    => $request->email,
                    'notify'   => $n,
                ]);

//                \DB::insert('insert into tbl_students (name, class_id, phone, email, notify) values (?, ?, ?, ?, ?)', [$request->fname, $student[0], $request->phone, $request->email, $n]);
                
                StudentUtility::sendTimeTableToStudentEmail($request->class, $request->section, $student);

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

    public function editStudent(Request $request, $id)
    {
        set_time_limit(0);
        $id = decrypt($id);
        $error = ['status' => false, 'message' => ''];

        if ($request->isMethod('post')) {
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

            if ($request->notify == true) {
                if (isset($request->phone) || isset($request->email))
                    $n = "yes";
                else
                    return back()->with('error', Config::get('constants.WebMessageCode.132'));
            } else
                $n = "no";

            if (isset($request->phone) && !is_numeric($request->phone) && str_len($request->phone) != 10)
                return back()->with('error', Config::get('constants.WebMessageCode.133'));

            $student = Student::find($id);

            if (!$student)
                return redirect()->route('adminlist.students')->with('error', 'Student does not exist');

            StudentUtility::removeStudentFromClassroom($student);
            
            $classrooms = StudentClass::where('class_name', $request->class)->where('section_name', $request->section)->get();

            $response = StudentUtility::inviteStudentToClassroom($request->email, Session::get('access_token'), $classrooms);
            if(!$response['success'])
                return redirect()->route('adminlist.students')->with('error', $response['data']);
            
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->notify = $n;
            $student->save();
            $student->refresh();

            StudentUtility::sendTimeTableToStudentEmail($request->class, $request->section, $student);
            
            return redirect()->route('adminlist.students')->with('success', Config::get('constants.WebMessageCode.112'));
        }

        $student = \DB::select('select s.id, s.name, s.phone, s.email, s.notify, c.class_name, c.section_name from tbl_students s, tbl_classes c
								where c.id = s.class_id and s.id=?', [$id]);


        return view('admin.numbers.edit', compact('student'));
    }

    public function deleteStudent(Request $request, $id)
    {
        if ($request->delete == 'Delete' || $request->delete == 'delete') {
            $student = Student::with('class')->find($request->txt_student_id);

            $response = StudentUtility::removeStudentFromClassroom($student);
            if(!$response['success'])
                return back()->with('error', $response['data']);
 
            $student->delete();

            return redirect()->route('adminlist.students')->with('success', Config::get('constants.WebMessageCode.139'));
        } else {
            return redirect()->back()->with('error', "Type delete to confirm");
        }
    }

    public function listStudents()
    {
        $students = Student::get();
        $classes  = ClassSection::orderByRaw("CAST(class_name as UNSIGNED) ASC")->get();
        $sections = ClassSection::orderBy('section_name', 'ASC')->get();

        return view('admin.numbers.index', compact('classes', 'sections', 'students'));
    }

    public function filterStudent(Request $request)
    {

        if (($request->txtSerachClass) && ($request->txtSerachClass == 'all-class')) {
            $getResult = \DB::select("SELECT s.id, s.name, s.email, s.phone, s.notify, c.class_name, c.section_name from tbl_students s left join tbl_classes c on c.id = s.class_id");
            if ($request->txtSerachSection && $request->txtSerachSection != 'all-section') {
                $getResult = \DB::select("SELECT s.id, s.name, s.email, s.phone, s.notify, c.class_name, c.section_name from tbl_students s left join tbl_classes c on c.id = s.class_id where c.section_name=?", [$request->txtSerachSection]);
            }
        } else if ($request->txtSerachClass && $request->txtSerachSection == 'all-section') {
            $getResult = \DB::select("SELECT s.id, s.name, s.email, s.phone, s.notify, c.class_name, c.section_name from tbl_students s left join tbl_classes c on c.id = s.class_id where c.class_name=?", [$request->txtSerachClass]);
        } else if (($request->txtSerachClass) && ($request->txtSerachClass != 'all-class')) {
            $getResult = \DB::select("SELECT s.id, s.name, s.email, s.phone, s.notify, c.class_name, c.section_name from tbl_students s left join tbl_classes c on c.id = s.class_id where c.class_name=?", [$request->txtSerachClass]);
            if (($request->txtSerachSection && $request->txtSerachSection != 'all-section')) {
                $getResult = \DB::select("SELECT s.id, s.name, s.email, s.phone, s.notify, c.class_name, c.section_name from tbl_students s left join tbl_classes c on c.id = s.class_id where c.section_name=? and c.class_name=?", [$request->txtSerachSection, $request->txtSerachClass]);
            }
            if (($request->txtSerachSection) && ($request->txtSerachSection == 'all-section')) {
                $getResult = \DB::select("SELECT s.id, s.name, s.email, s.phone, s.notify, c.class_name, c.section_name from tbl_students s left join tbl_classes c on c.id = s.class_id where c.class_name=?", [$request->txtSerachClass]);
            }
        } else
            $getResult = \DB::select("SELECT s.id, s.name, s.email, s.phone, s.notify, c.class_name, c.section_name from tbl_students s left join tbl_classes c on c.id = s.class_id");

        return view('admin.numbers.filter-student', compact('getResult'));
    }

    public function sampleStudentsDownload(Request $request)
    {
        $path = public_path('student-excels/sample') . '/Sample-Students-format.csv';

        return response()->download($path);
    }


    /*Import no of students in a class*/
    public function importClassStudentNumber(Request $request)
    {
        $from = CustomHelper::getFromMail();
        set_time_limit(0);
        $student_class = StudentClass::all();
        $error = "";
        $rows = "";
        if (Request()->post()) {

            $request->validate([
                'file' => 'required',
            ]);
            try {

                $extensions = array("csv", "xlsx");
                $file_validate = strtolower($request->file('file')->getClientOriginalExtension());

                if (!in_array($file_validate, $extensions)) {
                    return back()->with('error', sprintf(Config::get('constants.WebMessageCode.103'), implode(",", $extensions)));
                }

                $file = $request->file('file');
                $destinationPath = public_path('student-excels');
                
                $filename = $file->getClientOriginalName();

                if (file_exists($destinationPath . '/' . $filename))
                    unlink($destinationPath . '/' . $filename);

                $file->move($destinationPath, $filename);
                
                $path = $destinationPath . '/' . $filename;

                $headerMissing = array();
                $supplierAdded = 0;
                $i = 1;
                $collection = (new FastExcel)->import($path);

                if ( !isset($collection[0]) ) {
                    if ( file_exists($path) )
                        @unlink($path);
                    return back()->with('error', Config::get('constants.WebMessageCode.104'));
                }
                $numbers = array();
                
                Log::info('Filename processing - ' . $filename);
                foreach ($collection as $key => $reader) {
                    // $reader['name'] = trim($reader['name']);
                    if ( !isset($reader["class"]) || !isset($reader["name"]) || !isset($reader["phone"]) || !isset($reader["email"]) || !isset($reader["section"]) ) {
                        $error = "Header mismatch";
                        Log::error('Header mismatch!!');
                    } elseif ($reader["name"] == "" || $reader["class"] == "" || $reader["section"] == "" || $reader["email"] == "" || $reader["phone"] == "") {
                        Log::error('Student details missing : ROW - ' . $i);
                        $error = "true";
                        $rows .= $i . ",";
                    } elseif ($reader["phone"] == "" && $reader["email"] == "" && $reader["notify"] == "yes") {
                        Log::error('Student details missing for notification : ROW - ' . $i);
                        $rows .= $i . ",";
                        $error = "true";
                    } else if (!preg_match("/^[a-zA-Z\s]*$/", $reader['name'])) {
                        Log::error('Student name must contain only charachters : ROW - ' . $i);
                        $error = 'found';
                        $rows .= $i . ",";
                    } else if (!preg_match("/^[0-9]{10}$/", $reader['phone'])) {
                        Log::error('Phone number must have 10 digits : ROW - ' . $i);
                        $error = 'found';
                        $rows .= $i . ",";
                    } else if (!CustomHelper::is_email($reader['email'])) {
                        Log::error('Invalid Email : ROW - ' . $i);
                        $error = 'found';
                        $rows .= $i . ",";
                    } else if (CustomHelper::getDomainFromEmail($reader['email']) != 'gmail.com') {
                        Log::error('Email with invalid domain : ROW - ' . $i);
                        $errorString = 'Email with invalid domain : ROW - ' . $i;
                        $error = 'found';
                        $rows .= $i . ",";
                    } else {
                        
                        $studentClassExist = \DB::select('select id from tbl_classes where class_name="' . $reader["class"] . '" and section_name="' . $reader["section"] . '"');

                        $obj_class = StudentClass::where('class_name', $reader["class"])->where('section_name', $reader["section"])->get();

                        if (count($obj_class) > 0) {
                            $class_id = $studentClassExist[0]->id;

                            $studenExist = \DB::select('select * from tbl_students where email="' . $reader["email"] . '" and phone="' . $reader["phone"] . '" and name="' . $reader["name"] . '" and class_id="' . $class_id . '"');
                            $emailAndPhoneCheck = Student::where('email', $reader["email"])->orWhere('phone', $reader["phone"])->count();
                            if ($emailAndPhoneCheck) {
                                Log::error('Either mobile number or Email already registered : ROW - ' . $i);
                                $rows .= $i . ",";
                                $error = "true";
                            } else if (count($studenExist) > 0) {
                                Log::error('Duplicate entry : ROW - ' . $i);
                                $rows .= $i . ",";
                                $error = "true";
                            } else {
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
                if ( file_exists($path) )
                        @unlink($path);
                if ( $error == "" )
                {
                    $event = EventManager::createEvent([
                        'event_name'=>'Student csv upload',
                        'job_id'=>Utility::getNextJobId(),
                        'payload'=>$collection,
                    ]);
                    dispatch(new CreateStudentJob($collection, encrypt(Session::get('access_token'))));
                    return back()->with('success', 'Student details uploaded successfully!!');
                }else
                    return back()->with('error', 'Student details processed, check logs, error in rows - ' . $rows);
            } catch ( \Exception $e ) {
                if ( file_exists($path) )
                        @unlink($path);
                if ( $error == "Header mismatch" ) {
                    return back()->with('error', 'CSV file Header/(1st line) mismatch!!, check the file format!!');
                } else {
                    Log::error($e);
                    return back()->with('error', Config::get('constants.WebMessageCode.136'));
                }
            }
            if (file_exists($path))
                @unlink($path);
        }

        return view('admin.numbers.import', compact('student_class'));
    }

    public function deleteAllStudent(Request $request)
    {
        $students = Student::with('class')->whereIn('id', explode(",", $request->ids))->get();

        foreach ($students as $student) {
            $response = StudentUtility::removeStudentFromClassroom($student);
            if(!$response['success'])
                return response()->json(['error' => $response['data']]);
            $student->delete();
        }
        return response()->json(['success' => "Deleted successfully."]);
    }
}
