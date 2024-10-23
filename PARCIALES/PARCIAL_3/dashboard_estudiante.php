<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'estudiante') {
    header('Location: login.php');
    exit();
}

$calificaciones = [
    'estudiante1' => 90,
];

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Estudiante</title>
</head>
<body>
    <h2>Bienvenido, Estudiante <?php echo $_SESSION['usuario']; ?></h2>
    <h3>Tu calificación:</h3>
    <p>Calificación: <?php echo $calificaciones[$usuario]; ?></p>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
