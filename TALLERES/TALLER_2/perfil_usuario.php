
<?php
// Definición de variables
$nombre = "Daniel Almanza";
$edad = 21;
$correo = "danielalmanza@gmail.com";
$telefono = "6767-9144";

// Definición de constante
define("OCUPACION", "Lic. Desarrollo de Software");

// Creación de mensaje usando diferentes métodos de concatenación e impresión
$mensaje1 = "Hola, mi nombre es " . $nombre . " y tengo " . $edad . " años," . "mi correo es" . $correo;
$mensaje2 = "Mi telefono es $telefono y soy " . OCUPACION . ".";

echo $mensaje1 . "<br>";
print($mensaje2 . "<br>");

printf("En resumen: %s, %d años, %s, %s<br>", $nombre, $edad, $correo, OCUPACION);

echo "<br>Información de debugging:<br>";
var_dump($nombre);
echo "<br>";
var_dump($edad);
echo "<br>";
var_dump($correo);
echo "<br>";
var_dump($telefono);
echo "<br>";
var_dump(OCUPACION);
echo "<br>";
?>
                    
