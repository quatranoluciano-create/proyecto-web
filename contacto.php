<?php
require_once __DIR__ . '/includes/config.php';

$error = '';
$exito = '';

if (es_post()) {
    $nombre = obtener_post('nombre');
    $telefono = obtener_post('telefono');
    $tipo_servicio = obtener_post('tipo_servicio');
    $descripcion = obtener_post('descripcion');

    if (!validar_longitud($nombre, 3) || !validar_longitud($telefono, 10) || !$tipo_servicio || !validar_longitud($descripcion, 10)) {
        $error = 'Por favor completa todos los campos requeridos.';
    } elseif (!es_telefono_valido($telefono)) {
        $error = 'El teléfono debe tener al menos 10 dígitos.';
    } else {
        try {
            $pdo = obtener_conexion();
            $insertar = $pdo->prepare(
                'INSERT INTO solicitudes_contacto (nombre, telefono, tipo_servicio, descripcion)
                 VALUES (:nombre, :telefono, :tipo_servicio, :descripcion)'
            );
            $insertar->execute([
                'nombre' => $nombre,
                'telefono' => $telefono,
                'tipo_servicio' => $tipo_servicio,
                'descripcion' => $descripcion,
            ]);
            $exito = 'Solicitud enviada correctamente. Te contactaremos en la próxima hora.';
            $_POST = [];
        } catch (PDOException $e) {
            registrar_error('Error al guardar solicitud de contacto: ' . $e->getMessage());
            $error = 'Ocurrió un problema al guardar tu solicitud. Probá de nuevo en unos minutos.';
        }
    }
}

$titulo_pagina = 'Contacto';
require_once __DIR__ . '/includes/header.php';
?>

<main>
    <section class="contacto">
        <div class="contacto-info">
            <h2>Contacta un <span>Técnico</span></h2>
            <p>Completa el formulario y recibe una respuesta dentro de la hora. Atención rápida para tu equipo, tu hogar y tu trabajo.</p>
            <p><strong>Servicios incluidos:</strong></p>
            <ul>
                <li>Diagnóstico inicial sin cargo.</li>
                <li>Presupuestos claros y reparaciones con garantía.</li>
                <li>Repuestos originales o compatibles según tu preferencia.</li>
                <li>Soporte remoto y asistencia presencial.</li>
            </ul>
            <p>Atención en toda el área metropolitana, de lunes a sábado de 9:00 a 20:00.</p>
            <p>WhatsApp directo: <strong>+54 11 XXXX-XXXX</strong></p>
            <div class="contact-highlight">Te ayudamos a solucionar tu equipo hoy mismo con transparencia, rapidez y respaldo técnico.</div>
        </div>

        <div class="formulario">
            <h3>Solicitar técnico</h3>

            <?php mostrar_alertas($error, $exito); ?>

            <form method="post" action="contacto.php" class="form-contacto">
                <div class="form-group">
                    <label for="nombre">Nombre *</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Tu nombre completo" required value="<?php echo attr($_POST['nombre'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono *</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="11 XXXX-XXXX" required value="<?php echo attr($_POST['telefono'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="tipo_servicio">Tipo de servicio *</label>
                    <select id="tipo_servicio" name="tipo_servicio" required>
                        <option value="">Selecciona una opción</option>
                        <?php foreach ($tipos_trabajo as $clave => $etiqueta) : ?>
                            <option value="<?php echo $clave; ?>"<?php echo isset($_POST['tipo_servicio']) && $_POST['tipo_servicio'] === $clave ? ' selected' : ''; ?>><?php echo htmlspecialchars($etiqueta); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción del problema *</label>
                    <textarea id="descripcion" name="descripcion" placeholder="Contanos qué le pasa a tu equipo..." required rows="5"><?php echo attr($_POST['descripcion'] ?? ''); ?></textarea>
                </div>

                <button type="submit" class="btn-primary">Enviar solicitud</button>
            </form>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
