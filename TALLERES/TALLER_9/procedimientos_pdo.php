<?php
require_once "config_pdo.php";

// Función para registrar una venta
function registrarVenta($pdo, $cliente_id, $producto_id, $cantidad) {
    try {
        $stmt = $pdo->prepare("CALL sp_registrar_venta(:cliente_id, :producto_id, :cantidad, @venta_id)");
        $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
        $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->execute();
        
        // Obtener el ID de la venta
        $result = $pdo->query("SELECT @venta_id as venta_id")->fetch(PDO::FETCH_ASSOC);
        
        echo "Venta registrada con éxito. ID de venta: " . $result['venta_id'];
    } catch (PDOException $e) {
        echo "Error al registrar la venta: " . $e->getMessage();
    }
}

// Función para obtener estadísticas de cliente
function obtenerEstadisticasCliente($pdo, $cliente_id) {
    try {
        $stmt = $pdo->prepare("CALL sp_estadisticas_cliente(:cliente_id)");
        $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $estadisticas = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo "<h3>Estadísticas del Cliente</h3>";
        echo "Nombre: " . $estadisticas['nombre'] . "<br>";
        echo "Membresía: " . $estadisticas['nivel_membresia'] . "<br>";
        echo "Total compras: " . $estadisticas['total_compras'] . "<br>";
        echo "Total gastado: $" . $estadisticas['total_gastado'] . "<br>";
        echo "Promedio de compra: $" . $estadisticas['promedio_compra'] . "<br>";
        echo "Últimos productos: " . $estadisticas['ultimos_productos'] . "<br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Ejemplos de uso
registrarVenta($pdo, 1, 1, 2);
obtenerEstadisticasCliente($pdo, 1);

$pdo = null;

function procesarDevolucion($pdo, $venta_id, $producto_id, $cantidad) {
    try {
        $stmt = $pdo->prepare("CALL sp_procesar_devolucion(:venta_id, :producto_id, :cantidad)");
        $stmt->bindParam(':venta_id', $venta_id, PDO::PARAM_INT);
        $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->execute();
        
        echo "Devolución procesada correctamente.";
    } catch (PDOException $e) {
        echo "Error al procesar devolución: " . $e->getMessage();
    }
}

require_once "config_pdo.php";

// Procedimiento para aplicar descuento
function aplicarDescuento($pdo, $cliente_id, $porcentaje_descuento) {
    try {
        $stmt = $pdo->prepare("CALL sp_aplicar_descuento(:cliente_id, :porcentaje_descuento, @descuento_total)");
        $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
        $stmt->bindParam(':porcentaje_descuento', $porcentaje_descuento, PDO::PARAM_STR);
        $stmt->execute();
        
        // Obtener el descuento total aplicado
        $result = $pdo->query("SELECT @descuento_total AS descuento_total")->fetch(PDO::FETCH_ASSOC);
        
        echo "Descuento total aplicado: $" . $result['descuento_total'];
    } catch (PDOException $e) {
        echo "Error al aplicar descuento: " . $e->getMessage();
    }
}

// Procedimiento para reporte de productos con bajo stock
function reporteBajoStock($pdo, $umbral) {
    try {
        $stmt = $pdo->prepare("CALL sp_reporte_bajo_stock(:umbral, @reposicion_total)");
        $stmt->bindParam(':umbral', $umbral, PDO::PARAM_INT);
        $stmt->execute();
        
        echo "<h3>Reporte de Bajo Stock</h3>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "ID Producto: " . $row['id'] . "<br>";
            echo "Nombre: " . $row['nombre'] . "<br>";
            echo "Stock Actual: " . $row['stock'] . "<br>";
            echo "Sugerido Reposición: " . $row['sugerido_reposicion'] . "<br><br>";
        }
        
        // Obtener la cantidad total de reposición sugerida
        $result = $pdo->query("SELECT @reposicion_total AS reposicion_total")->fetch(PDO::FETCH_ASSOC);
        echo "Total de reposición sugerida: " . $result['reposicion_total'];
    } catch (PDOException $e) {
        echo "Error en el reporte de bajo stock: " . $e->getMessage();
    }
}

// Procedimiento para calcular comisiones
function calcularComisiones($pdo, $vendedor_id, $porcentaje) {
    try {
        $stmt = $pdo->prepare("CALL sp_calcular_comisiones(:vendedor_id, :porcentaje, @comision_total)");
        $stmt->bindParam(':vendedor_id', $vendedor_id, PDO::PARAM_INT);
        $stmt->bindParam(':porcentaje', $porcentaje, PDO::PARAM_STR);
        $stmt->execute();
        
        // Obtener el valor de la comisión total calculada
        $result = $pdo->query("SELECT @comision_total AS comision_total")->fetch(PDO::FETCH_ASSOC);
        
        echo "Comisión total calculada: $" . $result['comision_total'];
    } catch (PDOException $e) {
        echo "Error al calcular comisión: " . $e->getMessage();
    }
}

$pdo = null;
?>