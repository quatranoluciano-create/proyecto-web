<?php
require_once __DIR__ . '/includes/config.php';

$error = '';

if (usuario_logueado()) {
    header('Location: cliente.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $clave = $_POST['clave'] ?? '';

    if (isset($usuarios_demo[$email]) && $usuarios_demo[$email]['clave'] === $clave) {
        $_SESSION['usuario'] = $email;
        $_SESSION['nombre'] = $usuarios_demo[$email]['nombre'];
        header('Location: cliente.php');
        exit;
    }

    $error = 'Email o contraseña incorrectos.';
}

$titulo_pagina = 'Iniciar sesión';
require_once __DIR__ . '/includes/header.php';
?>

<main class="auth-page">
    <section class="auth-card">
        <span class="eyebrow">Área de clientes</span>
        <h1>Iniciá sesión</h1>
        <p class="section-text">Accedé a tus trabajos solicitados, reseñas y el historial de servicios técnicos.</p>

        <?php if ($error !== '') : ?>
            <div class="alert-error" role="alert"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="post" class="auth-form">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="cliente@tecnolink.com" required>

            <label for="clave">Contraseña</label>
            <input type="password" id="clave" name="clave" placeholder="Tu contraseña" required>

            <button type="submit" class="btn-primary btn-block">Entrar</button>
        </form>

        <div class="auth-hint">
            <p><strong>Cuentas de prueba:</strong></p>
            <p>cliente@tecnolink.com / cliente123</p>
            <p>demo@tecnolink.com / demo123</p>
        </div>

        <a href="index.php" class="back-link">Volver al inicio</a>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
