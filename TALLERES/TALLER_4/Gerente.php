<?php
require_once 'Empleado.php';
require_once 'Evaluable.php';

class Gerente extends Empleado implements Evaluable {
    private $departamento;
    private $bono = 0;

    public function __construct($nombre, $idEmpleado, $salarioBase, $departamento) {
        parent::__construct($nombre, $idEmpleado, $salarioBase);
        $this->departamento = $departamento;
    }

    public function asignarBono($bono) {
        $this->bono = $bono;
    }

    public function evaluarDesempenio() {
        return "Evaluando desempeño del gerente: {$this->nombre}. Bono asignado: {$this->bono}";
    }

    public function obtenerInformacion() {
        return parent::obtenerInformacion() . ", Departamento: {$this->departamento}, Bono: {$this->bono}";
    }
}
?>
