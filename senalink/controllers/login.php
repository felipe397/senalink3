<?php
require_once '../Config/conexion.php'; // Asegúrate de que esta ruta sea correcta
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    try {
        // Buscar usuario por correo
        $sql = 'SELECT * FROM usuarios WHERE correo = :correo AND estado = "Activo"';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['correo' => $correo]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Validar existencia del usuario y su contraseña
        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            // Establecer sesión
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['correo'] = $usuario['correo'];
            $_SESSION['rol'] = $usuario['rol'];

            // Redirigir según el rol
            switch ($usuario['rol']) {
                case 'SuperAdmin':
                    header('Location: ../html/SuperAdmin/dashboard.html');
                    break;
                case 'AdminSENA':
                    header('Location: ../html/AdminSENA/dashboard.html');
                    break;
                case 'Otro':
                    header('Location: ../html/Otro/dashboard.html');
                    break;
                default:
                    echo 'Rol no permitido.';
                    exit();
            }
            exit();
        } else {
            echo 'Usuario o contraseña incorrectos.';
            exit();
        }

    } catch (PDOException $e) {
        echo "Error de base de datos: " . $e->getMessage();
    }
} else {
    echo "Método no permitido.";
}
?>
