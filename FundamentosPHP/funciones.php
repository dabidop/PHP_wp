<?php
    function calcularArea($base, $altura){
        $area = $base * $altura;
        return $area;      
    }
    function calcularPerimetro($base, $altura){
        $perimetro = (2 * $base) + (2 * $altura);
        return $perimetro;
    }

    $areaRectangulo = calcularArea(3, 5);
    $perimetroRectangulo = calcularPerimetro(10, 5);

    echo "El área del rectángulo es: $areaRectangulo, el perímetro es: $perimetroRectangulo";

    //Función en la que se agrega un parámetro por defecto
    function saludar($nombre = "Usuario") {
        echo "<br>Hola, $nombre!";
    }
    saludar(); // Muestra: Hola, Usuario!
    saludar("David"); // Muestra: Hola, David!

    //Función que se instancia o almacena en una variable
    $multiplicar = function($a, $b) {
        return $a * $b;
    };
    echo "<br>" . $multiplicar(3, 4); // Muestra: 12

    //paso de parámetros por valor
    function incrementar($numero) {
        $numero++;
    }
    $x = 5;
    incrementar($x);
    echo "<br>" . $x;  // Muestra: 5
    
    //paso de parámetros por referencia
    function incrementar2(&$numero) {
        $numero++;
    }
    $x = 5;
    incrementar2($x);
    echo "<br>" . $x;  // Muestra: 6
    
    

?>