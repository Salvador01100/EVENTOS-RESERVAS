<?php

// PROGRAMA ORIENTADA DE OBJECTOS

class Motor {

    public $marca;
    public $modelo;
    public $cor;

    //metudos 
    public function barulho(){}
    public function andar(){}

    public function ligar(){
        echo "Motor ligado";
    }
}

// Criar uma classe 
class Carro {
    private $motor;

    // executa automaticamente
    public function __construct(){
        $this->motor = new Motor();
    }

    // Criar Relacao
    public function ligarCarro(){
        $this->motor->ligar();
    }
}




