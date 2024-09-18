<?php

// Clase Estudiante
class Estudiante {
    private $id;
    private $nombre;
    private $edad;
    private $carrera;
    private $materias;

    public function __construct($id, $nombre, $edad, $carrera) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->carrera = $carrera;
        $this->materias = [];
    }

    public function agregarMateria($materia, $calificacion) {
        $this->materias[$materia] = $calificacion;
    }

    public function obtenerPromedio() {
        if (empty($this->materias)) {
            return 0;
        }
        return array_sum($this->materias) / count($this->materias);
    }

    public function obtenerDetalles() {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "edad" => $this->edad,
            "carrera" => $this->carrera,
            "materias" => $this->materias,
            "promedio" => $this->obtenerPromedio()
        ];
    }

    public function __toString() {
        return "ID: $this->id, Nombre: $this->nombre, Edad: $this->edad, Carrera: $this->carrera, Promedio: " . number_format($this->obtenerPromedio(), 2);
    }
}

// Clase SistemaGestionEstudiantes
class SistemaGestionEstudiantes {
    private $estudiantes;
    private $graduados;

    public function __construct() {
        $this->estudiantes = [];
        $this->graduados = [];
    }

    public function agregarEstudiante($estudiante) {
        $this->estudiantes[$estudiante->obtenerDetalles()['id']] = $estudiante;
    }

    public function obtenerEstudiante($id) {
        return $this->estudiantes[$id] ?? null;
    }

    public function listarEstudiantes() {
        return $this->estudiantes;
    }

    public function calcularPromedioGeneral() {
        $totalPromedios = array_map(function ($estudiante) {
            return $estudiante->obtenerPromedio();
        }, $this->estudiantes);

        return count($totalPromedios) ? array_sum($totalPromedios) / count($totalPromedios) : 0;
    }

    public function obtenerEstudiantesPorCarrera($carrera) {
        return array_filter($this->estudiantes, function ($estudiante) use ($carrera) {
            return $estudiante->obtenerDetalles()['carrera'] === $carrera;
        });
    }

    public function obtenerMejorEstudiante() {
        return max($this->estudiantes, fn($a, $b) => $a->obtenerPromedio() <=> $b->obtenerPromedio());
    }

    public function generarReporteRendimiento() {
        $materias = [];
        foreach ($this->estudiantes as $estudiante) {
            foreach ($estudiante->obtenerDetalles()['materias'] as $materia => $calificacion) {
                if (!isset($materias[$materia])) {
                    $materias[$materia] = [];
                }
                $materias[$materia][] = $calificacion;
            }
        }

        $reporte = [];
        foreach ($materias as $materia => $calificaciones) {
            $reporte[$materia] = [
                'promedio' => array_sum($calificaciones) / count($calificaciones),
                'max' => max($calificaciones),
                'min' => min($calificaciones)
            ];
        }

        return $reporte;
    }

    public function graduarEstudiante($id) {
        if (isset($this->estudiantes[$id])) {
            $this->graduados[$id] = $this->estudiantes[$id];
            unset($this->estudiantes[$id]);
        }
    }

    public function generarRanking() {
        usort($this->estudiantes, function ($a, $b) {
            return $b->obtenerPromedio() <=> $a->obtenerPromedio();
        });
        return $this->estudiantes;
    }
}

// Sección de prueba

$sistema = new SistemaGestionEstudiantes();

// Crear 10 estudiantes
$sistema->agregarEstudiante(new Estudiante(1, "Juan Pérez", 20, "Ingeniería"));
$sistema->agregarEstudiante(new Estudiante(2, "Ana López", 22, "Medicina"));
$sistema->agregarEstudiante(new Estudiante(3, "Luis González", 19, "Ingeniería"));
$sistema->agregarEstudiante(new Estudiante(4, "Marta Díaz", 21, "Derecho"));
$sistema->agregarEstudiante(new Estudiante(5, "Pedro Ruiz", 23, "Ingeniería"));
$sistema->agregarEstudiante(new Estudiante(6, "Sofía Ramírez", 20, "Medicina"));
$sistema->agregarEstudiante(new Estudiante(7, "Carlos Fernández", 24, "Derecho"));
$sistema->agregarEstudiante(new Estudiante(8, "Laura Gutiérrez", 22, "Ingeniería"));
$sistema->agregarEstudiante(new Estudiante(9, "Daniela Almanza", 21, "Programador"));
$sistema->agregarEstudiante(new Estudiante(10, "Andrés Torres", 19, "Derecho"));

// Añadir materias y calificaciones
$sistema->obtenerEstudiante(1)->agregarMateria("Matemáticas", 85);
$sistema->obtenerEstudiante(1)->agregarMateria("Física", 20);
$sistema->obtenerEstudiante(2)->agregarMateria("Biología", 35);
$sistema->obtenerEstudiante(2)->agregarMateria("Química", 80);
$sistema->obtenerEstudiante(3)->agregarMateria("Matemáticas", 85);
$sistema->obtenerEstudiante(3)->agregarMateria("Física", 70);
$sistema->obtenerEstudiante(3)->agregarMateria("Biología", 75);
$sistema->obtenerEstudiante(4)->agregarMateria("Química", 80);
$sistema->obtenerEstudiante(4)->agregarMateria("Matemáticas", 85);
$sistema->obtenerEstudiante(5)->agregarMateria("Física", 90);
$sistema->obtenerEstudiante(5)->agregarMateria("Biología", 95);
$sistema->obtenerEstudiante(5)->agregarMateria("Química", 60);
$sistema->obtenerEstudiante(5)->agregarMateria("Matemáticas", 85);
$sistema->obtenerEstudiante(6)->agregarMateria("Física", 90);
$sistema->obtenerEstudiante(6)->agregarMateria("Biología", 45);
$sistema->obtenerEstudiante(7)->agregarMateria("Química", 80);
$sistema->obtenerEstudiante(8)->agregarMateria("Física", 90);
$sistema->obtenerEstudiante(8)->agregarMateria("Biología", 95);
$sistema->obtenerEstudiante(8)->agregarMateria("Química", 80);
$sistema->obtenerEstudiante(9)->agregarMateria("Matemáticas", 45);
$sistema->obtenerEstudiante(9)->agregarMateria("Física", 90);
$sistema->obtenerEstudiante(10)->agregarMateria("Biología", 95);
$sistema->obtenerEstudiante(10)->agregarMateria("Química", 80);

// Listar estudiantes
echo "Listado de estudiantes:\n<br><br>";
foreach ($sistema->listarEstudiantes() as $estudiante) {
    echo $estudiante . "\n<br>";
}

// Calcular promedio general
echo "<br><br>\nPromedio general de estudiantes: " . number_format($sistema->calcularPromedioGeneral(), 2) . "\n";

// Generar ranking de estudiantes
echo "<br><br><br>\nRanking de estudiantes:\n<br><br>";
foreach ($sistema->generarRanking() as $estudiante) {
    echo $estudiante . "\n<br>";
}

// Graduar un estudiante
$sistema->graduarEstudiante(1);

// Generar reporte de rendimiento por materia
echo "<br>\nReporte de rendimiento por materia:\n<br>";
$reporte = $sistema->generarReporteRendimiento();
foreach ($reporte as $materia => $datos) {
    echo "$materia - Promedio: " . number_format($datos['promedio'], 2) . ", Máximo: " . $datos['max'] . ", Mínimo: " . $datos['min'] . "\n<br>";
}

?>
