import { Injectable } from '@angular/core';
import { Player } from '../models/PlayerModel';

@Injectable({
  providedIn: 'root'
})
export class GlobalService {

  constructor() { }

  resolvePlayerState(state) {
    const states = [
      'Offline',
      'Online',
      'Busy',
      'Away',
      'Snooze',
      'Looking to trade',
      'Looking to play',
    ]

    return states[state];
  }

  class(player: Player) {
    if (player.game)
      return {playing: true};

    if (player.personastate)
      return {online: true};

    return {offline: true};
  }
}
