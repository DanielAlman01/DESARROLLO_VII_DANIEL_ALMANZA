<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Compra</title>
</head>
<body>
    <?php
    require_once 'funciones_tienda.php';

    $carrito = [
        'camisa' => 2,
        'pantalon' => 1,
        'zapatos' => 1,
        'calcetines' => 3,
        'gorra' => 0
    ];

    $subtotal = calcular_subtotal($carrito, $productos);
    $descuento = calcular_descuento($subtotal);
    $impuesto = calcular_impuesto($subtotal);
    $total = calcular_total($subtotal, $descuento, $impuesto);

    echo "<h2>Problema 2: Resumen de compra</h2>";
    echo "<h3>Productos comprados:</h3>";
    echo "<ul>";
    echo generar_resumen_compra($carrito, $productos);
    echo "</ul>";
    echo "<p>Subtotal: $" . number_format($subtotal, 2) . "</p>";
    echo "<p>Descuento: $" . number_format($descuento, 2) . "</p>";
    echo "<p>Impuesto: $" . number_format($impuesto, 2) . "</p>";
    echo "<p><strong>Total a pagar: $" . number_format($total, 2) . "</strong></p>";
    ?>
</body>
</html>