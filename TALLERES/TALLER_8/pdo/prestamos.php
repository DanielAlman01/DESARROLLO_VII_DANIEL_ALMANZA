<?php
require_once 'config.php';

// Listar todos los préstamos
function listarPrestamos($pdo) {
    $sql = "SELECT p.*, u.nombre AS usuario, l.titulo AS libro FROM prestamos p 
            JOIN usuarios u ON p.usuario_id = u.id 
            JOIN libros l ON p.libro_id = l.id";
    $stmt = $pdo->query($sql);

    while ($prestamo = $stmt->fetch()) {
        echo "Usuario: " . $prestamo['usuario'] . " - Libro: " . $prestamo['libro'] . "<br>";
    }
}

// Registrar un préstamo
function registrarPrestamo($pdo, $usuario_id, $libro_id) {
    try {
        $pdo->beginTransaction();

        $sql = "INSERT INTO prestamos (usuario_id, libro_id, fecha_prestamo) VALUES (:usuario_id, :libro_id, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':usuario_id' => $usuario_id,
            ':libro_id' => $libro_id
        ]);

        $sql = "UPDATE libros SET cantidad_disponible = cantidad_disponible - 1 WHERE id=:libro_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':libro_id' => $libro_id]);

        $pdo->commit();
        echo "Préstamo registrado con éxito.";
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

// Llamadas de ejemplo
registrarPrestamo($pdo, 1, 1);
listarPrestamos($pdo);
?>
