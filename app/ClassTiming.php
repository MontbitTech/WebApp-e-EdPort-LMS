<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassTiming extends Model
{
	protected $table = 'tbl_class_timings';
	
	protected $fillable = ['class_id','teacher_id','subject_id','class_day','from_timing','to_timing','is_lunch'];
	
	
    public function studentClass()
    {
      return $this->belongsTo('App\StudentClass','class_id','id');
    }
    public function teacher()
    {
      return $this->belongsTo('App\Teacher','teacher_id','id');
    }
	 public function studentSubject()
    {
      return $this->belongsTo('App\StudentSubject','subject_id','id');
    }
	/* public function classwork()
    {
        return $this->hasMany('App\ClassWrok','timetable_id','id');
    } */
	public function dateClass()
    {
        return $this->hasMany('App\DateClass','timetable_id','id');
    }
}