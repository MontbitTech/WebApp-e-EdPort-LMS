<?php

namespace App\Jobs;

use App\Http\Helpers\CommonHelper;
use App\StudentClass;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteStudents implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $students;
    /**
     * Create a new job instance.
     * @param $students | array
     *
     * @return void
     */
    public function __construct($students)
    {
        $this->students = $students;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $token = CommonHelper::varify_Admintoken();
        foreach ( $this->students as $student ) {
            $invitationResponse = CommonHelper::teacher_invitation_delete($token, $student->invitation_code);

            $studentClasses = StudentClass::where('class_name', $student->class_name)->where('section_name', $student->section_name)->get();

            foreach ( $studentClasses as $studentClass ) {
                $inv_responce = CommonHelper::student_course_delete($token, $student->email, $studentClass->g_class_id);
            }

            $student->delete();
        }
    }
}
