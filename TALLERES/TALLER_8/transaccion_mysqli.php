<?php
require_once "config_mysqli.php";

// Iniciar transacción
mysqli_begin_transaction($conn);

try {
    // Insertar un nuevo usuario
    $sql = "INSERT INTO usuarios (nombre, email) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        throw new Exception("Error preparando la consulta: " . mysqli_error($conn));
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $nombre, $email);
    $nombre = "Nuevo Usuario";
    $email = "nuevo@example.com";
    mysqli_stmt_execute($stmt);
    
    if (mysqli_stmt_errno($stmt)) {
        throw new Exception("Error ejecutando la consulta: " . mysqli_stmt_error($stmt));
    }
    
    $usuario_id = mysqli_insert_id($conn);

    // Insertar una publicación para ese usuario
    $sql = "INSERT INTO publicaciones (usuario_id, titulo, contenido) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        throw new Exception("Error preparando la consulta: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "iss", $usuario_id, $titulo, $contenido);
    $titulo = "Nueva Publicación";
    $contenido = "Contenido de la nueva publicación";
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_errno($stmt)) {
        throw new Exception("Error ejecutando la consulta: " . mysqli_stmt_error($stmt));
    }

    // Confirmar la transacción
    mysqli_commit($conn);
    echo "Transacción completada con éxito.";
} catch (Exception $e) {
    // Revertir la transacción
    mysqli_rollback($conn);
    
    // Escribir el error en un archivo de log
    registrarError($e->getMessage());
    echo "Error en la transacción: " . $e->getMessage();
}

mysqli_close($conn);

// Función para registrar errores en un archivo de log
function registrarError($mensaje) {
    $fecha = date("Y-m-d H:i:s");
    $log = "[" . $fecha . "] " . $mensaje . PHP_EOL;
    file_put_contents("error_log.txt", $log, FILE_APPEND);
}
?>
