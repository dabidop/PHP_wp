<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("Location: login.php");
  exit();
}

require '../db.php';

// Definir cuántos usuarios se mostrarán por página
$perPage = 8; // 5 usuarios por página

// Obtener el número de la página actual desde la URL, por defecto será la página 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calcular el OFFSET (desde qué registro empezar)
$offset = ($page - 1) * $perPage;

// Obtener el total de usuarios para calcular el número total de páginas
$totalAuthorsStmt = $pdo->query("SELECT COUNT(*) FROM book_authors");
$totalAuthors = $totalAuthorsStmt->fetchColumn();
$totalPages = ceil($totalAuthors / $perPage);

// Obtener los usuarios para la página actual
$stmt = $pdo->prepare("SELECT author_id, author_name, created_at FROM book_authors LIMIT :limit OFFSET :offset");
$stmt->bindParam(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
  <title>Authors</title>
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
              <h2>Lista de autores</h2>
            </div>
            <div class="col-6">
              <a href="./crud_authors/create_author.php" class="btn btn-success btn-sm">Crear nuevo +</a>
            </div>
          </div>
          <table class="table table-striped table-bordered">
            <thead class="table-dark">
              <tr>
                <th>ID Autor</th>
                <th>Nombre de autor</th>
                <th>Fecha registro</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($authors as $author): ?>
                <tr>
                  <td><?= htmlspecialchars($author['author_id']) ?></td>
                  <td><?= htmlspecialchars($author['author_name']) ?></td>
                  <td><?= htmlspecialchars($author['created_at']) ?></td>
                  <td>
                    <a href="crud_authors/edit_author.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="crud_authors/delete_author.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este autor?')">Eliminar</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <!-- Paginación -->
          <nav>
            <ul class="pagination">
              <!-- Botón para la página anterior -->
              <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page - 1 ?>" tabindex="-1">Anterior</a>
              </li>

              <!-- Enlaces de páginas -->
              <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                  <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
              <?php endfor; ?>

              <!-- Botón para la página siguiente -->
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

<script>
  // JavaScript para alternar el sidebar con persistencia
  const sidebar = document.getElementById('sidebar');
  const content = document.getElementById('content');
  const toggleBtn = document.getElementById('toggleSidebar');

  // Cargar el estado guardado
  const sidebarState = localStorage.getItem('sidebarState');
  if (sidebarState === 'hidden') {
    sidebar.classList.add('hidden');
    content.classList.add('expanded');
  }

  // Alternar y guardar el estado
  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('hidden');
    content.classList.toggle('expanded');
    localStorage.setItem('sidebarState', sidebar.classList.contains('hidden') ? 'hidden' : 'visible');
  });
</script>

</html>