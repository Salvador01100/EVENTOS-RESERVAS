<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Pagina Official</h1>
    <?php if(!empty($servicos)): ?>
        <p>Foram encontrados <?= count($servicos); ?></p>

    <?php foreach($servicos as $servico): ?>

        <p><a href=""><strong>Nome:</strong> <?= ($servico['nome']); ?></a></p>
        <p><strong>Descrição:</strong> <?= ($servico['descricao']); ?></p>
        <p><strong>Preço:</strong> <?= ($servico['preco']); ?> €</p>
        <p><strong>Duração:</strong> <?= ($servico['duracao']); ?> minutos</p>

    <?php endforeach; ?>  
    <?php else: ?>  
        <p>Nao existem servicos registrados</p>
    <?php endif; ?> 
    
    <a href="/PHP/EVENTOS/reserva">Reserva</a><br>
    <a href="/PHP/EVENTOS/login">Login</a><br>
    <a href="/PHP/EVENTOS/register">Register</a><br>
    <a href="/PHP/EVENTOS/registroServicos">Adicionar Servicos</a><br>
        
</body>
</html>