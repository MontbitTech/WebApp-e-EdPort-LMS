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
            CommonHelper::teacher_invitation_delete($token, $courseInvitation->invitation_code);
            $courseInvitation->delete();
        }

        $studentClasses = StudentClass::where('class_name', $student->class_name)->where('section_name', $student->section_name)->get();
        
        foreach ( $studentClasses as $studentClass ) {
            $invitationResponce = CommonHelper::student_course_delete($token, $student->email, $studentClass->g_class_id);
        }
    }

    public static function inviteStudentToClassroom($studentEmail, $token, $classrooms)
    {
        foreach ( $classrooms as $classroom ) {
            $invitationData = array(
                "courseId" => $classroom->g_class_id,
                "role"     => "STUDENT",
                "userId"   => $studentEmail,

            );

            $response = self::createStudentInGoogleClassroom($token, json_encode($invitationData)); // Invite Student
        
            if(!$response['success'])
                return failure_message($response['data']->message.' in :'. $classroom->studentSubject->subject_name);
            
            self::createStudentInvitation([
                'course_code'=>$classroom->g_class_id,
                'invitation_code'=> $response['data']->id,
                'student_email'=>$studentEmail
            ]);
        }

        return success_message(true);
    }

    public static function sendTimeTableToStudentEmail($class, $section, $student)
    {
        $from = CustomHelper::getFromMail();
        $timeTableUrl = env('APP_URL') . "/timeTable/" . encrypt($class) . "/" . encrypt($section) . "";

        $data_mail = array('name' => $student->name, 'timetable_url' => $timeTableUrl);
        $email = $student->email;

        Mail::send('mail.mail_timetable', $data_mail, function ($message) use ($email, $from) {
            $message->to($email);
            $message->subject('New Time Table');
            $message->from($from->value, 'MontBIt');
        });
    }

    public static function createStudentInGoogleClassroom($token, $data)
    {
        $url = "https://classroom.googleapis.com/v1/invitations";
        $headers = array(
            "Authorization: Bearer ".$token['access_token'],
            "Content-Type: application/json",
        );

        $response = RemoteRequest::postJsonRequest($url, $headers, $data);

        if (!$response['success'] && isset($response['data']->status)) {
            if ($response['data']->status == 'UNAUTHENTICATED') {
                $token = CustomHelper::get_refresh_token($token);
                Log::info($response['data']->status);
                $response = self::createStudentInGoogleClassroom($token, $data); // access Google api craete Cource
            }
        }
        return $response;
    }
}