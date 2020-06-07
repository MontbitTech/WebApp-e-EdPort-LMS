<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DateClass extends Model
{
  protected $table = 'tbl_dateclass';
	
	protected $fillable = ['class_id','subject_id','teacher_id','topic_id','from_timing','to_timing','class_date','timetable_id','live_link','ass_live_url','quiz_link','is_past','class_student_msg','class_description','g_meet_url','recording_url'];
    
	
	 public function studentClass()
    {
      return $this->belongsTo('App\StudentClass','class_id','id');
    }
    public function teacher()
    {
      return $this->belongsTo('App\Teacher','teacher_id','id');
    }
	 public function timetable()
    {
      return $this->belongsTo('App\ClassTiming','timetable_id','id');
    }
	public function studentSubject()
    {
      return $this->belongsTo('App\StudentSubject','subject_id','id');
    }
	public function cmsLink()
    {
      return $this->belongsTo('App\CmsLink','topic_id','id');
    }
	
}