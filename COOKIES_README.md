# Sistema de Gestión de Cookies - InnovaByte

## 🍪 Descripción

Sistema completo de gestión de cookies conforme al RGPD, implementado para el sitio web de InnovaByte. Incluye banner de consentimiento, página de configuración detallada y botón de gestión flotante.

## 📁 Archivos Implementados

### 1. **assets/js/cookies.js**
- **Función**: Manejo completo del banner de cookies
- **Características**:
  - Banner animado que aparece desde abajo
  - Guarda preferencias en cookies con fecha de expiración
  - Métodos para aceptar/rechazar cookies
  - Integración con Google Analytics (comentado)
  - Notificaciones toast personalizadas
  - Compatible con RGPD

### 2. **assets/css/style.css** (Actualizado)
- **Función**: Estilos para el banner de cookies
- **Características**:
  - Banner responsive que se adapta a móviles
  - Animaciones suaves de entrada/salida
  - Diseño coherente con la marca (colores #CC7700)
  - Estilos para botones de acción

### 3. **cookies.php** (Actualizado)
- **Función**: Página completa de información y gestión de cookies
- **Características**:
  - Información detallada sobre tipos de cookies
  - Panel interactivo de gestión de preferencias
  - Switches para activar/desactivar categorías
  - Estado actual de configuración
  - Enlaces a configuración por navegador
  - Información legal y de contacto

### 4. **assets/templates/mainjs.php** (Actualizado)
- **Función**: Inclusión del script de cookies
- **Cambio**: Agregada línea para cargar `cookies.js`

### 5. **assets/templates/mainfooter.php** (Actualizado)
- **Función**: Botón flotante para gestión de cookies
- **Características**:
  - Botón siempre visible en esquina inferior izquierda
  - Responsive design
  - Redirige a página de configuración

## 🚀 Funcionamiento

### Banner Inicial
1. **Primera visita**: El banner aparece después de 0.5 segundos
2. **Opciones disponibles**:
   - ✅ **Aceptar todas**: Habilita todas las cookies
   - ❌ **Rechazar**: Solo cookies técnicas necesarias
   - ⚙️ **Configurar**: Redirige a página detallada

### Gestión de Cookies
1. **Página cookies.php**: Configuración detallada
2. **Categorías**:
   - 🔧 **Técnicas**: Siempre activas (necesarias)
   - 📊 **Analíticas**: Opcionales (Google Analytics)
   - 🔗 **Terceros**: Opcionales (servicios externos)

### Persistencia
- Las preferencias se guardan por **365 días**
- Cookie de consentimiento: `innovabyte_cookie_consent`
- Incluye timestamp y versión de la política

## 🛠️ Configuración

### Google Analytics (Opcional)
Para activar Google Analytics, descomenta las líneas en `cookies.js`:

```javascript
// En enableAnalytics() y disableAnalytics()
if (typeof gtag !== 'undefined') {
    gtag('consent', 'update', {
        'analytics_storage': 'granted' // o 'denied'
    });
}
```

### Personalización de Colores
Los colores principales están definidos en CSS:
- **Primario**: `#CC7700` (naranja InnovaByte)
- **Secundario**: `#141B2D` (azul oscuro)

### Textos Personalizables
Los textos del banner se pueden modificar en `cookies.js`:
- Mensaje principal
- Botones de acción
- Enlaces informativos

## 📱 Responsive Design

El sistema es completamente responsive:
- **Desktop**: Banner horizontal con 3 botones
- **Tablet**: Diseño centrado con botones apilados
- **Móvil**: Banner vertical con botones en columna

## 🔧 Métodos JavaScript Disponibles

### Uso Básico
```javascript
// Aceptar todas las cookies
window.cookieBanner.acceptAll();

// Rechazar cookies opcionales
window.cookieBanner.declineAll();

// Verificar si hay consentimiento
window.cookieBanner.hasConsent();

// Obtener detalles del consentimiento
window.cookieBanner.getConsent();

// Resetear configuración (para testing)
window.cookieBanner.resetConsent();
```

### Para Desarrolladores
```javascript
// Activar/desactivar analytics manualmente
window.cookieBanner.enableAnalytics();
window.cookieBanner.disableAnalytics();

// Mostrar notificación personalizada
window.cookieBanner.showToast('Mensaje', 'success');
```

## 🎨 Características Visuales

### Animaciones
- **Entrada**: Banner desliza desde abajo
- **Salida**: Banner se desliza hacia abajo
- **Hover**: Botones se elevan con sombra
- **Toast**: Notificaciones deslizantes

### Iconografía
- 🍪 Cookie para gestión general
- ⚙️ Engranajes para configuración técnica
- 📊 Gráficos para analytics
- 🔗 Enlaces para terceros

## 🔒 Cumplimiento Legal

### RGPD Compliance
- ✅ Consentimiento explícito
- ✅ Información clara y accesible
- ✅ Facilidad para retirar consentimiento
- ✅ Cookies técnicas diferenciadas
- ✅ Registro de timestamp de consentimiento

### Información Incluida
- Tipos de cookies utilizadas
- Finalidad de cada categoría
- Duración de almacenamiento
- Base legal para el tratamiento
- Información de contacto

## 🧪 Testing

### Pruebas Recomendadas
1. **Primera visita**: Verificar aparición del banner
2. **Aceptar todas**: Comprobar que se guarden preferencias
3. **Rechazar**: Verificar que solo cookies técnicas estén activas
4. **Página de configuración**: Probar switches interactivos
5. **Botón flotante**: Verificar accesibilidad
6. **Responsive**: Probar en diferentes dispositivos

### Debug Mode
Para verificar el funcionamiento:
```javascript
// En consola del navegador
console.log(window.cookieBanner.getConsent());
```

## 📞 Soporte

Para dudas o modificaciones:
- **Email**: info@innovabyte.es
- **Teléfono**: +34 647 124 790

## 📄 Notas Adicionales

### Archivos No Modificados
- El sistema no interfiere con archivos existentes
- Solo agrega funcionalidad nueva
- Compatible con el diseño actual

### Rendimiento
- Script ligero (~4KB)
- CSS mínimo agregado
- Sin dependencias externas
- Carga asíncrona

### Mantenimiento
- Revisar política anualmente
- Actualizar fecha en cookies.php
- Verificar enlaces externos
- Comprobar nuevas normativas

---

*Sistema implementado por GitHub Copilot para InnovaByte - Septiembre 2025*
