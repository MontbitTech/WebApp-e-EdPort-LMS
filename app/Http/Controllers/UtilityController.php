<?php

namespace App\Http\Controllers;

use App\DateClass;
use App\Http\Helpers\CustomHelper;
use App\libraries\Utility\DateUtility;
use App\Models\ClassSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UtilityController extends Controller
{
    public function weekleyMailsToStudents(Request $request)
    {
        set_time_limit(0);
        $classes = ClassSection::with('students')->get();
        $from = CustomHelper::getFromMail();

        foreach($classes as $class){
            $weeksClasses = DateClass::with('studentClass','studentSubject','teacher')->whereHas('studentClass',function($q) use($class){
                $q->where('class_name', $class->class_name);
                $q->where('section_name', $class->section_name);
            })
            ->where('class_date','>=',DateUtility::getDate())
            ->where('class_date','<=',DateUtility::getFutureDate(7))
            ->get()->toArray();

            if(!count($class->students) || !count($weeksClasses))
                continue;

            foreach($class->students as $student){
                Mail::send('mail.weekleySchedule',  ['weeksClasses' => $weeksClasses], function ($message) use ($student, $from) {
                    $message->to($student->email);
                    $message->subject("This week's schdule");
                    $message->from($from->value, 'MontBIt');
                });
            }
        }

        return $classes;
    }
}
