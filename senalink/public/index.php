<?php
// public/index.php
// Archivo de entrada principal. Todas las peticiones al backend deben pasar por aquí.

// PASO 1: ESTABLECER CABECERAS COMUNES PARA RESPUESTAS JSON
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // Permitir CORS (útil si el frontend está en otro servidor)
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// PASO 2: INCLUIR EL ENRUTADOR
// Este archivo conecta el frontend con los controladores del backend según la ruta.
require_once __DIR__ . '/../routes/router.php';

// Nota: Si necesitas configurar URL amigables (sin ?ruta=...), deberás usar .htaccess (solo en Apache)
