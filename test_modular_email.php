<?php
/**
 * Prueba del Sistema Modular de Email - InnovaByte
 */

require_once 'phpmailer_config.php';

// Verificar instalación y configuración
echo "<h2>🧪 Prueba del Sistema Modular de Email</h2>";

try {
    $mailer = new InnovaByteMailer();
    echo "<p style='color: green;'>✅ Clase InnovaByteMailer cargada correctamente</p>";
    
    // Verificar configuración
    $smtp_config = $mailer->getConfig('smtp');
    echo "<h3>Configuración SMTP:</h3>";
    echo "<ul>";
    echo "<li><strong>Host:</strong> " . $smtp_config['host'] . "</li>";
    echo "<li><strong>Puerto:</strong> " . $smtp_config['port'] . "</li>";
    echo "<li><strong>Usuario:</strong> " . $smtp_config['username'] . "</li>";
    echo "<li><strong>Encriptación:</strong> " . $smtp_config['encryption'] . "</li>";
    echo "</ul>";
    
    // Verificar templates
    $templates = $mailer->getConfig('templates');
    echo "<h3>Templates disponibles:</h3>";
    echo "<ul>";
    foreach ($templates as $name => $config) {
        echo "<li><strong>$name:</strong> " . $config['subject'] . "</li>";
    }
    echo "</ul>";
    
    // Verificar destinatarios por defecto
    $recipients = $mailer->getConfig('default_recipients');
    echo "<h3>Destinatarios por defecto:</h3>";
    echo "<ul>";
    foreach ($recipients as $type => $email) {
        echo "<li><strong>$type:</strong> $email</li>";
    }
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}

// Formulario de prueba
if ($_POST && isset($_POST['test_email'])) {
    $test_email = filter_var($_POST['test_email'], FILTER_SANITIZE_EMAIL);
    $test_type = $_POST['test_type'] ?? 'newsletter';
    
    if (filter_var($test_email, FILTER_VALIDATE_EMAIL)) {
        try {
            echo "<hr><h3>🧪 Ejecutando prueba...</h3>";
            
            switch ($test_type) {
                case 'newsletter':
                    $resultado = enviarEmailNewsletter($test_email);
                    break;
                    
                case 'contacto':
                    $datos = [
                        'nombre' => 'Usuario de Prueba',
                        'email' => $test_email,
                        'telefono' => '123456789',
                        'empresa' => 'Empresa Test',
                        'asunto' => 'Prueba de contacto',
                        'mensaje' => 'Este es un mensaje de prueba del sistema modular.'
                    ];
                    
                    // Cargar función de ejemplo
                    require_once 'phpmailer_ejemplos.php';
                    $resultado = enviarEmailContacto($datos);
                    break;
                    
                case 'basico':
                    $config = [
                        'reply_to' => $test_email,
                        'subject' => 'Email de prueba - Sistema Modular',
                        'body' => "
                            <h3>🧪 Email de Prueba</h3>
                            <p>Este es un email de prueba del sistema modular de InnovaByte.</p>
                            <p><strong>Email de prueba:</strong> $test_email</p>
                            <p><strong>Fecha:</strong> " . date('d/m/Y H:i:s') . "</p>
                            <hr>
                            <p><small>Generado automáticamente por el sistema de pruebas.</small></p>
                        ",
                        'success_message' => 'Email de prueba enviado correctamente.',
                        'error_message' => 'Error al enviar el email de prueba.'
                    ];
                    
                    $resultado = $mailer->enviarEmail($config);
                    break;
            }
            
            if ($resultado['success']) {
                echo "<div style='background: #d4edda; color: #155724; padding: 15px; border-radius: 5px;'>";
                echo "✅ " . $resultado['message'];
                echo "</div>";
            } else {
                echo "<div style='background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px;'>";
                echo "❌ " . $resultado['message'];
                echo "</div>";
            }
            
        } catch (Exception $e) {
            echo "<div style='background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px;'>";
            echo "❌ Error de excepción: " . $e->getMessage();
            echo "</div>";
        }
    } else {
        echo "<div style='background: #fff3cd; color: #856404; padding: 15px; border-radius: 5px;'>";
        echo "⚠️ Email no válido: $test_email";
        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Sistema Modular Email - InnovaByte</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .form-container { background: #f8f9fa; padding: 30px; border-radius: 10px; margin: 20px 0; }
        input, select { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; margin: 10px 0; }
        button { background: #007bff; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .info { background: #e7f3ff; padding: 15px; border-radius: 5px; margin: 20px 0; }
        hr { margin: 30px 0; }
    </style>
</head>
<body>
    
    <div class="form-container">
        <h2>🧪 Formulario de Prueba</h2>
        <p>Usa este formulario para probar el envío de emails con el sistema modular.</p>
        
        <form method="POST" action="">
            <label for="test_email">Email de prueba:</label>
            <input type="email" name="test_email" id="test_email" placeholder="email@ejemplo.com" required>
            
            <label for="test_type">Tipo de prueba:</label>
            <select name="test_type" id="test_type">
                <option value="newsletter">Newsletter (función específica)</option>
                <option value="contacto">Contacto (ejemplo completo)</option>
                <option value="basico">Email básico (configuración manual)</option>
            </select>
            
            <button type="submit">🚀 Enviar Prueba</button>
        </form>
    </div>
    
    <div class="info">
        <h3>📋 Información de Prueba</h3>
        <p><strong>Newsletter:</strong> Usa la función específica <code>enviarEmailNewsletter()</code></p>
        <p><strong>Contacto:</strong> Usa el ejemplo completo de formulario de contacto</p>
        <p><strong>Básico:</strong> Usa la clase <code>InnovaByteMailer</code> directamente</p>
        
        <h4>🔗 Enlaces útiles:</h4>
        <ul>
            <li><a href="index.php">→ Página principal (newsletter real)</a></li>
            <li><a href="test_phpmailer.php">→ Verificar instalación PHPMailer</a></li>
            <li><a href="test_newsletter.php">→ Prueba newsletter simple</a></li>
        </ul>
    </div>
    
    <div class="info">
        <h3>📁 Archivos del Sistema Modular</h3>
        <ul>
            <li><strong>phpmailer_config.php</strong> - Clase principal InnovaByteMailer</li>
            <li><strong>email_config.php</strong> - Configuración SMTP y templates</li>
            <li><strong>phpmailer_ejemplos.php</strong> - Ejemplos de uso para formularios</li>
            <li><strong>PHPMAILER_MODULAR_README.md</strong> - Documentación completa</li>
        </ul>
    </div>
    
</body>
</html>
