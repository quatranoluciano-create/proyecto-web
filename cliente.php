<?php
require_once __DIR__ . '/includes/config.php';
requiere_login();

$pdo = obtener_conexion();
$consulta = $pdo->prepare(
    'SELECT titulo, estado, tipo, fecha
     FROM trabajos
     WHERE usuario_id = :usuario_id
     ORDER BY fecha DESC'
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
