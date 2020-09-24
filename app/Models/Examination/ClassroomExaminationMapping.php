<?php

namespace App\Models\Examination;

use App\StudentClass;
use Illuminate\Database\Eloquent\Model;

class ClassroomExaminationMapping extends Model
{
    protected $table = 'ex_classroom_examination_mappings';

    public function examination ()
    {
        return $this->hasOne(Examination::class);
    }

    public function classroom ()
    {
        return $this->hasOne(StudentClass::class);
    }
}
