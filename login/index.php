<?php

session_start();
if (!isset($_SESSION["user"])) {
    header("Location: form.php");
}
?>
<h2>Esta es una página de inicio</h2>
<?php

echo "Bienvenido, " . $_SESSION["user"];

?>
<br><br>
<form action="" method="POST">
    <button type="submit" name="logout">Cerrar sesión</button>
</form>
<?php

    if (isset($_POST["logout"])) {
        session_destroy();
        echo "Sesión cerrada exitosamente";
        header("Location: form.php");
        exit();
    }

?>