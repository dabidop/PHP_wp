<?php
session_start();
require '../../db.php'; // Conexión a la base de datos
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Create author</title>
</head>

<body>
    <div class="container text-center">
        <h1>Crear autor</h1>
        <form method="POST">
            <label for="author_name">Nombre de autor:</label>
            <input type="text" name="author_name" required><br><br>
            <a href="../authors_list.php" class="btn btn-sm btn-warning">Volver</a>
            <input type="submit" value="Registrar" class="btn btn-sm btn-success">
        </form>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $author_name = htmlspecialchars($_POST["author_name"]);

        // Verificar si el usuario ya existe
        $stmt = $pdo->prepare("SELECT * FROM book_authors WHERE author_name = :author_name");
        $stmt->execute(['author_name' => $author_name]);
        if ($stmt->rowCount() > 0) {
            echo "El autor ya existe. Intenta con otro.";
        } else {
            // Registrar autor
            $stmt = $pdo->prepare("INSERT INTO book_authors (author_name) VALUES (:author_name)");
            $stmt->execute([
                'author_name' => $author_name
            ]);
            header('Location: ../authors_list.php');
        }
    }

    ?>
</body>

</html>