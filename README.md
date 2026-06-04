# TecnoLink - Portal de Servicios Técnicos

**TecnoLink** es una plataforma web para solicitar y ofrecer servicios técnicos (reparación de computadoras, redes, celulares, etc.) con una interfaz moderna y responsiva.

---

## 🚀 Características Principales

✅ **Sistema de búsqueda** - Filtra trabajos técnicos por especialidad, zona y palabra clave  
✅ **Autenticación de usuarios** - Login seguro con sesiones PHP  
✅ **Formulario de CV** - Los técnicos pueden enviar su CV con validación completa  
✅ **Solicitud de servicios** - Formulario de contacto funcional con validación  
✅ **Panel de cliente** - Área personalizada para usuarios autenticados  
✅ **Sistema de reseñas** - Comentarios y valoraciones de clientes  
✅ **Diseño responsivo** - Adaptado a móvil, tablet y desktop  
✅ **Seguridad** - Validación de formularios y protección contra XSS  

---

## 📋 Requisitos

- **PHP** 7.4 o superior
- **Servidor web** Apache o similar
- **Navegador moderno** (Chrome, Firefox, Edge, Safari)
- **Git** (opcional, para control de versiones)

---

## 📁 Estructura del Proyecto

```
proyecto-web-main/
├── index.php                  # Página principal - Búsqueda de trabajos
├── login.php                  # Autenticación de usuarios
├── cv.php                     # Envío de CV (NUEVO)
├── contacto.php               # Formulario de solicitud de servicios
├── servicios.php              # Catálogo de servicios
├── nosotros.php               # Información de la empresa
├── cliente.php                # Panel del usuario autenticado
├── panel.php                  # Panel de administración
├── logout.php                 # Cerrar sesión
├── styles.css                 # Estilos CSS globales
├── app.js                     # JavaScript del cliente
│
├── includes/
│   ├── config.php             # Configuración y datos
│   ├── header.php             # Encabezado HTML
│   ├── footer.php             # Pie de página HTML
│   └── helpers.php            # Funciones auxiliares reutilizables (NUEVO)
│
├── logs/                      # Carpeta de logs (se crea automáticamente)
├── Marketing/                 # Recursos de marketing
│
├── README.md                  # Este archivo
├── PROMPT_CHATGPT_INFORME.md  # Prompt para generar informe (NUEVO)
└── OPTIMIZACIONES_RECOMENDADAS.md  # Guía de optimizaciones (NUEVO)
```

---

## 🔧 Instalación

### 1. Clonar o descargar el proyecto
```bash
git clone <URL_REPOSITORIO>
cd proyecto-web-main
```

### 2. Configurar servidor local
- Colocar en `/var/www/html/` (Linux) o `C:/xampp/htdocs/` (Windows)
- O usar `php -S localhost:8000` para servidor de desarrollo

### 3. Acceder a la aplicación
```
http://localhost/proyecto-web-main/
```

---

## 👥 Cuentas de Prueba

La aplicación incluye dos cuentas de prueba:

| Email | Contraseña | Nombre |
|-------|-----------|--------|
| cliente@tecnolink.com | cliente123 | María López |
| demo@tecnolink.com | demo123 | Usuario Demo |

Puedes probar el login en: `http://localhost/proyecto-web-main/login.php`

---

## 📝 Páginas y Funciones

### Públicas
- **index.php** - Búsqueda de trabajos técnicos con filtros
- **servicios.php** - Catálogo de servicios disponibles
- **contacto.php** - Formulario para solicitar técnico
- **nosotros.php** - Información de la empresa
- **cv.php** - Envío de CV de técnicos
- **login.php** - Autenticación

### Protegidas (requieren login)
- **cliente.php** - Panel de usuario autenticado
- **panel.php** - Panel de administración

### Sistema
- **logout.php** - Cerrar sesión

---

## 🔒 Seguridad

El proyecto implementa las siguientes medidas:

✅ **Validación de formularios** - Tanto del lado cliente como servidor  
✅ **Sanitización de entrada** - Uso de `htmlspecialchars()` y `trim()`  
✅ **Validación de email** - Con `filter_var()`  
✅ **Protección contra XSS** - Escapado de caracteres especiales  
✅ **Sesiones PHP seguras** - Almacenamiento de datos de usuario  
✅ **Funciones auxiliares** - Módulo `helpers.php` para código limpio y reutilizable  

---

## 🎨 Diseño y Responsive

- **Colores principales:**
  - Azul oscuro: #0f4c5c
  - Azul claro: #0078b8
  - Naranja: #ff7a34

- **Tipografía:** Montserrat (Google Fonts)

- **Breakpoints:**
  - Mobile: < 768px
  - Tablet: 768px - 1024px
  - Desktop: > 1024px

---

## 📊 Tipos de Trabajo Disponibles

1. **Computadoras y laptops**
2. **Celulares y tablets**
3. **Redes y WiFi**
4. **Electrodomésticos**
5. **Soporte remoto**
6. **Soporte empresarial**

---

## 🚀 Optimizaciones Implementadas

### Recientes
- ✅ Agregado formulario de CV con validación completa
- ✅ Actualizado header para incluir enlace a CV
- ✅ Mejorado contacto.php con validación y procesamiento
- ✅ Creado archivo helpers.php con 30+ funciones auxiliares
- ✅ Agregados estilos CSS para formularios
- ✅ Mensaje de éxito/error en formularios

### Recomendadas
- 📝 Ver archivo `OPTIMIZACIONES_RECOMENDADAS.md`

---

## 📧 Funcionalidades de Formularios

### Formulario CV (cv.php)
- Datos personales
- Especialidad técnica
- Años de experiencia
- Habilidades y certificaciones
- Disponibilidad laboral
- Validación completa

### Formulario Contacto (contacto.php)
- Nombre y teléfono
- Tipo de servicio
- Descripción del problema
- Validación de campos
- Mensajes de éxito/error

---

## 🔍 Validaciones Implementadas

| Campo | Validación |
|-------|-----------|
| Nombre | Mínimo 3 caracteres |
| Email | Formato válido (RFC 5322) |
| Teléfono | Mínimo 10 caracteres numéricos |
| Descripción | Mínimo 10 caracteres |
| Selects | Campo requerido |

---

## 📱 Navegadores Soportados

- ✅ Chrome (versión actual)
- ✅ Firefox (versión actual)
- ✅ Edge (versión actual)
- ✅ Safari (versión actual)

---

## 📚 Funciones Auxiliares (helpers.php)

Incluye 35+ funciones para tareas comunes:

```php
// Ejemplos de uso:
sanitizar_texto($input)              // Previene XSS
es_email_valido($email)              // Valida email
es_telefono_valido($tel)             // Valida teléfono
obtener_etiqueta_tipo($tipo)         // Obtiene nombre del tipo
obtener_nombre_usuario()             // Obtiene nombre del usuario logueado
es_pagina('login.php')               // Verifica página actual
truncar($texto, 100)                 // Corta texto a 100 caracteres
```

Ver archivo `includes/helpers.php` para lista completa.

---

## 📝 Para Generar el Informe

Se incluye un prompt pre-escrito para ChatGPT que genera automáticamente un informe profesional:

1. Abre el archivo: `PROMPT_CHATGPT_INFORME.md`
2. Copia el contenido completo
3. Pégalo en ChatGPT
4. Completa los datos específicos del equipo
5. ChatGPT generará un informe Word/PDF profesional

Ver archivo `PROMPT_CHATGPT_INFORME.md` para más detalles.

---

## 🐛 Solución de Problemas

### "La página no carga"
- Verificar que PHP está instalado: `php -v`
- Verificar que el servidor Apache está ejecutándose

### "Los formularios no se envían"
- Verificar que los campos `name=""` están presentes
- Revisar la consola del navegador (F12)

### "Las sesiones no funcionan"
- Verificar que `php.ini` tiene `session.save_path` configurado
- Limpiar cookies del navegador

---

## 📄 Archivos Importantes

- **styles.css** - 1000+ líneas de CSS optimizado
- **app.js** - JavaScript para validación y UX
- **config.php** - Datos y configuración central
- **helpers.php** - 30+ funciones reutilizables
- **OPTIMIZACIONES_RECOMENDADAS.md** - Guía de mejoras futuras

---

## 🤝 Contribuciones

Para contribuir al proyecto:

1. Fork el repositorio
2. Crea una rama: `git checkout -b feature/mi-feature`
3. Commit los cambios: `git commit -am 'Agrego feature'`
4. Push a la rama: `git push origin feature/mi-feature`
5. Abre un Pull Request

---

## 📄 Licencia

Este proyecto es de código abierto. Puedes usarlo libremente.

---

## 👨‍💻 Autor

Proyecto TecnoLink - Plataforma de servicios técnicos  
Desarrollado como proyecto educativo

---

## 📞 Soporte

Para reportar problemas o sugerencias:
- Abre un issue en GitHub
- Contacta al equipo de desarrollo

---

## 🎯 Próximas Fases

- [ ] Integración con base de datos real
- [ ] Sistema de pagos en línea
- [ ] Notificaciones por email
- [ ] App móvil nativa
- [ ] Panel de administración completo
- [ ] Sistema de chat en tiempo real
- [ ] Mapas de ubicación de técnicos

---

**Última actualización:** Junio 2026  
**Versión:** 1.1  
**Estado:** En desarrollo activo
