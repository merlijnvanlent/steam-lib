import { Injectable } from '@angular/core';
import { Player } from '../models/PlayerModel';

@Injectable({
  providedIn: 'root'
})
export class FriendsService {

  constructor() { }

  online: Player[] = [];
  offline: Player[] = [];
  playing: Player[] = [];

  add(player: Player) {
    if (player.game) {
      this.playing.push(player);
      this.playing.sort(this.compare);
    }
    else if (player.personastate) 
    {
      this.online.push(player);
      this.online.sort(this.compare);
    }
    else
    {
      this.offline.push(player);
      this.offline.sort(this.compare);
    }
  };

  all() {
    return this.playing.concat(this.online, this.offline);
  }

  private compare(a, b) {
    return (a.personaname > b.personaname) ? 1 : ((b.personaname > a.personaname) ? -1 : 0); 
  }
}
