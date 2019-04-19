<?php

namespace App;
use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;

class Player
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'steamid',
        'personaname',
        'profileurl',
        'avatar',
        'avatarfull',
        'personastate',
        'gameid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    function __construct($id = null)
    {
        $this->client = new Client();
        $this->key = env('API_KEY' , false);

        if ($id !== null) {
            return $this->get($id);
        }
    }

    public function get(Type $var = null)
    {
        // determine what type of id it is
        // vanity url with or without the url parts or steamID
    }

    /**
     * @return Player
     * @param $id
     * 
     * returns player object from an id or false if no account was found.
     */
    public function getByVanity($vanityurl = null)
    {
        $request = $this->client->get(
            "http://api.steampowered.com/ISteamUser/ResolveVanityURL/v0001",
            [
                'query' => [
                    'format'    => 'json',
                    'key'       => $this->key,
                    'vanityurl' => $vanityurl
                ]
            ]
        );

        $response = json_decode( $request->getBody() );

        if ($response === null) {
            return false;
        }

        if (isset($response->response->success)) {
            if ($response->response->success) {

            }
        }
    }
}
