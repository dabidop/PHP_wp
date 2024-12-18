<?php
session_start();
echo $_SESSION["user"];
session_destroy();
echo "<br>Has cerrado sesión de manera exitosa";
