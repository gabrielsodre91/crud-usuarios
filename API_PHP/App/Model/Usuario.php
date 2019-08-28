<?php

namespace App\Model;

class Usuario {

    // PROPRIEDADES
    private $id, $nome, $email, $telefone;

    // MÉTODOS

    // GETTERS E SETTERS
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        if(!preg_match('/\d/', $id)){
            throw new \Exception("Id inválido.");
        } else {
            $this->id = $id;
        }
    }

    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
        if(!preg_match('/^[a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]*$/', $nome)){
            throw new \Exception("Nome inválido.");
        } else {
            $this->nome = $nome;
        }
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("E-mail inválido.");
        } else {
            $this->email = $email;
        }
    }

    public function getTelefone(){
        return $this->telefone;
    }
    public function setTelefone($telefone){
        if(!preg_match('/\d/', $telefone)){
            throw new \Exception("Telefone inválido.");
        } else {
            $this->telefone = $telefone;
        }
    }
}