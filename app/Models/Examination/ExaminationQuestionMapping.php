<?php

namespace App\Models\Examination;

use Illuminate\Database\Eloquent\Model;

class ExaminationQuestionMapping extends Model
{
    protected $table = 'ex_examination_question_mappings';

    public function examination ()
    {
        return $this->hasOne(Examination::class);
    }

    public function question ()
    {
        return $this->hasOne(Question::class);
    }
}
