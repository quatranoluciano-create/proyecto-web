<?php
/**
 * Funciones auxiliares para el proyecto TecnoLink
 * Reutilizables en todo el proyecto
 */

/**
 * Sanitiza texto para prevenir XSS
 */
function sanitizar_texto(string $texto): string
{
    return htmlspecialchars(trim($texto), ENT_QUOTES, 'UTF-8');
}

/**
 * Valida un email
 */
function es_email_valido(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Valida un teléfono (mínimo 10 caracteres numéricos)
 */
function es_telefono_valido(string $telefono): bool
{
    return preg_match('/^[\d\s\-\+\(\)]{10,}$/', $telefono) !== false;
}

/**
 * Valida una longitud de texto
 */
function validar_longitud(string $texto, int $min, int $max = PHP_INT_MAX): bool
{
    $longitud = strlen(trim($texto));
    return $longitud >= $min && $longitud <= $max;
}

/**
 * Obtiene etiqueta de tipo de trabajo
 */
function obtener_etiqueta_tipo(string $tipo): string
{
    global $tipos_trabajo;
    return $tipos_trabajo[$tipo] ?? ucfirst($tipo);
}

/**
 * Redirige a una URL
 */
function redirigir(string $url): void
{
    header("Location: $url");
    exit;
}

/**
 * Obtiene el nombre del usuario actual (si está logueado)
 */
function obtener_nombre_usuario(): ?string
{
    return usuario_logueado() ? ($_SESSION['nombre'] ?? null) : null;
}

/**
 * Obtiene el email del usuario actual (si está logueado)
 */
function obtener_email_usuario(): ?string
{
    return usuario_logueado() ? ($_SESSION['usuario'] ?? null) : null;
}

/**
 * Registra un error en el log (requiere carpeta logs/)
 */
function registrar_error(string $mensaje): void
{
    $logs_dir = __DIR__ . '/../logs';
    if (!is_dir($logs_dir)) {
        mkdir($logs_dir, 0755, true);
    }
    
    $log_file = $logs_dir . '/errores.log';
    $timestamp = date('Y-m-d H:i:s');
    error_log("[$timestamp] $mensaje\n", 3, $log_file);
}

/**
 * Obtiene el nombre de la página actual
 */
function obtener_pagina_actual(): string
{
    return basename($_SERVER['PHP_SELF']);
}

/**
 * Verifica si se está en una página específica
 */
function es_pagina(string $pagina): bool
{
    return obtener_pagina_actual() === $pagina;
}

/**
 * Genera una clase "active" si estamos en cierta página
 */
function clase_activa(string $pagina): string
{
    return es_pagina($pagina) ? 'active' : '';
}

/**
 * Escapa caracteres especiales para atributos HTML
 */
function attr(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

/**
 * Obtiene un valor de array con default
 */
function obtener_valor(array $array, string $clave, string $default = ''): string
{
    return isset($array[$clave]) ? htmlspecialchars($array[$clave], ENT_QUOTES, 'UTF-8') : $default;
}

/**
 * Valida que un campo POST exista y no esté vacío
 */
function campo_post_requerido(string $campo): bool
{
    return isset($_POST[$campo]) && trim($_POST[$campo]) !== '';
}

/**
 * Obtiene todos los campos POST validados
 */
function obtener_campos_post(array $campos_requeridos): array
{
    $datos = [];
    $errores = [];

    foreach ($campos_requeridos as $campo) {
        if (!campo_post_requerido($campo)) {
            $errores[] = "El campo '$campo' es requerido.";
        } else {
            $datos[$campo] = trim($_POST[$campo]);
        }
    }

    return [
        'valido' => empty($errores),
        'datos' => $datos,
        'errores' => $errores,
    ];
}

/**
 * Genera una URL con parámetros GET
 */
function url_con_parametros(string $pagina, array $parametros): string
{
    $query = http_build_query($parametros);
    return $pagina . ($query ? "?$query" : '');
}

/**
 * Verifica si la solicitud es POST
 */
function es_post(): bool
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

/**
 * Verifica si la solicitud es GET
 */
function es_get(): bool
{
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

/**
 * Obtiene valor de GET de forma segura
 */
function obtener_get(string $clave, string $default = ''): string
{
    return isset($_GET[$clave]) ? sanitizar_texto($_GET[$clave]) : $default;
}

/**
 * Obtiene valor de POST de forma segura
 */
function obtener_post(string $clave, string $default = ''): string
{
    return isset($_POST[$clave]) ? sanitizar_texto($_POST[$clave]) : $default;
}

/**
 * Formatea una fecha para mostrar
 */
function formatear_fecha(string $fecha, string $formato = 'd/m/Y'): string
{
    $fecha_obj = DateTime::createFromFormat('d M Y', $fecha);
    return $fecha_obj ? $fecha_obj->format($formato) : $fecha;
}

/**
 * Convierte una fecha en formato YYYY-MM-DD (como viene de MySQL) a
 * un formato legible en español, ej: "22 mayo 2026".
 */
function formatear_fecha_es(string $fecha_mysql): string
{
    $meses = [
        1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
        5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
        9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre',
    ];

    $fecha_obj = DateTime::createFromFormat('Y-m-d', $fecha_mysql);
    if (!$fecha_obj) {
        return $fecha_mysql;
    }

    return $fecha_obj->format('d') . ' ' . $meses[(int) $fecha_obj->format('n')] . ' ' . $fecha_obj->format('Y');
}

/**
 * Calcula el tiempo transcurrido desde una fecha
 */
function tiempo_transcurrido(string $fecha): string
{
    // Retorna algo como "hace 2 días"
    return $fecha; // Implementación simplificada
}

/**
 * Trunca un texto a cierta longitud
 */
function truncar(string $texto, int $longitud = 100): string
{
    if (strlen($texto) <= $longitud) {
        return $texto;
    }
    return substr($texto, 0, $longitud) . '...';
}

/**
 * Convierte un array a JSON
 */
function a_json(array $datos): string
{
    return json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}

/**
 * Obtiene información del navegador
 */
function obtener_user_agent(): string
{
    return $_SERVER['HTTP_USER_AGENT'] ?? 'Desconocido';
}

/**
 * Obtiene la IP del cliente
 */
function obtener_ip_cliente(): string
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'Desconocida';
    }
    return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : 'Desconocida';
}

/**
 * Muestra alertas de error y éxito
 */
function mostrar_alertas(string $error = '', string $exito = ''): void
{
    if ($error !== '') {
        echo '<div class="alert-error" role="alert">' . htmlspecialchars($error) . '</div>';
    }
    if ($exito !== '') {
        echo '<div class="alert-success" role="alert">' . htmlspecialchars($exito) . '</div>';
    }
}
