<?php

namespace App\Http\Controllers\Examination;

use App\HelpTicketCategory;
use App\Http\Controllers\Controller;
use App\libraries\Utility\ExaminationUtility;
use App\libraries\Utility\TeacherUtility;
use App\Models\Examination\ClassroomExaminationMapping;
use App\Models\Examination\Examination;
use App\Models\Examination\ExaminationLogs;
use App\Models\Examination\ExaminationQuestionMapping;
use App\Models\Examination\Question;
use App\Models\Examination\StudentAnswer;
use App\Models\Student;
use App\StudentClass;
use App\StudentSubject;
use App\SupportVideo;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ExamValidation;
use App\libraries\Utility\DateUtility;


/**
 * Class ExaminationController
 * @package App\Http\Controllers\Examination
 */
class ExaminationController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index (Request $request)
    {
        $loggedTeacher = Session::get('teacher_session');

        return Examination::where('created_by', $loggedTeacher['teacher_id'])->get();
    }

    /**
     * @param Request $request
     * @param $id
     * @return string
     */
    public function show (Request $request, $id)
    {
        $loggedTeacher = Session::get('teacher_session');

        $examination = Examination::where('created_by', $loggedTeacher['teacher_id'])->find($id);

        return $examination ? $examination : 'No record found';
    }

    /**
     * @param ExamValidation $request
     * @return Examination
     */
    public function store (ExamValidation $request)
    {
        $loggedTeacher = Session::get('teacher_session');

        $examination = new Examination();
        $examination->title = $request->title;
        $examination->created_by = $loggedTeacher['teacher_id'];
        $examination->save();

        return $examination;
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function destroy (Request $request, $id)
    {
        $loggedTeacher = Session::get('teacher_session');
        $examination = Examination::where('created_by', $loggedTeacher['teacher_id'])->find($id);

        if ( $examination )
            $examination->delete();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createExamination (Request $request)
    {
        $helpCategories  = HelpTicketCategory::get();
        $videos          = SupportVideo::all();
        $classes         = StudentClass::groupBy('class_name')->pluck('class_name');
        $subjects        = StudentSubject::get();
        $classrooms      = StudentClass::with('studentSubject')->get();
        $examinationShow = ClassroomExaminationMapping::all();
        $classrooms_data = "";
        $questionData    = "";
        $examDetail      = "";

        return view('teacher.examination.index', compact('videos', 'helpCategories', 'examinationShow', 'classes', 'subjects', 'classrooms', 'classrooms_data', 'questionData', 'examDetail'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function takeExamination (Request $request, $id)
    {
        $classroomExamination = ClassroomExaminationMapping::with('examination', 'classroom', 'logs')->find($id);

        if ( !$classroomExamination )
            return Response::json(['success' => false, 'response' => 'Invalid Exam']);

        if ( $classroomExamination->start_time > DateUtility::getDateTime() )
            return Response::json(['success' => false, 'response' => 'Please wait till the start time of the exam']);

        return view('examination.exam', compact('classroomExamination'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function validateStudent (Request $request)
    {
        $examinationData['classroomExaminationMapping'] = ClassroomExaminationMapping::with('examination', 'classroom')->find($request->classroom_examination_mapping_id);

        if ( $examinationData['classroomExaminationMapping']->start_time > DateUtility::getDateTime() )
            return Response::json(['success' => false, 'response' => 'Please wait till the start time of the exam']);

        $examinationData['student'] = Student::whereHas('class', function ($q) use ($examinationData) {
            $q->where('class_name', $examinationData['classroomExaminationMapping']->classroom->class_name);
            $q->where('section_name', $examinationData['classroomExaminationMapping']->classroom->section_name);
        })->where('email', $request->email)->first();

        if ( !$examinationData['student'] )
            return Response::json(['success' => false, 'response' => 'Invalid Student']);

        $examinationData['logs'] = ExaminationLogs::where('student_id', $examinationData['student']->id)->get();
        $examinationData['previousResponse'] = StudentAnswer::with('examQuestionMapping.question')->whereHas('examQuestionMapping', function ($q) use ($examinationData) {
            $q->where('examination_id', $examinationData['classroomExaminationMapping']->examination_id);
            $q->where('classroom_id', $examinationData['classroomExaminationMapping']->classroom_id);
        })->where('student_id', $examinationData['student']->id)->get();

        $examinationData['questions'] = Question::with('examinationQuestionMappings')->whereHas('examinationQuestionMappings', function ($q) use ($examinationData) {
            $q->where('examination_id', $examinationData['classroomExaminationMapping']->examination_id);
            $q->where('classroom_id', $examinationData['classroomExaminationMapping']->classroom_id);
        })->get(['id', 'question', 'options', 'type_of_question', 'topic']);


        return Response::json(['success' => true, 'response' => $examinationData]);
    }

    /**
     * @param ExamValidation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setExamination (ExamValidation $request)
    {
        $examination = $this->store($request);
        $minutesToAdd = $request->duration + number_format(( 16 / 100 ) * $request->duration, 0);
        $endTime = DateUtility::getFutureDateTime($minutesToAdd, $request->start_time);

        $classroomExaminationMapping = ExaminationUtility::createClassroomExaminationMapping([
            'examination_id'         => $examination->id,
            'classroom_id'           => $request->classroom_id,
            'duration'               => date('H:i', mktime(0, $request->duration)),
            'start_time'             => $request->start_time,
            'end_time'               => $endTime,
            'examination_properties' => json_encode($request->properties),
        ]);

        $examinationQuestionMappings = array();
        foreach ( $request->questions as $questionId ) {
            $examinationQuestionMappings[] = [
                'examination_id' => $examination->id,
                'classroom_id'   => $request->classroom_id,
                'question_id'    => $questionId,
                'marks'          => $request->marks[ $questionId ],
            ];
        }

        ExaminationQuestionMapping::insert($examinationQuestionMappings);

        TeacherUtility::createAnnouncementInClassroom(
            env('APP_URL') . '/student/exam?examID=' . $classroomExaminationMapping->id . '  is the url to take your exam',
            StudentClass::find($request->classroom_id)->g_class_id
        );

        return redirect()->route('examination')->with('success', 'Added successfully');
    }

    public function getExamination (Request $request)
    {
        $assignments = ExaminationQuestionMapping::with('examinations', 'question')->where('examination_id', $request->examination_id)
            ->where('classroom_id', $request->classroom_id)->get();


        return json_encode(array('status' => 'success', 'data' => $assignments, 'total_marks' => $assignments->sum('marks')));
    }

    public function getExaminationList (Request $request)
    {
        $examinationList = ClassroomExaminationMapping::with('examination', 'classroom', 'classroom.studentSubject')
            ->where('classroom_id', $request->classroom_id)
            ->get();

        return json_encode(array('status' => 'success', 'data' => $examinationList));
    }

    public function assignExamination (Request $request)
    {
        
        $helpCategories   = HelpTicketCategory::get();
        $videos           = SupportVideo::all();
        $classes          = StudentClass::groupBy('class_name')->pluck('class_name');
        $subjects         = StudentSubject::get();
        $classrooms       = StudentClass::with('studentSubject')->get();
        $examinationShow  = ClassroomExaminationMapping::all();
        $questionData     = ExaminationQuestionMapping::with('examinations', 'question')
                            ->where('examination_id', $request->examination_id)
                            ->where('classroom_id', $request->classroom_id)->first();
        $examDetail       = ClassroomExaminationMapping::where('classroom_id', $request->classroom_id)->first();
        $classrooms_data  = StudentClass::with('studentSubject')
                            ->where('id', $request->classroom_id)->first();

        return view('teacher.examination.index', compact('examDetail', 'videos', 'classrooms_data', 'helpCategories', 'examinationShow', 'classes', 'subjects', 'classrooms', 'questionData'));
    }

    public function examDelete (Request $request, $id)
    {
        if ( $request->delete == 'delete' ) {
            $examClassroom = ClassroomExaminationMapping::where('id', $id)
                ->firstorFail();
            $examquestion = ExaminationQuestionMapping::where('examination_id', $examClassroom->examination_id)
                ->where('classroom_id', $examClassroom->classroom_id)
                ->firstorFail();
            $examClassroom->delete();
            $examClassroom->delete();

            return back()->with('success', "delete");
        } else {
            return back()->with('error', "Type delete to confirm");
        }
    }
}
