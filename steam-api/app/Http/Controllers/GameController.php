<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;

class GameController extends Controller 
{
    public function getGame(Request $request)
    {
        $GameId = $request->input('gameid');

        $Game = new Game($GameId);

        if (isset($Game->steam_appid)) {
            return response()->json(
                [
                    'success' => true,
                    'game' => $Game,
                ]
            );
        }

        return $this->returnFalse();
    }
}