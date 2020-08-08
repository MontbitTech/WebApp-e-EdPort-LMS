<?php

namespace App\libraries\Utility;

use Illuminate\Support\Facades\DB;

class Utility
{
    public static function getNextJobId(){
        $data = DB::select("SHOW TABLE STATUS LIKE 'jobs'");

        return $data[0]->Auto_increment;
    }
}