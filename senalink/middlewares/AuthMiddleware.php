<?php
// middlewares/AuthMiddleware.php
// Middleware para verificar si el usuario está autenticado usando token o sesión

class AuthMiddleware {
    public static function verificarAutenticacion() {
        session_start();

        // MÉTODO 1: Verificar por sesión
        if (isset($_SESSION['usuario_id'])) {
            return true; // Usuario autenticado por sesión
        }

        // MÉTODO 2: Verificar por token (ej: Authorization: Bearer xxx)
        $headers = apache_request_headers();
        if (isset($headers['Authorization'])) {
            $token = str_replace("Bearer ", "", $headers['Authorization']);

            // Aquí deberías consultar si el token es válido (en la BD o una tabla de sesiones activas)
            // Simulación:
            if ($token === "TOKEN_EJEMPLO_VALIDO") {
                return true;
            }
        }

        // Si no pasa ninguna validación, rechazar la solicitud
        http_response_code(401);
        echo json_encode(["error" => "No autorizado."]);
        exit();
    }
}
?>
