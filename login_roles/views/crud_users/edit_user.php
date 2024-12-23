<?php
session_start();
require '../../db.php'; // Conexión a la base de datos

// Verificar si el usuario es admin
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}

// Obtener el ID del usuario a editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener datos del usuario
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Usuario no encontrado.";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recoger los nuevos datos
        $username = htmlspecialchars($_POST["username"]);
        $role = htmlspecialchars($_POST["role"]);

        // Actualizar el usuario
        $stmt = $pdo->prepare("UPDATE users SET username = :username, role = :role WHERE id = :id");
        $stmt->execute([
            'username' => $username,
            'role' => $role,
            'id' => $id
        ]);

        echo "Usuario actualizado correctamente. <a href='../list_users.php'>Ver usuarios</a>";
    }
} else {
    echo "No se ha proporcionado un ID de usuario.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Editar Usuario</title>
</head>
<body>
    <h1 class="text-center">Editar Usuario</h1>

    <form method="POST" class="text-center">
        <label for="username">Usuario:</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br><br>

        <label for="role">Rol:</label>
        <select name="role" required>
            <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Administrador</option>
            <option value="user" <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>Usuario</option>
        </select><br><br>

        <a href="../list_users.php" class="btn btn-danger btn-sm">Volver</a>
        <input type="submit" value="Actualizar" class="btn btn-sm btn-success">
    </form>

    <br>
    
</body>
</html>
