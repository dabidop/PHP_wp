<?php
session_start();
require '../../db.php'; // Conexión a la base de datos

// Verificar si el usuario es admin
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}

// Eliminar el usuario
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el usuario de la base de datos
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);

    echo "Usuario eliminado correctamente. <a href='../list_users.php'>Ver usuarios</a>";
} else {
    echo "No se ha proporcionado un ID de usuario.";
}
?>