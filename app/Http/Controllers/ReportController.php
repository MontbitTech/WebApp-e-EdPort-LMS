<?php

namespace App\Http\Controllers;

use App\ClassWork;
use App\DateClass;
use App\HelpTicketCategory;
use App\InvitationClass;
use App\libraries\Utility\ClassWorkUtility;
use App\Models\Attendance;
use App\Models\Student;
use App\StudentClass;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

/**
 * Class ReportController
 * @package App\Http\Controllers
 */
class ReportController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function teacherReport (Request $request)
    {
        $logged_teacher = Session::get('teacher_session');

        $helpCategories = HelpTicketCategory::get();
//        $teacherId = Session::get('teacher_session');
//        $classrooms = StudentClass::with('dateClass', 'dateClass.attendance')
//            ->whereHas('dateClass', function ($q) use ($teacherId) {
//                $q->where('teacher_id', $teacherId);
//            })->get()->toArray();

//        foreach ( $classrooms as $classroom ) {
//            $students[ $classroom['id'] ] = Student::with('class')
//                ->whereHas('class', function ($q) use ($classroom) {
//                    $q->where('class_name', $classroom['class_name']);
//                    $q->where('section_name', $classroom['section_name']);
//                })->get();
//        }
        $inviteClassData = InvitationClass::with('studentClass', 'studentSubject')
            ->where('teacher_id', $logged_teacher['teacher_id'])
            ->orderBy('id', 'DESC')
            ->get();

        return view('teacher.report.index', compact('helpCategories', 'inviteClassData'));
    }

    public function studentAttendanceAverage (Request $request)
    {
        $teacherId = Session::get('teacher_session');
        $classrooms = StudentClass::with('dateClass')->whereHas('dateClass', function ($q) use ($teacherId) {
            $q->where('teacher_id', $teacherId);
        })->get();
        $averageOfClasses = array();
        foreach ($classrooms as $class ) {
            // $total = array();
            $present = array();
            foreach ($class->dateClass as $date ) {
                $totalAttendance = Attendance::where('dateclass_id', $date->id)->count();
                $presentStudent = Attendance::present()->where('dateclass_id', $date->id)->count();
                // $total[] =$totalAttendance;
                $present[] = $presentStudent;
            }
            if($totalAttendance!=0){
                $averageOfClasses[$class->id]=(array_sum($present))/($totalAttendance);
            }
            else{
                $averageOfClasses[$class->id]=0;
            }
        }
        return $averageOfClasses;
    }

    public function assignmentSubmissionGrades (Request $request)
    {
        $loggedTeacher = Session::get('teacher_session');

        $totalClassesOfClassrooms = StudentClass::with('dateClass')
            ->whereHas('dateClass', function ($q) use ($loggedTeacher) {
                $q->where('teacher_id', $loggedTeacher['teacher_id']);
            })->get()->pluck('dateClass.*','id');

        $cancelledClassesOfClassrooms = StudentClass::with(['dateClass' => function ($q) {
            $q->where('cancelled', 1);
        }])
            ->whereHas('dateClass', function ($q) use ($loggedTeacher) {
                $q->where('teacher_id', $loggedTeacher['teacher_id']);
            })->get()->pluck('dateClass.*','id');

        $classWorks = ClassWork::with('studentClass', 'studentClass.dateClass')
            ->whereHas('studentClass.dateClass', function ($q) use ($loggedTeacher) {
                $q->where('teacher_id', $loggedTeacher['teacher_id']);
            })
            ->get();

        $gradeAverage = ClassWorkUtility::calculateGrade($classWorks);
        $inviteClassData = InvitationClass::with('studentClass', 'studentSubject')
            ->where('teacher_id', $loggedTeacher['teacher_id'])
            ->orderBy('id', 'DESC')
            ->get();
        $helpCategories = HelpTicketCategory::get();

        return view('teacher.report.report', compact('helpCategories', 'inviteClassData', 'gradeAverage', 'totalClassesOfClassrooms', 'cancelledClassesOfClassrooms'));
    }
}
