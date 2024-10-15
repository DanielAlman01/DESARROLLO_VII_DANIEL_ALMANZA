<?php
include 'config_sesion.php';

// Verificar si se recibió el ID del producto
if (isset($_GET['id'])) {
    $id_producto = intval($_GET['id']);
    
    // Inicializar el carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Añadir el producto al carrito
    if (isset($_SESSION['carrito'][$id_producto])) {
        $_SESSION['carrito'][$id_producto]++;
    } else {
        $_SESSION['carrito'][$id_producto] = 1;
    }

    header("Location: productos.php");
    exit();
} else {
    echo "Producto no especificado.";
}
?>
