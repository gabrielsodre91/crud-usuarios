<?php

namespace App\Model;

class UsuarioDAO {
    // INSERIR UM USUÁRIO
    public static function insert(Usuario $usuario){
        $insert = "
            INSERT INTO usuario (nome, email, telefone) 
            VALUES (:nome, :email, :telefone);
        ";

        $stmt = Conexao::obterConexao()->prepare($insert);

        $stmt->bindValue(':nome', $usuario->getNome());
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->bindValue(':telefone', $usuario->getTelefone());

        $stmt->execute();
    }


    // ATUALIZAR UM USUÁRIO
    public static function update(Usuario $usuario){
        $update = "
            UPDATE usuario 
            SET 
                nome = :nome,
                email = :email,
                telefone = :telefone
            WHERE id = :id
        ";

        $stmt = Conexao::obterConexao()->prepare($update);

        $stmt->bindValue(':id', $usuario->getId());
        $stmt->bindValue(':nome', $usuario->getNome());
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->bindValue(':telefone', $usuario->getTelefone());

        $stmt->execute();
    }

    // APAGAR UM USUÁRIO
    public static function delete(Usuario $usuario){
        $delete = "
            DELETE FROM usuario
            WHERE id = :id
        ";

        $stmt = Conexao::obterConexao()->prepare($delete);

        $stmt->bindValue(':id', $usuario->getId());
        
        $stmt->execute();
    }

    // LER USUÁRIOS (formtato: JSON)
    public static function read(){
        $resultado = Conexao::obterConexao()->query(
            "
                SELECT * 
                FROM usuario;
            ");

        $jsonArray = [];
        
        while($row = $resultado->fetch(\PDO::FETCH_ASSOC)){ 
            $jsonArray[] = $row;
        }

        return $jsonArray;
    }

    // RETORNA UM USUÁRIO
    public static function readOne($usuario){
        $selectOne = "
            SELECT * 
            FROM usuario 
            WHERE id = '{$usuario->getId()}'
        ";

        $resultado = Conexao::obterConexao()->query($selectOne);
        
        while($row = $resultado->fetch(\PDO::FETCH_ASSOC)){ 
            $jsonArray[] = $row;
        }

        return $jsonArray;
    }
}