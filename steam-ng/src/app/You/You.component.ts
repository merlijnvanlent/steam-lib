import { Component, OnInit } from '@angular/core';

import {Observable} from 'rxjs';
import {debounceTime, distinctUntilChanged, map} from 'rxjs/operators';

@Component({
  selector: 'app-You',
  templateUrl: './You.component.html',
  styleUrls: ['./You.component.scss']
})
export class YouComponent implements OnInit {
  public model: any;

  constructor() { }

  ngOnInit() {
  }

}
