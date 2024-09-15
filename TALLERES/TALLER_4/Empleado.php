<?php
class Empleado {
    protected $nombre;
    protected $idEmpleado;
    protected $salarioBase;

    public function __construct($nombre, $idEmpleado, $salarioBase) {
        $this->nombre = $nombre;
        $this->idEmpleado = $idEmpleado;
        $this->salarioBase = $salarioBase;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getIdEmpleado() {
        return $this->idEmpleado;
    }

    public function getSalarioBase() {
        return $this->salarioBase;
    }

    public function obtenerInformacion() {
        return "Empleado: {$this->nombre}, ID: {$this->idEmpleado}, Salario: {$this->salarioBase}";
    }
}
?>
