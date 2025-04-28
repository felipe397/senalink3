<?php
// controllers/ProgramaController.php
// Controlador para CRUD de programas de formación

require_once __DIR__ . '/../config/db.php';

class ProgramaController {
    public function listarProgramas() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM programas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearPrograma($nombre, $descripcion) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO programas (nombre, descripcion) VALUES (?, ?)");
        return $stmt->execute([$nombre, $descripcion]);
    }
}
?>
