<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Análisis de Texto</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Problema 1: Análisis de texto</h2>
    
    <?php
    // Incluir el archivo de utilidades
    require_once 'utilidades_texto.php';

    $frases = [
        "Hola mundo PHP",
        "Programación web con PHP",
        "Examen parcial de introducción a PHP"
    ];

    echo "<table>";
    echo "<tr><th>Frase</th><th>Palabras</th><th>Vocales</th><th>Invertida</th></tr>";

    foreach ($frases as $frase) {
        $analisis = analizar_frase($frase);
        echo "<tr>";
        echo "<td>{$analisis['frase']}</td>";
        echo "<td>{$analisis['palabras']}</td>";
        echo "<td>{$analisis['vocales']}</td>";
        echo "<td>{$analisis['invertida']}</td>";
        echo "</tr>";
    }

    echo "</table>";
    ?>
</body>
</html>