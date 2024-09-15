<?php
require_once 'Empleado.php';
require_once 'Evaluable.php';

class Desarrollador extends Empleado implements Evaluable {
    private $lenguajePrincipal;
    private $nivelExperiencia;

    public function __construct($nombre, $idEmpleado, $salarioBase, $lenguajePrincipal, $nivelExperiencia) {
        parent::__construct($nombre, $idEmpleado, $salarioBase);
        $this->lenguajePrincipal = $lenguajePrincipal;
        $this->nivelExperiencia = $nivelExperiencia;
    }

    public function evaluarDesempenio() {
        return "Evaluando desempeño del desarrollador: {$this->nombre}. Nivel: {$this->nivelExperiencia}";
    }

    public function obtenerInformacion() {
        return parent::obtenerInformacion() . ", Lenguaje: {$this->lenguajePrincipal}, Nivel: {$this->nivelExperiencia}";
    }
}
?>
