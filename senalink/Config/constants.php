<?php
// config/constants.php
// Constantes globales del sistema SenaLink

// Roles de usuario
define('ROL_SUPER_ADMIN', 'SU_ADMIN');
define('ROL_ADMIN_SENA', 'ADMIN_SENA');
define('ROL_EMPRESA', 'EMPRESA');

// Estados de diagnóstico (puedes agregar más según la lógica del negocio)
define('ESTADO_DIAGNOSTICO_PENDIENTE', 'pendiente');
define('ESTADO_DIAGNOSTICO_COMPLETADO', 'completado');

// Ruta base para reportes generados (PDF o XML)
define('RUTA_REPORTES', __DIR__ . '/../uploads/reportes/');
?>
