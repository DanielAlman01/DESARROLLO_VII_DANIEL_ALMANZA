<?php
session_start([
    'cookie_lifetime' => 86400, // 24 horas
    'cookie_httponly' => true,
    'cookie_secure' => false, // Cambia a true si usas HTTPS
    'cookie_samesite' => 'Lax'
]);
?>
