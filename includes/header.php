<?php
require_once __DIR__ . '/config.php';
$pagina_actual = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo_pagina) ? htmlspecialchars($titulo_pagina) . ' - ' : ''; ?><?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="site-header">
        <a href="index.php" class="logo"><?php echo SITE_NAME; ?></a>
        <nav class="main-nav">
            <a href="index.php"<?php echo $pagina_actual === 'index.php' ? ' class="active"' : ''; ?>>Inicio</a>
            <a href="servicios.php"<?php echo $pagina_actual === 'servicios.php' ? ' class="active"' : ''; ?>>Servicios</a>
            <a href="index.php#reseñas">Reseñas</a>
            <a href="contacto.php"<?php echo $pagina_actual === 'contacto.php' ? ' class="active"' : ''; ?>>Contacto</a>
            <a href="cv.php"<?php echo $pagina_actual === 'cv.php' ? ' class="active"' : ''; ?>>CV</a>
            <?php if (usuario_logueado()) : ?>
                <a href="cliente.php" class="nav-cta<?php echo $pagina_actual === 'cliente.php' ? ' active' : ''; ?>">Mi cuenta</a>
                <a href="logout.php" class="nav-muted">Salir</a>
            <?php else : ?>
                <a href="login.php" class="nav-cta<?php echo $pagina_actual === 'login.php' ? ' active' : ''; ?>">Iniciar sesión</a>
                <a href="registro.php" class="nav-cta<?php echo $pagina_actual === 'registro.php' ? ' active' : ''; ?>">Registrarse</a>
            <?php endif; ?>
        </nav>
    </header>
