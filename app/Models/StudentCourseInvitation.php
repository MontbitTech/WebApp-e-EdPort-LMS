<?php

namespace App\Models;

use App\StudentClass;
use Illuminate\Database\Eloquent\Model;

class StudentCourseInvitation extends Model
{
    protected $table = 'student_course_invitation';

    public function student ()
    {
        $this->hasOne(Student::class, 'email', 'student_email');
    }

    public function studentClass ()
    {
        $this->hasOne(StudentClass::class, 'g_class_id', 'course_code');
    }
}
