<?php

namespace App\Model;

class Conexao {
    // INSTÂNCIA DO BANCO DE DADOS PARA SINGLETON
    private static $instancia;

    // OBTER A INSTÂNCIA, SE HOUVER. OU CRIAR, CASO NÃO HAJA.
    public static function obterConexao(){
        if(!isset(self::$instancia)){
            self::$instancia = new \PDO("sqlite:crud-usuarios.sqlite3");
        }

        return self::$instancia;
    }
}