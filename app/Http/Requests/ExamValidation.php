<?php

namespace App\Http\Requests;

/**
 * Class FileRequestValidation
 * @package App\Http\Requests
 */
class ExamValidation extends BaseRequest
{
    public function rules ()
    {
        return [
            'title'          => 'required',
            'classroom_id'   => 'required|exists:tbl_student_classes,id',
            'duration'       => 'required',
            'start_time'     => 'required',

        ];
    }

    public function messages()
    {
    return [
            'title.required'         => 'Exam name is required',
            'classroom_id.required'  => 'Select Classroom',
            'duration.required'      => 'Duration is required',
            'start_time.required'    => 'Start time is required'
    ];
}
}
