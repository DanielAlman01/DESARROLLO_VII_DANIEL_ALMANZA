<?php
// Definir la interfaz Detalle
interface Detalle {
    public function obtenerDetallesEspecificos(): string;
}

// Clase abstracta Entrada que implementa la interfaz Detalle
abstract class Entrada implements Detalle {
    protected int $id;
    protected string $fecha_creacion;
    protected int $tipo;

    public function __construct($id, $fecha_creacion, $tipo) {
        $this->id = $id;
        $this->fecha_creacion = $fecha_creacion;
        $this->tipo = $tipo;
    }

    // Método abstracto que será implementado por las clases hijas
    abstract public function obtenerDetallesEspecificos(): string;
}

// Clase EntradaUnaColumna
class EntradaUnaColumna extends Entrada {
    private string $titulo;
    private string $descripcion;

    public function __construct($id, $fecha_creacion, $titulo, $descripcion) {
        parent::__construct($id, $fecha_creacion, 1);
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
    }

    public function obtenerDetallesEspecificos(): string {
        return "Entrada de una columna: " . $this->titulo;
    }
}

// Clase EntradaDosColumnas
class EntradaDosColumnas extends Entrada {
    private string $titulo1;
    private string $descripcion1;
    private string $titulo2;
    private string $descripcion2;

    public function __construct($id, $fecha_creacion, $titulo1, $descripcion1, $titulo2, $descripcion2) {
        parent::__construct($id, $fecha_creacion, 2);
        $this->titulo1 = $titulo1;
        $this->descripcion1 = $descripcion1;
        $this->titulo2 = $titulo2;
        $this->descripcion2 = $descripcion2;
    }

    public function obtenerDetallesEspecificos(): string {
        return "Entrada de dos columnas: " . $this->titulo1 . " | " . $this->titulo2;
    }
}

// Clase EntradaTresColumnas
class EntradaTresColumnas extends Entrada {
    private string $titulo1;
    private string $descripcion1;
    private string $titulo2;
    private string $descripcion2;
    private string $titulo3;
    private string $descripcion3;

    public function __construct($id, $fecha_creacion, $titulo1, $descripcion1, $titulo2, $descripcion2, $titulo3, $descripcion3) {
        parent::__construct($id, $fecha_creacion, 3);
        $this->titulo1 = $titulo1;
        $this->descripcion1 = $descripcion1;
        $this->titulo2 = $titulo2;
        $this->descripcion2 = $descripcion2;
        $this->titulo3 = $titulo3;
        $this->descripcion3 = $descripcion3;
    }

    public function obtenerDetallesEspecificos(): string {
        return "Entrada de tres columnas: " . $this->titulo1 . " | " . $this->titulo2 . " | " . $this->titulo3;
    }
}

// Clase GestorBlog para manejar las entradas
class GestorBlog {
    private array $entradas = [];

    public function __construct($jsonFile) {
        $this->entradas = json_decode(file_get_contents($jsonFile), true);
    }

    public function agregarEntrada(Entrada $entrada): void {
        $this->entradas[] = $entrada;
        $this->guardarEntradas();
    }

    public function editarEntrada(Entrada $entrada): void {
        foreach ($this->entradas as &$e) {
            if ($e['id'] == $entrada->id) {
                $e = $entrada;
                break;
            }
        }
        $this->guardarEntradas();
    }

    public function eliminarEntrada($id): void {
        $this->entradas = array_filter($this->entradas, function ($entrada) use ($id) {
            return $entrada['id'] != $id;
        });
        $this->guardarEntradas();
    }

    public function obtenerEntrada($id): ?Entrada {
        foreach ($this->entradas as $entrada) {
            if ($entrada['id'] == $id) {
                return $entrada;
            }
        }
        return null;
    }

    public function moverEntrada($id, $direccion): void {
        // Implementar la lógica para mover la entrada hacia arriba o abajo
        // Similar al uso de array_splice
    }

    private function guardarEntradas(): void {
        file_put_contents('blog.json', json_encode($this->entradas, JSON_PRETTY_PRINT));
    }
}
?>
