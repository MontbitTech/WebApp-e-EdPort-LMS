<?php

namespace App\Http\Controllers;

use App\Http\Helpers\CustomHelper;
use App\Http\Requests\FileRequestValidation;
use App\libraries\Classroom;
use App\libraries\Utility\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

//use Auth;
use Illuminate\Support\Facades\Log;
use Validator;
use App\Http\Helpers\CommonHelper;
use App\StudentClass;
use App\StudentSubject;
use App\Teacher;
use DB;
use App\ClassTiming;
use App\InvitationClass;
use App\DateClass;
use App\ClassWork;
use App\Models\ClassSection;

class ClassController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        //  return Auth::guard('admin');
    }

    /**
     * Show the application dashboard.|min:8
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list_class()
    {
        $studentClasses = StudentClass::get();
        $classes        = ClassSection::orderByRaw("CAST(class_name as UNSIGNED) ASC")->get();
        $section        = ClassSection::orderBy('section_name', 'ASC')->get();

        return view('admin.class.list_class', compact('classes', 'section', 'studentClasses'));
    }


    public function filterSubject(Request $request, StudentClass $StudentClass)
    {
        $rec = $StudentClass->newQuery();

        if (!empty($request->txtSerachByClass == 'all-class')) {
            $getResult = $rec->get();
            if ($request->txtSerachBySection && $request->txtSerachBySection != 'all-section') {
                $getResult = $rec->where('section_name', $request->txtSerachBySection)->get();
            }
        } else if ($request->txtSerachByClass && $request->txtSerachBySection == 'all-section') {
            $getResult = $rec->where('class_name', $request->txtSerachByClass)->get();
        } else if (!empty($request->txtSerachByClass) && ($request->txtSerachByClass != 'all-class')) {
            $getResult = $rec->where('class_name', $request->txtSerachByClass)->get();
            if (!empty($request->txtSerachBySection && $request->txtSerachBySection != 'all-section')) {
                $getResult = $rec->where('section_name', $request->txtSerachBySection)->get();
            }
            if (!empty($request->txtSerachBySection && $request->txtSerachBySection == 'all-section')) {
                $getResult = $rec->where('class_name', $request->txtSerachBySection)->get();
            }
        }

        return view('admin.class.filter-subject', compact('getResult'));
    }

    public function addClasses(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'class_name' => 'required|max:100',
                'subject'    => 'required|array|min:1',
                'section'    => 'required|max:100',
            ]);

            $subjects = StudentSubject::whereIn('id', $request->subject)->get();

            $classExist = StudentClass::with('studentSubject')->where('class_name', $request->class_name)->where('section_name', $request->section)->whereIn('subject_id', $request->subject)->get();

            if (count($classExist)) {
                $errorMsg = 'Classes with ';
                foreach ($classExist as $class) {
                    $errorMsg .= $class->studentSubject->subject_name . ' ';
                }

                return redirect()->route('classes.add')->with('error', $errorMsg . "subjects Already Exists !.");
            }

            $successMessage = 'Classes with ';
            foreach ($subjects as $subject) {

                $data = array(
                    "name"               => $request->class_name . ' ' . $subject->subject_name,
                    "section"            => $request->section,
                    "descriptionHeading" => "",
                    "description"        => "",
                    "room"               => "",
                    "ownerId"            => "me",
                    "courseState"        => "ACTIVE",

                );
                $data = json_encode($data);

                $token = CommonHelper::varify_Admintoken(); // verify admin token

                $response = CommonHelper::create_class($token, $data); // access Google api craete Cource

                if (!$response['success']) {
                    if ($response['data']->status == 'UNAUTHENTICATED') {
                        Log::error($response['data']->message);
                        CustomHelper::get_refresh_token();
                        $token = CommonHelper::varify_Admintoken(); // verify admin token

                        $response = CommonHelper::create_class($token, $data); // access Google api craete Cource
                        //                        return redirect()->route('admin.logout');
                    }
                }

                if (!$response['success']) {
                    if ($response['data']->status == 'UNAUTHENTICATED') {
                        Log::error($response['data']->message);

                        return redirect()->route('admin.logout');
                    }

                    return back()->with('error', $response['data']->message);
                } else {
                    $g_class_id = $response['data']->id;
                    $obj = new StudentClass;
                    $obj->class_name = $request->class_name;
                    $obj->section_name = $request->section;
                    $obj->subject_id = $subject->id;

                    $obj->g_class_id = $g_class_id;
                    $obj->g_link = $response['data']->alternateLink;
                    $obj->g_response = serialize($response['data']);
                    $obj->save();

                    $successMessage .= $subject->subject_name . ' ';
                }
            }

            return redirect()->route('admin.listClass')->with('success', $successMessage . 'added successfully');
        }

        $data['subject'] = StudentSubject::orderBy('subject_name', 'ASC')->pluck('subject_name', 'id');
        //$data['subject']->prepend('Select Subject', '');
        $data['section'] = DB::table('tbl_classes')->select('section_name')->distinct()->get()->pluck('section_name', 'section_name');
        $data['class'] = DB::table('tbl_classes')->select('class_name')->distinct()->get()->pluck('class_name', 'class_name');
        $data['class']->prepend('Select Division', '');
        $data['section']->prepend('Select Section', '');

        return view('admin.class.add', compact('data', $data));
    }

    public function deleteClasses(Request $request)
    {
        if (strtolower($request->delete) != 'delete')
            return redirect()->back()->with('error', "Type delete to confirm");

        if ($request->txt_class_id == '')
            return redirect()->route('admin.listClass');

        $classTimingExist = ClassTiming::where('class_id', $request->txt_class_id)->first();
        if ($classTimingExist)
            return redirect()->route('admin.listClass')->with('error', "you cannot delete this class! it's associated with Teacher,Assignent....");

        $dateClassExist = DateClass::where('class_id', $request->txt_class_id)->first();
        if ($dateClassExist)
            return redirect()->route('admin.listClass')->with('error', "you cannot delete this class! it's associated with Teacher,Assignent....");

        $classWorkExits = ClassWork::where('class_id', $request->txt_class_id)->first();
        if ($classWorkExits)
            return redirect()->route('admin.listClass')->with('error', "you cannot delete this class! it's associated with Assignent....");

        $classes = StudentClass::find($request->txt_class_id);

        $token = CommonHelper::varify_Admintoken(); // verify admin token

        $response = CommonHelper::delete_class($token, $classes->g_class_id); // access Google api delete Cource
        if (!$response['success']) {
            if ($response['data']->status == 'UNAUTHENTICATED')
                return redirect()->route('admin.logout');

            return back()->with('error', $response['message']->message);
        } else {
            $classes->delete();

            return redirect()->route('admin.listClass')->with('success', "Class Deleted Successfully.");
        }
    }

    public function sampleClassroomImportFile (Request $request)
    {
        $path = public_path('classroom') . '/sample/sample-classroom-format.csv';

        return response()->download($path);
    }

    public function importClassroom (FileRequestValidation $request)
    {
        set_time_limit(0);
        $rows = ' ';
        $error = false;
        $fileExtension = strtolower($request->file('file')->getClientOriginalExtension());

        if ( !in_array($fileExtension, array('csv', 'xlsx')) ) {
            return back()->with('error', sprintf(Config::get('constants.WebMessageCode.103'), implode(",", array('csv', 'xlsx'))));
        }

        $collection = FileUpload::uploadFile(public_path('classroom'), $request->file('file'));
        if ( !$collection['success'] )
            return back()->with('error', $collection['message']);

        $rowCount = 1;
        foreach ( $collection['data'] as $row ) {
            if ( !isset($row['division']) || !isset($row['section']) || !isset($row['subjects']) )
                return back()->with('error', 'Header Mismatch at row: ' . $rowCount);

            $subjects = explode('|', $row['subjects']);

            foreach ( $subjects as $subject ) {
                $response = Classroom::checkClassroomAndCreate($row, $subject);

                if ( !$response['success'] ) {
                    if($response['data'] == 'UNAUTHENTICATED')
                        return redirect()->route('admin.logout');
                    Log::error($response['data']);
                    $error = true;
                    $rows = $rowCount . ' ';
                }
            }
        }

        unlink(public_path('classroom').'/'.$request->file('file')->getClientOriginalName());
        if ( $error )
            return back()->with('error', 'Teacher details processed, Please check logs for detailed error, errors in rows - ' . $rows);

        return back()->with('success', 'Classroom details processed successfully.');
    }
}
