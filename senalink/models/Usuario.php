<?php
// models/Usuario.php
// Modelo para la entidad Usuario

class Usuario {
    public $id;
    public $nombre;
    public $email;
    public $password;
    public $rol;

    public function __construct($data) {
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->rol = $data['rol'];
    }
}
?>
