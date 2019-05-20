import { Component, OnInit } from '@angular/core';
import { Player } from '../models/PlayerModel';
import { PlayerService } from '../services/player.service';
import { ProblemService } from '../services/problem.service';
import { GlobalService } from '../services/global.service';

@Component({
  selector: 'app-Party',
  templateUrl: './Party.component.html',
  styleUrls: ['./Party.component.scss']
})
export class PartyComponent implements OnInit {
  friends: Player[] = [];
  loading: number = 0;
  constructor(private PlayerService:PlayerService, private ProblemService: ProblemService, private GlobalService: GlobalService) { }

  ngOnInit() {
    let self =  this;
    if (!this.PlayerService.getPlayer()) {
      return;
    }
    this.PlayerService.addPlayerToParty(this.PlayerService.getPlayer());
    this.PlayerService.getFriends(this.PlayerService.getPlayer().steamid).subscribe((result) => {
      if (!result.success) {
        self.ProblemService.problem({
          type: 'danger',
          message: 'Something went wrong. Pleas try again.',
        });
      }
      
      this.PlayerService.setPlayer(result.player);

      this.PlayerService.getPlayer().friends.forEach(x => {
        self.PlayerService.getPlayerById(x.steamid).subscribe(result => {
          if (!result.success) {
            self.ProblemService.problem({
              type: 'warning',
              message: 'One of your friends could not be found.'
            });
          }

          self.friends.push(result.player);
        });
      });
    })
  }

  
  

}