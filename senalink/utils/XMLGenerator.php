<?php
// utils/XMLGenerator.php
// Utilidad para generar archivos XML desde diagnósticos

class XMLGenerator {
    public static function crearDesdeDiagnostico($diagnostico_id) {
        // Consultar base de datos con $diagnostico_id y generar XML
        $xml = new SimpleXMLElement('<diagnostico></diagnostico>');
        $xml->addChild('id', $diagnostico_id);
        $xml->addChild('estado', 'pendiente');

        $filename = 'reportes/diagnostico_' . $diagnostico_id . '.xml';
        $xml->asXML($filename);

        return $filename;
    }
}
?>
