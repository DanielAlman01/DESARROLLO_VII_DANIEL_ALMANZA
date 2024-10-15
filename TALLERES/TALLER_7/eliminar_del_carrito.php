<?php
include 'config_sesion.php';

// Verificar si se recibió el ID del producto
if (isset($_GET['id'])) {
    $id_producto = intval($_GET['id']);
    
    // Verificar si el producto existe en el carrito
    if (isset($_SESSION['carrito'][$id_producto])) {
        unset($_SESSION['carrito'][$id_producto]);
    }

    header("Location: ver_carrito.php");
    exit();
} else {
    echo "Producto no especificado.";
}
?>
