<?php
/**
 * Script de prueba para PHPMailer
 * Este archivo verifica que PHPMailer esté instalado correctamente
 */

echo "<h2>Verificación de PHPMailer - InnovaByte</h2>";

// Verificar si los archivos existen
$archivos_requeridos = [
    'assets/phpmailer/src/PHPMailer.php',
    'assets/phpmailer/src/SMTP.php',
    'assets/phpmailer/src/Exception.php'
];

$archivos_ok = true;

echo "<h3>Verificando archivos:</h3>";
echo "<ul>";

foreach ($archivos_requeridos as $archivo) {
    if (file_exists($archivo)) {
        echo "<li style='color: green;'>✓ $archivo - OK</li>";
    } else {
        echo "<li style='color: red;'>✗ $archivo - NO ENCONTRADO</li>";
        $archivos_ok = false;
    }
}

echo "</ul>";

if ($archivos_ok) {
    echo "<h3 style='color: green;'>✓ PHPMailer está instalado correctamente</h3>";
    
    // Intentar cargar PHPMailer
    try {
        require_once 'assets/phpmailer/src/PHPMailer.php';
        require_once 'assets/phpmailer/src/SMTP.php';
        require_once 'assets/phpmailer/src/Exception.php';
        
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        echo "<p style='color: green;'>✓ PHPMailer se cargó correctamente</p>";
        echo "<p>Versión de PHPMailer: " . $mail::VERSION . "</p>";
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>✗ Error al cargar PHPMailer: " . $e->getMessage() . "</p>";
    }
    
} else {
    echo "<h3 style='color: red;'>✗ Faltan archivos de PHPMailer</h3>";
    echo "<p>Ejecuta el archivo 'instalar_phpmailer.bat' para instalar PHPMailer</p>";
}

echo "<hr>";
echo "<h3>Configuración SMTP:</h3>";
echo "<ul>";
echo "<li><strong>Host:</strong> innovabyte.es</li>";
echo "<li><strong>Puerto:</strong> 465 (SSL)</li>";
echo "<li><strong>Usuario:</strong> luiscarlos@innovabyte.es</li>";
echo "<li><strong>Contraseña:</strong> [configurada]</li>";
echo "</ul>";

echo "<hr>";
echo "<p><a href='index.php'>← Volver a la página principal</a></p>";
?>
