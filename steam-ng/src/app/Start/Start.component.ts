import { Component, OnInit } from '@angular/core';
import { PlayerService } from '../services/player.service';
import { Player } from '../models/PlayerModel';
import { Subscription } from 'rxjs';
import { ProblemService } from '../services/problem.service';
import { GlobalService } from '../services/global.service';

@Component({
  selector: 'app-Start',
  templateUrl: './Start.component.html',
  styleUrls: ['./start.component.scss']
})
export class StartComponent implements OnInit {
  request: Subscription;

  constructor(private PlayerService: PlayerService, private ProblemService: ProblemService, private GlobalService: GlobalService) {
  }

  ngOnInit() {
  }

  getPlayer(input: any) {
    let self = this;

    if (this.request) {
      this.request.unsubscribe();
    }

    this.request = this.PlayerService.getPlayerById(input).subscribe(response => {
      if (response.success) {
        this.PlayerService.setPlayer(response.player);
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
