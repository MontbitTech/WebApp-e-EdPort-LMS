<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Model 
{
    //use Notifiable;
    protected $table = 'tbl_admin';
    protected $fillable = ['first_name','last_name','email','phone',  'password'];
}
