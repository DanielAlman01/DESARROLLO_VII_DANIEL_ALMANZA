<?php
include 'config_sesion.php';

// Lista de productos
$productos = [
    ['id' => 1, 'nombre' => 'Producto 1', 'precio' => 10],
    ['id' => 2, 'nombre' => 'Producto 2', 'precio' => 20],
    ['id' => 3, 'nombre' => 'Producto 3', 'precio' => 30],
    ['id' => 4, 'nombre' => 'Producto 4', 'precio' => 40],
    ['id' => 5, 'nombre' => 'Producto 5', 'precio' => 50],
];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
</head>
<body>
    <h2>Productos</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($productos as $producto): ?>
        <tr>
            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
            <td><?php echo htmlspecialchars($producto['precio']); ?> $</td>
            <td>
                <a href="agregar_al_carrito.php?id=<?php echo $producto['id']; ?>">Añadir al carrito</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="ver_carrito.php">Ver Carrito</a>
</body>
</html>
