<?php
// models/Empresa.php
// Modelo para la entidad Empresa

class Empresa {
    public $id;
    public $nombre;
    public $nit;

    public function __construct($data) {
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre'];
        $this->nit = $data['nit'];
    }
}
?>
