<?php

    $documento = ("archivito.txt");

    //si el documento existe
    if (file_exists($documento)) {
        echo "El archivo existe<br>";
        
        echo "El archivo pesa: " . filesize($documento) . " bytes";
        
        //última fecha de acceso al documento
        $fecha_acceso = fileatime($documento);
        //echo "<br>La última fecha de acceso del documento fue: " . $fecha_acceso;
        echo "<br>La última fecha de acceso del documento fue: " . date("D d M Y", $fecha_acceso);

        //última fecha de modificación del archivo
        $fecha_modificacion = filectime($documento);
        echo "<br>La última modificación del documento fue: " . date("D d M Y", $fecha_modificacion);

        //el archivo es legible?
        echo "<br>¿El archivo es legible? " . is_readable($documento);

        //Se puede escribir en él?
        echo "<br>¿Se puede escribir en el archivo? " . is_writable($documento);

        //Obtener el contenido del documento, como STRING
        $contenido_documento = file_get_contents($documento);
        echo "<br>" . $contenido_documento;

        //Abrir un archivo con fopen y r para sólo leer el archivo, w para escribir desde el comienzo, 
        //a, para escribir al final del documento y el contenido no se pierde
        $abrir_documento = fopen($documento, "r");
        do {
            echo "<br>" . fgets($abrir_documento);
        } while (!feof($abrir_documento));

        //Escribir en el archivo
        $abrir_documento = fopen($documento, "a");
        fwrite($abrir_documento, "<br>YA NO HAY HOLIWIS, SÓLO HOLA");
        $abrir_documento = fopen($documento, "w");
        fwrite($abrir_documento, "<br>Ya sólo hay silencio");

        fclose($abrir_documento);

    } else {
        echo "El archino no existe";
    }

    //copy($documento, "archivito_copia.txt") or die();
    //rename($documento, "nuevo nombre.txt") or die();

?>