<?php
// models/Diagnostico.php
// Modelo para la entidad Diagnóstico

class Diagnostico {
    public $id;
    public $empresa_id;
    public $respuestas;
    public $estado;

    public function __construct($data) {
        $this->id = $data['id'] ?? null;
        $this->empresa_id = $data['empresa_id'];
        $this->respuestas = json_decode($data['respuestas'], true);
        $this->estado = $data['estado'];
    }
}
?>
