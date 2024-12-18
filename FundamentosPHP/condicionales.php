<?php
$numero1 = 5;
if ($numero1 % 2 == 0) {
    echo "$numero1 es par";
} else {
    echo "$numero1 es impar";
}

$numero2 = 6;
if ($numero2 % 2 == 0) {
    echo " <br> $numero2 es par";
} else {
    echo " <br> $numero2 es impar";
}

if ($numero1 == $numero2) {
    echo "<br> Los números son iguales";
} elseif ($numero1 < $numero2) {
    echo "<br> $numero2 es mayor que $numero1";
} elseif ($numero1 > $numero2) {    
    echo "<br> $numero1 es mayor que $numero2";
}
?>
