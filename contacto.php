<?php
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

            <button type="button" class="btn-enviar">Enviar solicitud</button>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
