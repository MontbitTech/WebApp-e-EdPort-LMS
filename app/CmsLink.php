<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsLink extends Model
{
  protected $table = 'tbl_cmslinks';
	
	protected $fillable = ['class','subject','chapter','topic','link'];    
	
  
   public function dateClass()
   {
	   return $this->hasMany('App\DateClass','topic_id','id');
   }

   public function subject()
   {
	   return $this->belongsTo('App\StudentSubject','subject','id');
   }
   
}
