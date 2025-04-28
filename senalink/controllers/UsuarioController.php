<?php
// controllers/UsuarioController.php
// Controlador para CRUD de usuarios

require_once __DIR__ . '/../config/db.php';

class UsuarioController {
    // Listar todos los usuarios
    public function listarUsuarios() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo usuario
    public function crearUsuario($nombres, $apellidos, $correo, $password, $rol) {
        global $pdo;

        // Validar si el correo ya está registrado
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        if ($stmt->rowCount() > 0) {
            return "El correo electrónico ya está registrado.";
        }

        // Validar el rol (Solo 'SuperAdmin', 'AdminSENA' o 'Otro')
        $validRoles = ['SuperAdmin', 'AdminSENA', 'Otro'];
        if (!in_array($rol, $validRoles)) {
            return "Rol no válido.";
        }

        // Hashear la contraseña antes de almacenarla
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la sentencia SQL para insertar el nuevo usuario
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombres, apellidos, correo, contrasena, rol) VALUES (?, ?, ?, ?, ?)");

        try {
            // Ejecutar la sentencia SQL
            $stmt->execute([$nombres, $apellidos, $correo, $hashedPassword, $rol]);
            return "Usuario creado exitosamente.";
        } catch (Exception $e) {
            return "Error al crear el usuario: " . $e->getMessage();
        }
    }

    // Función para verificar si un correo y contraseña son válidos (para login)
    public function verificarCredenciales($correo, $password) {
        global $pdo;

        // Buscar el usuario por correo
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si el usuario no existe
        if (!$usuario) {
            return "Usuario no encontrado.";
        }

        // Verificar la contraseña
        if (password_verify($password, $usuario['contrasena'])) {
            // Si la contraseña es correcta, devolvemos los datos del usuario
            return $usuario; 
        } else {
            return "Contraseña incorrecta.";
        }
    }
}
?>
