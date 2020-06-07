<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tbl_techers';
    protected $fillable = ['name','email','phone','address','city','state','pincode','login_pin','g_user_id','g_customer_id','g_response','photo','g_meet_url','g_meet_datetime','hasToken'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     protected $hidden = [
       // 'password', 'remember_token',
    ]; 

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
   /*  protected $casts = [
        'email_verified_at' => 'datetime',
    ]; */
	
	  public function validateForPassportPasswordGrant($password)
    {
        return true;
    }
}
