<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>
    Calendário
</h1>

<h2>
    <?= $nomeMes ?> <?= $ano ?>
</h2>


<table>

    <!-- Dias da semana -->
    <tr>
        <th>Seg</th>
        <th>Ter</th>
        <th>Qua</th>
        <th>Qui</th>
        <th>Sex</th>
        <th>Sáb</th>
        <th>Dom</th>
    </tr>


    <tr>

        <?php

        // Começa a contar a posição da semana
        $coluna = 1;


        // Criar espaços vazios antes do dia 1
        for ($i = 1; $i < $primeiroDiaSemana; $i++) :

        ?>

            <td></td>

        <?php

            $coluna++;

        endfor;


        // Criar os dias do mês
        for ($dia = 1; $dia <= $diasDoMes; $dia++) :

        ?>

            <td>

                <?php if (in_array($dia, $diasIndisponiveis)) : ?>

                    <!-- Dia indisponível -->
                    <span style = "color: red">
                        <?= $dia ?>
                    </span>


                <?php else : ?>

                    <!-- Dia disponível -->
                    <a href="/PHP/EVENTOS/reserva/barbeiro/<?= $barbeiro_id ?>/servicos/<?= $servico_id ?>/selecionarDia/<?= $ano ?>-<?= $mes ?>-<?= $dia ?>">
                        <?= $dia ?>
                    </a>

                <?php endif; ?>

            </td>


        <?php

            $coluna++;


            // Quando chega ao domingo cria nova linha
            if ($coluna > 7) :

        ?>

    </tr>

    <tr>

        <?php

            $coluna = 1;

            endif;


        endfor;

        ?>

    </tr>

</table>

<hr>

<hr>

<h3>Horários disponíveis</h3>

<?php if (isset($todosOsHorarios)): ?>
    <?php foreach ($todosOsHorarios as $hora): ?>
        
        

        <?php if (in_array($hora, $horariosOcupados)): ?>

            <a style="color:red;">
                <?= $hora ?> - Ocupado
            </a><br>

        <?php else: ?>

            <a href="/PHP/EVENTOS/reserva/barbeiro/<?= $barbeiro_id ?>/servicos/<?= $servico_id ?>/confirmacao?data=<?= $dataSelecionada ?>&hora=<?= urlencode($hora) ?>">
                <?= $hora ?> - Disponível
            </a>
            <br>

        <?php endif; ?>

    <?php endforeach; ?>

    <?php if (isset($_SESSION['mensagem'])): ?>

        <p style="color: green;">
            <?= $_SESSION['mensagem'] ?>
        </p>

    <?php unset($_SESSION['mensagem']); ?>

    <?php endif; ?>

<?php endif; ?>    

</body>
</html>