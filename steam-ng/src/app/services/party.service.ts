import { Injectable } from '@angular/core';
import { Player } from '../models/PlayerModel';

@Injectable({
  providedIn: 'root'
})
export class PartyService {

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

  clear() {
    this.playing = [];
    this.online = [];
    this.offline = [];
  }

  remove(player: Player) {
    let i = this.playing.findIndex(x => x.steamid == player.steamid);
    if (i !== -1) {
      this.playing.splice(i, 1);
    }

    i = this.online.findIndex(x => x.steamid == player.steamid);
    if (i !== -1) {
      this.online.splice(i, 1);
    }

    i = this.offline.findIndex(x => x.steamid == player.steamid);
    if (i !== -1) {
      this.offline.splice(i, 1);
    }
  }

  check(player: Player) {
    if (this.all().find(x => x.steamid == player.steamid)) {
      return true;
    }
    return false;
  }

  get(steamid: number) {
    let player = this.all().find(x => x.steamid == steamid);
    if (player) {
      return player;
    }

    return false;
  }
}
