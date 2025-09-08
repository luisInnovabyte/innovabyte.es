<?php
/**
 * Configuración SMTP para InnovaByte
 * 
 * Este archivo contiene toda la configuración SMTP centralizada.
 * Modifica estos valores según tus necesidades.
 */

return [
    // Configuración del servidor SMTP
    'smtp' => [
        'host' => 'innovabyte.es',
        'username' => 'luiscarlos@innovabyte.es',
        'password' => '27979699$C',
        'port' => 465,
        'encryption' => 'ssl', // 'ssl', 'tls' o null
        'charset' => 'UTF-8'
    ],
    
    // Configuración del remitente por defecto
    'from' => [
        'email' => 'luiscarlos@innovabyte.es',
        'name' => 'InnovaByte'
    ],
    
    // Destinatarios por defecto para formularios
    'default_recipients' => [
        'contact' => 'luiscarlos@innovabyte.es',
        'newsletter' => 'luiscarlos@innovabyte.es',
        'support' => 'luiscarlos@innovabyte.es',
        'sales' => 'luiscarlos@innovabyte.es'
    ],
    
    // Mensajes por defecto
    'messages' => [
        'success' => 'Mensaje enviado correctamente.',
        'error' => 'Error al enviar el mensaje. Por favor, inténtalo de nuevo.',
        'invalid_email' => 'Por favor, introduce una dirección de email válida.',
        'required_fields' => 'Todos los campos obligatorios deben ser completados.'
    ],
    
    // Configuración de seguridad
    'security' => [
        'enable_rate_limit' => true,
        'max_emails_per_hour' => 10,
        'log_emails' => true,
        'log_file' => 'logs/email_log.txt'
    ],
    
    // Templates de email
    'templates' => [
        'newsletter' => [
            'subject' => 'Nueva suscripción a newsletter - InnovaByte',
            'success_message' => '¡Gracias! en breve nos pondremos en contacto con vosotros.'
        ],
        'contact' => [
            'subject' => 'Nuevo mensaje de contacto - InnovaByte',
            'success_message' => '¡Gracias! Tu mensaje ha sido enviado correctamente. Te responderemos pronto.'
        ],
        'quote' => [
            'subject' => 'Nueva solicitud de presupuesto - InnovaByte',
            'success_message' => '¡Gracias! Tu solicitud de presupuesto ha sido enviada. Te contactaremos en las próximas 24 horas.'
        ]
    ]
];
