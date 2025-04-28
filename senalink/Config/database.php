<?php
// config/database.php
// Plantilla autosostenible para conectar tu backend con una base de datos MySQL utilizando PDO.

// PASO 1: MODIFICA ESTAS VARIABLES CON TUS CREDENCIALES REALES
$host = 'localhost';       // Dirección del servidor (normalmente 'localhost')
$db   = 'nombre_bd';       // Nombre de la base de datos (ej: senalink)
$user = 'usuario';         // Usuario de la base de datos (ej: root)
$pass = 'contraseña';      // Contraseña del usuario de la base de datos ('' por defecto en XAMPP)
$charset = 'utf8mb4';      // Codificación recomendada

// NO MODIFIQUES esta línea a menos que sepas lo que haces
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opciones que activan seguridad y manejo de errores
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Muestra errores detallados
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Devuelve los resultados como arrays asociativos
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Desactiva la emulación para seguridad real
];

// PASO 2: INTENTA CONECTARTE. Si algo falla, se devuelve un error en JSON.
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Fallo al conectar con la base de datos: ' . $e->getMessage()
    ]);
    exit;
}
