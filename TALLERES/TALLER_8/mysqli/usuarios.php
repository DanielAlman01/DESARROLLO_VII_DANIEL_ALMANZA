<?php
require_once 'config.php';

// Listar todos los usuarios
function listarUsuarios($conn) {
    $sql = "SELECT * FROM usuarios";
    $result = mysqli_query($conn, $sql);

    while ($usuario = mysqli_fetch_assoc($result)) {
        echo "Nombre: " . $usuario['nombre'] . " - Email: " . $usuario['email'] . "<br>";
    }
}

// Añadir nuevo usuario
function agregarUsuario($conn, $nombre, $email, $password) {
    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sss', $nombre, $email, $password);
    mysqli_stmt_execute($stmt);
}

// Actualizar usuario
function actualizarUsuario($conn, $id, $nombre, $email, $password) {
    $sql = "UPDATE usuarios SET nombre=?, email=?, password=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssi', $nombre, $email, $password, $id);
    mysqli_stmt_execute($stmt);
}

// Eliminar usuario
function eliminarUsuario($conn, $id) {
    $sql = "DELETE FROM usuarios WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
}

// Llamadas de ejemplo
agregarUsuario($conn, 'Usuario Prueba', 'prueba@example.com', '123456');
listarUsuarios($conn);
mysqli_close($conn);
?>
