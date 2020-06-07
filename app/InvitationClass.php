<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvitationClass extends Model
{
    //
    //use Notifiable;
  // use SoftDeletes;
    protected $table = 'tbl_invite_teacher';
    protected $fillable = ['class_id','teacher_id','subject_id','g_code','g_responce','is_accept'];

	public function studentClass()
    {
      return $this->belongsTo('App\StudentClass','class_id','id');
    }
	public function studentSubject()
    {
      return $this->belongsTo('App\StudentSubject','subject_id','id');
    }
	
	
}
	