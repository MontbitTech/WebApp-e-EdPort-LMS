<?php

namespace App\Models\Examination;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class ExaminationLogs extends Model
{
    protected $table = 'ex_examination_logs';

    public function examination ()
    {
        return $this->hasOne(Examination::class);
    }

    public function student ()
    {
        return $this->hasOne(Student::class);
    }
}
