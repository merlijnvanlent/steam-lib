<?php

namespace App;
use GuzzleHttp\Client;
use Validator;

class Model
{
    protected $client;
    protected $key;

    function __construct()
    {
        $this->client = new Client();
        $this->key = '31848E1A1F4CE64106272E040B4B1861'; // env('API_KEY' , false);
    }

    public function validateRequest($request)
    {
        if ($request->getStatusCode() != 200) {
            return false;
        }

        $validator = Validator::make(['JSON' => $request->getBody()], [
            'JSON' => 'json|required',
        ]);

        if ($validator->fails()) {
            return false;
        }

        return json_decode( $request->getBody() );
    }
}