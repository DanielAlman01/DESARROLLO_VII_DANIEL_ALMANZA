<?php
class Tarea {
    public $id;
    public $titulo;
    public $descripcion;
    public $estado;
    public $prioridad;
    public $fechaCreacion;
    public $tipo;
    public $lenguajeProgramacion;
    public $herramientaDiseno;
    public $tipoTest;

    public function __construct($data) {
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->titulo = $data['titulo'];
        $this->descripcion = $data['descripcion'];
        $this->estado = isset($data['estado']) ? $data['estado'] : 'pendiente';
        $this->prioridad = $data['prioridad'];
        $this->fechaCreacion = isset($data['fechaCreacion']) ? $data['fechaCreacion'] : date('Y-m-d');
        $this->tipo = $data['tipo'];
        $this->lenguajeProgramacion = isset($data['lenguajeProgramacion']) ? $data['lenguajeProgramacion'] : null;
        $this->herramientaDiseno = isset($data['herramientaDiseno']) ? $data['herramientaDiseno'] : null;
        $this->tipoTest = isset($data['tipoTest']) ? $data['tipoTest'] : null;
    }
}

class GestorTareas {
    private $archivo = 'tareas.json';

    public function cargarTareas() {
        if (file_exists($this->archivo)) {
            $contenido = file_get_contents($this->archivo);
            $data = json_decode($contenido, true);
            $tareas = [];
            foreach ($data as $item) {
                $tareas[] = new Tarea($item);
            }
            return $tareas;
        }
        return [];
    }

    public function guardarTareas($tareas) {
        file_put_contents($this->archivo, json_encode($tareas, JSON_PRETTY_PRINT));
    }

    public function agregarTarea($nuevaTarea) {
        $tareas = $this->cargarTareas();
        $nuevaTarea->id = count($tareas) + 1;
        $tareas[] = $nuevaTarea;
        $this->guardarTareas($tareas);
    }

    public function editarTarea($id, $tareaEditada) {
        $tareas = $this->cargarTareas();
        foreach ($tareas as $key => $tarea) {
            if ($tarea->id == $id) {
                $tareaEditada->id = $id;
                $tareas[$key] = $tareaEditada;
                break;
            }
        }
        $this->guardarTareas($tareas);
    }

    public function eliminarTarea($id) {
        $tareas = $this->cargarTareas();
        foreach ($tareas as $key => $tarea) {
            if ($tarea->id == $id) {
                unset($tareas[$key]);
                break;
            }
        }
        $this->guardarTareas(array_values($tareas));
    }

    public function cambiarEstado($id, $nuevoEstado) {
        $tareas = $this->cargarTareas();
        foreach ($tareas as $tarea) {
            if ($tarea->id == $id) {
                $tarea->estado = $nuevoEstado;
                break;
            }
        }
        $this->guardarTareas($tareas);
    }

    public function filtrarTareasPorEstado($estado) {
        $tareas = $this->cargarTareas();
        if ($estado) {
            return array_filter($tareas, function ($tarea) use ($estado) {
                return $tarea->estado === $estado;
            });
        }
        return $tareas;
    }

    public function ordenarTareas($field, $direction) {
        $tareas = $this->cargarTareas();
        usort($tareas, function ($a, $b) use ($field, $direction) {
            $valueA = $a->{$field};
            $valueB = $b->{$field};
            return $direction === 'ASC' ? strcmp($valueA, $valueB) : strcmp($valueB, $valueA);
        });
        return $tareas;
    }
}
?>