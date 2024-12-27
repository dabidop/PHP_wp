<?php
session_start();
require '../../db.php'; // Conexión a la base de datos

// Verificar si el usuario es admin
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// Eliminar el usuario
if (isset($_GET['author_id'])) {
    $author_id = $_GET['author_id'];

    // Eliminar el usuario de la base de datos
    $stmt = $pdo->prepare("DELETE FROM book_authors WHERE author_id = :author_id");
    $stmt->execute(['author_id' => $author_id]);

    header('Location: ../authors_list.php');
} else {
    echo "No se ha proporcionado un ID de usuario.";
}
?>