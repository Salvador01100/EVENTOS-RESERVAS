<?php

class ServicoModel {
    private $conexao; // Conecao remoto
    private $dataBase; // objecto DataBase

    public function __construct(){
        $this->dataBase = new DataBase();
        $this->conexao = $this->dataBase->conectarBancoDeDados();
    }

    public function criarServicos($nome, $descricao, $preco, $duracao){
        $sql = "INSERT INTO servicos
        (nome, descricao, preco, duracao) VALUES (:nome, :descricao, :preco, :duracao)";

        $stm = $this->conexao->prepare($sql);

        $stm->bindParam(":nome" , $nome);
        $stm->bindParam(":descricao" , $descricao);
        $stm->bindParam(":preco" , $preco);
        $stm->bindParam(":duracao" , $duracao);

        return $stm->execute();

    }

    public function listarServicos(){
        $sql = "SELECT * FROM servicos";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $servicos = $stm->fetchAll(PDO::FETCH_ASSOC);
        
        return $servicos;
    }
}