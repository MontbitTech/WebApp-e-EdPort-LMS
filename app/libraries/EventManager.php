<?php

namespace App\libraries;

use App\Models\EventDetail;
use Illuminate\Database\Console\Migrations\StatusCommand;

class EventManager 
{

    public static function createEvent($params)
    {
        $event = new EventDetail();
        foreach($params as $key=>$value){
            $event->$key = $value;
        }
        return $event->save();
    }
}