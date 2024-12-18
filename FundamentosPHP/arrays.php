<?php
    $array1 = [5, 11, 3, 2, 7];
    $array2 = [9, 13, 6, 1, 7, 6, 8, 9];
    
    function suma($array) {
        $suma = 0;
        foreach ($array as $numero) {
            $suma += $numero;
        }
        return $suma;
    }

    function promedio($array) {
        $suma = 0;
        foreach ($array as $numero) {
            $suma += $numero;
        }
        $promedio = $suma / count($array);
        return $promedio;
    }

    echo "La suma 1 de los números es: " . suma($array1);
    echo "<br>La suma 2 de los números es: " . suma($array2);

    echo "<br>El promedio del primer array es: " . promedio($array1);
    echo "<br>El promedio del segundo array es: " . promedio($array2);
?>