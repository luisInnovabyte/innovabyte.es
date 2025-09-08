<?php
/**
 * Ejemplos de uso de InnovaByteMailer para diferentes formularios
 */

require_once 'phpmailer_config.php';

// Crear instancia del mailer
$mailer = new InnovaByteMailer();

// =============================================================================
// EJEMPLO 1: FORMULARIO DE CONTACTO
// =============================================================================
function enviarEmailContacto($datos) {
    global $mailer;
    
    $config = [
        'reply_to' => $datos['email'],
        'reply_to_name' => $datos['nombre'],
        'subject' => 'Nuevo mensaje de contacto - InnovaByte',
        'body' => "
            <h3>Nuevo mensaje desde el formulario de contacto</h3>
            <table style='border-collapse: collapse; width: 100%;'>
                <tr>
                    <td style='padding: 8px; border: 1px solid #ddd; background: #f8f9fa;'><strong>Nombre:</strong></td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>{$datos['nombre']}</td>
                </tr>
                <tr>
                    <td style='padding: 8px; border: 1px solid #ddd; background: #f8f9fa;'><strong>Email:</strong></td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>{$datos['email']}</td>
                </tr>
                <tr>
                    <td style='padding: 8px; border: 1px solid #ddd; background: #f8f9fa;'><strong>Teléfono:</strong></td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>{$datos['telefono']}</td>
                </tr>
                <tr>
                    <td style='padding: 8px; border: 1px solid #ddd; background: #f8f9fa;'><strong>Empresa:</strong></td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>{$datos['empresa']}</td>
                </tr>
                <tr>
                    <td style='padding: 8px; border: 1px solid #ddd; background: #f8f9fa;'><strong>Asunto:</strong></td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>{$datos['asunto']}</td>
                </tr>
                <tr>
                    <td style='padding: 8px; border: 1px solid #ddd; background: #f8f9fa;'><strong>Mensaje:</strong></td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . nl2br(htmlspecialchars($datos['mensaje'])) . "</td>
                </tr>
                <tr>
                    <td style='padding: 8px; border: 1px solid #ddd; background: #f8f9fa;'><strong>Fecha:</strong></td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . date('d/m/Y H:i:s') . "</td>
                </tr>
                <tr>
                    <td style='padding: 8px; border: 1px solid #ddd; background: #f8f9fa;'><strong>IP:</strong></td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>{$_SERVER['REMOTE_ADDR']}</td>
                </tr>
            </table>
        ",
        'success_message' => '¡Gracias! Tu mensaje ha sido enviado correctamente. Te responderemos pronto.',
        'error_message' => 'Error al enviar el mensaje. Por favor, inténtalo de nuevo.'
    ];
    
    return $mailer->enviarEmail($config);
}

// =============================================================================
// EJEMPLO 2: SOLICITUD DE PRESUPUESTO
// =============================================================================
function enviarEmailPresupuesto($datos) {
    global $mailer;
    
    $config = [
        'reply_to' => $datos['email'],
        'reply_to_name' => $datos['nombre'],
        'subject' => 'Nueva solicitud de presupuesto - InnovaByte',
        'body' => "
            <h3>Nueva solicitud de presupuesto</h3>
            <div style='background: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px;'>
                <h4 style='color: #007bff; margin-top: 0;'>Datos del Cliente</h4>
                <p><strong>Nombre:</strong> {$datos['nombre']}</p>
                <p><strong>Email:</strong> {$datos['email']}</p>
                <p><strong>Teléfono:</strong> {$datos['telefono']}</p>
                <p><strong>Empresa:</strong> {$datos['empresa']}</p>
            </div>
            
            <div style='background: #e7f3ff; padding: 20px; border-radius: 5px; margin-bottom: 20px;'>
                <h4 style='color: #007bff; margin-top: 0;'>Detalles del Proyecto</h4>
                <p><strong>Tipo de proyecto:</strong> {$datos['tipo_proyecto']}</p>
                <p><strong>Presupuesto estimado:</strong> {$datos['presupuesto']}</p>
                <p><strong>Plazo deseado:</strong> {$datos['plazo']}</p>
                <p><strong>Descripción:</strong></p>
                <div style='background: white; padding: 15px; border-radius: 3px;'>
                    " . nl2br(htmlspecialchars($datos['descripcion'])) . "
                </div>
            </div>
            
            <div style='background: #f0f0f0; padding: 15px; border-radius: 5px; font-size: 12px; color: #666;'>
                <p><strong>Fecha:</strong> " . date('d/m/Y H:i:s') . "</p>
                <p><strong>IP:</strong> {$_SERVER['REMOTE_ADDR']}</p>
            </div>
        ",
        'success_message' => '¡Gracias! Tu solicitud de presupuesto ha sido enviada. Te contactaremos en las próximas 24 horas.',
        'error_message' => 'Error al enviar la solicitud. Por favor, inténtalo de nuevo.'
    ];
    
    return $mailer->enviarEmail($config);
}

// =============================================================================
// EJEMPLO 3: NOTIFICACIÓN INTERNA
// =============================================================================
function enviarNotificacionInterna($asunto, $mensaje, $destinatarios = null) {
    global $mailer;
    
    $config = [
        'to' => $destinatarios ?: ['luiscarlos@innovabyte.es'],
        'subject' => '[INTERNO] ' . $asunto,
        'body' => "
            <h3>Notificación Interna - InnovaByte</h3>
            <div style='background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 5px;'>
                <h4>🔔 {$asunto}</h4>
                <p>{$mensaje}</p>
                <hr>
                <small>
                    <strong>Fecha:</strong> " . date('d/m/Y H:i:s') . "<br>
                    <strong>Servidor:</strong> {$_SERVER['SERVER_NAME']}<br>
                    <strong>IP:</strong> {$_SERVER['REMOTE_ADDR']}
                </small>
            </div>
        ",
        'success_message' => 'Notificación enviada correctamente.',
        'error_message' => 'Error al enviar la notificación.'
    ];
    
    return $mailer->enviarEmail($config);
}

// =============================================================================
// EJEMPLO 4: EMAIL CON ADJUNTOS
// =============================================================================
function enviarEmailConAdjuntos($destinatario, $asunto, $mensaje, $archivos = []) {
    global $mailer;
    
    $config = [
        'to' => $destinatario,
        'subject' => $asunto,
        'body' => $mensaje,
        'attachments' => $archivos,
        'success_message' => 'Email con adjuntos enviado correctamente.',
        'error_message' => 'Error al enviar el email con adjuntos.'
    ];
    
    return $mailer->enviarEmail($config);
}

// =============================================================================
// EJEMPLO 5: EMAIL A MÚLTIPLES DESTINATARIOS
// =============================================================================
function enviarEmailMasivo($destinatarios, $asunto, $mensaje, $con_copia = []) {
    global $mailer;
    
    $config = [
        'to' => $destinatarios,
        'cc' => $con_copia,
        'subject' => $asunto,
        'body' => $mensaje,
        'success_message' => 'Email enviado a múltiples destinatarios.',
        'error_message' => 'Error al enviar el email masivo.'
    ];
    
    return $mailer->enviarEmail($config);
}

// =============================================================================
// FUNCIÓN PARA NEWSLETTER (mantener compatibilidad)
// =============================================================================
function enviarEmailNewsletter($email) {
    global $mailer;
    
    $config = [
        'reply_to' => $email,
        'subject' => 'Nueva suscripción a newsletter - InnovaByte',
        'body' => "
            <h3>Mensaje Enviado desde el formulario de newsletter de la WEB</h3>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Fecha:</strong> " . date('d/m/Y H:i:s') . "</p>
            <p><strong>IP:</strong> " . $_SERVER['REMOTE_ADDR'] . "</p>
            <p><strong>User Agent:</strong> " . $_SERVER['HTTP_USER_AGENT'] . "</p>
        ",
        'success_message' => '¡Gracias! Te has suscrito correctamente a nuestro newsletter.',
        'error_message' => 'Error al enviar el mensaje. Por favor, inténtalo de nuevo.'
    ];
    
    return $mailer->enviarEmail($config);
}

?>
