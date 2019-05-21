import { Component, OnInit, Input } from '@angular/core';
import { Player } from 'src/app/models/PlayerModel';
import { GlobalService } from 'src/app/services/global.service';

@Component({
  selector: 'app-player',
  templateUrl: './player.component.html',
  styleUrls: ['./player.component.scss']
})
export class PlayerComponent implements OnInit {

  @Input() player:Player;

  constructor(private GlobalService: GlobalService) { }

  ngOnInit() {
  }

}
