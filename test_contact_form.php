<?php
/**
 * Página de prueba del formulario de contacto - InnovaByte
 */

// Procesar el formulario de contacto
$contacto_mensaje_enviado = '';
$contacto_error_mensaje = '';

if ($_POST && isset($_POST['contact_form'])) {
    // Validar campos requeridos
    $errores = [];
    
    if (empty($_POST['name'])) {
        $errores[] = 'El nombre es obligatorio.';
    }
    
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El email es obligatorio y debe ser válido.';
    }
    
    if (empty($_POST['message'])) {
        $errores[] = 'El mensaje es obligatorio.';
    }
    
    if (empty($errores)) {
        // Incluir la configuración de PHPMailer
        require_once 'phpmailer_config.php';
        
        try {
            $mailer = new InnovaByteMailer();
            $template = $mailer->getTemplate('contact');
            
            // Sanitizar datos
            $datos = [
                'nombre' => htmlspecialchars(trim($_POST['name'])),
                'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
                'telefono' => htmlspecialchars(trim($_POST['number'] ?? '')),
                'empresa' => htmlspecialchars(trim($_POST['company'] ?? '')),
                'asunto' => htmlspecialchars(trim($_POST['subject'] ?? 'Consulta desde web')),
                'sitio_web' => htmlspecialchars(trim($_POST['website'] ?? '')),
                'mensaje' => htmlspecialchars(trim($_POST['message']))
            ];
            
            $config = [
                'to' => $mailer->getDefaultRecipient('contact'),
                'reply_to' => $datos['email'],
                'reply_to_name' => $datos['nombre'],
                'subject' => $template['subject'] ?? 'Nuevo mensaje de contacto - InnovaByte',
                'body' => "
                    <h3>Nuevo mensaje desde el formulario de contacto</h3>
                    <div style='background: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px;'>
                        <h4 style='color: #007bff; margin-top: 0;'>Datos del Contacto</h4>
                        <table style='border-collapse: collapse; width: 100%;'>
                            <tr>
                                <td style='padding: 8px; border: 1px solid #ddd; background: #f8f9fa; width: 150px;'><strong>Nombre:</strong></td>
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
                                <td style='padding: 8px; border: 1px solid #ddd; background: #f8f9fa;'><strong>Sitio web:</strong></td>
                                <td style='padding: 8px; border: 1px solid #ddd;'>{$datos['sitio_web']}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div style='background: #e7f3ff; padding: 20px; border-radius: 5px; margin-bottom: 20px;'>
                        <h4 style='color: #007bff; margin-top: 0;'>Mensaje</h4>
                        <div style='background: white; padding: 15px; border-radius: 3px; border-left: 4px solid #007bff;'>
                            " . nl2br($datos['mensaje']) . "
                        </div>
                    </div>
                    
                    <div style='background: #f0f0f0; padding: 15px; border-radius: 5px; font-size: 12px; color: #666;'>
                        <p><strong>Fecha:</strong> " . date('d/m/Y H:i:s') . "</p>
                        <p><strong>IP:</strong> {$_SERVER['REMOTE_ADDR']}</p>
                        <p><strong>User Agent:</strong> {$_SERVER['HTTP_USER_AGENT']}</p>
                    </div>
                ",
                'success_message' => $template['success_message'] ?? '¡Gracias! Tu mensaje ha sido enviado correctamente. Te responderemos pronto.',
                'error_message' => 'Error al enviar el mensaje. Por favor, inténtalo de nuevo.'
            ];
            
            $resultado = $mailer->enviarEmail($config);
            
            if ($resultado['success']) {
                $contacto_mensaje_enviado = $resultado['message'];
                // Limpiar variables POST para evitar reenvío
                $_POST = [];
            } else {
                $contacto_error_mensaje = $resultado['message'];
            }
            
        } catch (Exception $e) {
            $contacto_error_mensaje = 'Error: PHPMailer no está instalado correctamente. ' . $e->getMessage();
        }
    } else {
        $contacto_error_mensaje = implode('<br>', $errores);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Formulario de Contacto - InnovaByte</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            max-width: 800px; 
            margin: 50px auto; 
            padding: 20px; 
            background: #f8f9fa;
        }
        
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .form-container { 
            background: #f8f9fa; 
            padding: 30px; 
            border-radius: 10px; 
            margin: 20px 0; 
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        
        input, textarea, select { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid #ddd; 
            border-radius: 5px; 
            font-size: 14px;
            box-sizing: border-box;
        }
        
        input:focus, textarea:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0,123,255,0.3);
        }
        
        button { 
            background: #007bff; 
            color: white; 
            padding: 12px 25px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 16px;
            transition: background 0.3s;
        }
        
        button:hover { 
            background: #0056b3; 
        }
        
        .alert { 
            padding: 15px; 
            margin: 20px 0; 
            border-radius: 5px; 
            font-weight: bold;
        }
        
        .alert-success { 
            background: #d4edda; 
            color: #155724; 
            border: 1px solid #c3e6cb; 
        }
        
        .alert-danger { 
            background: #f8d7da; 
            color: #721c24; 
            border: 1px solid #f5c6cb; 
        }
        
        .info { 
            background: #e7f3ff; 
            padding: 15px; 
            border-radius: 5px; 
            margin: 20px 0; 
            border-left: 4px solid #007bff;
        }
        
        .status-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px 0;
        }
        
        .status-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #28a745;
        }
        
        .status-item.error {
            border-left-color: #dc3545;
        }
        
        .required {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧪 Prueba del Formulario de Contacto</h1>
        <p>Esta página permite probar el formulario de contacto con el sistema modular de PHPMailer.</p>
        
        <div class="status-grid">
            <div class="status-item">
                <h4>Estado de PHPMailer</h4>
                <p>
                <?php 
                if (file_exists('assets/phpmailer/src/PHPMailer.php')) {
                    echo "✅ Instalado correctamente";
                } else {
                    echo "❌ No instalado";
                }
                ?>
                </p>
            </div>
            
            <div class="status-item">
                <h4>Configuración SMTP</h4>
                <p>✅ Configurado: innovabyte.es:465</p>
            </div>
        </div>
        
        <div class="form-container">
            <h2>Formulario de Contacto</h2>
            
            <?php if ($contacto_mensaje_enviado): ?>
                <div class="alert alert-success">
                    <i>✅</i> <?php echo $contacto_mensaje_enviado; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($contacto_error_mensaje): ?>
                <div class="alert alert-danger">
                    <i>❌</i> <?php echo $contacto_error_mensaje; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <input type="hidden" name="contact_form" value="1">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nombre completo <span class="required">*</span></label>
                        <input type="text" name="name" id="name" required 
                               value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" name="email" id="email" required 
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="number">Teléfono</label>
                        <input type="text" name="number" id="number" 
                               value="<?php echo isset($_POST['number']) ? htmlspecialchars($_POST['number']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="company">Empresa</label>
                        <input type="text" name="company" id="company" 
                               value="<?php echo isset($_POST['company']) ? htmlspecialchars($_POST['company']) : ''; ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="subject">Asunto</label>
                        <input type="text" name="subject" id="subject" 
                               value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="website">Sitio web</label>
                        <input type="url" name="website" id="website" 
                               value="<?php echo isset($_POST['website']) ? htmlspecialchars($_POST['website']) : ''; ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="message">Mensaje <span class="required">*</span></label>
                    <textarea name="message" id="message" rows="5" required 
                              placeholder="Describe tu consulta o proyecto..."><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                </div>
                
                <button type="submit">🚀 Enviar Mensaje</button>
            </form>
        </div>
        
        <div class="info">
            <h3>📋 Información del Sistema</h3>
            <p><strong>Template usado:</strong> contact</p>
            <p><strong>Destinatario:</strong> <?php 
                try {
                    require_once 'phpmailer_config.php';
                    $mailer = new InnovaByteMailer();
                    echo $mailer->getDefaultRecipient('contact');
                } catch (Exception $e) {
                    echo "No configurado";
                }
            ?></p>
            <p><strong>Validación:</strong> Nombre, email y mensaje son obligatorios</p>
            <p><strong>Sanitización:</strong> Todos los campos son limpiados antes del envío</p>
        </div>
        
        <div class="info">
            <h3>🔗 Enlaces útiles</h3>
            <ul>
                <li><a href="index.php">→ Página principal (con ambos formularios)</a></li>
                <li><a href="test_modular_email.php">→ Prueba sistema modular completo</a></li>
                <li><a href="test_phpmailer.php">→ Verificar instalación PHPMailer</a></li>
                <li><a href="PHPMAILER_MODULAR_README.md">→ Documentación completa</a></li>
            </ul>
        </div>
    </div>
</body>
</html>
