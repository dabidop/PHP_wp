<?php
    $numero = 9;

    if ($numero % 3 == 0 and $numero % 5 == 0) {
        echo "El número $numero es divisible por 5 y por 3";
    } elseif ($numero % 5 == 0) {
        echo "En número $numero es divisible por 5";
    } elseif ($numero % 3 == 0) {
        echo "En número $numero es divisible por 3";
    } else {
        echo "El número $numero no es divisible ni por 5 ni por 3";
    }
?>