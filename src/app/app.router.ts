import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { ListaUsuariosComponent } from './pages/lista-usuarios/lista-usuarios.component';
import { FormUsuariosComponent } from './pages/form-usuarios/form-usuarios.component';

const routes: Routes = [
  { path: 'lista-usuarios', component: ListaUsuariosComponent },
  { path: 'form-usuarios/:id', component: FormUsuariosComponent },
  { path: 'form-usuarios', component: FormUsuariosComponent },
  { path: '', redirectTo: 'lista-usuarios', pathMatch: 'full' }
];

@NgModule({
  exports: [ RouterModule ],
  imports: [ RouterModule.forRoot(routes) ]
})
export class AppRoutingModule { }