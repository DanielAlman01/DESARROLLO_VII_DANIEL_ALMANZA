<?php
$productos = [
    'camisa' => 50,
    'pantalon' => 70,
    'zapatos' => 80,
    'calcetines' => 10,
    'gorra' => 25
];

function calcular_subtotal($carrito, $productos) {
    $subtotal = 0;
    foreach ($carrito as $producto => $cantidad) {
        if (isset($productos[$producto])) { 
            $subtotal += $productos[$producto] * $cantidad;
        }
    }
    return $subtotal;
}

function calcular_descuento($subtotal) {
    if ($subtotal < 100) {
        return 0;
    } elseif ($subtotal <= 500) {
        return $subtotal * 0.05;
    } elseif ($subtotal <= 1000) {
        return $subtotal * 0.10;
    } else {
        return $subtotal * 0.15;
    }
}

function calcular_impuesto($subtotal) {
    return $subtotal * 0.07;
}

function calcular_total($subtotal, $descuento, $impuesto) {
    return $subtotal - $descuento + $impuesto;
}

function generar_resumen_compra($carrito, $productos) {
    $resumen = "";
    foreach ($carrito as $producto => $cantidad) {
        if ($cantidad > 0) {
            $precio = $productos[$producto];
            $resumen .= "<li>$producto: $cantidad x $$precio = $" . ($cantidad * $precio) . "</li>";
        }
    }
    return $resumen;
}
?>