<?php

namespace App\Http\Controllers;

use App\HelpTicketCategory;
use App\InvitationClass;
use App\libraries\Utility\ReportUtility;
use App\StudentClass;
use App\SupportVideo;
use App\Models\ClassSection;
use App\Models\Student;
use App\Models\Attendance;
use App\Teacher;
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
    public function teacherReport(Request $request)
    {
        $logged_teacher = Session::get('teacher_session');

        $helpCategories = HelpTicketCategory::get();

        $inviteClassData = InvitationClass::with('studentClass', 'studentSubject')
            ->where('teacher_id', $logged_teacher['teacher_id'])
            ->orderBy('id', 'DESC')
            ->get();
        $videos = SupportVideo::all();

        return view('teacher.report.index', compact('helpCategories', 'inviteClassData', 'videos'));
    }

    public function studentAttendanceAverage(Request $request)
    {
        $loggedTeacher = Session::get('teacher_session');

        return ReportUtility::getAttedanceAverage($loggedTeacher['teacher_id']);
    }

    public function assignmentSubmissionGrades(Request $request)
    {
        set_time_limit(0);
        $loggedTeacher = Session::get('teacher_session');

        $totalClassesOfClassrooms = StudentClass::with('dateClass')
            ->whereHas('dateClass', function ($q) use ($loggedTeacher) {
                $q->where('teacher_id', $loggedTeacher['teacher_id']);
            })->get()->pluck('dateClass.*', 'id');

        $cancelledClassesOfClassrooms = StudentClass::with(['dateClass' => function ($q) {
            $q->where('cancelled', 1);
        }])
            ->whereHas('dateClass', function ($q) use ($loggedTeacher) {
                $q->where('teacher_id', $loggedTeacher['teacher_id']);
            })->get()->pluck('dateClass.*', 'id');


        $inviteClassData = InvitationClass::with('studentClass', 'studentSubject')
            ->where('teacher_id', $loggedTeacher['teacher_id'])
            ->orderBy('id', 'DESC')
            ->get();

        $attendanceAverage = $this->studentAttendanceAverage($request);
        $gradeAverage = ReportUtility::getAssignmentSubmissionGrades($loggedTeacher['teacher_id']);

        return view('teacher.report.report', compact('inviteClassData', 'gradeAverage', 'totalClassesOfClassrooms', 'cancelledClassesOfClassrooms', 'attendanceAverage'));
    }

    public function reports()
    {
        $studentClassData = StudentClass::with('studentSubject','ClassTiming','dateClass')
        ->orderBy('id', 'DESC')
        ->distinct()
        ->get(['class_name','section_name']);

        return view('admin.reports.index', compact('studentClassData'));
    }

    public function filterReports(Request $request)
    {
        set_time_limit(0);
        $totalClassesOfClassrooms = StudentClass::with('dateClass')->get()->pluck('dateClass.*', 'id');

        $cancelledClassesOfClassrooms = StudentClass::with(['dateClass' => function ($q) {
            $q->where('cancelled', 1);
        }])->get()->pluck('dateClass.*', 'id');

        if($request->class && $request->section ){
            $studentClassData = StudentClass::with('studentSubject','dateClass','classtiming')
            ->where('class_name', $request->class)
            ->where('section_name', $request->section)
            ->orderBy('id', 'DESC')
            ->get();
        }
        else
        {
            $studentClassData = StudentClass::with('studentSubject','dateClass')
            ->orderBy('id', 'DESC')
            ->get();
        }
        $teacherData   = Teacher::get();
        $getAttendance = Attendance::with('student')->get();

        if($request->class && $request->section ){
            $getStudents = ClassSection::with('students')->where('class_name', $request->class)->where('section_name', $request->section)->get();
        }
        else
        {
            $getStudents = ClassSection::with('students')->get();
        }

        $attendanceAverage     = ReportUtility::getClassAttedanceAverage();
        $gradeAverage          = ReportUtility::getAssignmentSubmissionGradesAdmin();

        return view('admin.reports.filter-reports', compact('studentClassData', 'totalClassesOfClassrooms', 'cancelledClassesOfClassrooms', 'attendanceAverage','getStudents','gradeAverage','teacherData','getAttendance'));
    }
}
