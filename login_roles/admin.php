<?php
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include("sidebar.php"); ?>

            <!-- Main Content -->

            <div id="content" class="col-md-9">
                <button id="toggleSidebar" class="btn btn-primary mb-3">☰</button>
                <h1>Bienvenido, <?php echo $_SESSION["username"]; ?></h1>
                <p>Panel de administración</p>
            </div>
        </div>
    </div>

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

    <?php
    if (isset($_POST["logout"])) {
        session_destroy();
        header("Location: login.php");
        exit();
    }
    ?>

</body>

</html>