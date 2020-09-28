<?php

namespace App\Http\Controllers\Examination;

use App\HelpTicketCategory;
use App\Http\Controllers\Controller;
use App\Models\Examination\ClassroomExaminationMapping;
use App\Models\Examination\Examination;
use App\Models\Examination\ExaminationQuestionMapping;
use App\Models\Examination\Question;
use App\Models\Student;
use App\StudentClass;
use App\StudentSubject;
use App\SupportVideo;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    public function show (Request $request, $id)
    {
        $loggedTeacher = Session::get('teacher_session');

        $examination = Examination::where('created_by', $loggedTeacher['teacher_id'])->find($id);

        return $examination ? $examination : 'No record found';
    }

    public function store (Request $request)
    {
        $loggedTeacher = Session::get('teacher_session');

        $examination = new Examination();
        $examination->title = $request->title;
        $examination->created_by = $loggedTeacher['teacher_id'];
        $examination->save();

        return Response::json(['success' => true, 'response' => $examination]);
    }

    public function destroy (Request $request, $id)
    {
        $loggedTeacher = Session::get('teacher_session');
        $examination = Examination::where('created_by', $loggedTeacher['teacher_id'])->find($id);

        if ( $examination )
            $examination->delete();
    }

    public function createExamination (Request $request)
    {
        $helpCategories = HelpTicketCategory::get();
        $videos = SupportVideo::all();

        $classroomExaminationMapping = ClassroomExaminationMapping::with('examination', 'classroom')->get();

        $questionClasses = Question::groupBy('class')->pluck('class');
        $classes = StudentClass::groupBy('class_name')->pluck('class_name');
        $subjects = StudentSubject::get();
        $classrooms = StudentClass::with('studentSubject')->get();

        return view('teacher.examination.index', compact('videos', 'helpCategories', 'classroomExaminationMapping', 'questionClasses', 'classes', 'subjects', 'classrooms'));
    }


    public function takeExamination (Request $request, $id)
    {
        return ClassroomExaminationMapping::with('examination', 'classroom')->find($id);
    }

    public function getQuestions (Request $request)
    {
        $classroomExaminationMapping = ClassroomExaminationMapping::with('examination', 'classroom')->find($request->classroom_examiation_mapping_id);

        $student = Student::whereHas('class', function ($q) use ($classroomExaminationMapping) {
            $q->where('class_name', $classroomExaminationMapping->classroom->class_name);
            $q->where('section_name', $classroomExaminationMapping->classroom->section_name);
        })->where('email', $request->email)->first();

        if ( !$student )
            return false;

        $questions = ExaminationQuestionMapping::with('questions')->where('examination_id', $classroomExaminationMapping->examination_id)
            ->where('classroom_id', $classroomExaminationMapping->classroom_id)->get();
    }

    public function setExamination (Request $request)
    {
        dd($request);
    }
}