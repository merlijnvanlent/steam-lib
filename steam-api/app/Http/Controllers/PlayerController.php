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

        if (isset($Player->steamid)) {
            return response()->json(
                [
                    'response' => [
                        'success' => true,
                        'player' => $Player,
                    ]
                ]
            );
        }

        return response()->json(
            [
                'response' => [
                    'success' => false,
                ]
            ]
        );
    }
}