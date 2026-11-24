<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
 <h1>Confirmar reserva</h1>

    <h2>Detalhes da reserva</h2>

    <p>
        <strong>Barbeiro:</strong>
        <?= htmlspecialchars($barbeiro['nome']) ?>
    </p>

    <p>
        <strong>Serviço:</strong>
        <?= htmlspecialchars($servico['nome']) ?>
    </p>

    <p>
        <strong>Data:</strong>
        <?= htmlspecialchars($data) ?>
    </p>

    <p>
        <strong>Hora:</strong>
        <?= htmlspecialchars($hora) ?>
    </p>


    <hr>


    <!-- Confirmar -->
    <form
        method="POST"
        action="/PHP/EVENTOS/reserva/barbeiro/<?= $barbeiro['id'] ?>/servicos/<?= $servico['id'] ?>/guardar"
    >

        <input
            type="hidden"
            name="data"
            value="<?= htmlspecialchars($data) ?>"
        >

        <input
            type="hidden"
            name="hora"
            value="<?= htmlspecialchars($hora) ?>"
        >

        <button type="submit">
            Confirmar reserva
        </button>

    </form>


    <!-- Cancelar -->
    <br>

    <a
        href="/PHP/EVENTOS/reserva/barbeiro/<?= $barbeiro['id'] ?>/servicos/<?= $servico['id'] ?>/calendario"
    >
        Cancelar
    </a>

</body>
</html>