<?php
$productos = [
    'camisa' => 50,
    'pantalon' => 70,
    'zapatos' => 80,
    'calcetines' => 10,
    'gorra' => 25
];

$carrito = [
    'camisa' => 2,
    'pantalon' => 1,
    'zapatos' => 1,
    'calcetines' => 3,
    'gorra' => 0
];

$subtotal = 0;
foreach ($carrito as $producto => $cantidad) {
    if (isset($productos[$producto])) {
        $subtotal += $productos[$producto] * $cantidad;
    }
}

// Calcular descuento
if ($subtotal < 100) {
    $descuento = 0;
} elseif ($subtotal <= 500) {
    $descuento = $subtotal * 0.05;
} elseif ($subtotal <= 1000) {
    $descuento = $subtotal * 0.10;
} else {
    $descuento = $subtotal * 0.15;
}

// Calcular impuesto
$impuesto = $subtotal * 0.07;

// Calcular total
$total = $subtotal - $descuento + $impuesto;

echo "<h2>Problema 2: Resumen de compra</h2>";
echo "<h3>Productos comprados:</h3>";
echo "<ul>";
foreach ($carrito as $producto => $cantidad) {
    if ($cantidad > 0) {
        $precio = $productos[$producto];
        echo "<li>$producto: $cantidad x $$precio = $" . ($cantidad * $precio) . "</li>";
    }
}
echo "</ul>";

echo "<p>Subtotal: $" . number_format($subtotal, 2) . "</p>";
echo "<p>Descuento: $" . number_format($descuento, 2) . "</p>";
echo "<p>Impuesto: $" . number_format($impuesto, 2) . "</p>";
echo "<p><strong>Total a pagar: $" . number_format($total, 2) . "</strong></p>";

?>