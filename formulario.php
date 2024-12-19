<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
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

    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $genero = $_POST['genero'];


    echo "Hola, $nombre. Tienes $edad años y eres género $genero";
}
?>