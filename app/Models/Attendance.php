<?php

namespace App\Models;

use App\DateClass;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'tbl_student_attendance';

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function dateclass()
    {
        return $this->belongsTo(DateClass::class);
    }

    public function scopePresent()
    {
        return $this->where('status', 1);
    }

    public function scopeAbsent()
    {
        return $this->where('status', 0);
    }
}
