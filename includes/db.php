<?php
/**
 * Conexión a la base de datos (PDO / MySQL).
 *
 * En XAMPP, por defecto:
 *   - Host: 127.0.0.1
 *   - Usuario: root
 *   - Contraseña: '' (vacía)
 *
 * Si tu XAMPP tiene otra configuración, cambiá las constantes de abajo.
 * Nunca subas contraseñas reales de producción a este archivo si el
 * repositorio es público: en ese caso usá variables de entorno.
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'tecnolink');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

/**
 * Devuelve una conexión PDO única (patrón singleton) para no abrir
 * una conexión nueva en cada llamada.
 */
function obtener_conexion(): PDO
{
    static $conexion = null;

    if ($conexion === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;

        $opciones = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $conexion = new PDO($dsn, DB_USER, DB_PASS, $opciones);
        } catch (PDOException $e) {
            // No mostramos el error real (podría filtrar datos sensibles).
            // Lo guardamos en el log y mostramos un mensaje genérico.
            if (function_exists('registrar_error')) {
                registrar_error('Error de conexión a la base de datos: ' . $e->getMessage());
            }
            http_response_code(500);
            die('No se pudo conectar a la base de datos. Verificá que MySQL esté ' .
                'corriendo en XAMPP y que la base "tecnolink" exista (ver database/tecnolink.sql).');
        }
    }

    return $conexion;
}
