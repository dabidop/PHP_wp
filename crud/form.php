<?php

$server = "localhost";
$user = "root";
$pass = "";
$db = "bd_practica";

$link = mysqli_connect($server, $user, $pass, $db);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Formulario de registro</title>
</head>

<body>
    <div class="text-center">
        <br>
        <h1>Registrar un usuario</h1>
        <br>
        <form method="POST" action="">
            <label for="username">Username</label>
            <input type="text" name="username">
            <br><br><label for="password">password</label>
            <input type="password" name="password">
            <br><br><label for="role">Role</label>
            <input type="text" name="role">
            <br><br><input type="submit" name="send" value="Register">
        </form>
    </div>

    <?php
    
    if (isset($_POST["send"])) {
        if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["role"])) {
            echo "Por favor, diligencie todos los campos";
        } else {
            $username = htmlspecialchars($_POST["username"]);
            //contraseña y encriptación con bcrypt
            $password = htmlspecialchars($_POST["password"]);
            $hash_pass = password_hash($password, PASSWORD_BCRYPT);
            echo $hash_pass;

            $role = htmlspecialchars($_POST["role"]);

            if (true) {

            }
        }
    }
    
    ?>
</body>

</html>