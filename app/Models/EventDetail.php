<?php

namespace App\Models;

use App\Jobs;
use Illuminate\Database\Eloquent\Model;

class EventDetail extends Model
{
    protected $table = 'event_details';

    public function job()
    {
        return $this->hasOne(Jobs::class, 'id', 'job_id');
    }
}
