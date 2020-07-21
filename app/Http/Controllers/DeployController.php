<?php

namespace App\Http\Controllers;

use App\ClassTiming;
use App\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DeployController extends Controller
{
    public function deploy (Request $request)
    {
        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');

        $localToken = config('app.deploy_secret');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);

        if ( hash_equals($githubHash, $localHash) ) {
//            $root_path = base_path();
//            $process = new Process(array('cd ' . $root_path . '; ./deploy.sh'));
//            $process->run(function ($type, $buffer) {
//                echo $buffer;
//            });
            echo shell_exec(base_path() . '/deploy.sh');

        }
    }

    public function createJsonFilesForGoogleAuth ()
    {
        $result = 'already exist';
        if ( !file_exists(base_path() . '/credentials.json') ) {
            $handle = fopen(base_path() . '/credentials.json', 'w') or die('Cannot open file:  ' . 'credentials.json');
            $data = json_encode([
                'web' => [
                    'client_id'                   => env('GOOGLE_CLIENT_ID'),
                    'project_id'                  => env('APP_NAME'),
                    'auth_uri'                    => 'https://accounts.google.com/o/oauth2/auth',
                    'token_uri'                   => 'https://oauth2.googleapis.com/token',
                    'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
                    'client_secret'               => env('GOOGLE_CLIENT_SECRET'),
                    'redirect_uris'               => [env('APP_URL') . '/admin/login'],
                ],
            ]);
            fwrite($handle, $data);
            $result = 'credentials created';
        }

        if ( !file_exists(base_path() . '/credentials_teacher.json') ) {
            $handle = fopen(base_path() . '/credentials_teacher.json', 'w') or die('Cannot open file:  ' . 'credentials_teacher.json');
            $data = json_encode([
                'web' => [
                    'client_id'                   => env('GOOGLE_CLIENT_ID'),
                    'project_id'                  => env('APP_NAME'),
                    'auth_uri'                    => 'https://accounts.google.com/o/oauth2/auth',
                    'token_uri'                   => 'https://oauth2.googleapis.com/token',
                    'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
                    'client_secret'               => env('GOOGLE_CLIENT_SECRET'),
                    'redirect_uris'               => [env('APP_URL') . '/teacher/login'],
                ],
            ]);
            fwrite($handle, $data);
            $result = 'credentials_teacher created';
        }

        echo Response::json(['success' => $result]);
    }
}
