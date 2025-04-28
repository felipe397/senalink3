<?php
// routes/api.php
// Enrutador principal del backend de SenaLink

// Incluir los controladores necesarios
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/EmpresaController.php';
require_once __DIR__ . '/../controllers/UsuarioController.php';
require_once __DIR__ . '/../controllers/ProgramaController.php';
require_once __DIR__ . '/../controllers/DiagnosticoController.php';
require_once __DIR__ . '/../controllers/ReporteController.php';

// Obtener la solicitud actual
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Enrutamiento simple basado en URI y método HTTP
switch ($uri) {
    case '/api/login':
        if ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $controller = new AuthController();
            echo json_encode($controller->login($data['email'], $data['password']));
        }
        break;

    case '/api/empresas':
        $controller = new EmpresaController();
        if ($method === 'GET') {
            echo json_encode($controller->listarEmpresas());
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode($controller->crearEmpresa($data['nombre'], $data['nit']));
        }
        break;

    // Agrega aquí tus otras rutas (usuarios, programas, diagnósticos, reportes)...

    default:
        http_response_code(404);
        echo json_encode(["error" => "Ruta no encontrada"]);
        break;
}

// Nota: puedes extender esta lógica con validaciones de tokens, middlewares, etc.
?>
