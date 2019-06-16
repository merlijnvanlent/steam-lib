<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Player;
use App\LibraryGame;

class PartyController extends Controller {
  
  public function getParty(Request $request)
  {
    $partyPeople = $request->input('party');
    $partyLibrary = [];

    foreach ($partyPeople as &$player) {
      $player = new Player($player);

      if (!isset($player->steamid)) {
        $player = false;
        continue;
      }
      $player = $player->getLibrary();

      if (!isset($player->steamid)) {
        $player = false;
        continue;
      }

      foreach($player->library->games as $game) {
        if (isset($partyLibrary[$game->appid])) {
          $partyLibrary[$game->appid]->addPlayer($player);
        }
        else
        {
          $partyLibrary[$game->appid] = new LibraryGame(null , $player);
        }
      }


    }

    if (count($partyLibrary)) {
      return response()->json([
        'success' => true,
        'partyLibrary' => $partyLibrary,
        'party' => $request->input('party'),
      ]);
    }

    return $this->returnFalse('No games where found.');
  }
}

?>