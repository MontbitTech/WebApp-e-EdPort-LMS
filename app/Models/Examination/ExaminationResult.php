<?php

namespace App\Models\Examination;

use App\Models\Student;
use App\StudentClass;
use Illuminate\Database\Eloquent\Model;

class ExaminationResult extends Model
{
    protected $table = 'ex_examination_results';

    public function examination ()
    {
        return $this->hasOne(Examination::class, 'id', 'examination_id');
    }

    public function student ()
    {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function classroom()
    {
        return $this->hasOne(StudentClass::class, 'id', 'classroom_id');
    }
}
