# Configuración de PHPMailer para InnovaByte

Este proyecto usa PHPMailer para enviar emails desde el formulario de newsletter. A continuación se explican los pasos para instalarlo correctamente.

## Opción 1: Instalación con Composer (Recomendado)

1. **Instalar Composer** (si no lo tienes):
   - Descarga desde: https://getcomposer.org/
   - Sigue las instrucciones de instalación para Windows

2. **Instalar PHPMailer**:
   ```bash
   # Navega a la carpeta del proyecto en PowerShell
   cd w:\sland
   
   # Instala PHPMailer
   composer require phpmailer/phpmailer
   ```

3. **Verificar instalación**:
   - Se debe crear una carpeta `vendor/` en tu proyecto
   - El archivo `vendor/autoload.php` debe existir

## Opción 2: Instalación Manual

1. **Descargar PHPMailer**:
   - Ve a: https://github.com/PHPMailer/PHPMailer/releases
   - Descarga la última versión (ZIP)

2. **Extraer archivos**:
   - Crea la carpeta: `w:\sland\assets\phpmailer\`
   - Extrae el contenido en esa carpeta
   - Asegúrate de que existan estos archivos:
     ```
     assets/phpmailer/src/PHPMailer.php
     assets/phpmailer/src/SMTP.php
     assets/phpmailer/src/Exception.php
     ```

## Configuración SMTP

Los datos de configuración ya están incluidos en el código:

- **Host**: innovabyte.es
- **Puerto**: 465 (SSL)
- **Usuario**: luiscarlos@innovabyte.es
- **Contraseña**: 27979699$C
- **Seguridad**: SSL

## Funcionamiento

1. **Formulario de Newsletter**: 
   - Ubicado en la sección "¿Necesitas ayuda?"
   - Valida el email antes de enviar
   - Muestra mensajes de éxito o error

2. **Email enviado**:
   - **Para**: luiscarlos@innovabyte.es
   - **Asunto**: Nueva suscripción a newsletter - InnovaByte
   - **Contenido**: Email del usuario, fecha, IP y User Agent

3. **Mensajes de respuesta**:
   - **Éxito**: "¡Gracias! Te has suscrito correctamente a nuestro newsletter."
   - **Error**: Mensajes específicos según el tipo de error

## Comandos para instalar con Composer

```powershell
# Ir a la carpeta del proyecto
cd w:\sland

# Instalar PHPMailer
composer require phpmailer/phpmailer

# Verificar instalación
dir vendor
```

## Solución de problemas

1. **Error "PHPMailer no está instalado"**:
   - Verifica que hayas instalado PHPMailer correctamente
   - Comprueba las rutas de los archivos

2. **Error de conexión SMTP**:
   - Verifica los datos de conexión
   - Comprueba que el servidor permita conexiones SSL en el puerto 465

3. **Errores de validación**:
   - Asegúrate de introducir un email válido
   - Verifica que el formulario se envíe correctamente

## Archivos modificados

- `index.php`: Agregado el procesamiento del formulario
- `phpmailer_config.php`: Configuración y función de envío (nuevo archivo)
- `PHPMAILER_README.md`: Este archivo de documentación (nuevo archivo)
