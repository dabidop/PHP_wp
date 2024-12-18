<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Número primo</title>
</head>

<body>
    <form action="" method="POST">
        Ingrese un valor: <input type="text" id="numero" name="numero">
        <input type="submit" value="Enviar">
    </form>
</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $contador = 0;
    $numero = $_POST["numero"];

    for ($i = 1; $i <= $numero; $i++) {
        if ($numero % $i == 0) {
            $contador++;
        }
    }
    if ($contador == 2) {
        echo "El número $numero es primo";
    } else {
        echo "El número $numero NO es primo";
    }
}
?>