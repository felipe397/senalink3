<?php
// routes/router.php
// Plantilla autosostenible para enrutar las solicitudes HTTP entrantes al controlador correspondiente.

// PASO 1: DEFINE LAS RUTAS QUE ACEPTARÁS EN TU PROYECTO
// Cada ruta debe tener su método (GET, POST, etc.), una URL y una función del controlador asociada.

// EJEMPLO: Ruta para obtener todos los registros de ejemplo
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['ruta'] === 'ejemplo/obtener') {
    require_once __DIR__ . '/../controllers/PlantillaController.php';
    $controller = new PlantillaController();
    $controller->obtenerEjemplo();
    exit;
}

// Aquí puedes seguir agregando más rutas, como:
//// POST: crear nuevo
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['ruta'] === 'empresa/crear') {
//     require_once __DIR__ . '/../controllers/EmpresaController.php';
//     $controller = new EmpresaController();
//     $controller->crear();
//     exit;
// }

//// PUT o DELETE también pueden añadirse usando métodos personalizados si usas fetch() en JS

// PASO 2: SI LA RUTA NO EXISTE, MUESTRA ERROR
http_response_code(404);
echo json_encode(['error' => 'Ruta no encontrada']);
