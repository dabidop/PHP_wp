<?php
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "admin") {
  header("Location: login.php");
  exit();
}

require '../db.php';

// Obtén los usuarios de la tabla
$stmt = $pdo->query("SELECT id, username, role, created_at FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
  <title>Usuarios</title>
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
              <h2>Lista de Usuarios</h2>
            </div>
            <div class="col-6">
              <a href="./crud_users/create_user.php" class="btn btn-success btn-sm">Crear nuevo +</a>
            </div>
          </div>
          <table class="table table-striped table-bordered">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Fecha registro</th>
                <th >Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user): ?>
                <tr>
                  <td><?= htmlspecialchars($user['id']) ?></td>
                  <td><?= htmlspecialchars($user['username']) ?></td>
                  <td><?= htmlspecialchars($user['role']) ?></td>
                  <td><?= htmlspecialchars($user['created_at']) ?></td>
                  <td>
                    <a href="crud_users/edit_user.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="crud_users/delete_user.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
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