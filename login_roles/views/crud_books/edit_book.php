<?php
session_start();
require '../../db.php'; // Conexión a la base de datos

// Verificar si el usuario es admin
//if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "admin") {
//    header("Location: login.php");
//    exit();
//}

// Obtener el ID del usuario a editar
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    // Obtener datos del usuario
    $stmt = $pdo->prepare("SELECT * FROM books WHERE book_id = :book_id");
    $stmt->execute(['book_id' => $book_id]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book) {
        echo "Libro no encontrado.";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recoger los nuevos datos
        $book_name = htmlspecialchars($_POST["book_name"]);
        $book_description = htmlspecialchars($_POST["book_description"]);
        $book_author = htmlspecialchars($_POST["book_author"]);
        $user_id = htmlspecialchars($_POST["user_id"]);

        // Actualizar el usuario
        $stmt = $pdo->prepare("UPDATE books SET book_name = :book_name, book_description = :book_description,
        author = :book_author
        WHERE book_id = :book_id");
        $stmt->execute([
            'book_name' => $book_name,
            'book_description' => $book_description,
            'author' => $book_author,
            'user_id' => $user_id,
            'book_id' => $book_id
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
    <link rel="stylesheet" href="../../style.css">
    <title>Editar libro</title>
</head>

<body>
    <h1 class="text-center">Editar libro</h1>

    <form method="POST" class="text-center">
        <label for="book_name">Nombre de libro:</label>
        <input type="text" name="book_name" value="<?php echo $book['book_name']; ?>" required>
        <br><br>
        <label for="book_description">Descripción:</label>
        <input type="text" name="book_description" value="<?php echo $book['book_description']; ?>" required>
        <br><br>
        <?php // echo $book["author"]//impresión del id del autor ?>
        <label for="book_author">Nombre de autor:</label>
        <!--<select name="book_author" id="author" required>
            <option value="<?php //echo $book["author"] ?>" disabled selected></option>
            <?php
            // Consulta para obtener todos los autores
            /*$stmt = $pdo->prepare("SELECT author_id, author_name FROM book_authors");
            $stmt->execute();
            $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Recorrer y generar las opciones del select
            foreach ($authors as $author) {
                echo "<option value='" . $author['author_id'] . "'>" . htmlspecialchars($author['author_name']) . "</option>";
            }*/
            ?>
        </select>-->
        <select name="book_author" id="author" required>
            <?php
            // Consultar el autor que tiene este libro
            $current_author_id = $book['author']; // Este es el author_id del libro

            // Consulta para obtener todos los autores
            $stmt = $pdo->prepare("SELECT author_id, author_name FROM book_authors");
            $stmt->execute();
            $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Recorrer y generar las opciones del select
            foreach ($authors as $author) {
                // Verificar si es el autor actual y marcarlo como seleccionado
                $selected = ($author['author_id'] == $current_author_id) ? "selected" : "";
                echo "<option value='" . $author['author_id'] . "' $selected>" . htmlspecialchars($author['author_name']) . "</option>";
            }
            ?>
        </select>
        <br><br>

        <a href="../books_list.php" class="btn btn-danger btn-sm">Volver</a>
        <input type="submit" value="Actualizar" class="btn btn-sm btn-success">
    </form>

    <br>

</body>

</html>