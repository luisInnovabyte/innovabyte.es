# Sistema de Email Modular para InnovaByte

## 📋 Descripción General

El sistema de email ha sido refactorizado para ser completamente modular y reutilizable. Ahora puedes usar la misma configuración SMTP para múltiples formularios sin duplicar código.

## 🗂️ Estructura de Archivos

```
w:\sland\
├── phpmailer_config.php     # Clase principal InnovaByteMailer
├── email_config.php         # Configuración SMTP y templates
├── phpmailer_ejemplos.php   # Ejemplos de uso para diferentes formularios
├── index.php               # Formulario de newsletter (ya implementado)
└── assets/phpmailer/       # Librería PHPMailer
```

## ⚙️ Configuración SMTP

Toda la configuración está centralizada en `email_config.php`:

```php
'smtp' => [
    'host' => 'innovabyte.es',
    'username' => 'luiscarlos@innovabyte.es',
    'password' => '27979699$C',
    'port' => 465,
    'encryption' => 'ssl',
    'charset' => 'UTF-8'
],
```

## 🚀 Uso Básico

### 1. Inicializar el Mailer

```php
require_once 'phpmailer_config.php';
$mailer = new InnovaByteMailer();
```

### 2. Enviar Email Simple

```php
$config = [
    'to' => 'destinatario@ejemplo.com',
    'subject' => 'Asunto del email',
    'body' => '<h1>Contenido del email</h1>',
    'success_message' => 'Email enviado correctamente',
    'error_message' => 'Error al enviar email'
];

$resultado = $mailer->enviarEmail($config);

if ($resultado['success']) {
    echo $resultado['message']; // Mensaje de éxito
} else {
    echo $resultado['message']; // Mensaje de error
}
```

## 📝 Ejemplos de Formularios

### Formulario de Contacto

```php
function procesarContacto($datos) {
    require_once 'phpmailer_config.php';
    $mailer = new InnovaByteMailer();
    
    $config = [
        'reply_to' => $datos['email'],
        'reply_to_name' => $datos['nombre'],
        'subject' => 'Nuevo mensaje de contacto - InnovaByte',
        'body' => "
            <h3>Nuevo mensaje de contacto</h3>
            <p><strong>Nombre:</strong> {$datos['nombre']}</p>
            <p><strong>Email:</strong> {$datos['email']}</p>
            <p><strong>Mensaje:</strong> {$datos['mensaje']}</p>
        ",
        'success_message' => 'Tu mensaje ha sido enviado correctamente.'
    ];
    
    return $mailer->enviarEmail($config);
}
```

### Formulario de Presupuesto

```php
function procesarPresupuesto($datos) {
    require_once 'phpmailer_config.php';
    $mailer = new InnovaByteMailer();
    
    $config = [
        'to' => $mailer->getDefaultRecipient('sales'),
        'reply_to' => $datos['email'],
        'subject' => 'Nueva solicitud de presupuesto',
        'body' => "
            <h3>Solicitud de presupuesto</h3>
            <p><strong>Cliente:</strong> {$datos['nombre']}</p>
            <p><strong>Proyecto:</strong> {$datos['tipo_proyecto']}</p>
            <p><strong>Presupuesto:</strong> {$datos['presupuesto']}</p>
        "
    ];
    
    return $mailer->enviarEmail($config);
}
```

## 📧 Opciones Avanzadas

### Múltiples Destinatarios

```php
$config = [
    'to' => [
        'luiscarlos@innovabyte.es',
        ['email' => 'admin@innovabyte.es', 'name' => 'Administrador']
    ],
    'cc' => ['copia@innovabyte.es'],
    'bcc' => ['copia_oculta@innovabyte.es'],
    'subject' => 'Email a múltiples destinatarios'
];
```

### Emails con Adjuntos

```php
$config = [
    'to' => 'destinatario@ejemplo.com',
    'subject' => 'Email con adjuntos',
    'body' => 'Contenido del email',
    'attachments' => [
        'ruta/al/archivo.pdf',
        ['path' => 'ruta/al/archivo.jpg', 'name' => 'imagen.jpg']
    ]
];
```

### Templates Personalizados

```php
// En email_config.php
'templates' => [
    'mi_formulario' => [
        'subject' => 'Asunto personalizado',
        'success_message' => 'Mensaje enviado correctamente'
    ]
]

// En tu código
$template = $mailer->getTemplate('mi_formulario');
$config = [
    'subject' => $template['subject'],
    'success_message' => $template['success_message']
];
```

## 🔧 Métodos Útiles de la Clase

### `getConfig($key)`
Obtiene valores de configuración:
```php
$smtp_host = $mailer->getConfig('smtp.host');
$mensajes = $mailer->getConfig('messages');
```

### `getTemplate($name)`
Obtiene configuración de template:
```php
$newsletter_template = $mailer->getTemplate('newsletter');
```

### `getDefaultRecipient($type)`
Obtiene destinatario por defecto:
```php
$email_contacto = $mailer->getDefaultRecipient('contact');
$email_ventas = $mailer->getDefaultRecipient('sales');
```

## 🛠️ Personalización

### Modificar Configuración SMTP
Edita `email_config.php` y cambia los valores en la sección `smtp`.

### Agregar Nuevos Templates
Añade nuevas entradas en la sección `templates` de `email_config.php`.

### Cambiar Destinatarios por Defecto
Modifica la sección `default_recipients` en `email_config.php`.

## 🔒 Seguridad

### Rate Limiting
```php
// En email_config.php
'security' => [
    'enable_rate_limit' => true,
    'max_emails_per_hour' => 10
]
```

### Log de Emails
```php
// En email_config.php
'security' => [
    'log_emails' => true,
    'log_file' => 'logs/email_log.txt'
]
```

## ✅ Funciones de Compatibilidad

Para mantener la compatibilidad con el código existente, estas funciones siguen funcionando:

```php
// Newsletter (ya existente)
$resultado = enviarEmailNewsletter($email);

// Otras funciones disponibles en phpmailer_ejemplos.php
$resultado = enviarEmailContacto($datos);
$resultado = enviarEmailPresupuesto($datos);
$resultado = enviarNotificacionInterna($asunto, $mensaje);
```

## 🚨 Troubleshooting

### Error "PHPMailer no está instalado"
- Ejecuta `instalar_phpmailer.bat`
- O instala via Composer: `composer require phpmailer/phpmailer`

### Error de configuración SMTP
- Verifica los datos en `email_config.php`
- Comprueba que el servidor SMTP esté accesible

### Error de permisos
- Asegúrate de que la carpeta `logs/` tenga permisos de escritura

---

## 💡 Ventajas del Nuevo Sistema

✅ **Configuración centralizada** - Cambios SMTP en un solo lugar  
✅ **Reutilizable** - Misma clase para todos los formularios  
✅ **Flexible** - Fácil personalización de templates  
✅ **Mantenible** - Código organizado y documentado  
✅ **Escalable** - Fácil agregar nuevos tipos de email  
✅ **Compatible** - Mantiene funcionalidad existente
