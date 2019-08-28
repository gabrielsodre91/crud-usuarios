<?php

namespace App\Model;

class InicializarBanco {
    // INSTÂNCIA DO BANCO
    private static $banco;
    
    // INICIALIZAR O BANCO
    public static function criarBanco(){
        // CRIAR ARQUIVO DO BANCO
        self::$banco = new \PDO('sqlite:crud-usuarios.sqlite3');
        self::$banco->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        // CRIAR TABELA DE USUÁRIOS
        self::criarTabelaUsuarios();
    }

    // TABELA DE USUÁRIOS
    private static function criarTabelaUsuarios(){
        self::$banco->exec(
            "
                CREATE TABLE IF NOT EXISTS usuario (
                id INTEGER PRIMARY KEY, 
                nome TEXT, 
                email TEXT, 
                telefone TEXT);
            "
        );
    }
}