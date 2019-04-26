import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { WelcomeComponent } from './Welcome/Welcome.component';
import { YouComponent } from './you/you.component';

const routes: Routes = [
  {
    path: '',
    component: WelcomeComponent
  },
  {
    path: 'you',
    component: YouComponent
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
