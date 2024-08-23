<?php
// Declarar la variable calificación y asignarle un valor numérico entre 0 y 100
$calificacion = 85;

// Determinar la letra correspondiente a la calificación
if ($calificacion >= 90 && $calificacion <= 100) {
    $letra = 'A';
} elseif ($calificacion >= 80 && $calificacion <= 89) {
    $letra = 'B';
} elseif ($calificacion >= 70 && $calificacion <= 79) {
    $letra = 'C';
} elseif ($calificacion >= 60 && $calificacion <= 69) {
    $letra = 'D';
} else {
    $letra = 'F';
}

// Imprimir el mensaje de calificación
echo "Tu calificación es $letra.<br>";

// Usar operador ternario para determinar si está aprobado o reprobado
$estatus = ($letra != 'F') ? "Aprobado" : "Reprobado";
echo "$estatus.<br>";

// Usar switch para imprimir un mensaje adicional
switch ($letra) {
    case 'A':
        echo "Excelente trabajo.<br>";
        break;
    case 'B':
        echo "Buen trabajo.<br>";
        break;
    case 'C':
        echo "Trabajo aceptable.<br>";
        break;
    case 'D':
        echo "Necesitas mejorar.<br>";
        break;
    case 'F':
        echo "Debes esforzarte más.<br>";
        break;
    default:
        echo "Calificación no válida.<br>";
        break;
}
?>
