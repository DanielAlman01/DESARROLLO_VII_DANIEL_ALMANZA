
<?php
$frases = [
    "Hola mundo PHP",
    "Programación web con PHP",
    "Examen parcial de introducción a PHP"
];

echo "<h2>Problema 1: Análisis de texto</h2>";
echo "<table border='1'><tr><th>Frase</th><th>Palabras</th><th>Vocales</th><th>Invertida</th></tr>";

foreach ($frases as $frase) {
    // Contar palabras
    $palabras = str_word_count($frase);
    
    // Contar vocales
    $vocales = preg_match_all('/[aeiouAEIOU]/i', $frase);
    
    // Invertir palabras
    $palabras_array = explode(' ', $frase);
    $invertida = implode(' ', array_reverse($palabras_array));
    
    echo "<tr><td>$frase</td><td>$palabras</td><td>$vocales</td><td>$invertida</td></tr>";
}

echo "</table>";
?>