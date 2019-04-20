<?php

namespace App;
use GuzzleHttp\Client;
use Validator;

class Player
{
    protected $client;
    protected $key;

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
        'gameid',
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

    public function get($id = null)
    {
        $player = $this->getBySteamId($id);

        if ($player === false) {
            $player = $this->getByVanity($id);
        }

        if ($player === false) {
            return false;
        }

        return $this;
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

        $response = $this->validateRequest($request);

        if ($response === false) {
            return false;
        }

        if (isset($response->response->success)) {
            if ($response->response->success === 1) {
                return $this->getBySteamId($response->response->steamid);
            }
        }

        return false;
    }

    public function getBySteamId($steamId = null)
    {
        $request = $this->client->get(
            "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/",
            [
                'query' => [
                    'format'    => 'json',
                    'key'       => $this->key,
                    'steamids' => $steamId,
                ]
            ]
        );

        $response = $this->validateRequest($request);

        if ($response === false) {
            return false;
        }

        if (isset($response->response->players)) {
            if (count($response->response->players) === 1) {
                return $this->createPlayer($response->response->players[0]);
            }
        }

        return false;
    }

    public function createPlayer($player = null)
    {
        if ($player === false) {
            return false;
        }

        $this->steamid = $player->steamid;
        $this->personaname = $player->personaname;
        $this->profileurl = $player->profileurl;
        $this->avatar = $player->avatar;
        $this->avatarfull = $player->avatarfull;

        //optional
        if (isset($player->personastate))
            $this->personastate = $player->personastate;

        if (isset($player->gameid))
            $this->gameid = $player->gameid;

        return $this;
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
