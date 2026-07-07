-- =====================================================================
-- TecnoLink - Base de datos
-- Motor: MySQL / MariaDB (compatible con XAMPP)
--
-- CÓMO IMPORTAR ESTE ARCHIVO:
-- 1. Abrí phpMyAdmin (http://localhost/phpmyadmin) con XAMPP corriendo.
-- 2. Creá una base nueva llamada "tecnolink" (o dejá que este script
--    la cree solo, ya incluye el CREATE DATABASE).
-- 3. Pestaña "Importar" -> elegí este archivo -> Continuar.
--    (También podés pegar todo el contenido en la pestaña "SQL".)
-- =====================================================================

CREATE DATABASE IF NOT EXISTS tecnolink
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE tecnolink;

-- ---------------------------------------------------------------------
-- Tabla: tipos_trabajo (catálogo de especialidades)
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS tipos_trabajo (
    id       VARCHAR(20)  NOT NULL PRIMARY KEY,
    etiqueta VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO tipos_trabajo (id, etiqueta) VALUES
    ('computadoras', 'Computadoras y laptops'),
    ('celulares',    'Celulares y tablets'),
    ('redes',        'Redes y WiFi'),
    ('electro',      'Electrodomésticos'),
    ('remoto',       'Soporte remoto'),
    ('empresas',     'Soporte empresarial')
ON DUPLICATE KEY UPDATE etiqueta = VALUES(etiqueta);

-- ---------------------------------------------------------------------
-- Tabla: usuarios (clientes que se loguean)
-- La contraseña NUNCA se guarda en texto plano: se guarda su hash
-- generado con password_hash() de PHP.
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nombre     VARCHAR(100) NOT NULL,
    email      VARCHAR(150) NOT NULL UNIQUE,
    clave_hash VARCHAR(255) NOT NULL,
    creado_en  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Usuarios de prueba (mismas cuentas que antes):
--   cliente@tecnolink.com / cliente123
--   demo@tecnolink.com    / demo123
INSERT INTO usuarios (nombre, email, clave_hash) VALUES
    ('María López',  'cliente@tecnolink.com', '$2b$10$XCgYSnfia8ZI04HjyoRSv.Ixxp4Q/tcFB.RjovFwzGHvMo9awZH.i'),
    ('Usuario Demo', 'demo@tecnolink.com',    '$2b$10$Y4RCTH9msCPKe5K.bTceQ.m7CeXNs7tHrOo1nNYyg2fbxPG7UUSRy')
ON DUPLICATE KEY UPDATE nombre = VALUES(nombre);

-- ---------------------------------------------------------------------
-- Tabla: trabajos (los avisos que se ven en index.php)
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS trabajos (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id  INT NULL,
    titulo      VARCHAR(150) NOT NULL,
    zona        VARCHAR(100) NOT NULL,
    tipo        VARCHAR(20)  NOT NULL,
    modalidad   VARCHAR(50)  NOT NULL,
    descripcion TEXT NOT NULL,
    estado      ENUM('Pendiente','En curso','Finalizado') NOT NULL DEFAULT 'Pendiente',
    urgente     TINYINT(1) NOT NULL DEFAULT 0,
    fecha       DATE NOT NULL,
    creado_en   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL,
    FOREIGN KEY (tipo) REFERENCES tipos_trabajo(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO trabajos (usuario_id, titulo, zona, tipo, modalidad, descripcion, estado, urgente, fecha) VALUES
    (NULL, 'Reparación urgente de notebook',        'Capital Federal',   'computadoras', 'A domicilio', 'Notebook que no enciende tras actualización. Diagnóstico y reparación con repuestos disponibles.', 'Pendiente', 1, '2026-05-22'),
    (NULL, 'Instalación y optimización de red WiFi', 'Zona Norte, GBA',   'redes',        'Presencial',  'Mejora de cobertura en hogar de dos plantas. Configuración de router mesh y pruebas de velocidad.', 'Pendiente', 0, '2026-05-21'),
    (NULL, 'Cambio de pantalla en celular',          'La Plata',          'celulares',    'En taller',   'Pantalla rota en smartphone Android. Presupuesto con repuesto original o compatible.', 'Pendiente', 0, '2026-05-20'),
    (NULL, 'Mantenimiento de PCs en oficina',        'CABA',              'empresas',     'Empresas',    'Limpieza, actualización de software y backup para 8 equipos de una pyme.', 'Pendiente', 0, '2026-05-19'),
    (NULL, 'Soporte remoto para PC lenta',           'Remoto',            'remoto',       'Online',      'Optimización de inicio, eliminación de malware y actualización de drivers a distancia.', 'Pendiente', 1, '2026-05-18'),
    (NULL, 'Configuración de electrodoméstico smart', 'Zona Oeste, GBA',  'electro',      'A domicilio', 'Vinculación de heladera y lavarropas inteligentes con app móvil y red doméstica.', 'Pendiente', 0, '2026-05-17'),
    (1,    'Notebook no enciende',                   'Capital Federal',   'computadoras', 'A domicilio', 'Diagnóstico de fuente de alimentación y placa madre.', 'En curso',   0, '2026-05-20'),
    (1,    'Optimización WiFi hogar',                'Capital Federal',   'redes',        'Presencial',  'Reconfiguración de red doméstica de dos ambientes.', 'Finalizado', 0, '2026-05-10'),
    (1,    'Backup y limpieza PC',                    'Remoto',            'remoto',       'Online',      'Backup completo y eliminación de archivos temporales.', 'Finalizado', 0, '2026-05-02');

-- ---------------------------------------------------------------------
-- Tabla: resenas
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS resenas (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    trabajo_id     INT NULL,
    nombre         VARCHAR(100) NOT NULL,
    trabajo_titulo VARCHAR(150) NOT NULL,
    estrellas      TINYINT NOT NULL,
    texto          TEXT NOT NULL,
    creado_en      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (trabajo_id) REFERENCES trabajos(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO resenas (trabajo_id, nombre, trabajo_titulo, estrellas, texto) VALUES
    (NULL, 'Carlos M.', 'Reparación de PC', 5, 'Vinieron el mismo día, explicaron todo y dejaron la computadora funcionando perfecta.'),
    (NULL, 'Laura S.',  'Red WiFi',         5, 'Excelente señal en toda la casa. Muy claros con el presupuesto y el tiempo de trabajo.'),
    (NULL, 'Diego R.',  'Celular',          4, 'Rápidos y profesionales. La pantalla quedó como nueva y con garantía escrita.');

-- ---------------------------------------------------------------------
-- Tabla: solicitudes_contacto (formulario de contacto.php)
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS solicitudes_contacto (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    nombre        VARCHAR(100) NOT NULL,
    telefono      VARCHAR(30)  NOT NULL,
    tipo_servicio VARCHAR(20)  NOT NULL,
    descripcion   TEXT NOT NULL,
    estado        ENUM('Nueva','Contactado','Cerrada') NOT NULL DEFAULT 'Nueva',
    creado_en     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tipo_servicio) REFERENCES tipos_trabajo(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------------
-- Tabla: postulaciones_cv (formulario de cv.php)
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS postulaciones_cv (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    nombre          VARCHAR(100) NOT NULL,
    email           VARCHAR(150) NOT NULL,
    telefono        VARCHAR(30)  NOT NULL,
    zona            VARCHAR(100),
    especialidad    VARCHAR(20)  NOT NULL,
    experiencia     VARCHAR(20)  NOT NULL,
    habilidades     TEXT,
    certificaciones TEXT,
    disponibilidad  VARCHAR(30)  NOT NULL,
    referencias     TEXT,
    creado_en       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (especialidad) REFERENCES tipos_trabajo(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
