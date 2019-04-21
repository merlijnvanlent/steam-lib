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
                        'game' => $Player,
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

    public function GetPlayers(Request $request)
    {
        //TODO: accept and return multiple players
    }

    public function getLibrary(Request $request)
    {
        $PlayerId = $request->input('playerid');
        
        $Player = new Player($PlayerId);

        if (isset($Player->steamid)) {
            $Player = $Player->getLibrary();

            if ($Player !== false) {
                return response()->json(
                    [
                        'response' => [
                            'success' => true,
                            'player' => $Player,
                        ]
                    ]
                );
            }
        }

        return response()->json(
            [
                'response' => [
                    'success' => false,
                ]
            ]
        );
    }

    public function getLibraries(Request $request)
    {
        //TODO: accept and return multiple libraries
    }
}