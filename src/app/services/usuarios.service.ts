import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';
import { HttpClient, HttpHeaders  } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class UsuariosService {

  constructor(
    private http: HttpClient
  ) { }

  listar(){
    return new Promise<any>((sucesso,falha) => {
      this.http.post(environment.apiURL + 'usuario/read', {  }, {
        headers: new HttpHeaders({'Content-Type': 'application/json'})
      }).subscribe(res => {
          sucesso(res);
        }, err => {
          falha(err);
        }
      );
    });
  }

  obterUsuarioPorId(id){
    return new Promise<any>((sucesso,falha) => {
      this.http.post(environment.apiURL + 'usuario/readOne', { id: id }, {
        headers: new HttpHeaders({'Content-Type': 'application/json'})
      }).subscribe(res => {
          sucesso(res);
        }, err => {
          falha(err);
        }
      );
    });
  }

  inserir(usuario){
    return new Promise((sucesso, falha) => {
      this.http.post(environment.apiURL + 'usuario/insert', usuario, {
        headers: new HttpHeaders({'Content-Type': 'application/json'})
      }).subscribe(res => {
          sucesso(res);
        }, err => {
          falha(err);
        }
      );
    });
  }

  editar(usuario){
    return new Promise((sucesso, falha) => {
      this.http.post(environment.apiURL + 'usuario/update', usuario, {
        headers: new HttpHeaders({'Content-Type': 'application/json'})
      }).subscribe(res => {
          sucesso(res);
        }, err => {
          falha(err);
        }
      );
    });
  }

  excluir(usuario){
    return new Promise<any>((sucesso,falha) => {
      this.http.post(environment.apiURL + 'usuario/delete', usuario, {
        headers: new HttpHeaders({'Content-Type': 'application/json'})
      }).subscribe(res => {
          sucesso(res);
        }, err => {
          falha(err);
        }
      );
    });
  }
}
