<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Barbeiros</h1>

    <?php foreach($barbeiros as $barbeiro): ?>
        <p><a href="<?= dirname($_SERVER['SCRIPT_NAME'])?>/reserva/barbeiro/<?= $barbeiro['id']?>/servicos">
            <?= ($barbeiro['nome']) ?></a></p>

    <?php endforeach ?>    

    
</body>
</html>