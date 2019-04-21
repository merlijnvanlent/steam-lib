<?php

namespace App;
use GuzzleHttp\Client;
use Validator;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'steam_appid',
        'name',
        'is_free',
        'header_image',
        'developers',
        'publishers',
        'price_overview',
        'platforms',
        'categories',
        'release_date',
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
        if ($id === null) {
            return false;
        }

        $request = $this->client->get(
            "https://store.steampowered.com/api/appdetails/",
            [
                'query' => [
                    'format'=> 'json',
                    'appids'=> $id,
                    'cc'    => 'nl',
                    'l'     => 'en'
                ]
            ]
        );

        $response = parent::validateRequest($request);

        if (isset($response->$id)) {
            if ($response->$id->success === true) {
                return $this->createGame($response->$id->data);
            }
        }

        return false;
    }

    public function createGame($game = null)
    {
        if ($game === null) {
            return false;
        }

        $this->steam_appid = $game->steam_appid;
        $this->name = $game->name;
        $this->is_free = $game->is_free;
        $this->header_image = $game->header_image;
        $this->developers = $game->developers;
        $this->publishers = $game->publishers;
        $this->price_overview = $game->price_overview;
        $this->platforms = $game->platforms;
        $this->categories = $game->categories;
        $this->release_date = $game->release_date;

        return $this;
    }

    public function determineCurrency()
    {
        //TODO: make currency dynamic to region.
    }

    public function determineLanguage()
    {
        //TODO: determine language.
    }
}