/**
 * Cookie Banner Management
 * InnovaByte - Cookie Consent Banner
 */

class CookieBanner {
    constructor() {
        this.cookieName = 'innovabyte_cookie_consent';
        this.cookieExpiry = 365; // días
        this.banner = null;
        this.init();
    }

    init() {
        // Solo mostrar si no se ha dado consentimiento
        if (!this.hasConsent()) {
            this.createBanner();
            this.showBanner();
        }
    }

    createBanner() {
        // Crear el elemento del banner
        this.banner = document.createElement('div');
        this.banner.className = 'cookie-banner';
        this.banner.id = 'cookieBanner';
        
        this.banner.innerHTML = `
            <div class="container">
                <div class="cookie-banner-content">
                    <div class="cookie-banner-text">
                        <p>
                            <strong>🍪 Utilizamos cookies</strong><br>
                            Usamos cookies propias y de terceros para mejorar tu experiencia de navegación, 
                            analizar el tráfico del sitio y personalizar el contenido. 
                            <a href="cookies.php" target="_blank">Más información sobre cookies</a>
                        </p>
                    </div>
                    <div class="cookie-banner-actions">
                        <button class="cookie-btn cookie-btn-accept" onclick="cookieBanner.acceptAll()">
                            Aceptar todas
                        </button>
                        <button class="cookie-btn cookie-btn-decline" onclick="cookieBanner.declineAll()">
                            Rechazar
                        </button>
                        <a href="cookies.php" class="cookie-btn cookie-btn-settings">
                            Configurar
                        </a>
                    </div>
                </div>
            </div>
        `;

        // Agregar al body
        document.body.appendChild(this.banner);
    }

    showBanner() {
        if (this.banner) {
            // Pequeño delay para la animación
            setTimeout(() => {
                this.banner.classList.add('show');
            }, 500);
        }
    }

    hideBanner() {
        if (this.banner) {
            this.banner.classList.remove('show');
            // Remover del DOM después de la animación
            setTimeout(() => {
                if (this.banner && this.banner.parentNode) {
                    this.banner.parentNode.removeChild(this.banner);
                }
            }, 400);
        }
    }

    acceptAll() {
        this.setConsent('accepted');
        this.hideBanner();
        
        // Aquí puedes agregar código para activar cookies de terceros
        this.enableAnalytics();
        this.enableMarketing();
        
        // Mostrar mensaje de confirmación (opcional)
        this.showToast('Cookies aceptadas. ¡Gracias!', 'success');
    }

    declineAll() {
        this.setConsent('declined');
        this.hideBanner();
        
        // Deshabilitar cookies no esenciales
        this.disableAnalytics();
        this.disableMarketing();
        
        // Mostrar mensaje de confirmación (opcional)
        this.showToast('Solo utilizaremos cookies esenciales.', 'info');
    }

    setConsent(status) {
        const consentData = {
            status: status,
            timestamp: new Date().toISOString(),
            version: '1.0'
        };
        
        this.setCookie(this.cookieName, JSON.stringify(consentData), this.cookieExpiry);
    }

    hasConsent() {
        const consent = this.getCookie(this.cookieName);
        return consent !== null;
    }

    getConsent() {
        const consent = this.getCookie(this.cookieName);
        if (consent) {
            try {
                return JSON.parse(consent);
            } catch (e) {
                return null;
            }
        }
        return null;
    }

    setCookie(name, value, days) {
        const expires = new Date();
        expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/;SameSite=Lax`;
    }

    getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    enableAnalytics() {
        // Aquí puedes agregar código para Google Analytics, etc.
        console.log('Analytics habilitado');
        
        // Ejemplo para Google Analytics (descomenta si lo usas):
        /*
        if (typeof gtag !== 'undefined') {
            gtag('consent', 'update', {
                'analytics_storage': 'granted'
            });
        }
        */
    }

    disableAnalytics() {
        console.log('Analytics deshabilitado');
        
        // Ejemplo para Google Analytics (descomenta si lo usas):
        /*
        if (typeof gtag !== 'undefined') {
            gtag('consent', 'update', {
                'analytics_storage': 'denied'
            });
        }
        */
    }

    enableMarketing() {
        console.log('Marketing cookies habilitado');
        
        // Ejemplo para Google Analytics (descomenta si lo usas):
        /*
        if (typeof gtag !== 'undefined') {
            gtag('consent', 'update', {
                'ad_storage': 'granted'
            });
        }
        */
    }

    disableMarketing() {
        console.log('Marketing cookies deshabilitado');
        
        // Ejemplo para Google Analytics (descomenta si lo usas):
        /*
        if (typeof gtag !== 'undefined') {
            gtag('consent', 'update', {
                'ad_storage': 'denied'
            });
        }
        */
    }

    showToast(message, type = 'info') {
        // Crear toast notification
        const toast = document.createElement('div');
        toast.className = `cookie-toast cookie-toast-${type}`;
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#10B981' : '#3B82F6'};
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

    // Método para resetear cookies (útil para testing)
    resetConsent() {
        document.cookie = `${this.cookieName}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
        location.reload();
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    window.cookieBanner = new CookieBanner();
});

// También funciona si el script se carga después del DOM
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function() {
        if (!window.cookieBanner) {
            window.cookieBanner = new CookieBanner();
        }
    });
} else {
    // DOM ya está listo
    if (!window.cookieBanner) {
        window.cookieBanner = new CookieBanner();
    }
}
