<?php
/**
 * Configuración de PHPMailer para InnovaByte
 * 
 * Para instalar PHPMailer, ejecuta uno de estos métodos:
 * 
 * MÉTODO 1 - Con Composer (recomendado):
 * 1. Abre la terminal en la carpeta del proyecto
 * 2. Ejecuta: composer require phpmailer/phpmailer
 * 
 * MÉTODO 2 - Descarga manual:
 * 1. Descarga PHPMailer desde: https://github.com/PHPMailer/PHPMailer/releases
 * 2. Extrae los archivos en la carpeta: assets/phpmailer/
 * 3. Asegúrate de que existan estos archivos:
 *    - assets/phpmailer/src/PHPMailer.php
 *    - assets/phpmailer/src/SMTP.php
 *    - assets/phpmailer/src/Exception.php
 */

// Configuración SMTP centralizada
class InnovaByteMailer {
    
    private $config;
    
    public function __construct() {
        // Cargar configuración desde archivo externo
        $this->config = include __DIR__ . '/email_config.php';
    }
    
    /**
     * Obtener configuración
     * @param string $key
     * @return mixed
     */
    public function getConfig($key = null) {
        if ($key === null) {
            return $this->config;
        }
        
        $keys = explode('.', $key);
        $value = $this->config;
        
        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return null;
            }
        }
        
        return $value;
    }
    
    /**
     * Obtener template de email
     * @param string $template_name
     * @return array
     */
    public function getTemplate($template_name) {
        $templates = $this->getConfig('templates');
        return isset($templates[$template_name]) ? $templates[$template_name] : [];
    }
    
    /**
     * Obtener destinatario por defecto
     * @param string $type
     * @return string
     */
    public function getDefaultRecipient($type = 'contact') {
        $recipients = $this->getConfig('default_recipients');
        return isset($recipients[$type]) ? $recipients[$type] : $this->getConfig('from.email');
    }
    
    /**
     * Crear instancia de PHPMailer con configuración SMTP
     * @return PHPMailer\PHPMailer\PHPMailer
     * @throws Exception
     */
    public function createMailer() {
        // Incluir PHPMailer según el método de instalación
        if (file_exists(__DIR__ . '/vendor/autoload.php')) {
            require_once __DIR__ . '/vendor/autoload.php';
        } elseif (file_exists(__DIR__ . '/assets/phpmailer/src/PHPMailer.php')) {
            require_once __DIR__ . '/assets/phpmailer/src/PHPMailer.php';
            require_once __DIR__ . '/assets/phpmailer/src/SMTP.php';
            require_once __DIR__ . '/assets/phpmailer/src/Exception.php';
        } else {
            throw new Exception('PHPMailer no está instalado. Por favor, instálalo usando Composer o descárgalo manualmente.');
        }
        
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        
        // Configuración del servidor SMTP
        $smtp = $this->getConfig('smtp');
        $from = $this->getConfig('from');
        
        $mail->isSMTP();
        $mail->Host = $smtp['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $smtp['username'];
        $mail->Password = $smtp['password'];
        $mail->SMTPSecure = $smtp['encryption'] === 'ssl' ? PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS : PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $smtp['port'];
        $mail->CharSet = $smtp['charset'];
        
        // Configuración básica del remitente
        $mail->setFrom($from['email'], $from['name']);
        
        return $mail;
    }
    
    /**
     * Enviar email genérico
     * @param array $config - Configuración del email
     * @return array
     */
    public function enviarEmail($config) {
        try {
            $mail = $this->createMailer();
            
            // Configurar destinatarios
            if (isset($config['to'])) {
                if (is_array($config['to'])) {
                    foreach ($config['to'] as $recipient) {
                        if (is_array($recipient)) {
                            $mail->addAddress($recipient['email'], $recipient['name'] ?? '');
                        } else {
                            $mail->addAddress($recipient);
                        }
                    }
                } else {
                    $mail->addAddress($config['to']);
                }
            } else {
                // Destinatario por defecto
                $from = $this->getConfig('from');
                $mail->addAddress($from['email'], $from['name']);
            }
            
            // Configurar Reply-To
            if (isset($config['reply_to'])) {
                $mail->addReplyTo($config['reply_to'], $config['reply_to_name'] ?? '');
            }
            
            // Configurar CC y BCC
            if (isset($config['cc'])) {
                if (is_array($config['cc'])) {
                    foreach ($config['cc'] as $cc) {
                        $mail->addCC($cc);
                    }
                } else {
                    $mail->addCC($config['cc']);
                }
            }
            
            if (isset($config['bcc'])) {
                if (is_array($config['bcc'])) {
                    foreach ($config['bcc'] as $bcc) {
                        $mail->addBCC($bcc);
                    }
                } else {
                    $mail->addBCC($config['bcc']);
                }
            }
            
            // Configurar contenido
            $mail->isHTML($config['is_html'] ?? true);
            $mail->Subject = $config['subject'] ?? 'Mensaje desde InnovaByte';
            $mail->Body = $config['body'] ?? '';
            
            if (isset($config['alt_body'])) {
                $mail->AltBody = $config['alt_body'];
            }
            
            // Adjuntos
            if (isset($config['attachments'])) {
                foreach ($config['attachments'] as $attachment) {
                    if (is_array($attachment)) {
                        $mail->addAttachment($attachment['path'], $attachment['name'] ?? '');
                    } else {
                        $mail->addAttachment($attachment);
                    }
                }
            }
            
            $mail->send();
            return ['success' => true, 'message' => $config['success_message'] ?? 'Email enviado correctamente.'];
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => $config['error_message'] ?? 'Error al enviar el mensaje. Por favor, inténtalo de nuevo.'];
        }
    }
}

// Función específica para newsletter (mantener compatibilidad)
function enviarEmailNewsletter($email) {
    $mailer = new InnovaByteMailer();
    $template = $mailer->getTemplate('newsletter');
    
    $config = [
        'to' => $mailer->getDefaultRecipient('newsletter'),
        'reply_to' => $email,
        'subject' => $template['subject'] ?? 'Nueva petición de información - InnovaByte',
        'body' => "
            <h3>Mensaje Enviado desde el formulario de petición de información de la WEB</h3>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Fecha:</strong> " . date('d/m/Y H:i:s') . "</p>
            <p><strong>IP:</strong> " . $_SERVER['REMOTE_ADDR'] . "</p>
            <p><strong>User Agent:</strong> " . $_SERVER['HTTP_USER_AGENT'] . "</p>
        ",
        'success_message' => $template['success_message'] ?? $mailer->getConfig('messages.success'),
        'error_message' => $mailer->getConfig('messages.error')
    ];
    
    return $mailer->enviarEmail($config);
}
?>
