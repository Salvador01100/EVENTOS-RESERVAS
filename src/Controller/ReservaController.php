<?php 

class ReservaController {
    private $model;

    public function __construct(){
        $this->model= new ReservaModel();
    }

    public function escolherBarbeiro(){
        
        $barbeiros = $this->model->listarBarbeiro();
        require_once __DIR__ . "/../View/Home/barbeiros.php";
    }

    public function escolherServico($barbeiro_id){
        $_SESSION["barbeiro_id"] = $barbeiro_id;
        $servicos = $this->model->listarServico();
        require_once __DIR__ . "/../View/Home/servicos.php";
    }

    // public function escolherData($barbeiro_id, $servico_id){
    //     $_SESSION['barbeiro_id'] = $barbeiro_id;
    //     $_SESSION['servico_id'] = $servico_id;

    //     $barbeiro = $this->model->buscarBarbeiro($barbeiro_id);
    //     $servico = $this->model->buscarservico($servico_id);
    //     $disponibelidade = $this->model->mostrarDisponibilidade($barbeiro_id);

    //     require_once __DIR__ . "/../View/Home/calendario.php";

    // }

    public function calendario($barbeiro_id, $servico_id){
    $_SESSION['barbeiro_id'] = $barbeiro_id;
    $_SESSION['servico_id'] = $servico_id;   
  
    //buscar data actualisada
    $dataCalendario = new DateTime();
    $ano = $dataCalendario->format('Y');
    $mes = $dataCalendario->format('m');
    $nomeMes = $dataCalendario->format('F');
    $diasDoMes = $dataCalendario->format('t');
    $primeiroDia = new DateTime("$ano-$mes-01");
    $primeiroDiaSemana = $primeiroDia->format('N');

    // Buscar dias e horários de trabalho do barbeiro
    $disponibilidade = $this->model->buscarDiasIndisponiveis($barbeiro_id);
       $diasIndisponiveis = [];

       for ($dia = 1; $dia <= $diasDoMes; $dia++) {

        // Criar a data completa do dia
        $data = new DateTime("$ano-$mes-$dia");

        // Número do dia da semana (1 Segunda até 7 Domingo)
        $diaSemana = $data->format('N');


        // Verificar se o barbeiro trabalha nesse dia
        $trabalha = false;

        foreach ($disponibilidade as $diaDisponivel) {

            if ($diaDisponivel['dia_semana'] == $diaSemana) {
                $trabalha = true;
                break;
            }

        }


        // Se não trabalha nesse dia, guardar como indisponível
        if (!$trabalha) {
            $diasIndisponiveis[] = $dia;
        }

    }


    // Buscar todas as reservas do mês
    $reservas = $this->model->buscarReservasMes($barbeiro_id, $ano, $mes);   



    require_once __DIR__ . "/../View/Home/calendario.php";
    }

    public function selecionarDia($barbeiro_id, $servico_id, $data){
        // Guardar dados escolhidos
        $_SESSION['barbeiro_id'] = $barbeiro_id;
        $_SESSION['servico_id'] = $servico_id;
        $_SESSION['data'] = $data;


        // Descobrir dia da semana
        $dataObj = new DateTime($data);
        $diaSemana = $dataObj->format('N');


        // Buscar disponibilidade do barbeiro nesse dia
        $disponibilidade = $this->model->buscarDisponibilidade($barbeiro_id, $diaSemana);

        // Gerar horários
        $todosOsHorarios = [];

        if (!empty($disponibilidade)){

            $horaInicio = $disponibilidade[0]['hora_inicio'];
            $horaFim = $disponibilidade[0]['hora_fim'];

            $todosOsHorarios = $this->model->gerarHorarios($horaInicio,$horaFim,30);
        }


        // Buscar horários já reservados
        $horariosOcupados = $this->model->horariosOcupados(
            $barbeiro_id,
            $data
        );


        // Dias indisponíveis (para manter o calendário)
        $diasIndisponiveis = $this->model->buscarDisponibilidade($barbeiro_id, $diaSemana);


        // Dados do calendário
        $dataCalendario = new DateTime();

        $ano = $dataCalendario->format('Y');
        $mes = $dataCalendario->format('m');
        $nomeMes = $dataCalendario->format('F');
        $diasDoMes = $dataCalendario->format('t');

        $primeiroDia = new DateTime("$ano-$mes-01");
        $primeiroDiaSemana = $primeiroDia->format('N');

        $dataSelecionada = $data;

        require_once __DIR__ . "/../View/Home/calendario.php";
    }

    public function confirmacao($barbeiro_id, $servico_id){
        $data = $_GET['data'];
        $hora = $_GET['hora'];

        $barbeiro = $this->model->buscarBarbeiro($barbeiro_id);
        $servico = $this->model->buscarServico($servico_id);

        require_once __DIR__ . "/../View/Home/comfirmacao.php";
       
    }

    public function guardarReserva($barbeiro_id, $servico_id){
        $data = $_POST['data'];
        $hora = $_POST['hora'];

        $this->model->guardarReserva(
            
            $barbeiro_id,
            $servico_id,
            $data,
            $hora
        );

        $_SESSION['mensagem'] = "Reserva confirmada com sucesso!";

        header(
            "Location: /PHP/EVENTOS/reserva/barbeiro/"
            . $barbeiro_id
            . "/servicos/"
            . $servico_id
            . "/calendario"
        );

        exit;
      
    }
}    