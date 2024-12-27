<?php
session_start();
require '../../db.php'; // Conexión a la base de datos

// Verificar si el usuario es admin
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// Obtener el ID del usuario a editar
if (isset($_GET['author_id'])) {
    $author_id = $_GET['author_id'];

    // Obtener datos del usuario
    $stmt = $pdo->prepare("SELECT * FROM book_authors WHERE author_id = :author_id");
    $stmt->execute(['author_id' => $author_id]);
    $author = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$author) {
        echo "Autor no encontrado.";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recoger los nuevos datos
        $author_name = htmlspecialchars($_POST["author_name"]);

        // Actualizar el usuario
        $stmt = $pdo->prepare("UPDATE book_authors SET author_name = :author_name WHERE author_id = :author_id");
        $stmt->execute([
            'author_name' => $author_name,
            'author_id' => $author_id // Aseguramos que solo se actualice el autor correcto
        ]);


        header('Location: ../authors_list.php');
    }
} else {
    echo "No se ha proporcionado un ID del autor.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Editar libro</title>
</head>

<body>
    <h1 class="text-center">Editar libro</h1>

    <form method="POST" class="text-center">
        <label for="author_name">Nombre de libro:</label>
        <input type="text" name="author_name" value="<?php echo $author['author_name']; ?>" required><br><br>

        <a href="../authors_list.php" class="btn btn-danger btn-sm">Volver</a>
        <input type="submit" value="Actualizar" class="btn btn-sm btn-success">
    </form>

    <br>

</body>

</html>