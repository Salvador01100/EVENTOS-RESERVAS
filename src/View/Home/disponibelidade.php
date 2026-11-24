<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Calendario</h1>

    <h3>
        Escolha o horário com <?= $barbeiro['nome'] ?>
    </h3>
    <p>
      
        Tipo de servico:<?= $servico['nome'] ?>
    </p>

    <?php foreach($disponibelidade as $disponibelidad): ?>
        
        <p>
            Dia: <?= $disponibelidad['dia_semana'] ?>
        </p>

        <p>
            Mes: <?= $disponibelidad['mes_ano'] ?>
        </p>

        <p>
            Das: <?= $disponibelidad['hora_inicio'] ?> 
            até
            <?= $disponibelidad['hora_fim'] ?><br><br>
        </p>
    <?php endforeach ?>

    

     <a href="/reserva/barbeiro/<?= $barbeiro['id']?>/servicos/<?= $servico['id']?>/confirmar">
        Confirmar
    </a><br>
        
    <a href="http://localhost/PHP/EVENTOS/">
        Voltar
    </a>


    
</body>
</html>