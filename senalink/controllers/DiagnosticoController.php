<?php
// controllers/DiagnosticoController.php
// Controlador para guardar diagnósticos empresariales

require_once __DIR__ . '/../config/db.php';

class DiagnosticoController {
    public function guardarDiagnostico($empresa_id, $respuestas) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO diagnosticos (empresa_id, respuestas, estado) VALUES (?, ?, ?)");
        return $stmt->execute([$empresa_id, json_encode($respuestas), 'pendiente']);
    }
}
?>
