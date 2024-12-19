<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
</head>
<body>
    <h1>
        Esta es la página del usuario común
    </h1>

    <?php
    echo $_SESSION["username"];
        
    ?>
    <form method="POST">
    <br><button type="submit" method="POST" name="logout2" >Cerrar sesión</button>
    </form>
    <?php
    
    if (isset($_POST["logout2"])) {
        session_destroy();
        header("Location: login.php");
        exit();
    }
    
    ?>
</body>
</html>