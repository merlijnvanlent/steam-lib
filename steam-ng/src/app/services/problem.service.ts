import { Injectable } from '@angular/core';
import { Subject } from 'rxjs';
import { Problem } from '../models/ProblemModel';

@Injectable({
  providedIn: 'root'
})
export class ProblemService {

  private newProblem = new Subject<Problem>();
  newProblem$ = this.newProblem.asObservable();

  constructor() { }

  problem(problem: Problem) {
    this.newProblem.next(problem);
  }
}
