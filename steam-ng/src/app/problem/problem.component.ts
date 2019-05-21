import { Component, OnInit } from '@angular/core';
import { Subject } from 'rxjs';
import { debounceTime } from 'rxjs/operators';
import { ProblemService } from '../services/problem.service';
import { Problem } from '../models/ProblemModel';

@Component({
  selector: 'app-Problem',
  templateUrl: './Problem.component.html',
  styleUrls: ['./Problem.component.scss']
})
export class ProblemComponent implements OnInit {

  constructor(private ProblemService: ProblemService) { }

  closed = false;
  problem: Problem;

  ngOnInit(): void {
    let self = this;
    this.ProblemService.newProblem$.subscribe((newProblem) => {
      self.problem = newProblem;
      self.closed = false;
      setTimeout(() => self.closed = true, 10000);
    })
  }
}
