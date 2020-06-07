<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsLink extends Model
{
  protected $table = 'tbl_cmslinks';
	
	protected $fillable = ['class','subject','topic','link'];    
	
  
   public function dateClass()
   {
	   return $this->hasMany('App\DateClass','topic_id','id');
   }
   
}
