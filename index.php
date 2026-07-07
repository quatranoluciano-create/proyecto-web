<?php
require_once __DIR__ . '/includes/config.php';

$busqueda = trim($_GET['q'] ?? '');
$filtro_tipo = $_GET['tipo'] ?? '';
$filtro_zona = trim($_GET['zona'] ?? '');

// Armamos la consulta de forma dinámica pero siempre con parámetros
// preparados (nunca concatenando texto del usuario en el SQL).
$sql = 'SELECT id, titulo, zona, tipo, modalidad, descripcion, urgente, fecha
        FROM trabajos
        WHERE 1 = 1';
$parametros = [];

if ($busqueda !== '') {
    $sql .= ' AND (titulo LIKE :busqueda OR descripcion LIKE :busqueda2)';
    $parametros['busqueda'] = '%' . $busqueda . '%';
    $parametros['busqueda2'] = '%' . $busqueda . '%';
}

if ($filtro_tipo !== '') {
    $sql .= ' AND tipo = :tipo';
    $parametros['tipo'] = $filtro_tipo;
}

if ($filtro_zona !== '') {
    $sql .= ' AND zona LIKE :zona';
    $parametros['zona'] = '%' . $filtro_zona . '%';
}

$sql .= ' ORDER BY fecha DESC';

$pdo = obtener_conexion();
$consulta = $pdo->prepare($sql);
$consulta->execute($parametros);
$trabajos_filtrados = $consulta->fetchAll();

$reseñas = $pdo->query('SELECT nombre, trabajo_titulo AS trabajo, estrellas, texto FROM resenas ORDER BY creado_en DESC')->fetchAll();

$total = count($trabajos_filtrados);
$titulo_pagina = 'Buscar trabajos técnicos';
require_once __DIR__ . '/includes/header.php';
?>

<main>
    <section class="jobs-hero">
        <div class="jobs-hero-inner">
            <span class="eyebrow">Portal de servicios técnicos</span>
            <h1>Encontrá el trabajo técnico que necesitás</h1>
            <p class="hero-text">Buscá por especialidad, zona o palabra clave. Inspirado en portales de empleo, adaptado a reparaciones, redes y soporte IT.</p>

            <form class="jobs-search" method="get" action="index.php">
                <div class="search-field">
                    <label for="q">¿Qué buscás?</label>
                    <input type="text" id="q" name="q" placeholder="Ej: notebook, WiFi, pantalla..." value="<?php echo htmlspecialchars($busqueda); ?>">
                </div>
                <div class="search-field">
                    <label for="tipo">Especialidad</label>
                    <select id="tipo" name="tipo">
                        <option value="">Todas</option>
                        <?php foreach ($tipos_trabajo as $clave => $etiqueta) : ?>
                            <option value="<?php echo $clave; ?>"<?php echo $filtro_tipo === $clave ? ' selected' : ''; ?>><?php echo htmlspecialchars($etiqueta); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="search-field">
                    <label for="zona">Zona</label>
                    <input type="text" id="zona" name="zona" placeholder="CABA, GBA, Remoto..." value="<?php echo htmlspecialchars($filtro_zona); ?>">
                </div>
                <button type="submit" class="btn-primary">Buscar</button>
            </form>

            <div class="hero-quick-tags">
                <?php foreach (array_slice($tipos_trabajo, 0, 4, true) as $clave => $etiqueta) : ?>
                    <a href="index.php?tipo=<?php echo urlencode($clave); ?>" class="tag-chip"><?php echo htmlspecialchars($etiqueta); ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="jobs-layout">
        <aside class="jobs-filters">
            <h2>Filtros</h2>
            <form method="get" class="filters-form">
                <?php if ($busqueda !== '') : ?>
                    <input type="hidden" name="q" value="<?php echo htmlspecialchars($busqueda); ?>">
                <?php endif; ?>
                <?php if ($filtro_zona !== '') : ?>
                    <input type="hidden" name="zona" value="<?php echo htmlspecialchars($filtro_zona); ?>">
                <?php endif; ?>

                <fieldset>
                    <legend>Especialidad</legend>
                    <?php foreach ($tipos_trabajo as $clave => $etiqueta) : ?>
                        <label class="filter-option">
                            <input type="radio" name="tipo" value="<?php echo $clave; ?>"<?php echo $filtro_tipo === $clave ? ' checked' : ''; ?> onchange="this.form.submit()">
                            <?php echo htmlspecialchars($etiqueta); ?>
                        </label>
                    <?php endforeach; ?>
                    <label class="filter-option">
                        <input type="radio" name="tipo" value=""<?php echo $filtro_tipo === '' ? ' checked' : ''; ?> onchange="this.form.submit()">
                        Ver todas
                    </label>
                </fieldset>
            </form>

            <div class="filter-cta">
                <p>¿Sos cliente registrado?</p>
                <a href="<?php echo usuario_logueado() ? 'cliente.php' : 'login.php'; ?>" class="btn-secondary btn-block">Mi área de cliente</a>
            </div>
        </aside>

        <div class="jobs-results">
            <div class="results-header">
                <h2><?php echo $total; ?> trabajos encontrados</h2>
                <span class="sort-label">Ordenar: relevancia</span>
            </div>

            <?php if ($total === 0) : ?>
                <article class="job-card empty-state">
                    <h3>No hay resultados</h3>
                    <p>Probá con otra palabra clave o quitá los filtros para ver más trabajos técnicos disponibles.</p>
                    <a href="index.php" class="btn-secondary">Ver todos</a>
                </article>
            <?php else : ?>
                <?php foreach ($trabajos_filtrados as $trabajo) : ?>
                    <article class="job-card" data-tipo="<?php echo htmlspecialchars($trabajo['tipo']); ?>">
                        <?php if ($trabajo['urgente']) : ?>
                            <span class="job-badge">Urgente</span>
                        <?php endif; ?>
                        <h3><?php echo htmlspecialchars($trabajo['titulo']); ?></h3>
                        <ul class="job-meta">
                            <li><?php echo htmlspecialchars($trabajo['zona']); ?></li>
                            <li><?php echo htmlspecialchars($trabajo['modalidad']); ?></li>
                            <li><?php echo htmlspecialchars(obtener_etiqueta_tipo($trabajo['tipo'])); ?></li>
                        </ul>
                        <p><?php echo htmlspecialchars($trabajo['descripcion']); ?></p>
                        <div class="job-card-footer">
                            <span class="job-date">Publicado el <?php echo htmlspecialchars(formatear_fecha_es($trabajo['fecha'])); ?></span>
                            <a href="contacto.php" class="btn-secondary">Solicitar técnico</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <section id="reseñas" class="reviews-section">
        <h2>Reseñas de trabajos anteriores</h2>
        <p class="section-text">Lo que dicen nuestros clientes después de cada servicio técnico.</p>
        <div class="reviews-grid">
            <?php foreach ($reseñas as $reseña) : ?>
                <article class="review-card">
                    <div class="stars" aria-label="<?php echo $reseña['estrellas']; ?> de 5 estrellas">
                        <?php echo str_repeat('★', $reseña['estrellas']) . str_repeat('☆', 5 - $reseña['estrellas']); ?>
                    </div>
                    <h3><?php echo htmlspecialchars($reseña['nombre']); ?></h3>
                    <span class="review-job"><?php echo htmlspecialchars($reseña['trabajo']); ?></span>
                    <p><?php echo htmlspecialchars($reseña['texto']); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="cta-banner">
        <div>
            <h2>¿Necesitás un técnico ahora?</h2>
            <p>Registrate, seguí tus pedidos y dejá tu reseña cuando terminemos el trabajo.</p>
        </div>
        <div class="cta-actions">
            <a href="contacto.php" class="btn-primary">Solicitar técnico</a>
            <?php if (!usuario_logueado()) : ?>
                <a href="login.php" class="btn-secondary">Crear acceso cliente</a>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
