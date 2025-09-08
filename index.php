<?php
// Procesar el formulario de newsletter
$mensaje_enviado = '';
$error_mensaje = '';

if ($_POST && isset($_POST['newsletter_email'])) {
    $email = filter_var($_POST['newsletter_email'], FILTER_SANITIZE_EMAIL);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Incluir la configuración de PHPMailer
        require_once 'phpmailer_config.php';
        
        try {
            $resultado = enviarEmailNewsletter($email);
            
            if ($resultado['success']) {
                $mensaje_enviado = $resultado['message'];
            } else {
                $error_mensaje = $resultado['message'];
            }
            
        } catch (Exception $e) {
            $error_mensaje = 'Error: PHPMailer no está instalado correctamente. ' . $e->getMessage();
        }
    } else {
        $error_mensaje = 'Por favor, introduce una dirección de email válida.';
    }
}

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
    <!--====== Required meta tags ======-->
     <?php include "./assets/templates/mainhead.php"; ?>
     <style>
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
     </style>
</head>

<body class="home-three dark-body">
    <div class="page-wrapper">

        <!-- Preloader -->
        <div class="preloader"></div>


        <!--====== Header Part Start ======-->
        <header class="main-header header-three">
            <!--Header-Upper-->
           <?php include "./assets/templates/mainheader.php"; ?>
            <!--End Header Upper-->

        </header>
        <!--====== Header Part End ======-->


        <!--====== Hero Section Start ======-->
        <section class="hero-section-three rel z-2 pt-235 rpt-150 pb-130 rpb-100" style="background-image: url(assets/images/shapes/solutions-bg-dots_black.png); background-size: cover; background-position: center center; background-repeat: no-repeat;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-11 offset-lg-1">
                        <div class="hero-content-three rpt-15 rmb-75">
                            <h1 class="mb-15 wow fadeInUp delay-0-2s" style="font-size: 5rem;">Software que soluciona</h1>
                            <p class="wow fadeInUp delay-0-4s" style="font-size: 1.4rem; font-weight: 500; color: #c3c3c3ff; margin-bottom: 15px;">Tu empresa tiene una forma de trabajar única...</p>
                            <p class="wow fadeInUp delay-0-4s" style="font-size: 1.6rem; font-weight: 600; color: #CC7700; text-shadow: 1px 1px 2px rgba(0,0,0,0.1); animation: pulse 3s ease-in-out infinite;">Nosotros te damos el software que te mereces</p>
                            <!-- <form class="newsletter-form mt-40" action="#">
                                <div class="newsletter-email wow fadeInUp delay-0-6s">
                                    <input type="email" placeholder="Enter Email Address" required>
                                    <button type="submit">Get Free Trial <i class="fas fa-arrow-right"></i></button>
                                </div>
                                <div class="newsletter-radios wow fadeInUp delay-0-8s"> -->
                                    <!-- <div class="custom-control custom-radio">
                                      <input type="radio" class="custom-control-input" id="hero-wekly" name="example1" checked>
                                      <label class="custom-control-label" for="hero-wekly">Wekly Updates</label>
                                    </div>  -->
                                    <!-- <div class="custom-control custom-radio">
                                      <input type="radio" class="custom-control-input" id="hero-monthly" name="example1">
                                      <label class="custom-control-label" for="hero-monthly">Monthly Updates</label>
                                    </div>  -->
                                <!-- </div>
                            </form> -->
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-image-three overlay wow fadeInLeft delay-0-4s">
                            <!-- <img src="assets/images/hero/hero-three.jpg" alt="Hero"> -->
                            <img src="assets/images/index_798x505_1.png" alt="Inicial" style="transform: scale(1.2);">
                        </div>
                    </div>
                </div>
            </div>
            <img class="dots-shape" src="assets/images/shapes/dots.png" alt="Shape">
            <img class="tringle-shape" src="assets/images/shapes/tringle.png" alt="Shape">
            <img class="close-shape" src="assets/images/shapes/close.png" alt="Shape">
        </section>
        <!--====== Hero Section End ======-->


        <!--====== Solutions Section Start ======-->
        <section class="solutions-section-three text-white text-center rel bg-blue pt-130 rpt-100 z-1 pb-75 rpb-45" ">
            <div class="container">
               <div class="row justify-content-center">
                   <div class="col-xl-7 col-lg-8 col-md-10">
                       <div class="section-title mb-75">
                            <span class="sub-title">En qué podemos ayudarte</span>
                            <h2>Desarrollamos el software que tu empresa necesita.</h2>
                        </div>
                   </div>
               </div>
                <div class="row justify-content-center">
                    <!-- <div class="col-xl-4 col-md-6"> -->
                    <div class="col-xl-6 col-md-8">
                        <div class="solution-item-three wow fadeInUp delay-0-2s">
                            <!-- <i class="far fa-compass" style="color: #CC7700;"></i> -->
                            <!-- <i class="fa-regular fa-file-code" style="color: #CC7700;"></i> -->
                            <img src="assets/images/DATA.png" alt="Data Icon" class="service-icon services-mov" style="margin-bottom: 20px; width: 90px; height: 90px; border: 10px solid white; border-radius: 10px;">
                            <h3><a href="single-service.html">Software a medida</a></h3>
                            <p>Soluciones digitales diseñadas de forma exclusiva para automatizar y simplificar tus procesos clave, optimizando la eficiencia y adaptándose perfectamente a las necesidades específicas de tu negocio.</p>
                            <a href="programacion_medida.php" class="read-more">Saber más <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-8">
                        <div class="solution-item-three wow fadeInUp delay-0-4s">
                            <!-- <i class="far fa-map" style="color: #CC7700;"></i> -->
                            <img src="assets/images/MARKET_SHARE.png" alt="Data Icon" class="service-icon services-mov" style="margin-bottom: 20px; width: 90px; height: 90px; border: 10px solid white; border-radius: 10px;">
                            <h3><a href="single-service.html">Ecommerce</a></h3>
                            <p>Desarrollamos soluciones de comercio electrónico personalizadas con un diseño intuitivo, con integración de pasarelas de pago 
                                y estrategias user-friendly para convertir las visitas en ventas.</p>
                            <a href="ecommerce.php" class="read-more">Saber más <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- <div class="col-xl-4 col-md-6">
                        <div class="solution-item-three wow fadeInUp delay-0-6s">
                            <i class="fas fa-shield-alt"></i>
                            <h3><a href="single-service.html">Final Testylization</a></h3>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem aperiam eaque</p>
                            <a href="single-service.html" class="read-more">Learn More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
        <!--====== Solutions Section End ======-->

       
        <!--====== About Section Start ======-->
        <section class="about-section-three rel z-1 pt-130 rpt-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-7 col-lg-6">
                        <div class="about-image rmb-55 wow fadeInLeft delay-0-2s">
                            <img src="assets/images/index_739x530_1.png" alt="About">
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="about-content-three wow fadeInRight delay-0-2s">
                            <div class="section-title mb-25">
                                <span class="sub-title">Nuestras soluciones</span>
                                <h2>Construimos herramientas digitales</h2>
                            </div>
                            <p>No desarrollamos software, desarrollamos las soluciones digitales que tu negocio necesita. Proyectos "llave en mano".</p>

                            <h4 class="mb-15"><i class="fas fa-cogs text-primary mr-2" style="color: #CC7700 !important; "></i>Software que encaja con tu forma de trabajar</h4>
                            <p>Diseñamos aplicaciones a medida que se integran con tus procesos productivos y operativos. No forzamos metodologías estándar: analizamos cómo trabajas y creamos herramientas que lo potenciarán.</p>

                            <h4 class="mb-15"><i class="fas fa-shopping-cart text-primary mr-2" style="color: #CC7700 !important;"></i>Tiendas online listas para vender desde el primer día</h4>
                            <p>Creamos ecommerce funcionales, optimizados y fáciles de usar, para que puedas empezar a vender sin complicaciones. Además, te acompañamos para que sepas gestionarlas tú mismo sin depender de nadie.</p>                            
                            <!-- <ul class="list-style-one mt-25 mb-35">
                                <li>Customers Website</li>
                                <li>Software Doct</li>
                            </ul> -->
                            <a href="about.html" class="theme-btn style-three">Saber más <i class="fas fa-arrow-right"></i></a>
                        </di>
                    </div>
                </div>
            </div>
        </section>
        <!--====== About Section End ======-->

       
        <!--====== Browser Support Start ======-->     
        <section class="browswr-support-section rel z-1 py-130 rpy-100" style="background-image: url(assets/images/shapes/solutions-bg-dots.png);">
                  <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-lg-6">
                        <div class="browswr-support-content rmb-55 wow fadeInRight delay-0-2s">
                            <div class="section-title">
                                <span class="sub-title">En entorno WEB</span>
                                <h2>Trabajamos sobre un entorno web personalizado que funciona en cualquier navegador</h2>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="solution-item-two">
                                        <i class="fas fa-mobile-alt"></i>
                                        <h4>Diseño Responsive</h4>
                                        <p>Tu software funciona perfectamente en todos los tamaños: móviles, tablets y ordenadores, garantizando una experiencia óptima.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="solution-item-two color-two">
                                        <i class="fas fa-chart-line"></i>
                                        <h4>Alto rendimiento</h4>
                                        <p>Monitorizamos y optimizamos el rendimiento de tu aplicación para asegurar velocidad y eficiencia en todos los navegadores.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6">
                        <div class="browswr-support-image text-lg-right wow fadeInLeft delay-0-2s">
                            <img src="assets/images/illustartion_3.png" alt="Browser Support">
                            <!-- <img src="assets/images/about/borwser-support.jpg" alt="Browser Support"> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
        <!--====== Browser Support End ======-->
        
        
        <!--====== Newsletter Section Start ======-->
        <section class="newsletter-section-two mt-30 rmt-0 rel z-2">
            <div class="container">
                <div class="newsletter-inner style-two bg-gray bgs-cover text-white rel z-1">
                    <div class="row align-items-center align-items-xl-start">
                        <div class="col-lg-6">
                            <div class="newsletter-content p-60 wow fadeInUp delay-0-2s">
                                <div class="section-title mb-30">
                                    <span class="sub-title">¿Necesitas ayuda?</span>
                                    <h2>Ponte en contacto</h2>
                                </div>
                                <form class="newsletter-form" action="#" method="POST">
                                    <?php if ($mensaje_enviado): ?>
                                        <div class="alert alert-success mb-3" style="background-color: #28a745; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                                            <?php echo $mensaje_enviado; ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($error_mensaje): ?>
                                        <div class="alert alert-danger mb-3" style="background-color: #dc3545; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                                            <?php echo $error_mensaje; ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="newsletter-email">
                                        <input type="email" name="newsletter_email" placeholder="Introduce tu dirección de correo electrónico" required>
                                        <button type="submit">Enviar <i class="fas fa-angle-right"></i></button>
                                    </div>
                                    <!-- <div class="newsletter-radios">
                                        <div class="custom-control custom-radio">
                                          <input type="radio" class="custom-control-input" id="wekly" name="example1" checked>
                                          <label class="custom-control-label" for="wekly">Wekly Updates</label>
                                        </div> 
                                        <div class="custom-control custom-radio">
                                          <input type="radio" class="custom-control-input" id="monthly" name="example1">
                                          <label class="custom-control-label" for="monthly">Monthly Updates</label>
                                        </div> 
                                    </div> -->
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="newsletter-images wow fadeInUp delay-0-4s">
                                <img src="assets/images/newsletter-two.png" alt="Newsletter">
                                <img src="assets/images/newsletter/circle.png" alt="shape" class="circle slideUpRight">
                                <img src="assets/images/newsletter/dots.png" alt="shape" class="dots slideLeftRight">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--====== Newsletter Section End ======-->

       
        <!--====== Services Section Start ======-->
        <!-- <section class="services-section-three bg-lighter rel z-1 pt-250 pb-100 rpb-70"> -->
        <section class="services-section-three bg-lighter rel z-1 pt-250 pb-100 rpb-70">
            <div class="container">
               <div class="row justify-content-center text-center">
                   <div class="col-xl-7 col-lg-8 col-md-10">
                       <div class="section-title mt-100 rmt-70 mb-55">
                            <span class="sub-title">Servicios ofrecidos</span>
                            <h2>Nuestros servicios más demandados</h2>
                        </div>
                   </div>
               </div>
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="service-item wow fadeInUp delay-0-2s">
                            <i class="flaticon-responsive-design" style="color: #CC7700 !important;"></i>
                            <div class="content">
                                <h3><a href="single-service.html">Desarrollo a medida</a></h3>
                                <p>Creamos aplicaciones web personalizadas que se adaptan perfectamente a los procesos únicos de tu empresa</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="service-item wow fadeInUp delay-0-4s">
                            <i class="flaticon-analytics" style="color: #CC7700 !important;"></i>
                            <div class="content">
                                <h3><a href="single-service.html">Tiendas WooCommerce</a></h3>
                                <p>Desarrollamos ecommerce completos, optimizados para conversión y fáciles de gestionar</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="service-item wow fadeInUp delay-0-6s">
                            <i class="flaticon-security" style="color: #CC7700 !important;"></i>
                            <div class="content">
                                <h3><a href="single-service.html">Integración de sistemas</a></h3>
                                <p>Conectamos tu software con sistemas existentes: CRM, ERP y herramientas de gestión</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="service-item wow fadeInUp delay-0-8s">
                            <i class="flaticon-puzzle" style="color: #CC7700 !important;"></i>
                            <div class="content">
                                <h3><a href="single-service.html">Formación y consultoría</a></h3>
                                <!-- <p>Ofrecemos formación personalizada y consultoría especializada para que tu equipo saque el máximo provecho de las nuevas herramientas digitales</p> -->
                                <p>Ofrecemos formación personalizada y consultoría especializada para tu equipo.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="service-item wow fadeInUp delay-1-0s">
                            <i class="flaticon-badge" style="color: #CC7700 !important;"></i>
                            <div class="content">
                                <h3><a href="single-service.html">Mantenimiento y soporte</a></h3>
                                <p>Ofrecemos soporte técnico continuo para mantener tu software siempre funcionando</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="service-item wow fadeInUp delay-1-2s">
                            <i class="flaticon-file" style="color: #CC7700 !important;"></i>
                            <div class="content">
                                <h3><a href="single-service.html">Migración web</a></h3>
                                <p>Migramos tu sitio web o tienda online a nuevas plataformas manteniendo todos tus datos y mejorando el rendimiento</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--====== Services Section End ======-->
        
        
        <!--====== Dashboard Section Start ======-->
        <section class="dashboard-section rel z-1 py-130 rpy-100">
            <div class="container">
               <div class="row justify-content-center text-center">
                   <div class="col-xl-7 col-lg-8 col-md-10">
                       <div class="section-title mb-60">
                            <span class="sub-title">Dashboard Screenshot</span>
                            <h2>Te mostramos ejemplos de algunos de nuestros proyectos</h2>
                        </div>
                   </div>
               </div>
                <div class="dashboard-screenshot-wrap">
                    <div class="dashboard-screenshot-item">
                        <img src="assets/images/proyectos/costavalencia_1_index.png" alt="Dashboard Screenshot">
                    </div>
                    <div class="dashboard-screenshot-item">
                        <img src="assets/images/proyectos/consultas_1_index.png" alt="Dashboard Screenshot">
                    </div>
                    <div class="dashboard-screenshot-item">
                        <img src="assets/images/proyectos/ERP.png" alt="Dashboard Screenshot">
                    </div>
                    <div class="dashboard-screenshot-item">
                        <img src="assets/images/proyectos/routline.png" alt="Dashboard Screenshot">
                    </div>
                    <div class="dashboard-screenshot-item">
                        <img src="assets/images/proyectos/keylocked_1.png" alt="Dashboard Screenshot">
                    </div>
                    <div class="dashboard-screenshot-item">
                        <img src="assets/images/proyectos/ecommerce.png" alt="Dashboard Screenshot">
                    </div>
                </div>
            </div>
        </section>
        <!--====== Dashboard Section End ======-->

        
        <!--====== Feedback Section Start ======-->
        <section class="feedback-section-three bg-blue rel z-1 py-115 rpy-85" style="background-image: url(assets/images/feedbacks/feedback-bg.png);">
            <div class="container">
               <div class="row">
                    <div class="col-xl-4">
                        <div class="feedback-three-content mt-15 text-white wow fadeInUp delay-0-2s">
                            <div class="section-title mb-25">
                                <span class="sub-title">Clientes Satisfechos</span>
                                <h2>Lo Que Nuestros Clientes Dicen Sobre Nosotros</h2>
                            </div>
                            <p>Estas experiencias son totalmente reales y reflejan nuestro compromiso con la excelencia en cada proyecto.</p>
                            <div class="slider-dots-area mt-25"></div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="feedback-three-wrap">
                            <div class="feedback-item-two wow fadeInUp delay-0-4s">
                                <img src="assets/images/sinergio.png" alt="Logo">
                                <p> Conozco a su responsable desde 2017 y también su trayectoria profesional marcada por su constante evolución. Hemos colaborado en algunos proyectos, llevando ellos la parte de desarrollo web, aplicaciones y programación. Tienen un equipo muy profesional con el que pueden abarcar distintos planes y enfoques. He visto sus recientes trabajos y me inspiran confianza, se nota su tendencia innovadora.</p>
                                <div class="feedback-author">
                                    <i class="flaticon-quote-1"></i>
                                    <div class="author-content">
                                        <h3>Jesús Beltrán</h3>
                                        <a href="https://sinergio.es/">
                                           <span>Dinamizador y gestor de SINERGIO</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="feedback-item-two wow fadeInUp delay-0-6s">
                                <img src="assets/images/leathertech.png" alt="Logo" style="transform: scale(1.2)">
                                <p>En nuestra experiencia con INNOVABYTE hemos recibido un trato muy cercano, casi familiar, y al mismo tiempo totalmente profesional. Han entendido perfectamente nuestras necesidades y nos han acompañado en cada paso del desarrollo. Los recomendamos al 100%.</p>
                                <div class="feedback-author">
                                    <i class="flaticon-quote-1"></i>
                                    <div class="author-content">
                                        <h3>Sara Barba</h3>
                                        <a href="https://leathertechworld.com">
                                           <span>Leathertech Valencia</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="feedback-item-two wow fadeInUp delay-0-8s">
                                <img src="assets/images/grupoastillero.png" alt="Logo">
                                <p>Confío plenamente en Luis Carlos Pérez, no solo como informático y como persona, sino que además destaco su consumada empatía con sus interlocutores para resolver todas las necesidades y dar solución a las acciones solicitadas y a las que él aporta.</p>
                                <div class="feedback-author">
                                    <i class="flaticon-quote-1"></i>
                                    <div class="author-content">
                                        <h3>Pedro Astillero</h3>
                                        <a href="https://grupoastillero.com">
                                           <span>CEO, “Grupo Astillero"</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--====== Feedback Section End ======-->

       
        <!--====== Partner Section Start ======-->
        <!-- <div class="partner-area-three text-center pt-130 rpt-100">
            <div class="container">
                <div class="row justify-content-around justify-content-lg-between mb-80 rmb-50">
                    <div class="col-lg-2 col-md-4 col-6">
                        <a class="partner-item-three wow fadeInUp delay-0-2s" href="project-details.html">
                            <img src="assets/images/grupoastillero.png" alt="Partner">
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <a class="partner-item-three wow fadeInUp delay-0-4s" href="project-details.html">
                            <img src="assets/images/leathertech.png" alt="Partner">
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <a class="partner-item-three wow fadeInUp delay-0-6s" href="project-details.html">
                            <img src="assets/images/sinergio.png" alt="Partner">
                        </a>
                    </div> -->
                    <!-- <div class="col-lg-2 col-md-4 col-6"> -->
                        <!-- <a class="partner-item-three wow fadeInUp delay-0-8s" href="project-details.html"> -->
                            <!-- <img src="assets/images/partners/partner-three-white4.png" alt="Partner"> -->
                        <!-- </a> -->
                    <!-- </div> -->
                    <!-- <div class="col-lg-2 col-md-4 col-6"> -->
                        <!-- <a class="partner-item-three wow fadeInUp delay-1-0s" href="project-details.html"> -->
                            <!-- <img src="assets/images/partners/partner-three-white5.png" alt="Partner"> -->
                        <!-- </a> -->
                    <!-- </div>  -->
                <!-- </div>
                <hr>
            </div>
        </div> -->
        <!--====== Partner Section End ======-->


        <!--====== How We Work Section Start ======-->
        <section class="how-we-work-section bg-lighter rel z-1 pt-130 rpt-100 pb-100 rpb-70">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-xl-7 col-lg-8 col-md-10">
                        <div class="section-title mb-55">
                            <span class="sub-title">¿Cómo trabajamos?</span>
                            <h2>Nuestro método y pasos clave para llevar tu proyecto adelante</h2>
                            <p>Diseñado para empresas que buscan soluciones a medida.</p>
                        </div>
                    </div>
                </div>
                
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10 col-md-12">
                        <div class="work-step-item wow fadeInUp delay-0-2s">
                            <div class="step-number">01</div>
                            <div class="content">
                                <h3>Análisis inicial</h3>
                                <p>Se identifican las necesidades y expectativas del cliente sobre el proyecto a desarrollar.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10 col-md-12">
                        <div class="work-step-item wow fadeInUp delay-0-4s">
                            <div class="step-number">02</div>
                            <div class="content">
                                <h3>Propuesta</h3>
                                <p>Se realiza una propuesta de valor en base a soluciones tecnológicas eficaces y recursos disponibles.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10 col-md-12">
                        <div class="work-step-item wow fadeInUp delay-0-6s">
                            <div class="step-number">03</div>
                            <div class="content">
                                <h3>Desarrollo/Instalación</h3>
                                <p>Durante la fase de desarrollo, mantenemos una comunicación continua con el cliente, realizando entregas parciales del proyecto para garantizar que el avance se ajuste a tus expectativas.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10 col-md-12">
                        <div class="work-step-item wow fadeInUp delay-0-8s">
                            <div class="step-number">04</div>
                            <div class="content">
                                <h3>Puesta en marcha/pruebas</h3>
                                <p>No te dejamos solo en el momento clave: durante la Puesta en Marcha, nuestro equipo está a tu lado, asegurando que la implantación sea exitosa y adaptándonos a tus necesidades reales sobre el terreno.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10 col-md-12">
                        <div class="work-step-item wow fadeInUp delay-1-0s">
                            <div class="step-number">05</div>
                            <div class="content">
                                <h3>Mantenimiento</h3>
                                <p>Tras la implantación, ofrecemos un plan de mantenimiento que cubre correcciones, actualizaciones y soporte técnico inmediato para resolver incidencias sin interrupciones en tu operativa.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--====== How We Work Section End ======-->


      
        <!--====== Contact Section Start ======-->
        <section class="contact-section-two rel z-1 pt-115 rpt-85 pb-130 rpb-55">
            <div class="container">
               <div class="row justify-content-center text-center">
                   <div class="col-xl-6 col-lg-8 col-md-10">
                       <div class="section-title mb-50">
                            <span class="sub-title">Cuéntanos tu proyecto</span>
                            <h2>Mándanos tu idea y nos pondremos en contacto contigo.</h2>
                        </div>
                   </div>
               </div>
                <div class="contact-information-area pb-50">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="contact-info-item wow fadeInUp delay-0-2s">
                                <i class="fas fa-envelope-open"></i>
                                <div class="contact-info-content">
                                    <h3>Email </h3>
                                    <span><a href="mailto:info@innovabyte.es">info@innovabyte.es</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="contact-info-item wow fadeInUp delay-0-4s">
                                <i class="fas fa-phone"></i>
                                <div class="contact-info-content">
                                    <h3>Teléfono</h3>
                                    <span><a href="calto:+647124790">+034 647 124 790</a></span>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-4 col-md-6">
                            <div class="contact-info-item wow fadeInUp delay-0-6s">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="contact-info-content">
                                    <h3>Address</h3>
                                    <span>55 Main Street, USA</span>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="row justify-content-center">
                    <!-- <div class="col-lg-6">
                        <div class="contact-left-map h-100 pr-xl-5 rpb-20 wow fadeInLeft delay-0-2s">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d136834.1519573059!2d-74.0154445224086!3d40.7260256534837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1639991650837!5m2!1sen!2sbd" style="border:0; width: 100%; height: 100%;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div> -->
                    <div class="col-lg-8 col-xl-6">
                        <form id="contact-form-two" class="contact-form-two py-45 wow fadeInUp delay-0-2s" action="#" method="post">
                            
                            <?php if ($contacto_mensaje_enviado): ?>
                                <div class="alert alert-success mb-4" style="background-color: #28a745; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                                    <i class="fas fa-check-circle"></i> <?php echo $contacto_mensaje_enviado; ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($contacto_error_mensaje): ?>
                                <div class="alert alert-danger mb-4" style="background-color: #dc3545; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                                    <i class="fas fa-exclamation-triangle"></i> <?php echo $contacto_error_mensaje; ?>
                                </div>
                            <?php endif; ?>
                            
                            <input type="hidden" name="contact_form" value="1">
                            
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Nombre completo" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" id="number" name="number" class="form-control" placeholder="Teléfono" value="<?php echo isset($_POST['number']) ? htmlspecialchars($_POST['number']) : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" id="company" name="company" class="form-control" placeholder="Empresa" value="<?php echo isset($_POST['company']) ? htmlspecialchars($_POST['company']) : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" id="subject" name="subject" class="form-control" placeholder="Asunto" value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="url" id="website" name="website" class="form-control" placeholder="Sitio web" value="<?php echo isset($_POST['website']) ? htmlspecialchars($_POST['website']) : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <textarea name="message" id="message" rows="4" class="form-control" placeholder="Mensaje" required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <button class="theme-btn" type="submit" id="contact-submit-btn">
                                            <span class="btn-text">Enviar</span>
                                            <span class="btn-loading" style="display: none;">Enviando...</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <script>
                            document.getElementById('contact-form-two').addEventListener('submit', function() {
                                const btn = document.getElementById('contact-submit-btn');
                                const btnText = btn.querySelector('.btn-text');
                                const btnLoading = btn.querySelector('.btn-loading');
                                
                                // Mostrar estado de carga
                                btnText.style.display = 'none';
                                btnLoading.style.display = 'inline';
                                btn.disabled = true;
                                
                                // Si hay errores, restaurar el botón después de un momento
                                setTimeout(function() {
                                    if (document.querySelector('.alert-danger')) {
                                        btnText.style.display = 'inline';
                                        btnLoading.style.display = 'none';
                                        btn.disabled = false;
                                    }
                                }, 1000);
                            });
                            
                            // Auto-scroll a mensajes de éxito/error del formulario de contacto
                            <?php if ($contacto_mensaje_enviado || $contacto_error_mensaje): ?>
                            setTimeout(function() {
                                document.getElementById('contact-form-two').scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });
                            }, 500);
                            <?php endif; ?>
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!--====== Contact Section End ======-->
       
       
       <!--====== Blog Section Start ======-->
        <!-- <section class="blog-section-two bg-lighter rel z-1 pt-130 rpt-100 pb-180 rpb-150">
            <div class="container">
               <div class="row">
                    <div class="col-xl-4 col-lg-8 col-md-10">
                        <div class="blog-two-section-content mb-55 wow fadeInUp delay-0-2s">
                            <div class="section-title mb-25">
                                <span class="sub-title">Latest News & Blog</span>
                                <h2>Get Our Every Single Update Latest News and Blog</h2>
                            </div>
                            <a href="blog.html" class="theme-btn style-three">View More News <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="blog-item-two wow fadeInUp delay-0-4s">
                            <div class="blog-two-image" style="background-image: url(assets/images/blog/blog-two.jpg);"></div>
                            <ul class="blog-meta">
                                <li><i class="far fa-calendar-alt"></i> <a href="blog-details.html">25 March 2022</a></li>
                                <li><i class="far fa-comments"></i> <a href="#">Com (5)</a></li>
                            </ul>
                            <h3><a href="blog-details.html">Smashin Podcast Episode Web Frameworks Solve Vanilla</a></h3>
                            <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized the charms of pleasure</p>
                            <a href="blog-details.html" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="blog-item-two wow fadeInUp delay-0-6s">
                            <div class="blog-two-image" style="background-image: url(assets/images/blog/blog-two.jpg);"></div>
                            <ul class="blog-meta">
                                <li><i class="far fa-calendar-alt"></i> <a href="blog-details.html">25 March 2022</a></li>
                                <li><i class="far fa-comments"></i> <a href="#">Com (5)</a></li>
                            </ul>
                            <h3><a href="blog-details.html">Designing Better Links Wesites And Emails A Guideline</a></h3>
                            <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized the charms of pleasure</p>
                            <a href="blog-details.html" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!--====== Blog Section End ======-->
        
       
        <!--====== Footer Section Start ======-->
        <footer class="footer-section footer-two bg-gray text-white rel z-1">
            <?php include "./assets/templates/mainfooter.php"; ?>
        </footer>
        <!--====== Footer Section End ======-->

    </div>
    <!--End pagewrapper-->


    <!-- Scroll Top Button -->
    <button class="scroll-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></button>

 <?php include 'assets/templates/mainjs.php'; ?>

</body>

</html>