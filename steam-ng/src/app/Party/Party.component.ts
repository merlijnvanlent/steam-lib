import { Component, OnInit } from '@angular/core';
import { Player } from '../models/PlayerModel';
import { PlayerService } from '../services/player.service';
import { ProblemService } from '../services/problem.service';
import { GlobalService } from '../services/global.service';
import { FriendsService } from '../services/friends.service';
import { PartyService } from '../services/party.service';
import { Subscription } from 'rxjs';

@Component({
  selector: 'app-Party',
  templateUrl: './Party.component.html',
  styleUrls: ['./Party.component.scss']
})
export class PartyComponent implements OnInit {
  loading: number = 0;
  request: Subscription;
  friend: string;
  constructor(private PartyService: PartyService, private FriendsService: FriendsService, private PlayerService:PlayerService, private ProblemService: ProblemService) { }

  ngOnInit() {
    let self =  this;
    if (!this.PlayerService.getPlayer()) {
      return;
    }

    this.FriendsService.clear();
    this.PartyService.clear();
    this.PartyService.add(this.PlayerService.getPlayer());

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

          self.FriendsService.add(result.player);
        });
      });
    })
  }
  
  getPlayer() {
    let self = this;

    if (this.request) {
      this.request.unsubscribe();
    }

    this.request = this.PlayerService.getPlayerById(this.friend).subscribe(response => {
      if (response.success) {
        this.PartyService.add(response.player);
        this.friend = '';
        return;
      }

      let problem = {
        type: 'warning',
        message: 'No results matched. Pleas try again.'
      }

      self.ProblemService.problem(problem);
    });
  }
}