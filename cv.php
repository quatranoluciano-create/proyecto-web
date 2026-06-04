<?php
require_once __DIR__ . '/includes/config.php';

$error = '';
$exito = '';

if (es_post()) {
    $nombre = obtener_post('nombre');
    $email = obtener_post('email');
    $telefono = obtener_post('telefono');
    $especialidad = obtener_post('especialidad');
    $experiencia = obtener_post('experiencia');
    $disponibilidad = obtener_post('disponibilidad');
    $habilidades = obtener_post('habilidades', '');
    $certificaciones = obtener_post('certificaciones', '');
    $zona = obtener_post('zona', '');
    $referencias = obtener_post('referencias', '');

    if (!validar_longitud($nombre, 3) || !$email || !validar_longitud($telefono, 10) || !$especialidad || !$experiencia || !$disponibilidad) {
        $error = 'Por favor completa todos los campos requeridos.';
    } elseif (!es_email_valido($email)) {
        $error = 'Email inválido.';
    } elseif (!es_telefono_valido($telefono)) {
        $error = 'El teléfono debe tener al menos 10 dígitos.';
    } else {
        $exito = '¡CV enviado correctamente! Te contactaremos pronto.';
    }
}

$titulo_pagina = 'Enviar CV';
require_once __DIR__ . '/includes/header.php';
?>

<main class="auth-page">
    <section class="auth-card cv-card">
        <span class="eyebrow">Únete a nuestro equipo</span>
        <h1>Envía tu CV</h1>
        <p class="section-text">Comparte tu experiencia en servicios técnicos y te contactaremos para oportunidades de trabajo.</p>

        <?php mostrar_alertas($error, $exito); ?>

        <form method="post" class="auth-form cv-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="nombre">Nombre completo *</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Juan Pérez" required value="<?php echo attr($_POST['nombre'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" placeholder="juan@email.com" required value="<?php echo attr($_POST['email'] ?? ''); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="telefono">Teléfono *</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="11 2345-6789" required value="<?php echo attr($_POST['telefono'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="zona">Zona de cobertura</label>
                    <input type="text" id="zona" name="zona" placeholder="CABA, GBA, Remoto..." value="<?php echo attr($_POST['zona'] ?? ''); ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="especialidad">Especialidad principal *</label>
                <select id="especialidad" name="especialidad" required>
                    <option value="">Selecciona una especialidad</option>
                    <?php foreach ($tipos_trabajo as $clave => $etiqueta) : ?>
                        <option value="<?php echo $clave; ?>"<?php echo isset($_POST['especialidad']) && $_POST['especialidad'] === $clave ? ' selected' : ''; ?>><?php echo htmlspecialchars($etiqueta); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="experiencia">Años de experiencia *</label>
                <select id="experiencia" name="experiencia" required>
                    <option value="">Selecciona experiencia</option>
                    <option value="0-1"<?php echo isset($_POST['experiencia']) && $_POST['experiencia'] === '0-1' ? ' selected' : ''; ?>>0-1 años</option>
                    <option value="1-3"<?php echo isset($_POST['experiencia']) && $_POST['experiencia'] === '1-3' ? ' selected' : ''; ?>>1-3 años</option>
                    <option value="3-5"<?php echo isset($_POST['experiencia']) && $_POST['experiencia'] === '3-5' ? ' selected' : ''; ?>>3-5 años</option>
                    <option value="5-10"<?php echo isset($_POST['experiencia']) && $_POST['experiencia'] === '5-10' ? ' selected' : ''; ?>>5-10 años</option>
                    <option value="10+"<?php echo isset($_POST['experiencia']) && $_POST['experiencia'] === '10+' ? ' selected' : ''; ?>>10+ años</option>
                </select>
            </div>

            <div class="form-group">
                <label for="habilidades">Habilidades principales</label>
                <textarea id="habilidades" name="habilidades" placeholder="Ej: Diagnóstico hardware, Windows, Linux, Redes..." rows="3"><?php echo attr($_POST['habilidades'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label for="certificaciones">Certificaciones y cursos</label>
                <textarea id="certificaciones" name="certificaciones" placeholder="Ej: CompTIA A+, Microsoft Certified..." rows="3"><?php echo attr($_POST['certificaciones'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label for="disponibilidad">Disponibilidad *</label>
                <select id="disponibilidad" name="disponibilidad" required>
                    <option value="">Selecciona disponibilidad</option>
                    <option value="tiempo-completo"<?php echo isset($_POST['disponibilidad']) && $_POST['disponibilidad'] === 'tiempo-completo' ? ' selected' : ''; ?>>Tiempo completo</option>
                    <option value="medio-tiempo"<?php echo isset($_POST['disponibilidad']) && $_POST['disponibilidad'] === 'medio-tiempo' ? ' selected' : ''; ?>>Medio tiempo</option>
                    <option value="freelance"<?php echo isset($_POST['disponibilidad']) && $_POST['disponibilidad'] === 'freelance' ? ' selected' : ''; ?>>Freelance/Por proyecto</option>
                    <option value="consultor"<?php echo isset($_POST['disponibilidad']) && $_POST['disponibilidad'] === 'consultor' ? ' selected' : ''; ?>>Consultor ocasional</option>
                </select>
            </div>

            <div class="form-group">
                <label for="referencias">Referencias profesionales</label>
                <textarea id="referencias" name="referencias" placeholder="Nombre, empresa y contacto de referencias..." rows="3"><?php echo attr($_POST['referencias'] ?? ''); ?></textarea>
            </div>

            <button type="submit" class="btn-primary btn-block">Enviar CV</button>
        </form>

        <a href="index.php" class="back-link">Volver al inicio</a>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
