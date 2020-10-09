<?php

namespace App\Models\Examination;

use Illuminate\Database\Eloquent\Model;

class ExaminationQuestionMapping extends Model
{
    protected $table = 'ex_examination_question_mappings';

    public function examinations ()
    {
        return $this->hasOne(Examination::class, 'id', 'examination_id');
    }

    public function question ()
    {
        return $this->hasOne(Question::class, 'id', 'question_id');
    }

    public function answers ()
    {
        return $this->hasMany(StudentAnswer::class);
    }
}
