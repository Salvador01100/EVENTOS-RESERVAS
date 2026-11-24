<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
    require_once "Poo.php";

    $motor1 = new Motor;
    $motor1->modelo = "3008";
    $motor1->cor = "Azul";
    $motor1->marca = "Peugeot";


    var_dump($motor1);

    ?>
    
</body>
</html>