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
    <title>Registro de libro</title>
</head>

<body>
    <div class="container text-center">
        <h1>Crear libro</h1>
        <form method="POST">
            <label for="book_name">Nombre libro:</label>
            <input type="text" name="book_name" required><br><br>
            <label for="book_description">Descripción:</label>
            <input type="text" name="book_description" required><br><br>
            <label for="book_author">Autor:</label>
            <input type="number" name="book_author" required><br><br>
            <label for="book_user">Usuario:</label>
            <input type="number" name="book_user" required><br><br>
            <a href="../books_list.php" class="btn btn-sm btn-warning">Volver</a>
            <input type="submit" value="Registrar" class="btn btn-sm btn-success">
        </form>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $book_name = htmlspecialchars($_POST["book_name"]);
        $book_description = htmlspecialchars($_POST["book_description"]);
        $book_author = htmlspecialchars($_POST["book_author"]);
        $book_user = htmlspecialchars($_POST["book_user"]);

        // Verificar si el autor si existe
        $stmt = $pdo->prepare("SELECT * FROM book_authors WHERE author_id = :book_author");
        $stmt->execute(['book_author' => $book_author]);
        if ($stmt->rowCount() > 0) {
            $stmt = $pdo->prepare("INSERT INTO books (book_name, book_description, author, user_id)
            VALUES (:book_name, :book_description, :book_author, :book_user)");
            $stmt->execute([
                'book_name' => $book_name,
                'book_description' => $book_description,
                'book_author' => $book_author,
                "book_user" => $book_user
            ]);
            header("Location: ../books_list.php");
        } else {
            echo "El autor no existe. Intenta con otro.";            
        }
    }

    ?>
</body>

</html>