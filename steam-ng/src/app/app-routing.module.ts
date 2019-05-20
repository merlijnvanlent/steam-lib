import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { StartComponent } from './Start/Start.component';
import { PartyComponent } from './Party/Party.component';

const routes: Routes = [
  {
    path: '',
    component: StartComponent
  },
  {
    path: 'party',
    component: PartyComponent
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
