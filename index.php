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
            <a href="#inicio">Inicio</a>
            <a href="#catalogo">Catálogo</a>
            <a href="#contacto">Contacto</a>
        </nav>
    </header>

    <main>
        <section id="inicio" class="hero">
            <div class="hero-copy">
                <span class="eyebrow">Servicio técnico profesional</span>
                <h1>tecnolink</h1>
                <p class="hero-text">Soluciones rápidas y confiables para computadoras, celulares, redes y electrodomésticos. Atención a domicilio, asistencia remota y diagnóstico exprés.</p>
                <a href="#contacto" class="btn-primary">Solicitar técnico</a>
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

        <section id="sobre-nosotros">
            <h2>Sobre nosotros</h2>
            <p class="section-text">En Tecnolink conectamos tu equipo con técnicos especializados para que vuelvas al trabajo o al entretenimiento sin esperas. Nuestro objetivo es ofrecer ayuda rápida, clara y transparente, con servicios pensados para todo tipo de dispositivos.</p>
        </section>

        <section id="catalogo" class="carousel-section">
            <h2>Carrusel de servicios</h2>
            <div class="carousel">
                <div class="carousel-track">
                    <article class="carousel-card">
                        <h3>Reparación de computadoras</h3>
                        <p>Instalación de sistemas, recuperación de archivos y mantenimiento general para PCs y notebooks.</p>
                    </article>
                    <article class="carousel-card">
                        <h3>Soporte de celulares</h3>
                        <p>Arreglo de pantallas, optimización de batería, actualización de software y restauración de datos.</p>
                    </article>
                    <article class="carousel-card">
                        <h3>Redes y WiFi</h3>
                        <p>Configuración de routers, mejorar la señal y solucionar problemas de conexión en tu hogar o local.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="contact-prompt">
            <h2>¡Contacta a un Tecnolink!</h2>
            <p>Es muy fácil: elegí tu servicio, contanos el problema y un técnico especializado te atenderá en seguida. Ideal para urgencias domésticas y soporte técnico exprés.</p>
        </section>

        <section class="services">
            <h2>¿Qué nos encargamos?</h2>
            <div class="cards">
                <article class="service-card">
                    <h3>Computadoras y laptops</h3>
                    <p>Diagnóstico rápido, cambio de componentes, limpieza interna y optimización general para tu equipo.</p>
                </article>
                <article class="service-card">
                    <h3>Celulares y tablets</h3>
                    <p>Reparación de pantallas, actualización de software, recuperación de datos y configuración personalizada.</p>
                </article>
                <article class="service-card">
                    <h3>Electrodomésticos y redes</h3>
                    <p>Soporte para electrodomésticos inteligentes, redes WiFi y conexiones de dispositivos en tu hogar.</p>
                </article>
            </div>
        </section>

        <section id="contacto" class="contacto">
            <div class="contacto-info">
                <h2>Contacta un <span>Técnico</span></h2>
                <p>Completa el formulario y te respondemos en menos de 1 hora. Servicio en toda el área metropolitana.</p>
                <p>Atención: lunes a sábado de 9:00 a 20:00.</p>
                <p>WhatsApp: +54 11 XXXX-XXXX</p>
            </div>
            <div class="formulario">
                <h3>Solicitar técnico</h3>
                <label>Nombre:</label>
                <input type="text" placeholder="Tu nombre completo">
                <label>Teléfono:</label>
                <input type="tel" placeholder="11 XXXX-XXXX">
                <label>Tipo de servicio:</label>
                <select>
                    <option value="">Selecciona una opción</option>
                    <option>Computadoras y laptops</option>
                    <option>Celulares y tablets</option>
                    <option>Electrodomésticos</option>
                    <option>Redes WiFi</option>
                    <option>Otro</option>
                </select>
                <label>Descripción del problema:</label>
                <textarea placeholder="Contanos qué le pasa a tu equipo..."></textarea>
                <button class="btn-enviar">Enviar solicitud</button>
            </div>
        </section>
    </main>
</body>
</html>
 
 