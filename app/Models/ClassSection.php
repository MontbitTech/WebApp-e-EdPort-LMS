<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class ClassSection extends Model
{
     protected $table = 'tbl_classes';

     protected $fillable = ['class_name','section_name'];


     public function students()
     {
          return $this->hasMany(Student::class,'class_id');
     }
}
