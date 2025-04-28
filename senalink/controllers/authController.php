<?php
session_start();

// Incluir la configuración de conexión a la base de datos
include('../../Config/conexion.php'); // Ajusta la ruta de acuerdo a tu estructura de directorios

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Comprobar si la conexión es exitosa
    if (!$conn) {
        die("Error: No se pudo establecer la conexión.");
    }

    // Recoger los datos del formulario
    $correo = trim($_POST['correo']);
    $contrasena = trim($_POST['contrasena']);

    // Validar que los campos no estén vacíos
    if (empty($correo) || empty($contrasena)) {
        die("Faltan campos.");
    }

    // Validar el formato del correo
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        die("Correo electrónico no válido.");
    }

    try {
        // Preparamos la consulta SQL para llamar al procedimiento almacenado
        $stmt = $conn->prepare("CALL validar_login(?, ?)");
        $stmt->bindParam(1, $correo, PDO::PARAM_STR);
        $stmt->bindParam(2, $contrasena, PDO::PARAM_STR);
        $stmt->execute();

        // Obtener el resultado del procedimiento
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Comprobar si el resultado contiene un mensaje
        if (isset($resultado['mensaje'])) {
            echo $resultado['mensaje']; // Mostrar el mensaje devuelto por el procedimiento

            // Verificar el tipo de mensaje para determinar el éxito
            if ($resultado['mensaje'] == 'Bienvenido Super Administrador' || 
                $resultado['mensaje'] == 'Bienvenido Administrador SENA' || 
                strpos($resultado['mensaje'], 'Bienvenido Usuario') !== false) {

                // Si el inicio de sesión es exitoso, guardar los datos del usuario en la sesión
                $_SESSION['usuario'] = [
                    'id' => $resultado['id'],
                    'nombres' => $resultado['nombres'],
                    'apellidos' => $resultado['apellidos'],
                    'correo' => $resultado['correo'],
                    'rol' => $resultado['rol']
                ];

                // Redirigir a la página principal o dashboard según el rol
                if ($resultado['rol'] == 'SuperAdmin') {
                    header("Location: ../html/superadmin_dashboard.php"); // Cambiar la ruta si es necesario
                } elseif ($resultado['rol'] == 'AdminSENA') {
                    header("Location: ../html/admin_sena_dashboard.php"); // Cambiar la ruta si es necesario
                } else {
                    header("Location: ../html/usuario_dashboard.php"); // Cambiar la ruta si es necesario
                }
                exit;
            }
        } else {
            echo "Hubo un problema con la validación del login.";
        }

    } catch (Exception $e) {
        // Capturar cualquier error y mostrarlo
        echo "Error al procesar la solicitud: " . $e->getMessage();
    }
} else {
    echo "Método no permitido.";
}

// Cerrar la conexión
$conn = null;
?>
