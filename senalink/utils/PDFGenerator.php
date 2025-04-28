<?php
// utils/PDFGenerator.php
// Utilidad para generar reportes en formato PDF

require_once __DIR__ . '/../vendor/autoload.php'; // Asegúrate de tener Dompdf instalado

use Dompdf\Dompdf;

class PDFGenerator {
    public static function crearDesdeDiagnostico($diagnostico_id) {
        // Aquí puedes consultar la base de datos según $diagnostico_id
        // Luego construir un HTML para el reporte
        $html = '<h1>Reporte Diagnóstico ID: ' . $diagnostico_id . '</h1>';
        $html .= '<p>Contenido del diagnóstico...</p>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();
        $filename = 'reportes/diagnostico_' . $diagnostico_id . '.pdf';
        file_put_contents($filename, $output);

        return $filename;
    }
}
?>
