<?php

namespace App\Http\Controllers;

use App\HelpTicketCategory;
use App\InvitationClass;
use App\libraries\Utility\ReportUtility;
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

        $inviteClassData = InvitationClass::with('studentClass', 'studentSubject')
            ->where('teacher_id', $logged_teacher['teacher_id'])
            ->orderBy('id', 'DESC')
            ->get();

        return view('teacher.report.index', compact('helpCategories', 'inviteClassData'));
    }

    public function studentAttendanceAverage (Request $request)
    {
        $loggedTeacher = Session::get('teacher_session');

        return ReportUtility::getAttedanceAverage($loggedTeacher['teacher_id']);
    }

    public function assignmentSubmissionGrades (Request $request)
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

        return view('teacher.report.report', compact('inviteClassData', 'gradeAverage', 'totalClassesOfClassrooms', 'cancelledClassesOfClassrooms','attendanceAverage'));
    }
}
