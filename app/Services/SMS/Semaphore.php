<?php
namespace App\Services\SMS;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Semaphore
{
    protected $url = 'http://beta.semaphore.co/api/v4/messages';
    protected $client;
    protected $apiKey = 'uyBCxqs8JWq8GZpVraqx';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri'  => $this->url,
            'timeout'   => 10.0
        ]);
    }
    public function sendSMS($number, $message)
    {
        $body = [
            [
                'name'  => 'apikey',
                'contents'  => $this->apiKey
            ],
            [
                'name'  => 'message',
                'contents'  => $message
            ],
            [
                'name'  => 'number',
                'contents'  => $number
            ],
            [
                'name'  => 'sendername',
                'contents'  => 'MEDIX'
            ]
        ];
        $request = new Request('POST', $this->url);
        $response = $this->client->send($request, ['multipart' => $body]);
        \Log::info($response->getBody());

        return $response->getBody();
    }
}