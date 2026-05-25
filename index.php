<?php
    session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tecnolink - Servicio técnico rápido</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="site-header">
        <div class="logo">Tecnolink</div>
        <nav class="main-nav">
            <a href="index.php">Inicio</a>
            <a href="#nosotros">Sobre nosotros</a>
            <a href="servicios.php">Servicios</a> 
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>
    
    <main> 
        <section id="inicio" class="hero">
            <div class="hero-copy">
                <span class="eyebrow">Servicio técnico profesional</span>
                <h1>tecnolink</h1>
                <p class="hero-text">Soluciones rápidas y confiables para computadoras, celulares, redes y electrodomésticos. Atención a domicilio, asistencia remota y diagnóstico exprés.</p>
                <a href="contacto.php" class="btn-primary">Solicitar técnico</a>
            </div>
            <div class="hero-card">
                <div class="hero-card-inner">
                    <div class="card-badge">Más rápido</div>
                    <h2>Tu equipo listo en pocas horas</h2>
                    <p>Nos ocupamos de que tu problema sea atendido con prioridad y sin complicaciones.</p>
                    <p>Experiencia en reparación de hardware, software y redes con servicio seguro y cercano.</p>
                </div>
            </div>
        </section>

        <section class="home-links">
            <h2>Elegí una sección independiente</h2>
            <div class="cards">
                <article class="link-card">
                    <h3>Sobre nosotros</h3>
                    <p>Conocé quiénes somos, qué hacemos y cómo trabajamos para resolver tus urgencias técnicas.</p>
                    <a href="nosotros.php" class="btn-secondary">Ver más</a>
                </article>
                <article class="link-card">
                    <h3>Servicios</h3>
                    <p>Explorá todas las soluciones disponibles para equipos, celulares, redes y dispositivos inteligentes.</p>
                    <a href="servicios.php" class="btn-secondary">Ver servicios</a>
                </article>
                <article class="link-card">
                    <h3>Contacto</h3>
                    <p>Solicitá un técnico de inmediato y compartí los detalles de tu problema en una página dedicada.</p>
                    <a href="contacto.php" class="btn-secondary">Contactar</a>
                </article>
            </div>
        </section>

        <section id="nosotros" class="about-section">
            <div class="about-inner">
                <div class="about-text">
                    <h2>Sobre nosotros</h2>
                    <p class="section-text">Somos un equipo de técnicos especializados con más de una década de experiencia brindando soluciones rápidas y confiables para equipos, celulares, redes y electrodomésticos inteligentes. Nos enfocamos en diagnósticos claros, presupuestos honestos y reparaciones con garantía.</p>
                    <a href="contacto.php" class="btn-primary">Solicitá tu diagnóstico</a>
                </div>
                <div class="about-cards">
                    <article class="about-card">
                        <h3>Misión</h3>
                        <p>Restaurar y mantener la tecnología accesible para todos, con respuestas ágiles y un servicio transparente.</p>
                    </article>
                    <article class="about-card">
                        <h3>Visión</h3>
                        <p>Ser referentes locales en soporte técnico, ofreciendo soluciones completas y confiables.</p>
                    </article>
                    <article class="about-card">
                        <h3>Valores</h3>
                        <p>Transparencia, rapidez y compromiso con la calidad en cada intervención técnica.</p>
                    </article>
                </div>
            </div>
        </section>

    </main>
</body>
</html>
 
 