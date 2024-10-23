<?php
session_start();

$usuarios = [
    'profesor1' => ['rol' => 'profesor', 'password' => '12345'],
    'estudiante1' => ['rol' => 'estudiante', 'password' => '12345'],
];

$usuario = $_POST['usuario'];
$password = $_POST['password'];

if (isset($usuarios[$usuario])) {
    if ($usuarios[$usuario]['password'] === $password) {
     
        $_SESSION['usuario'] = $usuario;
        $_SESSION['rol'] = $usuarios[$usuario]['rol'];

        if ($_SESSION['rol'] === 'profesor') {
            header('Location: dashboard_profesor.php');
        } else {
            header('Location: dashboard_estudiante.php');
        }
        exit();
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Usuario no encontrado.";
}
?>
