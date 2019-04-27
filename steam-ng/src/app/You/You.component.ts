import { Component, OnInit } from '@angular/core';

import { Player } from "../models/PlayerModel";

import { PlayerService } from "../services/player.service";

@Component({
  selector: 'app-You',
  templateUrl: './You.component.html',
  styleUrls: ['./You.component.scss']
})
export class YouComponent implements OnInit {
  Player: Player;
  PlayerSlug: string = '';

  constructor(private PlayerService: PlayerService) { }

  ngOnInit() {
  }

  GetPlayer() {
    let self = this;
    this.PlayerService.getPlayerById(self.PlayerSlug).subscribe(response => {
      self.Player = response.player;
    });
  }
}