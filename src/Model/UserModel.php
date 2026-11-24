<?php

class UserModel{
    private $conexao;
    

    public function __construct(){
        
        $conexaoBancoDeDados = new DataBase();
        $this->conexao = $conexaoBancoDeDados->conectarBancoDeDados(); // tenho que estudar melhor essas ligacoes 

    } 

    public function verificarEmail($email){

        $sql = "SELECT * FROM user WHERE email = :email LIMIT 1";

        $stm = $this->conexao->prepare($sql);
        $stm->bindParam(':email', $email);
        $stm->execute();

        return $stm->fetch(PDO::FETCH_ASSOC);

    }


    
    public function register($name, $email, $password, $telefone,$cidade){

        $sql = "INSERT INTO user (name, email, password, telefone, cidade) 
        VALUES (:name, :email, :password, :telefone, :cidade)";

        $stm = $this->conexao->prepare($sql);
        $stm->bindParam(':name', $name);
        $stm->bindParam(':email', $email);
        $stm->bindParam(':password', $password);
        $stm->bindParam(':telefone', $telefone);
        $stm->bindParam(':cidade', $cidade);

        return $stm->execute();

    } 

    public function login($email, $password){}
}