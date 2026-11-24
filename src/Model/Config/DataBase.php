<?php

class DataBase {

    public function conectarBancoDeDados(){
    // configuracoes de banco de dado 
    $host = "localhost";
    $dbname = "eventos";
    $username = "root";
    $password = "";

    try {
        //Conexao com banco de dados 
        $conexaoBancoDeDados = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        return $conexaoBancoDeDados;
        
    } catch (PDOException $e) {
        // Se tiver algum erro vai aparecer um texto a indicar
        die("Erro DB: " .  $e->getMessage());
        
    }
    }
}     