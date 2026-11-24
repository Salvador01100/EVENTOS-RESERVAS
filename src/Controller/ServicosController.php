<?php


class ServicosController {
    private $model;

    public function __construct(){
        $this->model= new ServicoModel();
    }

    public function criarServico(){
        //RECEBER OS DADOS
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $nome = htmlspecialchars(trim($_POST["nome"]));
            $descricao = htmlspecialchars(trim($_POST["descricao"]));
            $preco = trim($_POST["preco"]);
            $duracao = trim($_POST["duracao"]);

            //VERIFICAR OS DADOS QUE EU RECEBI
            // var_dump($_POST);
            // exit;

            //VERIFICAR SE ESTA VAZIO
            if(empty($nome) || empty($descricao) || empty($preco) || empty($duracao)){
                $erro = "Os campos sao obrigatorios a preencher por favor preencher";
                return;
            }

            //VERIFICAR SE E NUMERO
            if(!is_numeric($preco) || !is_numeric($duracao)){
                $erro = "Porfavor devo preencher os campos com numero";
                return;
            }

            //VERIFICAR SE JA ESTA REGISTRADO ESSE SERVICO
            

            //INSERIR DADOS NO BANCO
            $inserirDadosBanco = $this->model->criarServicos($nome, $descricao, $preco, $duracao);

            if($inserirDadosBanco){
                $socesso = "Os dados Foram bem recebidos";
                require_once __DIR__ . "/../View/Home/home.html";
                exit;

            } else {
                $erro = "Os dados nao foram bem recebidos";
                exit;
            }

        }
        require_once __DIR__ . "/../View/RegistrarServicos/registrarServicos.html";
    }

    public function listar(){
        echo "cheguei a te controller";
        exit;

        // $servicos = $this->model->listarServicos();
        // var_dump($servicos);
        // die();

        // if(empty($servicos)){
        //     echo "Nao temos servicos listados aqui";
        //     exit;

        // } else {
        //     require_once __DIR__ . "/../View/Home/home.php";
        // }
    
    }
}