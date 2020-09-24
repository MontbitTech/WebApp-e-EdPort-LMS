<?php

namespace App\Models\Examination;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $table = 'ex_examinations';

    public function classroomExaminationMappings ()
    {
        return $this->hasMany(ClassroomExaminationMapping::class);
    }

    public function examinationQuestionMappings ()
    {
        return $this->hasMany(ExaminationQuestionMapping::class);
    }
}
