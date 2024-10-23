<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'profesor') {
    header('Location: login.php');
    exit();
}

$estudiantes = [
    'Daniel Almanza' => 90,
    'Willfredo Batista' => 30,
    'Gadafy Nebil' => 100,
    'Roderic Sabera' => 85,
    'WiguDoribal' => 80,
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Profesor</title>
</head>
<body>
    <h2>Bienvenido, Profesor <?php echo $_SESSION['usuario']; ?></h2>
    <h3>Lista de estudiantes y sus calificaciones:</h3>
    <ul>
        <?php foreach ($estudiantes as $nombre => $calificacion): ?>
            <li><?php echo $nombre . ": " . $calificacion; ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
