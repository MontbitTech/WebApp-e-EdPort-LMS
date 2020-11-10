<?php

namespace App\Models\Examination;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    protected $table = 'ex_student_answers';

    protected $fillable = ['student_id', 'examination_question_mapping_id'];

    public function examQuestionMapping ()
    {
        return $this->hasOne(ExaminationQuestionMapping::class, 'id', 'examination_question_mapping_id');
    }

    public function student ()
    {
        return $this->hasOne(Student::class);
    }
}
