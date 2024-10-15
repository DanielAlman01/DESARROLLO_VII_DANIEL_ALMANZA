<?php
include 'config_sesion.php';

// Inicializar el carrito
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "El carrito está vacío. No se puede proceder al checkout.";
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
foreach ($_SESSION['carrito'] as $id => $cantidad) {
    $total += $productos[$id]['precio'] * $cantidad;
}

// Almacenar el nombre del usuario en una cookie (opcional)
if (!empty($_POST['nombre'])) {
    setcookie("usuario", $_POST['nombre'], time() + 86400); // 24 horas
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
</head>
<body>
    <h2>Resumen de Compra</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
        </tr>
        <?php foreach ($_SESSION['carrito'] as $id => $cantidad): ?>
        <tr>
            <td><?php echo htmlspecialchars($productos[$id]['nombre']); ?></td>
            <td><?php echo htmlspecialchars($productos[$id]['precio']); ?> $</td>
            <td><?php echo $cantidad; ?></td>
            <td><?php echo $productos[$id]['precio'] * $cantidad; ?> $</td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h3>Total: <?php echo $total; ?> $</h3>

    <h4>Nombre del Usuario</h4>
    <form method="post" action="">
        <input type="text" name="nombre" required placeholder="Ingresa tu nombre">
        <input type="submit" value="Finalizar Compra">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vaciar el carrito después del checkout
        unset($_SESSION['carrito']);
        echo "<p>Gracias por tu compra, " . htmlspecialchars($_POST['nombre']) . "!</p>";
    }
    ?>
</body>
</html>
