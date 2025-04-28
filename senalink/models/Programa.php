<?php
// models/Programa.php
// Modelo para la entidad Programa de formación

class Programa {
    public $id;
    public $nombre;
    public $descripcion;

    public function __construct($data) {
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre'];
        $this->descripcion = $data['descripcion'];
    }
}
?>
