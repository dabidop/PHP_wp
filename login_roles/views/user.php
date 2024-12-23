<?php

session_start();

if (isset($_POST["logout2"])) {
    session_destroy();
    session_unset();
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
</head>
<body>
    <h1>
        Esta es la página del usuario común
    </h1>

    <?php
    echo $_SESSION["username"];
    ?>
    <form method="POST">
    <br><button type="submit" name="logout2" >Cerrar sesión</button>
    </form>

</body>
</html>