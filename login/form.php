<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <div class="text-center">
        <h2>
            Incio de sesión
        </h2>
        <br>
        <form action="" method="POST">
            <label for="user">Usuario:</label>
            <input type="text" name="user"><br><br>
            <label for="pass">Contraseña:</label>
            <input type="password" name="pass"><br><br>
            <input type="submit" value="send" name="send">
        </form>
    </div>

    <?php

    $users = [
        "dabidop" => "12345",
        "user1" => "contra1",
        "user2" => "contra2",
        "user3" => "contra3",
        "user4" => "contra4",
        "user5" => "contra5",
        "usuarioComplejo" => "contraseñaCompleja1@"
    ];

    if (isset($_POST["send"])) {
        if (empty($_POST["user"]) || empty($_POST["pass"])) {
            echo "Por favor diligencie ambos campos";
            echo "<br>" . $_SESSION["user"];
        } else {
            $user = htmlspecialchars($_POST["user"]);
            $pass = htmlspecialchars($_POST["pass"]);

            if (isset($users[$user]) && $users[$user] === $pass) {
                $_SESSION["user"] = $user;
                $_SESSION["pass"] = $pass;
                echo "Has iniciado sesión de manera exitosa, " . $_SESSION["user"];
                header("Location: index.php");
                exit();
            } else {
                echo "usuario o contarseña inválidos";
            }
        }
    }

    ?>
</body>

</html>