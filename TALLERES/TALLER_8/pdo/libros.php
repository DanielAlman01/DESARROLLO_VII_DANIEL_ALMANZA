<?php
require_once 'config.php';

// Listar todos los libros
function listarLibros($pdo) {
    $stmt = $pdo->query("SELECT * FROM libros");
    while ($libro = $stmt->fetch()) {
        echo "Título: " . $libro['titulo'] . " - Autor: " . $libro['autor'] . "<br>";
    }
}

// Añadir nuevo libro
function agregarLibro($pdo, $titulo, $autor, $isbn, $anio, $cantidad) {
    $sql = "INSERT INTO libros (titulo, autor, isbn, anio_publicacion, cantidad_disponible) VALUES (:titulo, :autor, :isbn, :anio, :cantidad)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':titulo' => $titulo,
        ':autor' => $autor,
        ':isbn' => $isbn,
        ':anio' => $anio,
        ':cantidad' => $cantidad
    ]);
}

// Actualizar libro
function actualizarLibro($pdo, $id, $titulo, $autor, $isbn, $anio, $cantidad) {
    $sql = "UPDATE libros SET titulo=:titulo, autor=:autor, isbn=:isbn, anio_publicacion=:anio, cantidad_disponible=:cantidad WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':titulo' => $titulo,
        ':autor' => $autor,
        ':isbn' => $isbn,
        ':anio' => $anio,
        ':cantidad' => $cantidad,
        ':id' => $id
    ]);
}

// Eliminar libro
function eliminarLibro($pdo, $id) {
    $sql = "DELETE FROM libros WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
}

// Llamadas de ejemplo
agregarLibro($pdo, 'Libro de Prueba PDO', 'Autor Ejemplo PDO', '987654321', 2023, 10);
listarLibros($pdo);
?>
