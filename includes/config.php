<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cargar funciones auxiliares y conexión a la base de datos
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/db.php';

define('SITE_NAME', 'Tecnolink');

/**
 * Los "tipos de trabajo" ahora viven en la tabla tipos_trabajo.
 * Se cargan una sola vez por request y quedan disponibles como
 * $tipos_trabajo (mismo nombre de siempre) para no romper las vistas.
 */
function obtener_tipos_trabajo(): array
{
    static $tipos = null;

    if ($tipos === null) {
        $pdo = obtener_conexion();
        $filas = $pdo->query('SELECT id, etiqueta FROM tipos_trabajo ORDER BY etiqueta')->fetchAll();

        $tipos = [];
        foreach ($filas as $fila) {
            $tipos[$fila['id']] = $fila['etiqueta'];
        }
    }

    return $tipos;
}

$tipos_trabajo = obtener_tipos_trabajo();

function usuario_logueado(): bool
{
    return isset($_SESSION['usuario']) && $_SESSION['usuario'] !== '';
}

function requiere_login(): void
{
    if (!usuario_logueado()) {
        header('Location: login.php');
        exit;
    }
}
