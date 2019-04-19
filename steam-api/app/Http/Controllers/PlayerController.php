<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Player;

class PlayerController extends Controller
{
    public function getPlayer(Request $request)
    {
        $PlayerId = $request->input('playerid');

        $Player = new Player($PlayerId);

        // $client = new Client();
        // $request = $client->get($url);
        // $jsonResponse = json_decode($request->getBody());
    }
}