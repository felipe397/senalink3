<?php
// models/Reporte.php
// Modelo para representar un reporte generado

class Reporte {
    public $id;
    public $diagnostico_id;
    public $tipo;
    public $ruta_archivo;

    public function __construct($data) {
        $this->id = $data['id'] ?? null;
        $this->diagnostico_id = $data['diagnostico_id'];
        $this->tipo = $data['tipo']; // PDF o XML
        $this->ruta_archivo = $data['ruta_archivo'];
    }
}
?>
