<?php

namespace App\Http\Controllers;

use App\ClassTiming;
use App\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * Class DeployController
 * @package App\Http\Controllers
 */
class DeployController extends Controller
{
    /**
     * Deploy method for staging server
     * @param Request $request
     */
    public function deployStagingServer (Request $request)
    {
        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');

        $localToken = config('app.deploy_secret');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);

        if ( hash_equals($githubHash, $localHash) ) {
            if ( strpos($request->ref, 'feature-in-house') !== false )
                echo shell_exec(base_path() . '/deploy.sh');
            else
                echo "nothing updated ";
        }
    }

    /**
     * Deploy method for development server
     * @param Request $request
     */
    public function deployDevelopmentServer (Request $request)
    {
        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');

        $localToken = config('app.deploy_secret');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);

        if ( hash_equals($githubHash, $localHash) ) {
            if ( strpos($request->ref, 'development') !== false )
                echo shell_exec(base_path() . '/deploy.sh');
            else
                echo "nothing updated";
        }
    }

    /**
     * @param Request $request
     */
    public function createJsonFilesForGoogleAuth (Request $request)
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
