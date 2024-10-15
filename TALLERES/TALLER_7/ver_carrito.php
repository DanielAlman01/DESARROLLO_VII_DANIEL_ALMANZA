<?php
include 'config_sesion.php';

// Inicializar el carrito
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "El carrito está vacío.";
    exit();
}

// Lista de productos (debe ser la misma que en productos.php)
$productos = [
    1 => ['nombre' => 'Producto 1', 'precio' => 10],
    2 => ['nombre' => 'Producto 2', 'precio' => 20],
    3 => ['nombre' => 'Producto 3', 'precio' => 30],
    4 => ['nombre' => 'Producto 4', 'precio' => 40],
    5 => ['nombre' => 'Producto 5', 'precio' => 50],
];

// Calcular total
$total = 0;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Carrito</title>
</head>
<body>
    <h2>Carrito de Compras</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($_SESSION['carrito'] as $id => $cantidad): ?>
        <tr>
            <td><?php echo htmlspecialchars($productos[$id]['nombre']); ?></td>
            <td><?php echo htmlspecialchars($productos[$id]['precio']); ?> $</td>
            <td><?php echo $cantidad; ?></td>
            <td><?php echo $productos[$id]['precio'] * $cantidad; ?> $</td>
            <td>
                <a href="eliminar_del_carrito.php?id=<?php echo $id; ?>">Eliminar</a>
            </td>
        </tr>
        <?php
        $total += $productos[$id]['precio'] * $cantidad;
        endforeach; ?>
    </table>
    <h3>Total: <?php echo $total; ?> $</h3>
    <a href="checkout.php">Proceder al Checkout</a>
</body>
</html>
