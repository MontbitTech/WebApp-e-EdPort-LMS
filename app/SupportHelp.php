<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportHelp extends Model
{
	protected $table = 'tbl_support_help';

	protected $fillable = ['teacher_id','help_type','description','class_join_link','class_id','subject_id','status','read_status'];
    
	
     public function studentClass()
    {
      return $this->belongsTo('App\StudentClass','class_id','id');
    }

    public function teacher() {
        return $this->hasOne('App\Teacher','id','teacher_id');
    }

    public function studentSubject()
    {
      return $this->belongsTo('App\StudentSubject','subject_id','id');
    }
}
