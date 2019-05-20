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
                    'success' => true,
                    'player' => $Player,
                ]
            );
        }

        return $this->returnFalse();
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
                        'success' => true,
                        'player' => $Player,
                    ]
                );
            }
        }

        return $this->returnFalse();
    }

    public function getLibraries(Request $request)
    {
        //TODO: accept and return multiple libraries
    }

    public function getFriendsList(Request $request)
    {
        $PlayerId = $request->input('playerid');
        $Player = new Player($PlayerId);

        if ($Player === false) {
            return $this->returnFalse();
        }

        $Friends = $Player->getFriendsList();

        if ($Friends !== false) {
            return response()->json([
                'success' => true,
                'player' => $Player,
            ]);
        }

        return $this->returnFalse();
    }

    public function getFriends(Request $request)
    {
        $PlayerId = $request->input('playerid');
        $Player = new Player($PlayerId);

        if ($Player === false) {
            return $this->returnFalse();
        }

        $Friends = $Player->getFriends();

        if ($Friends !== false) {
            return response()->json([
                'success' => true,
                'player' => $Player,
            ]);
        }

        return $this->returnFalse();
    }

    public function getFriendsLists(Request $request)
    {
        // TODO return multiple players with there friends.
    }
}