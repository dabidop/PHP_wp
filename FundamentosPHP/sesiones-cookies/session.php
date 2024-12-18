<?php

session_start();
    /*
    $user = "dabidop";

    $_SESSION["user"] = $user;
    echo $_SESSION["user"];
    
    echo "<br>" .  $_COOKIE["session"];
    */

?>
<!--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
</head>

<body>
    <form method="POST" action="" >
        Usuario: <input name="user" id="user" type="" text><br>
        Contraseña: <input type="password" name="password">
        <br><input type="submit" name="send" id="Iniciar sesión">
    </form>

    <br><a href="logout.php">Cerrar sesión</a>

    <?php
    /*
    if (isset($_POST["send"])) {
        $user = $_POST["user"];
        $password = $_POST["password"]; 

        if ($user == "dabidop" && $password == "1234") {
            echo "<br>Inicio de sesión exitoso";
            $_SESSION["user"] = $user;
        } else {
            echo "Invalid user or password";
        }
    }

    echo "<br>" . $_SESSION["user"];
    //session_destroy();
    */
    ?>
</body>

</html>
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST">
        Ingrese su nombre: <input type="text" name="name"><br>
        Ingrese su edad: <input type="text" name="age"><br>
        <input type="submit" name="send" id="" value="Send">
    </form>
    <a href="muestra_sesion.php">ir a ver</a>

    <?php

    if (isset($_POST["send"])) {
        $name = $_POST["name"];
        $age = $_POST["age"];
        $_SESSION["name"] = $name;
        $_SESSION["age"] = $age;
        echo "<br>" . $_SESSION["name"];
        echo "<br>" . $_SESSION["age"];
    }

    ?>
</body>

</html>