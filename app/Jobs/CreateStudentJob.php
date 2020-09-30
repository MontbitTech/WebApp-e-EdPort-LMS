<?php

namespace App\Jobs;

use App\Http\Helpers\CustomHelper;
use App\libraries\Utility\RemoteRequest;
use App\libraries\Utility\StudentUtility;
use App\Models\ClassSection;
use App\StudentClass;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateStudentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    private $token;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $token)
    {
        $this->data  = $data;
        $this->token = decrypt($token);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        set_time_limit(0);
        $rowCount = 1;
        foreach($this->data as $row){
            $response = $this->createStudent($row, $rowCount);
            if(!$response['success'])
                Log::error($response['data']);
            $rowCount++;
        }
    }

    public function createStudent($row, $rowCount)
    {
        $classrooms = StudentClass::where('class_name', $row["class"])->where('section_name', $row["section"])->get();

        $response = StudentUtility::inviteStudentToClassroom($row["email"], $this->token, $classrooms);
        if(!$response['success']){
            return failure_message($response['data'].' at row : '.$rowCount);
        }

        $student = StudentUtility::createStudent([
            'name'     => $row["name"],
            'class_id' => ClassSection::where('class_name',$row['class'])->where('section_name',$row['section'])->pluck('id')[0],
            'phone'    => $row["phone"],
            'email'    => $row["email"],
            'notify'   => $row["notify"],
        ]);

        StudentUtility::sendTimeTableToStudentEmail($row["class"], $row["section"], $student);

        return success_message(true);
    }
}
