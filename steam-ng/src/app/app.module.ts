import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { FormsModule } from '@angular/forms';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { StartComponent } from './Start/Start.component';

import { PartyComponent } from './Party/Party.component'
import { PlayerComponent } from './templates/player/player.component';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { HttpConfigInterceptor } from './http-interceptor';
import { ProblemComponent } from './Problem/Problem.component';
import { LibraryComponent } from './library/library.component';
import { GameComponent } from './templates/game/game.component';
import { SpinnerComponent } from './templates/spinner/spinner.component';

@NgModule({
  declarations: [
    AppComponent,
    StartComponent,
    PlayerComponent,
    PartyComponent,
    ProblemComponent,
    PlayerComponent,
    LibraryComponent,
    GameComponent,
    SpinnerComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    NgbModule,
    FormsModule,
    HttpClientModule,
  ],
  providers: [
    { provide: HTTP_INTERCEPTORS, useClass: HttpConfigInterceptor, multi: true }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
