<?php

namespace App\Models\Examination;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    protected $table = 'ex_student_answers';

    public function examQuestionMapping ()
    {
        return $this->hasOne(ExaminationQuestionMapping::class);
    }

    public function student ()
    {
        return $this->hasOne(Student::class);
    }
}
