<?php
require_once __DIR__ . '/includes/config.php';

$error = '';
$exito = '';

if (usuario_logueado()) {
    header('Location: cliente.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $clave = $_POST['clave'] ?? '';
    $clave_confirmar = $_POST['clave_confirmar'] ?? '';

    // Validaciones
    if (!validar_longitud($nombre, 2, 100)) {
        $error = 'El nombre debe tener entre 2 y 100 caracteres.';
    } elseif (!es_email_valido($email)) {
        $error = 'El email no es válido.';
    } elseif (!validar_longitud($clave, 6)) {
        $error = 'La contraseña debe tener al menos 6 caracteres.';
    } elseif ($clave !== $clave_confirmar) {
        $error = 'Las contraseñas no coinciden.';
    } else {
        $pdo = obtener_conexion();

        // Verificar que el email no exista ya
        $consulta = $pdo->prepare('SELECT id FROM usuarios WHERE email = :email');
        $consulta->execute(['email' => $email]);

        if ($consulta->fetch()) {
            $error = 'Ese email ya está registrado. Probá iniciar sesión.';
        } else {
            $clave_hash = password_hash($clave, PASSWORD_DEFAULT);

            $insertar = $pdo->prepare(
                'INSERT INTO usuarios (nombre, email, clave_hash) VALUES (:nombre, :email, :clave_hash)'
            );
            $insertar->execute([
                'nombre' => $nombre,
                'email' => $email,
                'clave_hash' => $clave_hash,
            ]);

            // Login automático tras registrarse
            session_regenerate_id(true);
            $_SESSION['usuario_id'] = $pdo->lastInsertId();
            $_SESSION['usuario'] = $email;
            $_SESSION['nombre'] = $nombre;

            header('Location: cliente.php');
            exit;
        }
    }
}

$titulo_pagina = 'Crear cuenta';
require_once __DIR__ . '/includes/header.php';
?>

<main class="auth-page">
    <section class="auth-card">
        <span class="eyebrow">Área de clientes</span>
        <h1>Creá tu cuenta</h1>
        <p class="section-text">Registrate para solicitar servicios técnicos y hacer seguimiento de tus trabajos.</p>

        <?php if ($error !== '') : ?>
            <div class="alert-error" role="alert"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="post" class="auth-form">
            <label for="nombre">Nombre completo</label>
            <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required
                   value="<?php echo obtener_valor($_POST, 'nombre'); ?>">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="tu@email.com" required
                   value="<?php echo obtener_valor($_POST, 'email'); ?>">

            <label for="clave">Contraseña</label>
            <input type="password" id="clave" name="clave" placeholder="Mínimo 6 caracteres" required>

            <label for="clave_confirmar">Confirmar contraseña</label>
            <input type="password" id="clave_confirmar" name="clave_confirmar" placeholder="Repetí tu contraseña" required>

            <button type="submit" class="btn-primary btn-block">Crear cuenta</button>
        </form>

        <div class="auth-hint">
            <p>¿Ya tenés cuenta? <a href="login.php">Iniciá sesión acá</a>.</p>
        </div>

        <a href="index.php" class="back-link">Volver al inicio</a>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>