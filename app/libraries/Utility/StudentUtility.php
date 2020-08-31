<?php

namespace App\libraries\Utility;

use App\Http\Helpers\CommonHelper;
use App\Http\Helpers\CustomHelper;
use App\Models\Student;
use App\Models\StudentCourseInvitation;
use App\StudentClass;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class StudentUtility
 * @package App\libraries\Utility
 */
class StudentUtility
{
    public static function createStudent ($parameters)
    {
        $student = new Student();
        foreach ( $parameters as $key => $value ) {
            $student->$key = $value;
        }
        $student->save();

        return $student;
    }

    
    public static function createStudentInvitation($parameters){
        $studentInvitation = new StudentCourseInvitation();
        foreach ( $parameters as $key => $value ) {
            $studentInvitation->$key = $value;
        }
        $studentInvitation->save();

        return $studentInvitation;
    }

    public static function removeStudentFromClassroom ($student)
    {
        $token = CommonHelper::varify_Admintoken();
        $courseInvitations = StudentCourseInvitation::where('student_email',$student->email)->get();

        foreach ($courseInvitations as $courseInvitation){
            $response = CommonHelper::teacher_invitation_delete($token, $courseInvitation->invitation_code);
 
            $courseInvitation->delete();
        }

        $studentClasses = StudentClass::where('class_name', $student->class_name)->where('section_name', $student->section_name)->get();
        
        foreach ( $studentClasses as $studentClass ) {
            $inv_responce = CommonHelper::student_course_delete($token, $student->email, $studentClass->g_class_id);
        }

        return success_message('success');
    }

    public static function inviteStudentToClassroom($studentEmail, $token, $classrooms)
    {
        foreach ( $classrooms as $classroom ) {
            $inv_data = array(
                "courseId" => $classroom->g_class_id,
                "role"     => "STUDENT",
                "userId"   => $studentEmail,

            );

            $inv_responce = CommonHelper::teacher_invitation_forClass($token, json_encode($inv_data)); // Invite Student
            $inv_resData = array('error' => '');
            if ( $inv_responce == 101 ) {
                return failure_message(Config::get('constants.WebMessageCode.119'));
            } else {
                $inv_resData = array_merge($inv_resData, json_decode($inv_responce, true));
                if ( $inv_resData['error'] != '' ) {

                    if ( $inv_resData['error']['status'] == 'UNAUTHENTICATED' ) {
                        return failure_message('UNAUTHENTICATED');
                    } else {
                        Log::error($inv_resData['error']['message']);
                        return failure_message($inv_resData['error']['message'].' in :'. $classroom->studentSubject->subject_name);
                    }
                } else {
                    $inv_res_code = $inv_resData['id'];
                }
            }

            self::createStudentInvitation([
                'course_code'=>$classroom->g_class_id,
                'invitation_code'=> $inv_resData['id'],
                'student_email'=>$studentEmail
            ]);
        }

        return success_message(true);
    }

    public static function sendTimeTableToStudentEmail($class, $section, $student)
    {
        $from = CustomHelper::getFromMail();
        $timeTable_url = env('APP_URL') . "/timeTable/" . encrypt($class) . "/" . encrypt($section) . "";

        $data_mail = array('name' => $student->name, 'timetable_url' => $timeTable_url);
        $email = $student->email;

        Mail::send('mail.mail_timetable', $data_mail, function ($message) use ($email, $from) {
            $message->to($email);
            $message->subject('New Time Table');
            $message->from($from->value, 'MontBIt');
        });
    }

}