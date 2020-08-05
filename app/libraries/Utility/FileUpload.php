<?php

namespace App\libraries\Utility;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Rap2hpoutre\FastExcel\FastExcel;

/**
 * Class FileUpload
 * @package App\libraries\Utility
 */
class FileUpload
{
    public static function uploadFile ($destinationPath, $file)
    {
        $filename = strtolower($file->getClientOriginalName());

        if ( file_exists($destinationPath . '/' . $filename) )
            unlink($destinationPath . '/' . $filename);

        $path = $destinationPath . '/' . $filename;
        try {
            $file->move($destinationPath, $filename);

            $collection = ( new FastExcel )->import($path);

            if ( !isset($collection[0]) ) {
                @unlink($path);
                return failure_message(Config::get('constants.WebMessageCode.104'));
            }

            Log::info('Filename processing - ' . $filename);

            return success_message($collection);
        } catch ( \Exception $e ) {
            @unlink($path);

            return failure_message(Config::get('constants.WebMessageCode.121'));
        }
    }
}