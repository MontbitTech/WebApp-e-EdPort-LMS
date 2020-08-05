<?php

namespace App\Http\Requests;

/**
 * Class FileRequestValidation
 * @package App\Http\Requests
 */
class FileRequestValidation extends BaseRequest
{
    public function rules ()
    {
        return [
            'file' => 'required',
        ];
    }
}