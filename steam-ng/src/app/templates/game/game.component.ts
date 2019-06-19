import { Component, OnInit, Input } from '@angular/core';
import { Game } from 'src/app/models/GameModel';
import { GameService } from 'src/app/services/game.service';
import { PartyService } from 'src/app/services/party.service';
import { GlobalService } from 'src/app/services/global.service';

@Component({
  selector: 'app-game',
  templateUrl: './game.component.html',
  styleUrls: ['./game.component.scss']
})
export class GameComponent implements OnInit {

  constructor(private GlobalService: GlobalService, private GameService:GameService, private PartyService: PartyService) { }

  @Input() id;
  @Input() players: [];

  game: Game;

  ngOnInit() {
    let self = this;

    if (this.players.length < 2) {
      return;
    }

    this.GameService.getGame(this.id).subscribe((result) => {
      if(result.success) {
        self.game = result.game;
      }
    })
  }
}
