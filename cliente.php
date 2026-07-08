<?php
require_once __DIR__ . '/includes/config.php';
requiere_login();

$pdo = obtener_conexion();
$error_resena = '';
$exito_resena = '';

if (es_post() && obtener_post('accion') === 'dejar_resena') {
    $trabajo_id = (int) obtener_post('trabajo_id');
    $estrellas = (int) obtener_post('estrellas');
    $texto = trim(obtener_post('texto'));

    $verificar = $pdo->prepare(
        "SELECT id, titulo FROM trabajos WHERE id = :id AND usuario_id = :usuario_id AND estado = 'Finalizado'"
    );
    $verificar->execute(['id' => $trabajo_id, 'usuario_id' => $_SESSION['usuario_id']]);
    $trabajo_valido = $verificar->fetch();

    $existe = $pdo->prepare('SELECT id FROM resenas WHERE trabajo_id = :trabajo_id');
    $existe->execute(['trabajo_id' => $trabajo_id]);

    if (!$trabajo_valido) {
        $error_resena = 'Ese trabajo no existe o todavía no está finalizado.';
    } elseif ($existe->fetch()) {
        $error_resena = 'Ya dejaste una reseña para ese trabajo.';
    } elseif ($estrellas < 1 || $estrellas > 5) {
        $error_resena = 'Elegí una puntuación entre 1 y 5 estrellas.';
    } elseif (!validar_longitud($texto, 10, 500)) {
        $error_resena = 'La reseña debe tener entre 10 y 500 caracteres.';
    } else {
        $insertar = $pdo->prepare(
            'INSERT INTO resenas (trabajo_id, nombre, trabajo_titulo, estrellas, texto)
             VALUES (:trabajo_id, :nombre, :trabajo_titulo, :estrellas, :texto)'
        );
        $insertar->execute([
            'trabajo_id' => $trabajo_id,
            'nombre' => $_SESSION['nombre'] ?? $_SESSION['usuario'],
            'trabajo_titulo' => $trabajo_valido['titulo'],
            'estrellas' => $estrellas,
            'texto' => $texto,
        ]);
        $exito_resena = '¡Gracias por tu reseña!';
    }
}
$consulta = $pdo->prepare(
    'SELECT t.id, t.titulo, t.estado, t.tipo, t.fecha, r.id AS resena_id
     FROM trabajos t
     LEFT JOIN resenas r ON r.trabajo_id = t.id
     WHERE t.usuario_id = :usuario_id
     ORDER BY t.fecha DESC'
);

$consulta->execute(['usuario_id' => $_SESSION['usuario_id']]);
$mis_trabajos = $consulta->fetchAll();

$reseñas = $pdo->query('SELECT nombre, trabajo_titulo AS trabajo, estrellas, texto FROM resenas ORDER BY creado_en DESC')->fetchAll();

$titulo_pagina = 'Mi cuenta';
require_once __DIR__ . '/includes/header.php';
$nombre = $_SESSION['nombre'] ?? $_SESSION['usuario'];
?>

<main class="client-area">
    <section class="client-hero">
        <div>
            <span class="eyebrow">Área de cliente</span>
            <h1>Hola, <?php echo htmlspecialchars($nombre); ?></h1>
            <p class="section-text">Gestioná tus trabajos técnicos, revisá el historial y consultá las reseñas de servicios anteriores.</p>
        <?php mostrar_alertas($error_resena, $exito_resena); ?>
        </div>
        <a href="contacto.php" class="btn-primary">Nuevo pedido</a>
    </section>

    <?php
        $total_trabajos = count($mis_trabajos);
        $total_finalizados = count(array_filter($mis_trabajos, fn($t) => $t['estado'] === 'Finalizado'));
        $total_en_curso = count(array_filter($mis_trabajos, fn($t) => $t['estado'] === 'En curso'));
    ?>
    <section class="client-stats">
        <article class="stat-card">
            <strong><?php echo $total_trabajos; ?></strong>
            <span>Trabajos registrados</span>
        </article>
        <article class="stat-card">
            <strong><?php echo $total_finalizados; ?></strong>
            <span>Finalizados</span>
        </article>
        <article class="stat-card">
            <strong><?php echo $total_en_curso; ?></strong>
            <span>En curso</span>
        </article>
    </section>

    <section class="client-grid">
        <div class="client-panel">
            <h2>Mis trabajos</h2>
            <div class="client-jobs-list">
<?php foreach ($mis_trabajos as $trabajo) : ?>
    <article class="client-job-item">
        <div>
            <h3><?php echo htmlspecialchars($trabajo['titulo']); ?></h3>
            <p><?php echo htmlspecialchars(obtener_etiqueta_tipo($trabajo['tipo'])); ?> · <?php echo htmlspecialchars(formatear_fecha_es($trabajo['fecha'])); ?></p>

            <?php if ($trabajo['estado'] === 'Finalizado' && $trabajo['resena_id'] === null) : ?>
                <details class="review-form-toggle">
                    <summary>Dejar reseña</summary>
                    <form method="post" class="review-form">
                        <input type="hidden" name="accion" value="dejar_resena">
                        <input type="hidden" name="trabajo_id" value="<?php echo (int) $trabajo['id']; ?>">

                        <label for="estrellas-<?php echo $trabajo['id']; ?>">Puntuación</label>
                        <select name="estrellas" id="estrellas-<?php echo $trabajo['id']; ?>" required>
                            <option value="5">★★★★★ (5)</option>
                            <option value="4">★★★★☆ (4)</option>
                            <option value="3">★★★☆☆ (3)</option>
                            <option value="2">★★☆☆☆ (2)</option>
                            <option value="1">★☆☆☆☆ (1)</option>
                        </select>

                        <label for="texto-<?php echo $trabajo['id']; ?>">Tu comentario</label>
                        <textarea name="texto" id="texto-<?php echo $trabajo['id']; ?>" rows="3" minlength="10" maxlength="500" required placeholder="Contanos cómo fue el servicio..."></textarea>

                        <button type="submit" class="btn-primary btn-small">Enviar reseña</button>
                    </form>
                </details>
            <?php elseif ($trabajo['estado'] === 'Finalizado' && $trabajo['resena_id'] !== null) : ?>
                <span class="review-done">✓ Ya reseñaste este trabajo</span>
            <?php endif; ?>
        </div>
        <span class="status-pill status-<?php echo strtolower(str_replace(' ', '-', $trabajo['estado'])); ?>"><?php echo htmlspecialchars($trabajo['estado']); ?></span>
    </article>
<?php endforeach; ?>
            </div>
        </div>

        <aside class="client-panel">
            <h2>Tipos de trabajo</h2>
            <ul class="tipo-list">
                <?php foreach ($tipos_trabajo as $clave => $etiqueta) : ?>
                    <li>
                        <a href="index.php?tipo=<?php echo urlencode($clave); ?>"><?php echo htmlspecialchars($etiqueta); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>
    </section>

    <section class="client-reviews">
        <h2>Mis reseñas y referencias</h2>
        <div class="reviews-grid">
            <?php foreach ($reseñas as $reseña) : ?>
                <article class="review-card">
                    <div class="stars"><?php echo str_repeat('★', $reseña['estrellas']); ?></div>
                    <h3><?php echo htmlspecialchars($reseña['nombre']); ?></h3>
                    <span class="review-job"><?php echo htmlspecialchars($reseña['trabajo']); ?></span>
                    <p><?php echo htmlspecialchars($reseña['texto']); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
