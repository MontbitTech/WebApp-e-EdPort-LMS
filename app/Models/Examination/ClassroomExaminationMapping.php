<?php

namespace App\Models\Examination;

use App\StudentClass;
use Illuminate\Database\Eloquent\Model;

class ClassroomExaminationMapping extends Model
{
    protected $table = 'ex_classroom_examination_mappings';

    public function examination ()
    {
        return $this->hasOne(Examination::class, 'id', 'examination_id');
    }

    public function classroom ()
    {
        return $this->hasOne(StudentClass::class, 'id', 'classroom_id');
    }

    public function logs ()
    {
        return $this->hasMany(ExaminationLogs::class);
    }
}
