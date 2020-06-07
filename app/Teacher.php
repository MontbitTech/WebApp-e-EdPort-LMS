<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    //
    //use Notifiable;
  // use SoftDeletes;
    protected $table = 'tbl_techers';
    protected $fillable = ['name','email','phone','address','city','state','pincode','login_pin','g_user_id','g_customer_id','g_response','photo','g_meet_url','g_meet_datetime','hasToken'];

	public function class_timing()
    {
        return $this->hasMany('App\ClassTiming','teacher_id','id');
    }
	public function classwork()
    {
        return $this->hasMany('App\ClassWrok','teacher_id','id');
    }
	public function dateClass()
    {
        return $this->hasMany('App\DateClass','teacher_id','id');
    }
}
	