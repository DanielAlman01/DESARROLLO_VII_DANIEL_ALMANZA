<?php
require_once "config_pdo.php";

class TransactionManager {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function setIsolationLevel($level) {
        $levels = [
            'READ UNCOMMITTED',
            'READ COMMITTED',
            'REPEATABLE READ',
            'SERIALIZABLE'
        ];
        
        if (in_array($level, $levels)) {
            $this->pdo->exec("SET SESSION TRANSACTION ISOLATION LEVEL " . $level);
            echo "Nivel de aislamiento establecido a: $level<br>";
        }
    }
    
    // Ejemplo de transacción con lectura sucia (READ UNCOMMITTED)
    public function demonstrateDirtyRead() {
        try {
            $this->setIsolationLevel('READ UNCOMMITTED');
            
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare("UPDATE productos SET precio = precio * 1.1 WHERE id = ?");
            $stmt->execute([1]);
            
            // Simular un retraso
            sleep(2);
            
            // Rollback de la primera transacción
            $this->pdo->rollBack();
            echo "Transacción revertida<br>";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    // Ejemplo de transacción con lectura repetible
    public function demonstrateRepeatableRead() {
        try {
            $this->setIsolationLevel('REPEATABLE READ');
            
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->query("SELECT precio FROM productos WHERE id = 1");
            $precio1 = $stmt->fetchColumn();
            sleep(2);
            $stmt = $this->pdo->query("SELECT precio FROM productos WHERE id = 1");
            $precio2 = $stmt->fetchColumn();
            
            echo "Primera lectura: $precio1<br>";
            echo "Segunda lectura: $precio2<br>";
            
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }
}

// Ejemplo de uso
$tm = new TransactionManager($pdo);
$tm->demonstrateDirtyRead();
$tm->demonstrateRepeatableRead();
?>
