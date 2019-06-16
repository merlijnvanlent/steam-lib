import { Component, OnInit } from '@angular/core';
import { PartyService } from '../services/party.service';
import { Router } from '@angular/router';
import { GameService } from '../services/game.service';
import { Game } from '../models/GameModel';

@Component({
  selector: 'app-library',
  templateUrl: './library.component.html',
  styleUrls: ['./library.component.scss']
})
export class LibraryComponent implements OnInit {

  games: Game[] = []

  constructor(private PartyService: PartyService, private router: Router, private GameService: GameService) { }

  ngOnInit() {
    const party = this.PartyService.all();

    if (party.length < 2) {
      this.router.navigateByUrl('/');
      return;
    }

    this.GameService.getLibraryForParty().subscribe((result) => {
      debugger;
    });
  }

}
