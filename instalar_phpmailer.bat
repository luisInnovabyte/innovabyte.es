@echo off
echo Instalando PHPMailer para InnovaByte...
echo.

:: Crear directorio para PHPMailer
if not exist "assets\phpmailer" mkdir "assets\phpmailer"
if not exist "assets\phpmailer\src" mkdir "assets\phpmailer\src"

echo Descargando PHPMailer desde GitHub...
echo.

:: Descargar usando PowerShell (disponible en Windows 10+)
powershell -Command "& {Invoke-WebRequest -Uri 'https://github.com/PHPMailer/PHPMailer/archive/refs/heads/master.zip' -OutFile 'phpmailer.zip'}"

if exist "phpmailer.zip" (
    echo Extrayendo archivos...
    powershell -Command "& {Expand-Archive -Path 'phpmailer.zip' -DestinationPath '.' -Force}"
    
    :: Copiar archivos necesarios
    if exist "PHPMailer-master\src" (
        copy "PHPMailer-master\src\PHPMailer.php" "assets\phpmailer\src\"
        copy "PHPMailer-master\src\SMTP.php" "assets\phpmailer\src\"
        copy "PHPMailer-master\src\Exception.php" "assets\phpmailer\src\"
        copy "PHPMailer-master\src\POP3.php" "assets\phpmailer\src\"
        copy "PHPMailer-master\src\OAuth.php" "assets\phpmailer\src\"
        
        echo.
        echo ¡PHPMailer instalado correctamente!
        echo.
        echo Archivos instalados en: assets\phpmailer\src\
        echo.
        
        :: Limpiar archivos temporales
        del "phpmailer.zip"
        rmdir /s /q "PHPMailer-master"
        
        echo Instalación completada. Ya puedes usar el formulario de newsletter.
    ) else (
        echo Error: No se pudo extraer PHPMailer correctamente.
    )
) else (
    echo Error: No se pudo descargar PHPMailer.
    echo.
    echo Instalación manual:
    echo 1. Ve a: https://github.com/PHPMailer/PHPMailer/releases
    echo 2. Descarga la última versión
    echo 3. Extrae los archivos en: assets\phpmailer\
)

echo.
pause
