import { Injectable } from '@angular/core';
import { PartyService } from './party.service';
import { HttpParams, HttpClient } from '@angular/common/http';
import { Player } from '../models/PlayerModel';

@Injectable({
  providedIn: 'root'
})
export class GameService {

  constructor(private PartyService: PartyService, private http: HttpClient) { }

  getLibraryForParty() {
    let party = this.PartyService.all();
    let params = new HttpParams();

    party.forEach((player: Player) => {
      params = params.append('party[]', player.steamid.toString());
    });

    return this.http.get<any>('party' , {params : params})
  }

  getGame(gameid: string) {
    let params = new HttpParams().set('gameid' , gameid);
    return this.http.get<any>('game' , {params : params})
  }
}
