<div class="col-md-2 bg-light p-3" id="sidebar">
    <h6><?php echo $_SESSION["username"]; ?></h6>
    <ul class="nav flex-column">
        <?php if($_SESSION["role"] === "admin"):?>
        <li class="nav-item">
            <a class="nav-link active" href="admin.php">Inicio</a>
        </li>
        <?php endif; ?>
        <?php if($_SESSION["role"] === "user"):?>
        <li class="nav-item">
            <a class="nav-link active" href="user.php">Inicio</a>
        </li>
        <?php endif; ?>
        <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link" href="list_users.php">Usuarios</a>
            </li>
        <?php endif; ?>
        <li class="nav-item">
            <a class="nav-link" href="books_list.php">Libros</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="authors_list.php">Autores</a>
        </li>
    </ul>
    <form method="POST">
        <button type="submit" name="logout" class="btn btn-danger mt-3">Cerrar sesión</button>
    </form>
</div>