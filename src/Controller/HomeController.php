<?php

class HomeController {
    private $model;

    public function __construct(){
        $this->model = new ServicoModel();
    }

    public function home(){
        $servicos = $this->model->listarServicos();
        
        require_once __DIR__ . "/../View/Home/home.php";    
    }     
}