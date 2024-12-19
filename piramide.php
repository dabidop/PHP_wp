<?php

$numero = 10;
$array = [];

for ($i =  1; $i <= $numero; $i++) {
    $array[] = $i;
    echo "$i<br>";
    foreach ($array as $renglon) {
        print ($renglon);
    }
}

/*-----GPT-----
for ($i = 1; $i <= $numero; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $j;
    }
    echo "<br>";
}

*/

?>