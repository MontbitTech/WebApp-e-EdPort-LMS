<?php

namespace App\libraries;

use App\ClassTiming;
use App\StudentClass;
use App\StudentSubject;
use App\Teacher;

/**
 * Class Availability
 * @param $timings | array
 * @param $day | string
 * @package App\libraries
 */
class Availability
{
    /**
     * @param  $timings | array
     * @param $day | string
     * @return object
     */
    public static function getAvailableTeacher ($timings, $day)
    {
        return Teacher::whereDoesntHave('class_timing', function ($q) use ($timings, $day) {
            $q->where('from_timing', '<=', $timings[1]);
            $q->where('to_timing', '>=', $timings[0]);
            $q->where('class_day', '=', $day);
        })->get();
    }

    /**
     * @param  $timeTableId | int
     * @return object
     */
    public static function getAvailableSubject ($timeTableId)
    {
        $studentClass = StudentClass::whereHas('classtiming', function ($q) use ($timeTableId) {
            $q->where('id', $timeTableId);
        })->
        first();

        $className = $studentClass->class_name;
        $sectionName = $studentClass->section_name;
        $subject = $studentClass->subject_id;

        return StudentSubject::whereHas('studentClass', function ($q) use ($className, $sectionName, $subject) {
            $q->where('class_name', $className);
            $q->where('section_name', $sectionName);
            $q->where('subject_id', '!=', $subject);
        })->get();
    }

    /**
     * @param  $day | string
     * @param $startTime | time
     * @param $endTime | time
     * @return object
     */
    public static function getAvailableClasses ($day, $startTime, $endTime)
    {
        $occupiedClassTiminngs = ClassTiming::with('StudentClass')
            ->where('from_timing', '<=', $endTime)
            ->where('to_timing', '>=', $startTime)
            ->where('class_day', '=', $day)
            ->get()->pluck('class_id');

        return StudentClass::with('studentSubject')->whereNotIn('id', $occupiedClassTiminngs)->get();

    }
}