<?php
require_once 'config.php';

// Listar todos los préstamos
function listarPrestamos($conn) {
    $sql = "SELECT p.*, u.nombre AS usuario, l.titulo AS libro FROM prestamos p 
            JOIN usuarios u ON p.usuario_id = u.id 
            JOIN libros l ON p.libro_id = l.id";
    $result = mysqli_query($conn, $sql);

    while ($prestamo = mysqli_fetch_assoc($result)) {
        echo "Usuario: " . $prestamo['usuario'] . " - Libro: " . $prestamo['libro'] . "<br>";
    }
}

// Registrar un préstamo
function registrarPrestamo($conn, $usuario_id, $libro_id) {
    mysqli_begin_transaction($conn);

    try {
        $sql = "INSERT INTO prestamos (usuario_id, libro_id, fecha_prestamo) VALUES (?, ?, NOW())";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $usuario_id, $libro_id);
        mysqli_stmt_execute($stmt);

        $sql = "UPDATE libros SET cantidad_disponible = cantidad_disponible - 1 WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $libro_id);
        mysqli_stmt_execute($stmt);

        mysqli_commit($conn);
        echo "Préstamo registrado con éxito.";
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    }
}

// Llamadas de ejemplo
registrarPrestamo($conn, 1, 1);
listarPrestamos($conn);
mysqli_close($conn);
?>
