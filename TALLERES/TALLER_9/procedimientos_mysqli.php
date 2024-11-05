
<?php
require_once "config_mysqli.php";

// Función para registrar una venta
function registrarVenta($conn, $cliente_id, $producto_id, $cantidad) {
    $query = "CALL sp_registrar_venta(?, ?, ?, @venta_id)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iii", $cliente_id, $producto_id, $cantidad);
    
    try {
        mysqli_stmt_execute($stmt);
        
        // Obtener el ID de la venta
        $result = mysqli_query($conn, "SELECT @venta_id as venta_id");
        $row = mysqli_fetch_assoc($result);
        
        echo "Venta registrada con éxito. ID de venta: " . $row['venta_id'];
    } catch (Exception $e) {
        echo "Error al registrar la venta: " . $e->getMessage();
    }
    
    mysqli_stmt_close($stmt);
}

// Función para obtener estadísticas de cliente
function obtenerEstadisticasCliente($conn, $cliente_id) {
    $query = "CALL sp_estadisticas_cliente(?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $cliente_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $estadisticas = mysqli_fetch_assoc($result);
        
        echo "<h3>Estadísticas del Cliente</h3>";
        echo "Nombre: " . $estadisticas['nombre'] . "<br>";
        echo "Membresía: " . $estadisticas['nivel_membresia'] . "<br>";
        echo "Total compras: " . $estadisticas['total_compras'] . "<br>";
        echo "Total gastado: $" . $estadisticas['total_gastado'] . "<br>";
        echo "Promedio de compra: $" . $estadisticas['promedio_compra'] . "<br>";
        echo "Últimos productos: " . $estadisticas['ultimos_productos'] . "<br>";
    }
    
    mysqli_stmt_close($stmt);
}

registrarVenta($conn, 1, 1, 2);
obtenerEstadisticasCliente($conn, 1);

mysqli_close($conn);

function procesarDevolucion($conn, $venta_id, $producto_id, $cantidad) {
    $query = "CALL sp_procesar_devolucion(?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iii", $venta_id, $producto_id, $cantidad);
    
    try {
        mysqli_stmt_execute($stmt);
        echo "Devolución procesada correctamente.";
    } catch (Exception $e) {
        echo "Error al procesar devolución: " . $e->getMessage();
    }

    mysqli_stmt_close($stmt);
}

// Procedimiento para aplicar descuento
function aplicarDescuento($conn, $cliente_id, $porcentaje_descuento) {
    $query = "CALL sp_aplicar_descuento(?, ?, @descuento_total)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "id", $cliente_id, $porcentaje_descuento);
    
    try {
        mysqli_stmt_execute($stmt);
        
        // Obtener el descuento total aplicado
        $result = mysqli_query($conn, "SELECT @descuento_total AS descuento_total");
        $row = mysqli_fetch_assoc($result);
        
        echo "Descuento total aplicado: $" . $row['descuento_total'];
    } catch (Exception $e) {
        echo "Error al aplicar descuento: " . $e->getMessage();
    }
    
    mysqli_stmt_close($stmt);
}

// Procedimiento para reporte de productos con bajo stock
function reporteBajoStock($conn, $umbral) {
    $query = "CALL sp_reporte_bajo_stock(?, @reposicion_total)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $umbral);
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        
        echo "<h3>Reporte de Bajo Stock</h3>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "ID Producto: " . $row['id'] . "<br>";
            echo "Nombre: " . $row['nombre'] . "<br>";
            echo "Stock Actual: " . $row['stock'] . "<br>";
            echo "Sugerido Reposición: " . $row['sugerido_reposicion'] . "<br><br>";
        }
        
        // Obtener la cantidad total de reposición sugerida
        $result = mysqli_query($conn, "SELECT @reposicion_total AS reposicion_total");
        $row = mysqli_fetch_assoc($result);
        
        echo "Total de reposición sugerida: " . $row['reposicion_total'];
    }
    
    mysqli_stmt_close($stmt);
}

// Procedimiento para calcular comisiones
function calcularComisiones($conn, $vendedor_id, $porcentaje) {
    $query = "CALL sp_calcular_comisiones(?, ?, @comision_total)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "id", $vendedor_id, $porcentaje);
    
    try {
        mysqli_stmt_execute($stmt);
        
        // Obtener el valor de la comisión total calculada
        $result = mysqli_query($conn, "SELECT @comision_total AS comision_total");
        $row = mysqli_fetch_assoc($result);
        
        echo "Comisión total calculada: $" . $row['comision_total'];
    } catch (Exception $e) {
        echo "Error al calcular comisión: " . $e->getMessage();
    }
    
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);

?>
        