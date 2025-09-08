<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "./assets/templates/mainhead.php"; ?>
</head>

<body class="home-three dark-body">
    <div class="page-wrapper">

        <!-- Preloader -->
        <div class="preloader"></div>

        <!--====== Header Part Start ======-->
        <header class="main-header header-three">
            <?php include "./assets/templates/mainheader.php"; ?>
        </header>
        <!--====== Header Part End ======-->

        <!--====== Page Title Section Start ======-->
        <section class="page-title-section bg-blue text-white text-center pt-200 rpt-150 pb-130 rpb-100" style="background-image: url(assets/images/background/banner-bg.png);">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 mx-auto">
                        <h1 class="page-title">Política de Cookies</h1>
                        <p class="page-subtitle">Información sobre el uso de cookies en nuestro sitio web</p>
                    </div>
                </div>
            </div>
            <img class="dots-shape" src="assets/images/shapes/dots.png" alt="Shape">
            <img class="tringle-shape" src="assets/images/shapes/tringle.png" alt="Shape">
            <img class="close-shape" src="assets/images/shapes/close.png" alt="Shape">
        </section>
        <!--====== Page Title Section End ======-->

        <!--====== Cookies Content Section Start ======-->
        <section class="cookies-content-section pt-130 rpt-100 pb-130 rpb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12">
                        <div class="cookies-content">
                            
                            <!-- Introducción -->
                            <div class="cookies-intro mb-50">
                                <h2 class="section-title mb-25" style="color: #CC7700;">Política de Cookies</h2>
                                <p class="mb-20">En InnovaByte utilizamos cookies para mejorar tu experiencia de navegación y ofrecerte un servicio más personalizado. Esta política explica qué son las cookies, cómo las utilizamos y cómo puedes gestionarlas.</p>
                            </div>

                            <!-- ¿Qué son las cookies? -->
                            <div class="cookies-section mb-50">
                                <h2 class="section-title mb-25" style="color: #CC7700;"><i class="fas fa-cookie-bite mr-2"></i>¿Qué son las cookies?</h2>
                                <p class="mb-20">Las cookies son pequeños archivos de texto que se almacenan en tu dispositivo cuando visitas un sitio web. Estas cookies permiten que el sitio web "recuerde" tus acciones y preferencias durante un período de tiempo, para que no tengas que volver a introducirlas cada vez que regreses al sitio o navegues de una página a otra.</p>
                                
                                <div class="info-box p-30 mt-30" style="background: #e3f2fd; border-radius: 10px; border-left: 4px solid #2196F3;">
                                    <h4 style="color: #1976D2;"><i class="fas fa-info-circle mr-2"></i>¿Sabías que...?</h4>
                                    <p class="mb-0" style="color: #1976D2;">Las cookies en si mismas no son peligrosas y no pueden ejecutar programas ni contener virus. Solo almacenan información de texto que ayuda a mejorar tu experiencia web.</p>
                                </div>
                            </div>

                            <!-- Tipos de cookies que utilizamos -->
                            <div class="cookies-section mb-50">
                                <h2 class="section-title mb-25" style="color: #CC7700;"><i class="fas fa-list mr-2"></i>Tipos de cookies que utilizamos</h2>
                                
                                <!-- Cookies técnicas -->
                                <div class="cookie-type-card mb-30 p-30" style="background: #f8f9fa; border-radius: 15px; border-left: 5px solid #28a745;">
                                    <h4 style="color: #28a745;"><i class="fas fa-cog mr-2"></i>Cookies Técnicas (Necesarias)</h4>
                                    <p class="mb-15" style="color: #28a745;">Son imprescindibles para el funcionamiento básico del sitio web.</p>
                                    <ul class="cookies-list">
                                        <!-- <li><i class="fas fa-check" style="color: #28a745;"></i> <strong>Sesión de usuario:</strong> Mantienen tu sesión activa</li> -->
                                        <li><i class="fas fa-check" style="color: #28a745;"></i> <strong>Seguridad:</strong> Protegen contra ataques maliciosos</li>
                                        <li><i class="fas fa-check" style="color: #28a745;"></i> <strong>Funcionalidad:</strong> Recuerdan tus preferencias de navegación</li>
                                    </ul>
                                    <span class="cookie-duration" style="background: #28a745; color: white; padding: 5px 10px; border-radius: 15px; font-size: 12px;">
                                        <i class="fas fa-clock"></i> Duración: Sesión de navegación
                                    </span>
                                </div>

                                <!-- Cookies analíticas -->
                                <div class="cookie-type-card mb-30 p-30" style="background: #f8f9fa; border-radius: 15px; border-left: 5px solid #FF9800;">
                                    <h4 style="color: #FF9800;"><i class="fas fa-chart-bar mr-2"></i>Cookies Analíticas</h4>
                                    <p class="mb-15" style="color: #FF9800;">Nos ayudan a entender cómo interactúas con nuestro sitio web.</p>
                                    <ul class="cookies-list">
                                        <li><i class="fas fa-chart-line" style="color: #FF9800;"></i> <strong>Google Analytics:</strong> Estadísticas de visitas y comportamiento</li>
                                        <!-- <li><i class="fas fa-users" style="color: #FF9800;"></i> <strong>Audiencia:</strong> Datos demográficos anónimos</li> -->
                                        <li><i class="fas fa-mouse-pointer" style="color: #FF9800;"></i> <strong>Interacciones:</strong> Páginas más visitadas y tiempo de permanencia</li>
                                    </ul>
                                    <span class="cookie-duration" style="background: #FF9800; color: white; padding: 5px 10px; border-radius: 15px; font-size: 12px;">
                                        <i class="fas fa-clock"></i> Duración: 2 años
                                    </span>
                                </div>

                                <!-- Cookies de personalización -->
                                <!-- <div class="cookie-type-card mb-30 p-30" style="background: #f8f9fa; border-radius: 15px; border-left: 5px solid #9C27B0;">
                                    <h4 style="color: #9C27B0;"><i class="fas fa-palette mr-2"></i>Cookies de Personalización</h4>
                                    <p class="mb-15" style="color: #9C27B0;">Personalizan tu experiencia según tus preferencias.</p>
                                    <ul class="cookies-list">
                                        <li><i class="fas fa-language" style="color: #9C27B0;"></i> <strong>Idioma:</strong> Recuerdan tu idioma preferido</li>
                                        <li><i class="fas fa-paint-brush" style="color: #9C27B0;"></i> <strong>Tema:</strong> Configuración de diseño y colores</li>
                                        <li><i class="fas fa-map-marker-alt" style="color: #9C27B0;"></i> <strong>Localización:</strong> Contenido relevante para tu ubicación</li>
                                    </ul>
                                    <span class="cookie-duration" style="background: #9C27B0; color: white; padding: 5px 10px; border-radius: 15px; font-size: 12px;">
                                        <i class="fas fa-clock"></i> Duración: 1 año
                                    </span>
                                </div> -->

                                <!-- Cookies de terceros -->
                                <div class="cookie-type-card mb-30 p-30" style="background: #f8f9fa; border-radius: 15px; border-left: 5px solid #607D8B;">
                                    <h4 style="color: #607D8B;"><i class="fas fa-external-link-alt mr-2"></i>Cookies de Terceros</h4>
                                    <p class="mb-15" style="color: #607D8B;">Provienen de servicios externos que utilizamos.</p>
                                    <ul class="cookies-list">
                                        <li><i class="fab fa-google" style="color: #607D8B;"></i> <strong>Google Services:</strong> Maps, Fonts, Analytics</li>
                                        <li><i class="fas fa-share-alt" style="color: #607D8B;"></i> <strong>Redes Sociales:</strong> Botones de compartir</li>
                                        <li><i class="fas fa-video" style="color: #607D8B;"></i> <strong>Contenido multimedia:</strong> Videos y elementos embebidos</li>
                                    </ul>
                                    <span class="cookie-duration" style="background: #607D8B; color: white; padding: 5px 10px; border-radius: 15px; font-size: 12px;">
                                        <i class="fas fa-clock"></i> Duración: Variable según el proveedor
                                    </span>
                                </div>
                            </div>

                            <!-- ¿Para qué utilizamos las cookies? -->
                            <div class="cookies-section mb-50">
                                <h2 class="section-title mb-25" style="color: #CC7700;"><i class="fas fa-bullseye mr-2"></i>¿Para qué utilizamos las cookies?</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="purpose-item mb-20">
                                            <h5 style="color: #CC7700;"><i class="fas fa-tachometer-alt mr-2"></i>Mejorar el rendimiento</h5>
                                            <p>Optimizamos la velocidad y funcionalidad del sitio</p>
                                        </div>
                                        <div class="purpose-item mb-20">
                                            <h5 style="color: #CC7700;"><i class="fas fa-user-cog mr-2"></i>Personalizar experiencia</h5>
                                            <p>Adaptamos el contenido a tus preferencias</p>
                                        </div>
                                        <div class="purpose-item mb-20">
                                            <h5 style="color: #CC7700;"><i class="fas fa-shield-alt mr-2"></i>Garantizar seguridad</h5>
                                            <p>Protegemos tu navegación de amenazas</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="purpose-item mb-20">
                                            <h5 style="color: #CC7700;"><i class="fas fa-chart-pie mr-2"></i>Analizar el tráfico</h5>
                                            <p>Entendemos cómo interactúas con nuestro sitio</p>
                                        </div>
                                        <div class="purpose-item mb-20">
                                            <h5 style="color: #CC7700;"><i class="fas fa-magic mr-2"></i>Recordar preferencias</h5>
                                            <p>Mantenemos tus configuraciones guardadas</p>
                                        </div>
                                        <div class="purpose-item mb-20">
                                            <h5 style="color: #CC7700;"><i class="fas fa-tools mr-2"></i>Funcionalidad avanzada</h5>
                                            <p>Habilitamos características especiales</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cómo gestionar las cookies -->
                            <div class="cookies-section mb-50">
                                <h2 class="section-title mb-25" style="color: #CC7700;"><i class="fas fa-sliders-h mr-2"></i>Cómo gestionar las cookies</h2>
                                <p class="mb-20">Tienes control total sobre las cookies. Puedes gestionarlas de las siguientes maneras:</p>
                                
                                <div class="management-options">
                                    <!-- Configuración del navegador -->
                                    <div class="management-card p-30 mb-30" style="background: #f8f9fa; border-radius: 15px; border-left: 5px solid #2196F3;">
                                        <h4 style="color: #2196F3;"><i class="fas fa-browser mr-2"></i>Configuración del navegador</h4>
                                        <p class="mb-15" style="color: #2196F3;">Puedes configurar tu navegador para:</p>
                                        <ul class="management-list">
                                            <li><i class="fas fa-ban" style="color: #f44336;"></i> Bloquear todas las cookies</li>
                                            <li><i class="fas fa-eye" style="color: #FF9800;"></i> Aceptar solo cookies de sitios específicos</li>
                                            <li><i class="fas fa-bell" style="color: #2196F3;"></i> Recibir notificaciones antes de aceptar cookies</li>
                                            <li><i class="fas fa-trash" style="color: #9E9E9E;"></i> Eliminar cookies almacenadas</li>
                                        </ul>
                                    </div>

                                    <!-- Enlaces a configuración por navegador -->
                                    <div class="browser-links mb-30">
                                        <h4 style="color: #CC7700;" class="mb-20">Configuración por navegador:</h4>
                                        <div class="row">
                                            <div class="col-md-3 col-6 mb-15">
                                                <a href="https://support.google.com/chrome/answer/95647" target="_blank" class="browser-link" style="color: #CC7700;">
                                                    <i class="fab fa-chrome"></i> Chrome
                                                </a>
                                            </div>
                                            <div class="col-md-3 col-6 mb-15">
                                                <a href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-sitios-web-rastrear-preferencias" target="_blank" class="browser-link" style="color: #CC7700;">
                                                    <i class="fab fa-firefox"></i> Firefox
                                                </a>
                                            </div>
                                            <div class="col-md-3 col-6 mb-15">
                                                <a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac" target="_blank" class="browser-link" style="color: #CC7700;">
                                                    <i class="fab fa-safari"></i> Safari
                                                </a>
                                            </div>
                                            <div class="col-md-3 col-6 mb-15">
                                                <a href="https://support.microsoft.com/es-es/help/17442/windows-internet-explorer-delete-manage-cookies" target="_blank" class="browser-link" style="color: #CC7700;">
                                                    <i class="fab fa-edge"></i> Edge
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Advertencia sobre deshabilitación -->
                                    <div class="warning-box p-25" style="background: #fff3cd; border-radius: 10px; border-left: 4px solid #ffc107;">
                                        <h5 style="color: #856404;"><i class="fas fa-exclamation-triangle mr-2"></i>Importante</h5>
                                        <p class="mb-0" style="color: #856404;">Si deshabilitas todas las cookies, algunas funcionalidades de nuestro sitio web pueden no funcionar correctamente. Las cookies técnicas son necesarias para el funcionamiento básico del sitio.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Panel de gestión de cookies -->
                            <div class="cookies-section mb-50">
                                <h2 class="section-title mb-25" style="color: #CC7700;"><i class="fas fa-cogs mr-2"></i>Gestiona tus preferencias de cookies</h2>
                                <p class="mb-30">Configura qué tipos de cookies quieres permitir. Puedes cambiar estas configuraciones en cualquier momento.</p>
                                
                                <div class="cookie-preferences-panel p-30" style="background: #f8f9fa; border-radius: 15px; border: 1px solid #e9ecef;">
                                    
                                    <!-- Cookies técnicas -->
                                    <div class="cookie-preference-item mb-30 p-20" style="background: white; border-radius: 10px; border-left: 4px solid #28a745;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="preference-info">
                                                <h4 style="color: #28a745; margin-bottom: 10px;">
                                                    <i class="fas fa-cog mr-2"></i>Cookies Técnicas
                                                    <span class="badge ml-2" style="background: #28a745; color: white; padding: 3px 8px; border-radius: 12px; font-size: 10px;">NECESARIAS</span>
                                                </h4>
                                                <p class="mb-0" style="color: #6c757d; font-size: 14px;">Imprescindibles para el funcionamiento básico del sitio web.</p>
                                            </div>
                                            <div class="preference-toggle">
                                                <label class="switch" style="position: relative; display: inline-block; width: 60px; height: 34px;">
                                                    <input type="checkbox" checked disabled style="opacity: 0; width: 0; height: 0;">
                                                    <span class="slider" style="position: absolute; cursor: not-allowed; top: 0; left: 0; right: 0; bottom: 0; background-color: #28a745; transition: .4s; border-radius: 34px; opacity: 0.7;">
                                                        <span style="position: absolute; content: ''; height: 26px; width: 26px; left: 30px; bottom: 4px; background-color: white; transition: .4s; border-radius: 50%;"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cookies analíticas -->
                                    <div class="cookie-preference-item mb-30 p-20" style="background: white; border-radius: 10px; border-left: 4px solid #FF9800;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="preference-info">
                                                <h4 style="color: #FF9800; margin-bottom: 10px;">
                                                    <i class="fas fa-chart-bar mr-2"></i>Cookies Analíticas
                                                    <span class="badge ml-2" style="background: #FF9800; color: white; padding: 3px 8px; border-radius: 12px; font-size: 10px;">OPCIONAL</span>
                                                </h4>
                                                <p class="mb-0" style="color: #6c757d; font-size: 14px;">Nos ayudan a mejorar el sitio web analizando cómo lo utilizas.</p>
                                            </div>
                                            <div class="preference-toggle">
                                                <label class="switch" style="position: relative; display: inline-block; width: 60px; height: 34px;">
                                                    <input type="checkbox" id="analyticsToggle" onchange="toggleAnalytics(this.checked)" style="opacity: 0; width: 0; height: 0;">
                                                    <span class="slider" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ccc; transition: .4s; border-radius: 34px;">
                                                        <span style="position: absolute; content: ''; height: 26px; width: 26px; left: 4px; bottom: 4px; background-color: white; transition: .4s; border-radius: 50%;"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cookies de terceros -->
                                    <div class="cookie-preference-item mb-30 p-20" style="background: white; border-radius: 10px; border-left: 4px solid #607D8B;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="preference-info">
                                                <h4 style="color: #607D8B; margin-bottom: 10px;">
                                                    <i class="fas fa-external-link-alt mr-2"></i>Cookies de Terceros
                                                    <span class="badge ml-2" style="background: #607D8B; color: white; padding: 3px 8px; border-radius: 12px; font-size: 10px;">OPCIONAL</span>
                                                </h4>
                                                <p class="mb-0" style="color: #6c757d; font-size: 14px;">De servicios externos como Google Maps, redes sociales, etc.</p>
                                            </div>
                                            <div class="preference-toggle">
                                                <label class="switch" style="position: relative; display: inline-block; width: 60px; height: 34px;">
                                                    <input type="checkbox" id="thirdPartyToggle" onchange="toggleThirdParty(this.checked)" style="opacity: 0; width: 0; height: 0;">
                                                    <span class="slider" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ccc; transition: .4s; border-radius: 34px;">
                                                        <span style="position: absolute; content: ''; height: 26px; width: 26px; left: 4px; bottom: 4px; background-color: white; transition: .4s; border-radius: 50%;"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Botones de acción -->
                                    <div class="cookie-actions text-center pt-20">
                                        <button onclick="savePreferences()" class="theme-btn mr-3" style="background: #CC7700; border: none; padding: 12px 30px; border-radius: 5px; color: white; cursor: pointer;">
                                            <i class="fas fa-save mr-2"></i>Guardar Preferencias
                                        </button>
                                        <button onclick="acceptAllCookies()" class="theme-btn style-three mr-3" style="background: #28a745; border: none; padding: 12px 30px; border-radius: 5px; color: white; cursor: pointer;">
                                            <i class="fas fa-check mr-2"></i>Aceptar Todas
                                        </button>
                                        <button onclick="rejectAllCookies()" class="theme-btn" style="background: #dc3545; border: none; padding: 12px 30px; border-radius: 5px; color: white; cursor: pointer;">
                                            <i class="fas fa-times mr-2"></i>Rechazar Opcionales
                                        </button>
                                    </div>

                                    <!-- Estado actual -->
                                    <div class="current-status mt-30 p-20" style="background: #e3f2fd; border-radius: 8px; border: 1px solid #2196F3;">
                                        <h5 style="color: #1976D2;"><i class="fas fa-info-circle mr-2"></i>Estado actual de tus cookies</h5>
                                        <div id="cookieStatus" style="color: #1976D2;">
                                            <p class="mb-0">Cargando configuración actual...</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- CSS para los switches -->
                                <style>
                                input:checked + .slider {
                                    background-color: #CC7700 !important;
                                }

                                input:checked + .slider span {
                                    transform: translateX(26px);
                                }

                                .theme-btn:hover {
                                    transform: translateY(-2px);
                                    transition: all 0.3s ease;
                                }
                                </style>

                                <!-- JavaScript para la gestión -->
                                <script>
                                // Cargar preferencias actuales al cargar la página
                                document.addEventListener('DOMContentLoaded', function() {
                                    loadCurrentPreferences();
                                });

                                function loadCurrentPreferences() {
                                    // Verificar si existe el banner de cookies
                                    if (typeof window.cookieBanner !== 'undefined') {
                                        const consent = window.cookieBanner.getConsent();
                                        updateStatusDisplay(consent);
                                        
                                        if (consent && consent.status === 'accepted') {
                                            document.getElementById('analyticsToggle').checked = true;
                                            document.getElementById('thirdPartyToggle').checked = true;
                                        }
                                    } else {
                                        // Si no hay consentimiento, mostrar estado por defecto
                                        updateStatusDisplay(null);
                                    }
                                }

                                function updateStatusDisplay(consent) {
                                    const statusDiv = document.getElementById('cookieStatus');
                                    if (consent) {
                                        if (consent.status === 'accepted') {
                                            statusDiv.innerHTML = '<p class="mb-0"><i class="fas fa-check-circle" style="color: #28a745;"></i> Has aceptado todas las cookies. Última actualización: ' + new Date(consent.timestamp).toLocaleString('es-ES') + '</p>';
                                        } else if (consent.status === 'declined') {
                                            statusDiv.innerHTML = '<p class="mb-0"><i class="fas fa-times-circle" style="color: #dc3545;"></i> Has rechazado las cookies opcionales. Solo se usan cookies técnicas. Última actualización: ' + new Date(consent.timestamp).toLocaleString('es-ES') + '</p>';
                                        }
                                    } else {
                                        statusDiv.innerHTML = '<p class="mb-0"><i class="fas fa-question-circle" style="color: #FF9800;"></i> No has establecido preferencias aún. El banner aparecerá en tu próxima visita.</p>';
                                    }
                                }

                                function toggleAnalytics(enabled) {
                                    console.log('Analytics cookies:', enabled ? 'habilitadas' : 'deshabilitadas');
                                }

                                function toggleThirdParty(enabled) {
                                    console.log('Third party cookies:', enabled ? 'habilitadas' : 'deshabilitadas');
                                }

                                function savePreferences() {
                                    const analytics = document.getElementById('analyticsToggle').checked;
                                    const thirdParty = document.getElementById('thirdPartyToggle').checked;
                                    
                                    // Si existe el banner de cookies, usar su método
                                    if (typeof window.cookieBanner !== 'undefined') {
                                        if (analytics && thirdParty) {
                                            window.cookieBanner.acceptAll();
                                        } else {
                                            window.cookieBanner.declineAll();
                                        }
                                    }
                                    
                                    // Mostrar mensaje de confirmación
                                    showToast('Preferencias guardadas correctamente', 'success');
                                    
                                    // Actualizar estado
                                    setTimeout(loadCurrentPreferences, 500);
                                }

                                function acceptAllCookies() {
                                    document.getElementById('analyticsToggle').checked = true;
                                    document.getElementById('thirdPartyToggle').checked = true;
                                    
                                    if (typeof window.cookieBanner !== 'undefined') {
                                        window.cookieBanner.acceptAll();
                                    }
                                    
                                    showToast('Todas las cookies han sido aceptadas', 'success');
                                    setTimeout(loadCurrentPreferences, 500);
                                }

                                function rejectAllCookies() {
                                    document.getElementById('analyticsToggle').checked = false;
                                    document.getElementById('thirdPartyToggle').checked = false;
                                    
                                    if (typeof window.cookieBanner !== 'undefined') {
                                        window.cookieBanner.declineAll();
                                    }
                                    
                                    showToast('Cookies opcionales rechazadas. Solo se usarán cookies técnicas.', 'info');
                                    setTimeout(loadCurrentPreferences, 500);
                                }

                                function showToast(message, type = 'info') {
                                    // Crear toast notification
                                    const toast = document.createElement('div');
                                    toast.className = `cookie-toast cookie-toast-${type}`;
                                    toast.style.cssText = `
                                        position: fixed;
                                        top: 20px;
                                        right: 20px;
                                        background: ${type === 'success' ? '#28a745' : type === 'info' ? '#17a2b8' : '#ffc107'};
                                        color: white;
                                        padding: 15px 20px;
                                        border-radius: 8px;
                                        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                                        z-index: 10000;
                                        transform: translateX(100%);
                                        transition: transform 0.3s ease;
                                        max-width: 300px;
                                        font-size: 14px;
                                    `;
                                    toast.textContent = message;

                                    document.body.appendChild(toast);

                                    // Mostrar toast
                                    setTimeout(() => {
                                        toast.style.transform = 'translateX(0)';
                                    }, 100);

                                    // Ocultar y remover toast
                                    setTimeout(() => {
                                        toast.style.transform = 'translateX(100%)';
                                        setTimeout(() => {
                                            if (toast.parentNode) {
                                                toast.parentNode.removeChild(toast);
                                            }
                                        }, 300);
                                    }, 3000);
                                }
                                </script>
                            </div>

                            <!-- Consentimiento y base legal -->
                            <div class="cookies-section mb-50">
                                <h2 class="section-title mb-25" style="color: #CC7700;"><i class="fas fa-gavel mr-2"></i>Consentimiento y base legal</h2>
                                <div class="consent-info">
                                    <div class="consent-item mb-25">
                                        <h4 style="color: #CC7700;"><i class="fas fa-hand-paper mr-2"></i>Tu consentimiento</h4>
                                        <p>Al continuar navegando por nuestro sitio web, consientes el uso de cookies según se describe en esta política. Puedes retirar tu consentimiento en cualquier momento modificando la configuración de tu navegador.</p>
                                    </div>
                                    
                                    <div class="consent-item mb-25">
                                        <h4 style="color: #CC7700;"><i class="fas fa-balance-scale mr-2"></i>Base legal</h4>
                                        <p>El tratamiento de datos a través de cookies se basa en:</p>
                                        <ul class="legal-basis">
                                            <li><strong>Consentimiento:</strong> Para cookies analíticas y de personalización</li>
                                            <li><strong>Interés legítimo:</strong> Para cookies técnicas esenciales</li>
                                            <li><strong>Ejecución de contrato:</strong> Para servicios solicitados</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Actualizaciones de la política -->
                            <div class="cookies-section mb-50">
                                <h2 class="section-title mb-25" style="color: #CC7700;"><i class="fas fa-sync-alt mr-2"></i>Actualizaciones de esta política</h2>
                                <p>Podemos actualizar esta Política de Cookies periódicamente para reflejar cambios en nuestras prácticas o por otros motivos operativos, legales o reglamentarios. Te recomendamos revisar esta página regularmente para estar informado de cualquier cambio.</p>
                                <div class="update-info p-20 mt-20" style="background: #e8f5e8; border-radius: 8px; border-left: 4px solid #28a745;">
                                    <p class="mb-0"><i class="fas fa-calendar-alt" style="color: #28a745;"></i> <strong><span style="color: #28a745;">Última actualización: Agosto 2025</span></strong></p>
                                </div>
                            </div>

                            <!-- Contacto -->
                            <div class="cookies-section">
                                <div class="contact-info-box p-40" style="background: #f8f9fa; border-radius: 15px; border-left: 5px solid #CC7700;">
                                    <h3 style="color: #CC7700;" class="mb-20"><i class="fas fa-question-circle mr-2"></i>¿Tienes dudas sobre las cookies?</h3>
                                    <p class="mb-20" style="color: #CC7700;">Si tienes alguna pregunta sobre nuestra Política de Cookies o sobre cómo gestionamos las cookies en nuestro sitio web, no dudes en contactarnos.</p>
                                    <div class="contact-details">
                                        <p><i class="fas fa-envelope" style="color: #CC7700;"></i> <strong><span style="color: #CC7700;">Email:</span></strong> <a href="mailto:info@innovabyte.es" style="color: #CC7700;">info@innovabyte.es</a></p>
                                        <p><i class="fas fa-phone" style="color: #CC7700;"></i> <strong><span style="color: #CC7700;">Teléfono:</span></strong> <a href="tel:+34647124790" style="color: #CC7700;">+34 647 124 790</a></p>
                                    </div>
                                    <!-- <a href="contact.html" class="theme-btn style-three mt-20">Contactar <i class="fas fa-arrow-right"></i></a> -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--====== Cookies Content Section End ======-->

     <!--====== Footer Section Start ======-->
        <footer class="footer-section footer-two bg-gray text-white rel z-1">
            <?php include "./assets/templates/mainfooter.php"; ?>
        </footer>
        <!--====== Footer Section End ======-->

    </div>
    <!--End pagewrapper-->

    <!-- Scroll Top Button -->
    <button class="scroll-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></button>

    <?php include 'assets/templates/mainjs.php'; ?>

</body>

</html>
