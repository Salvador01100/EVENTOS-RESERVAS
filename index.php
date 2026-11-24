<?php 

session_start();




require_once __DIR__ . '/vendor/autoload.php'; // ligar o composer ao projecto




$router = new AltoRouter(); // copiado
    $router->setBasePath(dirname($_SERVER['SCRIPT_NAME']));

    //RESPOSABELIDADE NOME DOS SERVICOS
    $router->map("GET", "/", "HomeController#home");
//_____________________________________________________________________________USER

    // RESPONSABELIDADE DE RESGISTRAR SERVICOS
    $router->map("GET|POST", "/register", "UserController#register");

    // RESPONSABELIDADE DE LOGAR
    $router->map("GET|POST", "/login", "UserController#login");


//_____________________________________________________________________________SERVICOS
    // RESPONSABELIDADE DE CRIAR SERVICOS
    $router->map("GET|POST", "/registroServicos", "ServicosController#criarServico");

//_____________________________________________________________________________RESERVA
    ;
    $router->map("GET", "/reserva", "ReservaController#escolherBarbeiro");
    $router->map("GET", "/reserva/barbeiro/[i:barbeiro_id]/servicos", "ReservaController#escolherServico");
    $router->map("GET", "/reserva/barbeiro/[i:barbeiro_id]/servicos/[i:servico_id]/calendario", "ReservaController#calendario");
    $router->map("GET","/reserva/barbeiro/[i:barbeiro_id]/servicos/[i:servico_id]/selecionarDia/[*:data]","ReservaController#selecionarDia");
    $router->map("GET","/reserva/barbeiro/[i:barbeiro_id]/servicos/[i:servico_id]/confirmacao","ReservaController#confirmacao");
    
    $router->map("POST","/reserva/barbeiro/[i:barbeiro_id]/servicos/[i:servico_id]/guardar","ReservaController#guardarReserva");


    

    $match = $router->match(); // copiado
     
    

    // TODO COPIADO 
    if (is_array($match)) { // verifica se a rota existe
        list($controller, $action) = explode("#", $match['target']); // verifica controller e o metudo
        $obj = new $controller(); // e cria a classe controller
       

       if(is_callable(array($obj, $action))) {
        call_user_func_array(array($obj, $action), $match['params']);
       } // verifica se metudo pode ser chamado

    } else {
        http_response_code(404);
    } 
