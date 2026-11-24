<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Servicos</h1>

    <?php foreach($servicos as $servico): ?>
        <p><strong>Barbeiros </strong>
            <a href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/reserva/barbeiro/<?= $_SESSION['barbeiro_id'] ?>/servicos/<?= $servico['id'] ?>/calendario">
                <?= ($servico['nome']) ?>
            </a>
        </p>

        <p>
            <strong>
                descricao 
            </strong>

            <?= ($servico['descricao']) ?>
        </p>
        <a href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/reserva/barbeiro/<?= $servico['id']?>/servicos/<?= $servico['id']?>/calendario">


        </a>
        <p>
            <strong>
                preco 
            </strong>

            <?= ($servico['preco']) ?>
        </p>
        
    <?php endforeach ?>
</body>
</html>