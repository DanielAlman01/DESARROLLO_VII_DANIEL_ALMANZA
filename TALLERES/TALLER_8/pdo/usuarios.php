<?php
require_once 'config.php';

// Listar todos los usuarios
function listarUsuarios($pdo) {
    $stmt = $pdo->query("SELECT * FROM usuarios");
    while ($usuario = $stmt->fetch()) {
        echo "Nombre: " . $usuario['nombre'] . " - Email: " . $usuario['email'] . "<br>";
    }
}

// Añadir nuevo usuario
function agregarUsuario($pdo, $nombre, $email, $password) {
    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nombre' => $nombre,
        ':email' => $email,
        ':password' => $password
    ]);
}

// Actualizar usuario
function actualizarUsuario($pdo, $id, $nombre, $email, $password) {
    $sql = "UPDATE usuarios SET nombre=:nombre, email=:email, password=:password WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nombre' => $nombre,
        ':email' => $email,
        ':password' => $password,
        ':id' => $id
    ]);
}

// Eliminar usuario
function eliminarUsuario($pdo, $id) {
    $sql = "DELETE FROM usuarios WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
}

// Llamadas de ejemplo
agregarUsuario($pdo, 'Usuario Prueba PDO', 'prueba_pdo@example.com', '654321');
listarUsuarios($pdo);
?>
