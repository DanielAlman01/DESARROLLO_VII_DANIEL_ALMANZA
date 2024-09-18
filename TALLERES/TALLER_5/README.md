# Sistema de Gestión de Estudiantes

## Descripción

Este proyecto es un Sistema de Gestión de Estudiantes desarrollado en PHP que permite gestionar la información de estudiantes, incluyendo sus calificaciones, promedios, y generar reportes sobre su rendimiento. Utiliza principios de programación orientada a objetos (POO) y manipulación de arreglos en PHP.

## Estructura del Código

El sistema se compone de dos clases principales:

1. **Clase `Estudiante`:**
   - **Atributos:**
     - `id`: Identificador único del estudiante.
     - `nombre`: Nombre del estudiante.
     - `edad`: Edad del estudiante.
     - `carrera`: Carrera en la que está inscrito el estudiante.
     - `materias`: Un arreglo que almacena las materias y sus respectivas calificaciones.
   - **Métodos:**
     - `__construct($id, $nombre, $edad, $carrera)`: Constructor que inicializa los atributos.
     - `agregarMateria($materia, $calificacion)`: Añade una materia y su calificación al estudiante.
     - `obtenerPromedio()`: Calcula y retorna el promedio de calificaciones.
     - `obtenerDetalles()`: Retorna un arreglo asociativo con toda la información del estudiante.
     - `__toString()`: Método que facilita la impresión de información del estudiante.

2. **Clase `SistemaGestionEstudiantes`:**
   - **Atributos:**
     - `estudiantes`: Un arreglo que almacena los objetos de tipo `Estudiante`.
     - `graduados`: Un arreglo para almacenar estudiantes que han sido graduados.
   - **Métodos:**
     - `agregarEstudiante($estudiante)`: Añade un nuevo estudiante al sistema.
     - `obtenerEstudiante($id)`: Obtiene un estudiante por su ID.
     - `listarEstudiantes()`: Retorna un arreglo con todos los estudiantes.
     - `calcularPromedioGeneral()`: Calcula el promedio general de todos los estudiantes.
     - `obtenerEstudiantesPorCarrera($carrera)`: Retorna un arreglo de estudiantes de una carrera específica.
     - `obtenerMejorEstudiante()`: Retorna el estudiante con el promedio más alto.
     - `generarReporteRendimiento()`: Genera un reporte mostrando para cada materia el promedio, la calificación más alta y la más baja.
     - `graduarEstudiante($id)`: Gradúa a un estudiante eliminándolo del sistema y guardándolo en un nuevo arreglo de "graduados".
     - `generarRanking()`: Ordena a los estudiantes por su promedio y retorna el ranking.

## Funcionalidades

- **Agregar Estudiantes:** Permite añadir estudiantes con su información básica.
- **Agregar Materias y Calificaciones:** Cada estudiante puede tener múltiples materias con sus respectivas calificaciones.
- **Calcular Promedios:** El sistema puede calcular el promedio de calificaciones de un estudiante y el promedio general de todos los estudiantes.
- **Generar Reportes:** Se pueden generar reportes sobre el rendimiento en cada materia, así como un ranking de estudiantes basado en sus promedios.
- **Graduar Estudiantes:** Los estudiantes pueden ser graduados y movidos a un arreglo de graduados.

## Instrucciones de Uso

1. **Instalación:**
   - Asegúrate de tener un servidor web que soporte PHP (como Laragon, XAMPP o MAMP).
   - Coloca el archivo `proyecto_final.php` en el directorio de tu servidor.

2. **Ejecución:**
   - Abre tu navegador y dirígete a la URL donde está alojado tu archivo `http://localhost/TALLERES/TALLER_5/proyecto_final.php`.
   - El sistema mostrará un listado de estudiantes, el promedio general y un ranking basado en sus calificaciones.

## Ejemplo de Uso

```php
$sistema = new SistemaGestionEstudiantes();

// Crear estudiantes
$sistema->agregarEstudiante(new Estudiante(1, "Juan Pérez", 20, "Ingeniería"));
// ... agregar más estudiantes

// Listar estudiantes
foreach ($sistema->listarEstudiantes() as $estudiante) {
    echo $estudiante . "\n";
}

// Calcular promedio general
echo "Promedio general de estudiantes: " . number_format($sistema->calcularPromedioGeneral(), 2) . "\n";
