<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Inicio de sesión</title>
</head>

<body>
    <div class="text-center">
        <h1>
            Login
        </h1>
        <br>
        <form action="" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username">
            <br><br><label for="password">Password</label>
            <input type="password" name="password">
            <br><br><input type="submit" name="send" value="Iniciar sesión">
        </form>
    </div>

    <?php

    $users2 = [
        "admin" => ["password" => "12345", "role" => "admin"],
        "user1" => ["password" => "contra1", "role" => "user"],
        "user2" => ["password" => "contra2", "role" => "user"],
        "user3" => ["password" => "contra3", "role" => "user"],
        "user4" => ["password" => "contra4", "role" => "user"]
    ];


    if (isset($_POST["send"])) {
        if (empty($_POST["username"]) || empty($_POST["password"])) {
            echo "Por favor, diligencie ambos campos";
        } else {
            $username = htmlspecialchars($_POST["username"]);
            $password = htmlspecialchars($_POST["password"]);

            if (isset($users2[$username]) && $users2[$username]["password"] === $password) {
                echo "Has iniciado sesión de manera exitosa";
                $_SESSION["username"] = $username;
                if ($users2[$username]["role"] == "admin") {
                    header ("Location: admin.php");
                    exit();
                } elseif ($users2[$username]["role"] == "user") {
                    header("Location: user.php");
                    exit();
                }
            } else {
                echo "Problema al iniciar sesión";
            }
        }
    }

    ?>
</body>

</html>