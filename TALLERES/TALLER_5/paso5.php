
<?php
// 1. Crear un string JSON con datos de una tienda en línea
$jsonDatos = '
{
    "tienda": "ElectroTech",
    "productos": [
        {"id": 1, "nombre": "Laptop Gamer", "precio": 1200, "categorias": ["electrónica", "computadoras"]},
        {"id": 2, "nombre": "Smartphone 5G", "precio": 800, "categorias": ["electrónica", "celulares"]},
        {"id": 3, "nombre": "Auriculares Bluetooth", "precio": 150, "categorias": ["electrónica", "accesorios"]},
        {"id": 4, "nombre": "Smart TV 4K", "precio": 700, "categorias": ["electrónica", "televisores"]},
        {"id": 5, "nombre": "Tablet", "precio": 300, "categorias": ["electrónica", "computadoras"]}
    ],
    "clientes": [
        {"id": 101, "nombre": "Ana López", "email": "ana@example.com"},
        {"id": 102, "nombre": "Carlos Gómez", "email": "carlos@example.com"},
        {"id": 103, "nombre": "María Rodríguez", "email": "maria@example.com"}
    ]
}
';

// 2. Convertir el JSON a un arreglo asociativo de PHP
$tiendaData = json_decode($jsonDatos, true);

// 3. Función para imprimir los productos
function imprimirProductos($productos) {
    foreach ($productos as $producto) {
        echo "{$producto['nombre']} - \${$producto['precio']} - Categorías: " . implode(", ", $producto['categorias']) . "\n<br><br>";
    }
}

echo "Productos de {$tiendaData['tienda']}:\n";
imprimirProductos($tiendaData['productos']);

// 4. Calcular el valor total del inventario
$valorTotal = array_reduce($tiendaData['productos'], function($total, $producto) {
    return $total + $producto['precio'];
}, 0);

echo "<br>\nValor total del inventario: $$valorTotal\n<br>";

// 5. Encontrar el producto más caro
$productoMasCaro = array_reduce($tiendaData['productos'], function($max, $producto) {
    return ($producto['precio'] > $max['precio']) ? $producto : $max;
}, $tiendaData['productos'][0]);

echo "<br>\nProducto más caro: {$productoMasCaro['nombre']} (\${$productoMasCaro['precio']})\n<br>";

// 6. Filtrar productos por categoría
function filtrarPorCategoria($productos, $categoria) {
    return array_filter($productos, function($producto) use ($categoria) {
        return in_array($categoria, $producto['categorias']);
    });
}

$productosDeComputadoras = filtrarPorCategoria($tiendaData['productos'], "computadoras");
echo "<br>\nProductos en la categoría 'computadoras':\n<br>";
imprimirProductos($productosDeComputadoras);

// 7. Agregar un nuevo producto
$nuevoProducto = [
    "id" => 6,
    "nombre" => "Smartwatch",
    "precio" => 250,
    "categorias" => ["electrónica", "accesorios", "wearables"]
];
$tiendaData['productos'][] = $nuevoProducto;

// 8. Convertir el arreglo actualizado de vuelta a JSON
$jsonActualizado = json_encode($tiendaData, JSON_PRETTY_PRINT);
echo "<br>\nDatos actualizados de la tienda (JSON):\n$jsonActualizado\n<br>";

// TAREA: Implementa una función que genere un resumen de ventas
// Crea un arreglo de ventas (producto_id, cliente_id, cantidad, fecha)
$ventas = [
    ["producto_id" => 1, "cliente_id" => 101, "cantidad" => 2, "fecha" => "2024-09-01"],
    ["producto_id" => 3, "cliente_id" => 102, "cantidad" => 1, "fecha" => "2024-09-05"],
    ["producto_id" => 2, "cliente_id" => 103, "cantidad" => 3, "fecha" => "2024-09-10"],
    ["producto_id" => 1, "cliente_id" => 101, "cantidad" => 1, "fecha" => "2024-09-12"],
    ["producto_id" => 5, "cliente_id" => 103, "cantidad" => 2, "fecha" => "2024-09-15"]
];


// y genera un informe que muestre:
// - Total de ventas
// - Producto más vendido
// - Cliente que más ha comprado
// Tu código aquí

// Generar un informe de ventas que muestre:
function generarInformeVentas($ventas, $productos, $clientes) {

    // total de ventas
    $totalVentas = array_reduce($ventas, function($total, $venta) use ($productos) {
        $producto = array_filter($productos, function($p) use ($venta) {
            return $p['id'] == $venta['producto_id'];
        });
        $producto = array_values($producto)[0];
        return $total + ($producto['precio'] * $venta['cantidad']);
    }, 0);

    // Producto más vendido
    $productosVendidos = [];
    foreach ($ventas as $venta) {
        if (!isset($productosVendidos[$venta['producto_id']])) {
            $productosVendidos[$venta['producto_id']] = 0;
        }
        $productosVendidos[$venta['producto_id']] += $venta['cantidad'];
    }
    $productoMasVendidoId = array_keys($productosVendidos, max($productosVendidos))[0];
    $productoMasVendido = array_filter($productos, function($p) use ($productoMasVendidoId) {
        return $p['id'] == $productoMasVendidoId;
    });
    $productoMasVendido = array_values($productoMasVendido)[0];

    // Cliente que más ha comprado
    $clientesCompras = [];
    foreach ($ventas as $venta) {
        if (!isset($clientesCompras[$venta['cliente_id']])) {
            $clientesCompras[$venta['cliente_id']] = 0;
        }
        $clientesCompras[$venta['cliente_id']] += $venta['cantidad'];
    }
    $clienteMasCompradorId = array_keys($clientesCompras, max($clientesCompras))[0];
    $clienteMasComprador = array_filter($clientes, function($c) use ($clienteMasCompradorId) {
        return $c['id'] == $clienteMasCompradorId;
    });
    $clienteMasComprador = array_values($clienteMasComprador)[0];

    // Imprimir informe
    echo "\nInforme de ventas:\n<br>";
    echo "Total de ventas: $$totalVentas\n<br>";
    echo "Producto más vendido: {$productoMasVendido['nombre']} ({$productosVendidos[$productoMasVendidoId]} unidades)\n<br>";
    echo "Cliente que más ha comprado: {$clienteMasComprador['nombre']}\n<br>";
}

// Usar la función de informe de ventas
generarInformeVentas($ventas, $tiendaData['productos'], $tiendaData['clientes']);

?>
