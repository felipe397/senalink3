-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS senalink;
USE senalink;

-- Tabla de Usuarios (Super Administrador, Administradores, y otros)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_documento ENUM('CC', 'TI', 'CE', 'Pasaporte') NOT NULL,
    numero_documento VARCHAR(20) UNIQUE NOT NULL,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    nickname VARCHAR(50) UNIQUE NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM('SuperAdmin', 'AdminSENA', 'Otro') NOT NULL,
    estado ENUM('Activo', 'Suspendido', 'Desactivado') DEFAULT 'Activo',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Programas de Formación
CREATE TABLE programas_formacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    duracion_meses INT NOT NULL,
    nivel ENUM('Tecnólogo', 'Técnico', 'Profundización Técnica', 'Operario', 'Especialización') NOT NULL,
    estado ENUM('Activo', 'Suspendido', 'Desactivado') DEFAULT 'Activo',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Diagnósticos Empresariales
CREATE TABLE diagnosticos_empresariales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    resultado TEXT NOT NULL,
    fecha_realizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Reportes de Usuarios
CREATE TABLE reportes_usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    generado_por INT NOT NULL,
    fecha_generacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    formato ENUM('PDF', 'XML') NOT NULL,
    FOREIGN KEY (generado_por) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabla de Reportes de Diagnósticos Empresariales
CREATE TABLE reportes_diagnosticos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    fecha_generacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    formato ENUM('PDF', 'XML') NOT NULL
);

-- Tabla de Reportes de Programas de Formación
CREATE TABLE reportes_programas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    generado_por INT NOT NULL,
    fecha_generacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    formato ENUM('PDF', 'XML') NOT NULL,
    FOREIGN KEY (generado_por) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabla de Recuperación de Contraseñas
CREATE TABLE recuperacion_contrasenas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    codigo_verificacion VARCHAR(6) NOT NULL,
    fecha_solicitud TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Procedimiento para Validación de Inicio de Sesión
DELIMITER //

CREATE PROCEDURE validar_login(IN correo VARCHAR(100), IN password VARCHAR(255))
BEGIN
    -- Declaración de variables
    DECLARE stored_password_user VARCHAR(255);
    DECLARE user_role ENUM('SuperAdmin', 'AdminSENA', 'Otro');

    -- Validación para Usuarios (SuperAdmin, AdminSENA, Otro)
    IF EXISTS (SELECT * FROM usuarios WHERE correo = correo) THEN
        -- Si el correo es encontrado, validamos la contraseña
        SELECT contrasena INTO stored_password_user
        FROM usuarios
        WHERE correo = correo;

        -- Verificar si la contraseña ingresada coincide con la almacenada
        IF password = stored_password_user THEN
            -- Obtener el rol del usuario
            SELECT rol INTO user_role
            FROM usuarios
            WHERE correo = correo;

            -- Mensaje según el rol del usuario
            IF user_role = 'SuperAdmin' THEN
                SELECT 'Bienvenido Super Administrador' AS mensaje;
            ELSEIF user_role = 'AdminSENA' THEN
                SELECT 'Bienvenido Administrador SENA' AS mensaje;
            ELSE
                SELECT CONCAT('Bienvenido Usuario con rol: ', user_role) AS mensaje;
            END IF;
        ELSE
            -- Si la contraseña no es correcta
            SELECT 'Credenciales incorrectas para Usuario' AS mensaje;
        END IF;
    ELSE
        -- Si no se encuentra el correo en la tabla de usuarios
        SELECT 'Credenciales incorrectas' AS mensaje;
    END IF;
END //

DELIMITER ;
