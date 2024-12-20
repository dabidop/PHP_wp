<?php
require 'db.php'; // Conexión a la base de datos
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Registro de Usuario</title>
</head>
<body>
    <div class="text-center">
    <h1>Registro</h1>
    <form method="POST">
        <label for="username">Usuario:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br><br>
        <label for="role">Rol:</label>
        <select name="role" required>
            <option value="admin">Administrador</option>
            <option value="user">Usuario</option>
        </select><br><br>
        <input type="submit" value="Registrar">
    </form>
    </div>
    <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST["username"]);
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Encriptar la contraseña
        $role = htmlspecialchars($_POST["role"]);
    
        // Verificar si el usuario ya existe
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        if ($stmt->rowCount() > 0) {
            echo "El usuario ya existe. Intenta con otro.";
        } else {
            // Registrar usuario
            $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
            $stmt->execute([
                'username' => $username,
                'password' => $password,
                'role' => $role,
            ]);
            echo "Usuario registrado correctamente. <a href='login.php'>Iniciar sesión</a>";
        }
    }
    
    ?>
</body>
</html>
