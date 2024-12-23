<div class="col-md-2 bg-light p-3" id="sidebar">
    <h6><?php echo $_SESSION["username"]; ?></h6>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="admin.php">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="list_users.php">Usuarios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="register.php">Registrar Usuario</a>
        </li>
    </ul>
    <form method="POST">
        <button type="submit" name="logout" class="btn btn-danger mt-3">Cerrar sesión</button>
    </form>
</div>