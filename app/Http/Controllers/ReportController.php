<?php

namespace App\Http\Controllers;

use App\HelpTicketCategory;
use App\InvitationClass;
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
    public function teacherReport(Request $request)
    {
        $logged_teacher = Session::get('teacher_session');

        $helpCategories = HelpTicketCategory::get();
        $teacherId = Session::get('teacher_session');
        $classrooms = StudentClass::with('dateClass', 'dateClass.attendance')
            ->whereHas('dateClass', function ($q) use ($teacherId) {
                $q->where('teacher_id', $teacherId);
            })->get()->toArray();

        foreach ($classrooms as $classroom) {
            $students[$classroom['id']] = Student::with('class')
                ->whereHas('class', function ($q) use ($classroom) {
                    $q->where('class_name', $classroom['class_name']);
                    $q->where('section_name', $classroom['section_name']);
                })->get();
        }
        $inviteClassData = InvitationClass::with('studentClass', 'studentSubject')
            ->where('teacher_id', $logged_teacher['teacher_id'])
            ->orderBy('id', 'DESC')
            ->get();

        return view('teacher.report.index', compact('helpCategories', 'inviteClassData'));
    }

    public function studentAttendanceAverage(Request $request)
    {
        $totalAttenndance = Attendance::where('student_id', $request->studentId)->count();
        $present = Attendance::present()->where('student_id', $request->studentId)->count();
    }

    public function assignmentSubmissionGrades(Request $request)
    {
        $teacherId = Session::get('teacher_session');
        $classrooms = StudentClass::with('dateClass', 'classwork')->whereHas('dateClass', function ($q) use ($teacherId) {
            $q->where('teacher_id', $teacherId);
        })->get();

        dd($classrooms);
    }
}
