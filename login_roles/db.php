<?php

$host = "localhost";
$db_name = "db_practica";
$db_user = "root";
$db_password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8",
    $db_user,
    $db_password);
    //echo "Hola mundo!";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos". $e->getMessage());
}

?>