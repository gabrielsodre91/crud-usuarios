import { Component, OnInit, ViewChild } from '@angular/core';
import { Subscription } from 'rxjs';
import { Ng4LoadingSpinnerService } from 'ng4-loading-spinner';
import { UsuariosService } from 'src/app/services/usuarios.service';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';
import { Router, ActivatedRoute } from '@angular/router';


@Component({
  selector: 'app-form-usuarios',
  templateUrl: './form-usuarios.component.html',
  styleUrls: ['./form-usuarios.component.css']
})
export class FormUsuariosComponent implements OnInit {
  @ViewChild('templateModal') templateModal;

  inscricao: Subscription;
  modalRef: BsModalRef;

  usuario = {
    telefone: ''
  };

  tituloModal;
  textoModal;

  constructor(
    public usuariosService: UsuariosService,
    private spinnerService: Ng4LoadingSpinnerService,
    private modalService: BsModalService,
    private route: ActivatedRoute,
    private router: Router
  ) { }

  ngOnInit() {
    this.inscricao = this.route.params.subscribe((params: any) => {
      let id = params['id'];

      if (id) {
        this.spinnerService.show();

        this.usuariosService.obterUsuarioPorId(id).then(sucesso => {
          this.usuario = sucesso.usuarios[0];
        }, falha => {
          console.log(falha);
        }).then(() => {
          this.spinnerService.hide();
        });
      }
    });
  }

  salvar(){
    if((<any>this.usuario).id){
      this.editar();
    } else {
      this.inserir();
    }
  }

  inserir(){
    this.spinnerService.show();

    this.usuariosService.inserir(this.usuario).then(sucesso => {
      if((<any>sucesso).erro == 0){
        this.router.navigate(['/lista-usuarios']);
      } else {
        this.openModal('Ops!', (<any>sucesso).mensagem);
      }
    }, falha => {
      this.openModal('Ops!', 'A operação falhou.');
    }).then(() => {
      this.spinnerService.hide();
    });
  }

  editar(){
    this.spinnerService.show();
    
    this.usuariosService.editar(this.usuario).then(sucesso => {
      if((<any>sucesso).erro == 0){
        this.router.navigate(['/lista-usuarios']);
      } else {
        this.openModal('Ops!', (<any>sucesso).mensagem);
      }
    }, falha => {
      this.openModal('Ops!', 'A operação falhou.');
    }).then(() => {
      this.spinnerService.hide();
    });
  }

  openModal(titulo, texto) {
    this.tituloModal = titulo;
    this.textoModal = texto;

    this.modalRef = this.modalService.show(this.templateModal);
  }
}
