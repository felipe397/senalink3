<?php
// controllers/ReporteController.php
// Controlador para generar reportes PDF o XML

require_once __DIR__ . '/../utils/PDFGenerator.php';
require_once __DIR__ . '/../utils/XMLGenerator.php';

class ReporteController {
    public function generarReportePDF($diagnostico_id) {
        // Lógica para consultar datos y generar PDF
        return PDFGenerator::crearDesdeDiagnostico($diagnostico_id);
    }

    public function generarReporteXML($diagnostico_id) {
        // Lógica para consultar datos y generar XML
        return XMLGenerator::crearDesdeDiagnostico($diagnostico_id);
    }
}
?>
