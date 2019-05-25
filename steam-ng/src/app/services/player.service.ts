import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Player } from "../models/PlayerModel";

@Injectable({
  providedIn: 'root'
})
export class PlayerService {
  player: Player;

  constructor(
    private http: HttpClient,
  ) { }

  getPlayerById(id: any) {
    if (id.includes('/')) {
      id = id.split('/').filter(x => x).reverse()[0]; 
    }
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
}
