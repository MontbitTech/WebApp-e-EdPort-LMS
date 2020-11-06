<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClassSection;

class Student extends Model
{
    protected $table = 'tbl_students';

    protected $fillable = ['name', 'class_id', 'email', 'phone', 'notify'];

    public function class ()
    {
        return $this->hasOne(ClassSection::class, 'id', 'class_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function classwork()
    {
        return $this->hasMany(ClassWork::class,'class_id','class_id');
    }
}
