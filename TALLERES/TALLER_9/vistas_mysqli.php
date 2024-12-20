<?php
require_once "config_mysqli.php";

function mostrarResumenCategorias($conn) {
    $sql = "SELECT * FROM vista_resumen_categorias";
    $result = mysqli_query($conn, $sql);

    echo "<h3>Resumen por Categorías:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Categoría</th>
            <th>Total Productos</th>
            <th>Stock Total</th>
            <th>Precio Promedio</th>
            <th>Precio Mínimo</th>
            <th>Precio Máximo</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['categoria']}</td>";
        echo "<td>{$row['total_productos']}</td>";
        echo "<td>{$row['total_stock']}</td>";
        echo "<td>${$row['precio_promedio']}</td>";
        echo "<td>${$row['precio_minimo']}</td>";
        echo "<td>${$row['precio_maximo']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}

function mostrarProductosPopulares($conn) {
    $sql = "SELECT * FROM vista_productos_populares LIMIT 5";
    $result = mysqli_query($conn, $sql);

    echo "<h3>Top 5 Productos Más Vendidos:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Producto</th>
            <th>Categoría</th>
            <th>Total Vendido</th>
            <th>Ingresos Totales</th>
            <th>Compradores Únicos</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['producto']}</td>";
        echo "<td>{$row['categoria']}</td>";
        echo "<td>{$row['total_vendido']}</td>";
        echo "<td>${$row['ingresos_totales']}</td>";
        echo "<td>{$row['compradores_unicos']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}

// Mostrar los resultados
mostrarResumenCategorias($conn);
mostrarProductosPopulares($conn);

mysqli_close($conn);

function mostrarProductosBajoStock($conn) {
    $sql = "SELECT * FROM vista_productos_bajo_stock";
    $result = mysqli_query($conn, $sql);

    echo "<h3>Productos con Bajo Stock:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Producto</th>
            <th>Stock</th>
            <th>Total Vendido</th>
            <th>Ingresos Totales</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['producto']}</td>";
        echo "<td>{$row['stock']}</td>";
        echo "<td>{$row['total_vendido']}</td>";
        echo "<td>${$row['ingresos_totales']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}

function mostrarHistorialClientes($conn) {
    $sql = "SELECT * FROM vista_historial_clientes";
    $result = mysqli_query($conn, $sql);

    echo "<h3>Historial de Compras de Clientes:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Cliente</th>
            <th>Email</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th>Fecha de Venta</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['cliente']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['producto']}</td>";
        echo "<td>{$row['cantidad']}</td>";
        echo "<td>${$row['subtotal']}</td>";
        echo "<td>{$row['fecha_venta']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}

require_once "config_mysqli.php";

function mostrarRendimientoPorCategoria($conn) {
    $sql = "SELECT * FROM vista_rendimiento_categorias";
    $result = $conn->query($sql);

    echo "<h3>Métricas de Rendimiento por Categoría:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Categoría</th>
            <th>Total Productos</th>
            <th>Ventas Totales</th>
            <th>Producto Más Vendido</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['categoria']}</td>";
        echo "<td>{$row['total_productos']}</td>";
        echo "<td>{$row['ventas_totales']}</td>";
        echo "<td>{$row['producto_mas_vendido']}</td>";
        echo "</tr>";
    }
    echo "</table>";
}

function mostrarTendenciasVentasMensuales($conn) {
    $sql = "SELECT * FROM vista_tendencias_ventas_mensuales";
    $result = $conn->query($sql);

    echo "<h3>Tendencias de Ventas Mensuales:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Producto</th>
            <th>Mes</th>
            <th>Año</th>
            <th>Total Vendido</th>
            <th>Ingresos</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['producto']}</td>";
        echo "<td>{$row['mes']}</td>";
        echo "<td>{$row['año']}</td>";
        echo "<td>{$row['total_vendido']}</td>";
        echo "<td>{$row['ingresos']}</td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Mostrar los resultados
mostrarRendimientoPorCategoria($conn);
mostrarTendenciasVentasMensuales($conn);

$conn->close();
?>