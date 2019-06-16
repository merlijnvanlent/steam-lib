<?php

namespace App;

use Mockery\Undefined;

class LibraryGame extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'steam_appid',
        'players'
    ];

    function __construct($steam_appid = null, $player)
    {
        if ($steam_appid !== null) {
          $this->steam_appid = $steam_appid;
        }
        $this->players = [$player->steamid];
    }

    function addPlayer($player)
    {
      $this->players[] = $player->steamid;
    }
}