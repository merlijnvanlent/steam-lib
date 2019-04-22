<?php

namespace App;

class Player extends Model
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
        'gameid',
    ];

    function __construct($id = null)
    {
        parent::__construct();

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

        $response = parent::validateRequest($request);

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
                    'steamids'  => $steamId,
                ]
            ]
        );

        $response = parent::validateRequest($request);

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

    public function getLibrary()
    {
        if (!isset($this->steamid)) {
            return false;
        }

        $request = $this->client->get(
            "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/",
            [
                'query' => [
                    'format'    => 'json',
                    'key'       => $this->key,
                    'steamid'  => $this->steamid,
                ]
            ]
        );

        $response = parent::validateRequest($request);

        if (isset($response->response->game_count)) {
            if (is_int($response->response->game_count)) {
                $this->library = $response->response;
                return $this;
            }
        }
        
        return false;
    }
}