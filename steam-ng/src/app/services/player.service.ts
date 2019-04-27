import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Player } from "../models/PlayerModel";

@Injectable({
  providedIn: 'root'
})
export class PlayerService {

  constructor(
    private http: HttpClient,
  ) { }

  getPlayerById(id) {
    let params = new HttpParams().set('playerid' , id);
    return this.http.get<any>('player' , {params : params})
  }
}
