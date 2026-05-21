<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Tecnolink</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="site-header">
        <div class="logo">Tecnolink</div>
        <nav class="main-nav">
            <a href="index.php">Inicio</a>
            <a href="nosotros.php">Sobre nosotros</a>
            <a href="servicios.php">Servicios</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <main>
        <section class="contacto">
            <div class="contacto-info">
                <h2>Contacta un <span>Técnico</span></h2>
                <p>Completa el formulario y te respondemos en menos de 1 hora.</p>
                <p>Servicio en toda el área metropolitana.</p>
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
