<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassTopic extends Model
{
  protected $table = 'tbl_topics';
	
	protected $fillable = ['topicname','class_id','g_topic_id'];    
	
    public function studentClass()
    {
      return $this->belongsTo('App\StudentClass','class_id','id');
    }
   
   public function classwork()
   {
	   return $this->hasMany('App\ClassWork','topic_id','id');
   }
   
}
