<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
   protected $table = 'tbl_student_subjects';
  
   protected $fillable = ['subject_name'];
	
	public function classtiming()
    {
        return $this->hasMany('App\ClassTiming');
    }
	public function studentClass()
    {
      return $this->belongsTo('App\StudentClass','id','subject_id');
    }
	public function dateClass()
    {
        return $this->hasMany('App\DateClass','subject_id','id');
    }
	public function SupportHelp()
    {
        return $this->hasMany('App\SupportHelp','id','subject_id');
    }
	public function InvitationClass()
    {
        return $this->hasMany('App\InvitationClass','subject_id','id');
    }
}