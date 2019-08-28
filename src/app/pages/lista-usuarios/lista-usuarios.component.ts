import { Component, OnInit, ViewChild, TemplateRef } from '@angular/core';
import * as jsPDF from 'jspdf';
import { UsuariosService } from '../../services/usuarios.service';
import { Ng4LoadingSpinnerService } from 'ng4-loading-spinner';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';
import { Router } from '@angular/router';

@Component({
  selector: 'app-lista-usuarios',
  templateUrl: './lista-usuarios.component.html',
  styleUrls: ['./lista-usuarios.component.css']
})
export class ListaUsuariosComponent implements OnInit {
  @ViewChild('templateModal') templateModal;
  @ViewChild('templateModalExclusao') templateModalExclusao;

  modalRef: BsModalRef;

  tituloModal;
  textoModal;

  usuarios = [];

  functionExcluir;

  constructor(
    public usuariosService: UsuariosService,
    private spinnerService: Ng4LoadingSpinnerService,
    private modalService: BsModalService,
    public router: Router
  ) { }

  ngOnInit() {
    this.carregarUsuarios();
  }

  carregarUsuarios(){
    this.spinnerService.show();

    this.usuariosService.listar().then(sucesso => {

      if(sucesso.erro == 1){
        this.openModal('Ops!', sucesso.mensagem);
      } else {
        this.usuarios = sucesso.usuarios;
      }
    }, falha => {
      this.openModal('Ops!', 'A operação falhou.');
    }).then(() => {
      this.spinnerService.hide();
    });
  }

  editar(usuario){
    this.router.navigate(['/form-usuarios', usuario.id]);
  }

  excluir(usuario){
    this.spinnerService.show();

    this.usuariosService.excluir(usuario).then(sucesso => {
      if(sucesso.erro == 1){
        this.openModal('Ops!', sucesso.mensagem);
      } else {
        this.usuarios = sucesso.usuarios;
        
        this.openModal('Exclusão!', sucesso.mensagem);
        
        this.carregarUsuarios();
      }
    }, falha => {
      this.openModal('Ops!', 'A operação falhou.');
    }).then(() => {
      this.spinnerService.hide();
    });
  }

  exportarPDF() {
    var doc = new jsPDF('p', 'pt', 'a4');

    doc.addHTML(document.getElementById('cardListaUsuarios'), 5, 5, {
      'background': '#fff',
    }, function () {
      doc.save('usuarios.pdf');
    });
  }

  openModal(titulo, texto) {
    this.tituloModal = titulo;
    this.textoModal = texto;

    this.modalRef = this.modalService.show(this.templateModal);
  }
  
  confirmaExclusao(usuario) {
    this.tituloModal = "Confirmar exclusão";
    this.textoModal = "Tem certeza que deseja excluir '" + usuario.nome + "' ?";

    this.modalRef = this.modalService.show(this.templateModalExclusao);

    this.functionExcluir = function(){
      this.modalRef.hide();
      this.excluir(usuario);
    };
  }

}
