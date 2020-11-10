<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ClassWork extends Model
{
  protected $table = 'tbl_classwork';
	
	protected $fillable = ['class_id','g_live_link','g_class_id','classwork_type','topic_id','g_points','g_status','g_action','g_title','g_due_date','teacher_id','subject_id'];
    
	
	 public function studentClass()
    {
      return $this->belongsTo('App\StudentClass','class_id','id');
    }
    public function teacher()
    {
      return $this->belongsTo('App\Teacher','teacher_id','id');
    }
	/*  public function timetable()
    {
      return $this->belongsTo('App\ClassTiming','timetable_id','id');
    } */
	public function studentSubject()
    {
      return $this->hasOne('App\StudentSubject','id','subject_id');
    }
	public function classTopic()
	{
		return $this->belongsTo('App\ClassTopic','topic_id','id');
	}
  
}