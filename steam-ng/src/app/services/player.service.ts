import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Player } from "../models/PlayerModel";

@Injectable({
  providedIn: 'root'
})
export class PlayerService {
  player: Player;
  party: Player[] = [];

  constructor(
    private http: HttpClient,
  ) { }

  getPlayerById(id) {
    let params = new HttpParams().set('playerid' , id);
    return this.http.get<any>('player' , {params : params})
  }

  getFriends(id) {
    let params = new HttpParams().set('playerid' , id);
    return this.http.get<any>('player/friendslist' , {params : params})
  }

  setPlayer(player: Player) {
    this.player = player;
  }

  getPlayer() {
    return this.player;
  }

  setParty(party: Player[]) {
    this.party = party;
  }

  getParty() {
    return this.party;
  }

  addPlayerToParty(player: Player) {
    this.party.push(player);
  }

  removePlayerFromParty(id: any) {

  }
}
