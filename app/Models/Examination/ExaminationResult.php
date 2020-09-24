<?php

namespace App\Models\Examination;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class ExaminationResult extends Model
{
    protected $table = 'ex_examination_results';

    public function examination ()
    {
        return $this->hasOne(Examination::class);
    }

    public function student ()
    {
        return $this->hasOne(Student::class);
    }
}
