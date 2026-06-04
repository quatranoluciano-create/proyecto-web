<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cargar funciones auxiliares
require_once __DIR__ . '/helpers.php';

define('SITE_NAME', 'Tecnolink');

$usuarios_demo = [
    'cliente@tecnolink.com' => [
        'clave' => 'cliente123',
        'nombre' => 'María López',
    ],
    'demo@tecnolink.com' => [
        'clave' => 'demo123',
        'nombre' => 'Usuario Demo',
    ],
];

$tipos_trabajo = [
    'computadoras' => 'Computadoras y laptops',
    'celulares' => 'Celulares y tablets',
    'redes' => 'Redes y WiFi',
    'electro' => 'Electrodomésticos',
    'remoto' => 'Soporte remoto',
    'empresas' => 'Soporte empresarial',
];

$trabajos_destacados = [
    [
        'id' => 1,
        'titulo' => 'Reparación urgente de notebook',
        'zona' => 'Capital Federal',
        'tipo' => 'computadoras',
        'modalidad' => 'A domicilio',
        'descripcion' => 'Notebook que no enciende tras actualización. Diagnóstico y reparación con repuestos disponibles.',
        'fecha' => '22 mayo 2026',
        'urgente' => true,
    ],
    [
        'id' => 2,
        'titulo' => 'Instalación y optimización de red WiFi',
        'zona' => 'Zona Norte, GBA',
        'tipo' => 'redes',
        'modalidad' => 'Presencial',
        'descripcion' => 'Mejora de cobertura en hogar de dos plantas. Configuración de router mesh y pruebas de velocidad.',
        'fecha' => '21 mayo 2026',
        'urgente' => false,
    ],
    [
        'id' => 3,
        'titulo' => 'Cambio de pantalla en celular',
        'zona' => 'La Plata',
        'tipo' => 'celulares',
        'modalidad' => 'En taller',
        'descripcion' => 'Pantalla rota en smartphone Android. Presupuesto con repuesto original o compatible.',
        'fecha' => '20 mayo 2026',
        'urgente' => false,
    ],
    [
        'id' => 4,
        'titulo' => 'Mantenimiento de PCs en oficina',
        'zona' => 'CABA',
        'tipo' => 'empresas',
        'modalidad' => 'Empresas',
        'descripcion' => 'Limpieza, actualización de software y backup para 8 equipos de una pyme.',
        'fecha' => '19 mayo 2026',
        'urgente' => false,
    ],
    [
        'id' => 5,
        'titulo' => 'Soporte remoto para PC lenta',
        'zona' => 'Remoto',
        'tipo' => 'remoto',
        'modalidad' => 'Online',
        'descripcion' => 'Optimización de inicio, eliminación de malware y actualización de drivers a distancia.',
        'fecha' => '18 mayo 2026',
        'urgente' => true,
    ],
    [
        'id' => 6,
        'titulo' => 'Configuración de electrodoméstico smart',
        'zona' => 'Zona Oeste, GBA',
        'tipo' => 'electro',
        'modalidad' => 'A domicilio',
        'descripcion' => 'Vinculación de heladera y lavarropas inteligentes con app móvil y red doméstica.',
        'fecha' => '17 mayo 2026',
        'urgente' => false,
    ],
];

$reseñas = [
    [
        'nombre' => 'Carlos M.',
        'trabajo' => 'Reparación de PC',
        'estrellas' => 5,
        'texto' => 'Vinieron el mismo día, explicaron todo y dejaron la computadora funcionando perfecta.',
    ],
    [
        'nombre' => 'Laura S.',
        'trabajo' => 'Red WiFi',
        'estrellas' => 5,
        'texto' => 'Excelente señal en toda la casa. Muy claros con el presupuesto y el tiempo de trabajo.',
    ],
    [
        'nombre' => 'Diego R.',
        'trabajo' => 'Celular',
        'estrellas' => 4,
        'texto' => 'Rápidos y profesionales. La pantalla quedó como nueva y con garantía escrita.',
    ],
];

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
