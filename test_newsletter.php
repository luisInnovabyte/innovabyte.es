<?php
/**
 * Archivo de prueba del formulario de newsletter
 * Este archivo simula el envío de email sin usar SMTP real
 */

if ($_POST && isset($_POST['newsletter_email'])) {
    $email = filter_var($_POST['newsletter_email'], FILTER_SANITIZE_EMAIL);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Simular envío exitoso
        $mensaje_enviado = "✓ Email registrado: $email (Modo prueba - no se envió email real)";
        
        // Log para desarrollo
        $log_entry = date('Y-m-d H:i:s') . " - Newsletter: $email - IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
        file_put_contents('newsletter_log.txt', $log_entry, FILE_APPEND);
        
    } else {
        $error_mensaje = 'Por favor, introduce una dirección de email válida.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Newsletter - InnovaByte</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        .form-container { background: #f8f9fa; padding: 30px; border-radius: 10px; }
        .alert { padding: 15px; margin: 15px 0; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        input[type="email"] { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; margin: 10px 0; }
        button { background: #007bff; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .info { background: #e7f3ff; padding: 15px; border-radius: 5px; margin: 20px 0; }
    </style>
</head>
<body>
    <h1>Prueba del Formulario de Newsletter</h1>
    
    <div class="form-container">
        <h2>Suscríbete a nuestro newsletter</h2>
        
        <?php if (isset($mensaje_enviado)): ?>
            <div class="alert alert-success"><?php echo $mensaje_enviado; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error_mensaje)): ?>
            <div class="alert alert-danger"><?php echo $error_mensaje; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <input type="email" name="newsletter_email" placeholder="Introduce tu dirección de correo electrónico" required>
            <button type="submit">Enviar</button>
        </form>
    </div>
    
    <div class="info">
        <h3>Estado de la instalación:</h3>
        <p><strong>PHPMailer:</strong> 
        <?php 
        if (file_exists('assets/phpmailer/src/PHPMailer.php')) {
            echo "✓ Instalado correctamente";
        } else {
            echo "✗ No instalado";
        }
        ?>
        </p>
        
        <p><strong>Configuración SMTP:</strong></p>
        <ul>
            <li>Host: innovabyte.es</li>
            <li>Puerto: 465 (SSL)</li>
            <li>Usuario: luiscarlos@innovabyte.es</li>
        </ul>
        
        <p><a href="test_phpmailer.php">→ Verificar instalación de PHPMailer</a></p>
        <p><a href="index.php">→ Volver a la página principal</a></p>
    </div>
    
    <?php if (file_exists('newsletter_log.txt')): ?>
        <div class="info">
            <h3>Log de pruebas:</h3>
            <pre><?php echo htmlspecialchars(file_get_contents('newsletter_log.txt')); ?></pre>
        </div>
    <?php endif; ?>
</body>
</html>
