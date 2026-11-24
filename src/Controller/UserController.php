<?php


class UserController{
    private $UserModel;

    public function __construct(){
        $this->UserModel = new UserModel(); 
    }

    public function register(){
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            //RECEBER OS DADOS COM SEGURANCA
            $name = htmlspecialchars(trim($_POST["name"]));
            $email = htmlspecialchars(trim($_POST["email"]));
            $password = $_POST["password"];
            $telefone = $_POST["telefone"];
            $cidade = htmlspecialchars(trim($_POST["cidade"]));

            //PARA VERIFICAR SE OS DADOS RECEBIDOS
            // var_dump($_POST);

            //VERIFICAR SE OS CAMPOS ESTAO VAZIOS
            if(empty($name) || empty($email) || empty($password) || empty($telefone)){
                $erro = "Os campos sao obrigatorios, Porfavor preencher";
                
            }

            // VERIFICAR SE EMAIL FOI BEM INSCRITO
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $erro = "Formato email invalido";
                
            }

            //VERIFICAR SE EMAIL EXISTE
            
    
            $password = password_hash($password, PASSWORD_DEFAULT);

            $inserirDadosBanco = $this->UserModel->register($name, $email, $password, $telefone,$cidade); // E AQUI QUE EU CONECTO COM CLASSE MODEL

                if($inserirDadosBanco){
                    
                    $sucesso = "Usurario registrado com sucesso";
                    require_once __DIR__ . '/../View/Home/home.php';
                    exit;
                    
                }else{
                    $erro = "erro ao registrar usuario";

                }
               
        }

      require_once __DIR__ . '/../View/Registro/registro.html';

    }
    
    public function login(){

    $erro = "";

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);

            if(empty($email) || empty($password)){
                $erro = "Por favor Prencher todos os campos se faz favor";
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $erro = "Formato email invalido";
            }

            if(empty($erro)){
                
                $procuraEmail = $this->UserModel->verificarEmail($email);
                // var_dump($procuraEmail);
                // exit;


                if(!$procuraEmail){
                    $erro = "Credenciais invalidas";
                } else {

                    if(password_verify($password, $procuraEmail["password"])){

                        
                        $_SESSION["user_id"] = $procuraEmail["id"];
                        $_SESSION["user_name"] = $procuraEmail["name"];

                        header("Location: /PHP/EVENTOS/");
                        exit;

                    } else {
                        $erro = "Credenciais invalidas";
                    }

                }

            }    

        }

        require_once __DIR__ . '/../View/Registro/login.html';
        
    }

    public function home(){

    require_once __DIR__ . '/../View/Home/home.php';
    
    }
}