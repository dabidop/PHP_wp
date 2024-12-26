<?php

session_start();

if (!isset($_SESSION["username"])) {
  header("Location: login.php");
}

require "../db.php";

// Obtener el rol del usuario desde la sesión (asumimos que está guardado como 'user_role')
$userRole = $_SESSION["role"]; // Puede ser 'admin' o 'user'
$userId = $_SESSION["user_id"]; // ID del usuario (asumimos que lo tienes en la sesión)

// Definir cuántos libros se mostrarán por página
$perPage = 5; // 5 libros por página

// Obtener el número de la página actual desde la URL, por defecto será la página 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calcular el OFFSET (desde qué registro empezar)
$offset = ($page - 1) * $perPage;

// Obtener el total de libros para calcular el número total de páginas
if ($userRole === 'admin') {
    $totalBooksStmt = $pdo->query("SELECT COUNT(*) FROM books");
} else {
    $totalBooksStmt = $pdo->prepare("SELECT COUNT(*) FROM books WHERE user_id = :user_id");
    $totalBooksStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
}
$totalBooksStmt->execute();
$totalBooks = $totalBooksStmt->fetchColumn();
$totalPages = ceil($totalBooks / $perPage);

// Obtener los libros para la página actual
if ($userRole === 'admin') {
    $stmt = $pdo->prepare("
        SELECT 
        b.book_id, 
        b.book_name, 
        ba.author_name, 
        u.username AS user_name, 
        b.created_at
    FROM books b
    INNER JOIN book_authors ba ON b.author = ba.author_id
    INNER JOIN users u ON b.user_id = u.id
    LIMIT :limit OFFSET :offset
    ");
} else {
    $stmt = $pdo->prepare("
        SELECT 
        b.book_id, 
        b.book_name, 
        ba.author_name, 
        u.username AS user_name, 
        b.created_at
    FROM books b
    INNER JOIN book_authors ba ON b.author = ba.author_id
    INNER JOIN users u ON b.user_id = u.id
    WHERE b.user_id = :user_id
    LIMIT :limit OFFSET :offset
    ");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
}

$stmt->bindParam(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["logout"])) {
  session_destroy();
  session_unset();
  header("Location: ./login.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../style.css">
  <title>Books</title>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <?php include "../sidebar.php"; ?>
      <div id="content" class="col-md-10">
        <button id="toggleSidebar" class="btn btn-primary mb-3">☰</button>

        <div class="container-fluid text-center">
          <div class="row align-items-center">
            <div class="col-6">
              <h2>Lista de libros</h2>
            </div>
            <div class="col-6">
                <a href="./crud_books/create_book.php" class="btn btn-success btn-sm">Crear nuevo +</a>
            </div>
          </div>
          <table class="table table-striped table-bordered">
            <thead class="table-dark">
              <tr>
                <th>ID libro</th>
                <th>Nombre libro</th>
                <th>Autor</th>
                <th>Usuario</th>
                <th>Fecha de registro</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($books as $book): ?>
                <tr>
                  <td><?= htmlspecialchars($book['book_id']) ?></td>
                  <td><?= htmlspecialchars($book['book_name']) ?></td>
                  <td><?= htmlspecialchars($book['author_name']) ?></td>
                  <td><?= htmlspecialchars($book['user_name']) ?></td>
                  <td><?= htmlspecialchars($book['created_at']) ?></td>
                  <td>
                      <a href="crud_books/edit_book.php?id=<?= $book['book_id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                      <a href="crud_books/delete_book.php?id=<?= $book['book_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este libro?')">Eliminar</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <!-- Paginación -->
          <nav>
            <ul class="pagination">
              <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page - 1 ?>" tabindex="-1">Anterior</a>
              </li>

              <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                  <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
              <?php endfor; ?>

              <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page + 1 ?>">Siguiente</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
