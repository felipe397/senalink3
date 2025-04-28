<?php
// controllers/PlantillaController.php
// Plantilla base para construir controladores en SenaLink. Úsala como modelo para crear otros controladores.

// PASO 1: INCLUIR LA CONEXIÓN A LA BASE DE DATOS
require_once __DIR__ . '/../config/database.php';

// PASO 2: CREA UNA CLASE CON EL NOMBRE DE TU CONTROLADOR
class PlantillaController {

    // Método ejemplo para obtener datos de una tabla
    public function obtenerEjemplo() {
        global $pdo;

        try {
            // Reemplaza 'nombre_tabla' por el nombre real de tu tabla
            $stmt = $pdo->query("SELECT * FROM nombre_tabla");
            $resultados = $stmt->fetchAll();

            // Devuelve los datos en formato JSON
            echo json_encode($resultados);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al obtener datos: ' . $e->getMessage()]);
        }
    }

    // Puedes crear más métodos aquí: crear(), actualizar(), eliminar(), etc.
    // Usa siempre try/catch para manejar errores y devuelve las respuestas en JSON.
}
