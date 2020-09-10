<?php

namespace App\Jobs;

use App\Admin;
use App\Http\Helpers\CommonHelper;
use App\libraries\Utility\TeacherUtility;
use App\Teacher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateTeacherJob implements ShouldQueue
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
        $this->data = $data;
        $this->token = decrypt($token);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $rowCount = 1;
        foreach($this->data as $row){
            $response = $this->createTeacher($row, $rowCount);
            if(!$response['success'])
                Log::error($response['data']);
            $rowCount++;
        }
    }

    public function createTeacher($row, $rowCount)
    {
        $data = array(
            "name"          => array(
                "familyName" => "Teacher",
                "givenName"  => $row['name'],
                "fullName"   => $row['name'], 
            ),
            "password"      => 't#' . $row['phone'],
            "primaryEmail"  => $row['email'],
            "recoveryEmail" => Admin::first()->email,
        );

        $response = TeacherUtility::createTeacherInGoogleClassroom($this->token,json_encode($data));

        if(!$response['success'])
            return failure_message($response['data']->message.' at row : '.$rowCount);

        $teacher = TeacherUtility::createTeacher([
            'name'          =>  $row['name'],
            'email'         =>  $row['email'],
            'phone'         =>  $row['phone'],
            'g_user_id'     =>  $response['data']->id,
            'g_customer_id' =>  $response['data']->customerId,
            'g_response'    =>  serialize($response['data'])
        ]);

        if ( strlen($row['phone']) <= 10 ) {
            $number = '91' . $row['phone'];
        } else {
            $number = $row['phone'];
        }

        $message = "Your school created an account for you. Gmail ID: ".$row['email']." and  “t#” followed by phone number as password..";

        CommonHelper::send_sms($number, $message);

        return success_message(true);
    }
}
