<?php 

class ReservaModel {
    private $conexao; // Conecao remoto
    private $dataBase; // objecto DataBase

    public function __construct(){
        $this->dataBase = new DataBase();
        $this->conexao = $this->dataBase->conectarBancoDeDados();
    }

    public function listarBarbeiro(){
        
        $sql = "SELECT * FROM barbeiros";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $barbeiros = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $barbeiros;
    }

    public function listarServico(){

        $sql = "SELECT * FROM servicos";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $servicos = $stm->fetchAll(PDO::FETCH_ASSOC);
        
        return $servicos;
    }

    public function buscarBarbeiro($id){
        $sql = "SELECT * FROM barbeiros WHERE id = :id";

        $stm = $this->conexao->prepare($sql);
        $stm->bindParam(":id", $id, PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarservico($id){
        $sql = "SELECT * FROM servicos WHERE id = :id";

        $stm = $this->conexao->prepare($sql);
        $stm->bindParam(":id", $id, PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function horariosOcupados($barbeiroId, $data){

        $sql = "SELECT hora
                FROM reservas
                WHERE barbeiro_id = :barbeiroId
                AND data = :data";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':barbeiroId', $barbeiroId);
        $stmt->bindParam(':data', $data);

        $stmt->execute();

        $horas =  $stmt->fetchAll(PDO::FETCH_COLUMN);
        foreach ($horas as &$hora) {
        $hora = substr($hora, 0, 5);
        }
        
        return $horas;

    }

    public function buscarDiasIndisponiveis($barbeiro_id){
        $sql = "SELECT *
                FROM disponibilidade
                WHERE barbeiro_id = :barbeiro_id";

        $stm = $this->conexao->prepare($sql);
        $stm->bindParam(":barbeiro_id", $barbeiro_id, PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarDisponibilidade($barbeiro_id, $diaSemana){
        $sql = "SELECT *
                FROM disponibilidade
                WHERE barbeiro_id = :barbeiro_id
                AND dia_semana = :dia_semana";

        $stm = $this->conexao->prepare($sql);

        $stm->bindParam(":barbeiro_id", $barbeiro_id, PDO::PARAM_INT);
        $stm->bindParam(":dia_semana", $diaSemana, PDO::PARAM_INT);

        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gerarHorarios($horaInicio, $horaFim, $duracao){
        $horarios = [];

        $hora = new DateTime($horaInicio);
        $fim = new DateTime($horaFim);

        while ($hora < $fim) {

            $horarios[] = $hora->format('H:i');

            $hora->modify("+{$duracao} minutes");
        }

        return $horarios;
    }

    public function buscarReservasMes($barbeiro_id, $ano, $mes){
        $sql = "SELECT * 
            FROM reservas
            WHERE barbeiro_id = :barbeiro_id
            AND YEAR(data) = :ano
            AND MONTH(data) = :mes";

            $stm = $this->conexao->prepare($sql);
            $stm->bindParam(":barbeiro_id", $barbeiro_id, PDO::PARAM_INT);
            $stm->bindParam(":ano", $ano, PDO::PARAM_INT);
            $stm->bindParam(":mes", $mes, PDO::PARAM_INT);
            $stm->execute();

        $reservas =  $stm->fetchAll(PDO::FETCH_ASSOC);

        return $reservas;
    }

    public function confirmar(){}

    public function guardarReserva($barbeiro_id, $servico_id, $data, $hora){
        $sql = "INSERT INTO reservas 
            (barbeiro_id, servico_id, data, hora, status)
            VALUES
            (:barbeiro_id, :servico_id, :data, :hora, :status)";

        $stm = $this->conexao->prepare($sql);

        $status = "confirmada";

        $stm->bindParam(":barbeiro_id", $barbeiro_id, PDO::PARAM_INT);
        $stm->bindParam(":servico_id", $servico_id, PDO::PARAM_INT);
        $stm->bindParam(":data", $data);
        $stm->bindParam(":hora", $hora);
        $stm->bindParam(":status", $status);
        $stm->execute();

        return true;
    }

}