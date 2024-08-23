<?php
// Generar un patrón de triángulo rectángulo usando asteriscos (*) con un bucle for
echo "<h2>Patrón de triángulo rectángulo:</h2>";
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}

// Generar una secuencia de números del 1 al 20, pero solo mostrar los números impares con un bucle while
echo "<h2>Números impares del 1 al 20:</h2>";
$num = 1;
while ($num <= 20) {
    if ($num % 2 != 0) {
        echo $num . "<br>";
    }
    $num++;
}

// Crear un contador regresivo desde 10 hasta 1, pero saltar el número 5 con un bucle do-while
echo "<h2>Contador regresivo desde 10 hasta 1 (sin el 5):</h2>";
$contador = 10;
do {
    if ($contador != 5) {
        echo $contador . "<br>";
    }
    $contador--;
} while ($contador >= 1);

?>
