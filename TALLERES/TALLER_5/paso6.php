
<?php
// 1. Crear un arreglo multidimensional de ventas por región y producto
$ventas = [
    "<br>Norte" => [
        "<br>Producto A" => [100, 120, 140, 110, 130],
        "<br>Producto B" => [85, 95, 105, 90, 100],
        "<br>Producto C" => [60, 55, 65, 70, 75]
    ],
    "<br><br>Sur" => [
        "<br>Producto A" => [80, 90, 100, 85, 95],
        "<br>Producto B" => [120, 110, 115, 125, 130],
        "<br>Producto C" => [70, 75, 80, 65, 60]
    ],
    "<br><br>Este" => [
        "<br>Producto A" => [110, 115, 120, 105, 125],
        "<br>Producto B" => [95, 100, 90, 105, 110],
        "<br>Producto C" => [50, 60, 55, 65, 70]
    ],
    "<br><br>Oeste" => [
        "<br>Producto A" => [90, 85, 95, 100, 105],
        "<br>Producto B" => [105, 110, 100, 115, 120],
        "<br>Producto C" => [80, 85, 75, 70, 90]
    ]
];

// 2. Función para calcular el promedio de ventas
function promedioVentas($ventas) {
    return array_sum($ventas) / count($ventas);
}

// 3. Calcular y mostrar el promedio de ventas por región y producto
echo "<br><br>Promedio de ventas por región y producto:\n<br>";
foreach ($ventas as $region => $productos) {
    echo "$region:\n";
    foreach ($productos as $producto => $ventasProducto) {
        $promedio = promedioVentas($ventasProducto);
        echo "  $producto: " . number_format($promedio, 2) . "\n";
    }
    echo "\n";
}

// 4. Función para encontrar el producto más vendido en una región
function productoMasVendido($productos) {
    $maxVentas = 0;
    $productoTop = '';
    foreach ($productos as $producto => $ventas) {
        $totalVentas = array_sum($ventas);
        if ($totalVentas > $maxVentas) {
            $maxVentas = $totalVentas;
            $productoTop = $producto;
        }
    }
    return [$productoTop, $maxVentas];
}

// 5. Encontrar y mostrar el producto más vendido por región
echo "<br><br><br>Producto más vendido por región:<br>";
foreach ($ventas as $region => $productos) {
    [$productoTop, $ventasTop] = productoMasVendido($productos);
    echo "$region: $productoTop (Total: $ventasTop)\n";
}

// 6. Calcular las ventas totales por producto
$ventasTotalesPorProducto = [];
foreach ($ventas as $region => $productos) {
    foreach ($productos as $producto => $ventasProducto) {
        if (!isset($ventasTotalesPorProducto[$producto])) {
            $ventasTotalesPorProducto[$producto] = 0;
        }
        $ventasTotalesPorProducto[$producto] += array_sum($ventasProducto);
    }
}

echo "<br><br><br>\nVentas totales por producto:\n";
arsort($ventasTotalesPorProducto);
foreach ($ventasTotalesPorProducto as $producto => $total) {
    echo "$producto: $total\n";
}

// 7. Encontrar la región con mayores ventas totales
$ventasTotalesPorRegion = array_map(function($productos) {
    return array_sum(array_map('array_sum', $productos));
}, $ventas);

$regionTopVentas = array_keys($ventasTotalesPorRegion, max($ventasTotalesPorRegion))[0];
echo "<br><br><br>\nRegión con mayores ventas totales: $regionTopVentas\n<br>";

// TAREA: Implementa una función que analice el crecimiento de ventas
// Calcula y muestra el porcentaje de crecimiento de ventas del primer al último mes
// para cada producto en cada región. Identifica el producto y la región con mayor crecimiento.
// Tu código aquí

function crecimientoVentas($ventas) {
    $primerMes = $ventas[0];
    $ultimoMes = end($ventas);
    
    if ($primerMes == 0) {
        return $ultimoMes > 0 ? 100 : 0;
    }
    
    return (($ultimoMes - $primerMes) / $primerMes) * 100;
}

echo "<br><br>\nCrecimiento de ventas del primer al último mes:\n<br>";
$maxCrecimiento = -PHP_INT_MAX;
$productoMayorCrecimiento = '';
$regionMayorCrecimiento = '';

foreach ($ventas as $region => $productos) {
    echo "$region:\n";
    foreach ($productos as $producto => $ventasProducto) {
        $crecimiento = crecimientoVentas($ventasProducto);
        echo "  $producto: " . number_format($crecimiento, 2) . "%\n<br>";

        if ($crecimiento > $maxCrecimiento) {
            $maxCrecimiento = $crecimiento;
            $productoMayorCrecimiento = $producto;
            $regionMayorCrecimiento = $region;
        }
    }
}

echo "<br><br>\nProducto con mayor crecimiento: $productoMayorCrecimiento en la región $regionMayorCrecimiento ($maxCrecimiento%)\n";

?>
        