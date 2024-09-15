<?php
require_once 'Gerente.php';
require_once 'Desarrollador.php';
require_once 'Empresa.php';

$empresa = new Empresa();

$gerente = new Gerente("Carlos", 1, 5000, "Ventas");
$desarrollador = new Desarrollador("Ana", 2, 4000, "PHP", "Senior");

$empresa->agregarEmpleado($gerente);
$empresa->agregarEmpleado($desarrollador);

echo "Listado de empleados:\n";
$empresa->listarEmpleados();

echo "\nNómina total: " . $empresa->calcularNominaTotal() . "\n";

echo "\nEvaluaciones de desempeño:\n";
$empresa->evaluarTodos();
?>
