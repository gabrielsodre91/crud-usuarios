import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app.router';

import { HttpClientModule } from '@angular/common/http';

import { AppComponent } from './app.component';
import { LoginComponent } from './pages/login/login.component';
import { ListaUsuariosComponent } from './pages/lista-usuarios/lista-usuarios.component';
import { FormUsuariosComponent } from './pages/form-usuarios/form-usuarios.component';

import { FormsModule }   from '@angular/forms';

import { NgxMaskModule, IConfig } from 'ngx-mask';

import { Ng4LoadingSpinnerModule } from 'ng4-loading-spinner';

import { ModalModule } from 'ngx-bootstrap/modal';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    ListaUsuariosComponent,
    FormUsuariosComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    AppRoutingModule,
    Ng4LoadingSpinnerModule.forRoot(),
    ModalModule.forRoot(),
    FormsModule,
    NgxMaskModule.forRoot()
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
