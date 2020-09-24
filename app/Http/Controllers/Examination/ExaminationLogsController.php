<?php

namespace App\Http\Controllers\Examination;

use App\Http\Controllers\Controller;
use App\Models\Examination\ExaminationLogs;
use Illuminate\Http\Request;

class ExaminationLogsController extends Controller
{
    public function get (Request $request)
    {
        $logs = ExaminationLogs::query();

        foreach ( $request->all() as $key => $value ) {
            $logs = $logs->where($key, $value);
        }

        return $logs->get();
    }

    public function post (Request $request)
    {
        $logs = ExaminationLogs::firstOrNew([
            'classroom_examination_mapping_id' => $request->classroom_examination_mapping_id,
            'student_id'                       => $request->student_id,
        ]);

        $logs->remaining_time = $request->remaining_time;
        $logs->logs = $request->logs;
        $logs->disconnected_count = $request->disconnected_count;
        $logs->save();

        return $logs;
    }
}
