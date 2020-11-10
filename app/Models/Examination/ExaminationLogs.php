<?php

namespace App\Models\Examination;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class ExaminationLogs extends Model
{
    protected $table = 'ex_examination_logs';

    public function classroom_examination_mapping ()
    {
        return $this->hasOne(ClassroomExaminationMapping::class);
    }

    public function student ()
    {
        return $this->hasOne(Student::class);
    }
}
