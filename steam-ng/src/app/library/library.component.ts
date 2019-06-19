import { Component, OnInit } from '@angular/core';
import { PartyService } from '../services/party.service';
import { Router } from '@angular/router';
import { GameService } from '../services/game.service';
import { Game } from '../models/GameModel';
import { ProblemService } from '../services/problem.service';
import { GlobalService } from '../services/global.service';

@Component({
  selector: 'app-library',
  templateUrl: './library.component.html',
  styleUrls: ['./library.component.scss']
})
export class LibraryComponent implements OnInit {

  gameIds: [] = []

  constructor(private PartyService: PartyService, private router: Router, private GameService: GameService, private ProblemService: ProblemService) { }

  ngOnInit() {
    const party = this.PartyService.all();

    if (party.length < 2) {
      this.router.navigateByUrl('/');
      return;
    }

    let self = this;

    this.GameService.getLibraryForParty().subscribe((result) => {
      if (!result.success) {
        self.ProblemService.problem({
          type: 'danger',
          message: 'Something went wrong. Pleas try again.',
        });
      }

      self.gameIds = result.partyLibrary;
    });
  }
}
