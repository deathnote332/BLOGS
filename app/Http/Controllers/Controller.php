<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function send_notification ($tokens,$message)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'to' => $tokens,
            'data' => $message
        );
        $headers = array(
            'Authorization:key = AAAAB-PYOdc:APA91bGvYiMQc5fND8tHZ2KRv7lW1FORHrnmGhFmw7d7oi7uxpUVJw-ySAAvb8ooMT9AcvXDTGL_2hE7DmuIp7QmTLde3lYiK2ECCbQ9fTsbdy8hqOtLMtVOVTwf5RsAyjkPjoOamqLo ',
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
}
