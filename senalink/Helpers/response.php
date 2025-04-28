<?php
// helpers/response.php
// Funciones reutilizables para enviar respuestas JSON consistentes en todo el backend.

// PASO 1: LLAMAR A responseSuccess() cuando tu operación fue exitosa
function responseSuccess($data = [], $message = 'Operación exitosa') {
    echo json_encode([
        'status' => 'success',
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

// PASO 2: LLAMAR A responseError() cuando ocurra un error
function responseError($message = 'Ocurrió un error', $code = 400) {
    http_response_code($code);
    echo json_encode([
        'status' => 'error',
        'message' => $message
    ]);
    exit;
}

// Puedes incluir más funciones aquí si lo deseas (por ejemplo: validaciones, logger, etc.)
