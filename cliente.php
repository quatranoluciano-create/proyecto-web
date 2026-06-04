<?php
require_once __DIR__ . '/includes/config.php';
requiere_login();

$mis_trabajos = [
    [
        'titulo' => 'Notebook no enciende',
        'estado' => 'En curso',
        'tipo' => 'computadoras',
        'fecha' => '20 mayo 2026',
    ],
    [
        'titulo' => 'Optimización WiFi hogar',
        'estado' => 'Finalizado',
        'tipo' => 'redes',
        'fecha' => '10 mayo 2026',
    ],
    [
        'titulo' => 'Backup y limpieza PC',
        'estado' => 'Finalizado',
        'tipo' => 'remoto',
        'fecha' => '02 mayo 2026',
    ],
];

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

    <section class="client-stats">
        <article class="stat-card">
            <strong>3</strong>
            <span>Trabajos registrados</span>
        </article>
        <article class="stat-card">
            <strong>2</strong>
            <span>Finalizados</span>
        </article>
        <article class="stat-card">
            <strong>1</strong>
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
                            <p><?php echo htmlspecialchars(etiqueta_tipo($trabajo['tipo'])); ?> · <?php echo htmlspecialchars($trabajo['fecha']); ?></p>
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
