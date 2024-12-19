<?php
//página sólo para mostrar la cookie y la sesión
session_start();

echo "Hola " . "" . $_SESSION["name"] . ", tienes " . $_SESSION["age"] . " años y eres genial.";
//echo "<br>" . $_SESSION["name"];
//echo "<br>" . $_SESSION["age"];
echo "<br>" . $_COOKIE["cookie"];

?>