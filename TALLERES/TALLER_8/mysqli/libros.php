<?php
require_once 'config.php';

// Listar todos los libros
function listarLibros($conn) {
    $sql = "SELECT * FROM libros";
    $result = mysqli_query($conn, $sql);

    while ($libro = mysqli_fetch_assoc($result)) {
        echo "Título: " . $libro['titulo'] . " - Autor: " . $libro['autor'] . "<br>";
    }
}

// Añadir nuevo libro
function agregarLibro($conn, $titulo, $autor, $isbn, $anio, $cantidad) {
    $sql = "INSERT INTO libros (titulo, autor, isbn, anio_publicacion, cantidad_disponible) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssii', $titulo, $autor, $isbn, $anio, $cantidad);
    mysqli_stmt_execute($stmt);
}

// Actualizar libro
function actualizarLibro($conn, $id, $titulo, $autor, $isbn, $anio, $cantidad) {
    $sql = "UPDATE libros SET titulo=?, autor=?, isbn=?, anio_publicacion=?, cantidad_disponible=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssiii', $titulo, $autor, $isbn, $anio, $cantidad, $id);
    mysqli_stmt_execute($stmt);
}

// Eliminar libro
function eliminarLibro($conn, $id) {
    $sql = "DELETE FROM libros WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
}

// Llamadas de ejemplo
agregarLibro($conn, 'Libro de Prueba', 'Autor Ejemplo', '123456789', 2023, 10);
listarLibros($conn);
mysqli_close($conn);
?>
