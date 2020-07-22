<?php

namespace App\libraries\Utility;
/**
 * Class RemoteRequest
 * @package App\libraries\Utility
 */
class RemoteRequest
{

    public static function postJsonRequest ($url, $headers = null, $params = [])
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => $params,
            CURLOPT_HTTPHEADER     => $headers,
        ));

        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        if ( isset($response->error) ) {
            return failure_message($response->error);
        }

        return success_message($response);
    }

    public static function getJsonRequest ($url, $headers = null, $params = [])
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_POSTFIELDS     => $params,
            CURLOPT_HTTPHEADER     => $headers,
        ));

        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        if ( isset($response->error) ) {
            return failure_message($response->error);
        }

        return success_message($response);
    }

    public static function deleteJsonRequest ($url, $headers)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "DELETE",
            CURLOPT_HTTPHEADER     => $headers,
        ));

        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        if ( isset($response->error) ) {
            return failure_message($response->error);
        }

        return success_message($response);
    }
}