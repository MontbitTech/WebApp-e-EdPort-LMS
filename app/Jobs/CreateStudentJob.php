<?php

namespace App\Jobs;

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
        foreach($this->data as $row){
            $response = $this->createStudents($row);
            if(!$response['success'])
                Log::error($response['data']);
        }
    }

    public function createStudents($row)
    {
        $classrooms = StudentClass::where('class_name', $row["class"])->where('section_name', $row["section"])->get();

        $response = StudentUtility::inviteStudentToClassroom($row["email"], $this->token['access_token'], $classrooms);
        if(!$response['success']){
            if($response['data'] == 'UNAUTHENTICATED')
                return failure_message('UNAUTHENTICATED');
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
