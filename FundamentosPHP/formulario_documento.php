<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario y documento</title>
</head>

<body>
    <form action="" method="post">
        Por favor, ingrese su nombre<input type="text" name="nombre" id="nombre">
        <br>Por favor, ingrese su edad<input type="text" name="edad" id="edad">
        <br>Por favor, ingrese su género<input type="text" name="genero" id="" genero>
        <br><input type="submit" value="Enviar">
    </form>
</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $documento = "archivito.txt";

    if (file_exists($documento)) {
        
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $genero = $_POST['genero'];


        $escribir_documento = fopen($documento, "w");
        fwrite($escribir_documento, "Hola, soy $nombre. Tengo $edad años y soy género $genero");
        $leer_documento = file_get_contents($documento);
        echo $leer_documento;
        fclose($escribir_documento);
    } else {
        echo "El documento no existe";
    }
}

?>