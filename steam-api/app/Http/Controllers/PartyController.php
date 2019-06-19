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
          $partyLibrary[$game->appid] = new LibraryGame($game->appid , $player);
        }
      }
    }

    usort($partyLibrary, function($a, $b) {
      if (count($a->players) ==  count($b->players)) {
        return 0;
      }

      return (count($a->players) > count($b->players)) ? -1 : 1;
    });

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