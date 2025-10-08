<!DOCTYPE html>
<html lang="es">

<head>
    <!--====== Required meta tags ======-->
     <?php include "./assets/templates/mainhead.php"; ?>
</head>

<body class="home-three dark-body">
<?php
// Procesar el formulario de contacto
$mensaje_enviado = '';
$error_mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['email'], $_POST['message'])) {
    require_once 'phpmailer_config.php';
    $nombre = htmlspecialchars(trim($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $website = isset($_POST['website']) ? htmlspecialchars(trim($_POST['website'])) : '';
    $mensaje = htmlspecialchars(trim($_POST['message']));
    $errores = [];
    if (empty($nombre)) $errores[] = 'El nombre es obligatorio.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = 'El email no es válido.';
    if (empty($mensaje)) $errores[] = 'El mensaje es obligatorio.';
    if (empty($errores)) {
        try {
            $mailer = new InnovaByteMailer();
            $template = $mailer->getTemplate('contact');
            $config = [
                'to' => $mailer->getDefaultRecipient('contact'),
                'reply_to' => $email,
                'reply_to_name' => $nombre,
                'subject' => $template['subject'] ?? 'Nuevo mensaje de contacto - InnovaByte',
                'body' => 
                
                // "<h3>Nuevo mensaje desde el formulario de contacto</h3>"
                //     . "<p><strong>Nombre:</strong> $nombre</p>"
                //     . "<p><strong>Email:</strong> $email</p>"
                //     . (!empty($website) ? "<p><strong>Web:</strong> $website</p>" : '')
                //     . "<p><strong>Mensaje:</strong><br>" . nl2br($mensaje) . "</p>"
                //     . "<hr><small>Enviado el " . date('d/m/Y H:i:s') . ", IP: {$_SERVER['REMOTE_ADDR']}</small>",

               /****************************************************************/
               /*                       BODY ALTERNATIVO                       */
               /****************************************************************/
               "<h3>Nuevo mensaje desde el formulario de contacto</h3>
                                   <div style='background: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px;'>
                                       <h4 style='color: #007bff; margin-top: 0;'>Datos del Contacto</h4>
                                       <table style='border-collapse: collapse; width: 100%;'>
                                           <tr>
                                               <td style='padding: 8px; border: 1px solid #ddd; background: #f8f9fa; width: 150px;'><strong>Nombre:</strong></td>
                                               <td style='padding: 8px; border: 1px solid #ddd;'>$nombre</td>
                                           </tr>
                                           <tr>
                                               <td style='padding: 8px; border: 1px solid #ddd; background: #f8f9fa;'><strong>Email:</strong></td>
                                               <td style='padding: 8px; border: 1px solid #ddd;'>$email</td>
                                           </tr>
                                           <?php if (!empty($website)) { ?>
                                           <tr>
                                               <td style='padding: 8px; border: 1px solid #ddd; background: #f8f9fa;'><strong>Sitio web:</strong></td>
                                               <td style='padding: 8px; border: 1px solid #ddd;'>$website</td>
                                           </tr>
                                           <?php } ?>
                                       </table>
                                   </div>
                                   
                                   <div style='background: #e7f3ff; padding: 20px; border-radius: 5px; margin-bottom: 20px;'>
                                       <h4 style='color: #007bff; margin-top: 0;'>Mensaje</h4>
                                       <div style='background: white; padding: 15px; border-radius: 3px; border-left: 4px solid #007bff;'>
                                           " . nl2br($mensaje) . "
                                       </div>
                                   </div>
                                   
                                   <div style='background: #f0f0f0; padding: 15px; border-radius: 5px; font-size: 12px; color: #666;'>
                                       <p><strong>Fecha:</strong> " . date('d/m/Y H:i:s') . "</p>
                                       <p><strong>IP:</strong> {$_SERVER['REMOTE_ADDR']}</p>
                                       <p><strong>User Agent:</strong> {$_SERVER['HTTP_USER_AGENT']}</p>
                                   </div>", 
               /***************************************************************/
               /*                      FIN BODY ALTERNATIVO                   */
               /***************************************************************/


                'success_message' => $template['success_message'] ?? '¡Gracias! Tu mensaje ha sido enviado correctamente. Te responderemos pronto.',
                'error_message' => 'Error al enviar el mensaje. Por favor, inténtalo de nuevo.'
            ];
            $resultado = $mailer->enviarEmail($config);
            if ($resultado['success']) {
                $mensaje_enviado = $resultado['message'];
                $_POST = [];
            } else {
                $error_mensaje = $resultado['message'];
            }
        } catch (Exception $e) {
            $error_mensaje = 'Error: PHPMailer no está instalado correctamente. ' . $e->getMessage();
        }
    } else {
        $error_mensaje = implode('<br>', $errores);
    }
}
?>
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


       <!--====== Page Banner Start ======-->
        <section class="page-banner bg-blue rel z-1" style="background-image: url(assets/images/background/banner-bg.png);">
            <div class="container">
                <div class="banner-inner">
                    <h1 class="page-title wow fadeInUp delay-0-2s">Contacto</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb wow fadeInUp delay-0-4s">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Contacto</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <img class="dots-shape" src="assets/images/shapes/white-dots-two.png" alt="Shape">
            <img class="tringle-shape slideLeftRight" src="assets/images/shapes/white-tringle.png" alt="Shape">
            <img class="close-shape" src="assets/images/shapes/white-close.png" alt="Shape">
            <img src="assets/images/newsletter/circle.png" alt="shape" class="banner-circle slideUpRight">
            <img class="dots-shape-three slideUpDown delay-1-5s" src="assets/images/shapes/white-dots-three.png" alt="Shape">
        </section>
        <!--====== Page Banner End ======-->


  <!--====== Contact Us Start ======-->
        <section class="contact-page-section pt-130 rpt-100 pb-150 rpb-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-content-area mr-xl-5 rmb-35 wow fadeInLeft delay-0-2s">
                            <div class="section-title mb-15">
                                <span class="sub-title">Contacto</span>
                                <h2>¿En qué podemos ayudarte? ¡Cuéntanos tu proyecto!</h2>
                            </div>
                            <p>Cuéntanos tu idea, consulta o proyecto y te responderemos lo antes posible. Nuestro equipo está preparado para ayudarte a encontrar la mejor solución digital para tu empresa.</p>
                            <div class="row pt-25">
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="contact-info-item style-two">
                                        <i class="fas fa-envelope-open"></i>
                                        <div class="contact-info-content">
                                            <h5>Email</h5>
                                            <span><a href="mailto:support@gmail.com">info@innovabyte.es</a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="contact-info-item style-two">
                                         <i class="fas fa-phone"></i>
                                        <div class="contact-info-content">
                                            <h5>Teléfono</h5>
                                            <span><a href="callto:+0123456789">+34 647 12 47 90</a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="contact-info-item style-two">
                                        <i class="fas fa-globe"></i>
                                        <div class="contact-info-content">
                                            <h5>Website</h5>
                                            <span><a href="creativedesign.net" target="_blank">https://innovabyte.es</a></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="contact-info-item style-two">
                                        <i class="fas fa-envelope-open"></i>
                                        <div class="contact-info-content">
                                            <h5>Location</h5>
                                            <span>55 Main Street, USA</span>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-form-area wow fadeInRight delay-0-2s">
                            <div class="section-title">
                                <span class="sub-title">Formulario de contacto</span>
                                <h2>Envíanos tu mensaje y te responderemos lo antes posible</h2>
                            </div>
                            <form id="contact-page-form" class="contact-form-three pt-35" action="#" method="post">
                                <?php if ($mensaje_enviado): ?>
                                    <div class="alert alert-success" role="alert" style="margin-bottom:20px;"> 
                                        <?php echo $mensaje_enviado; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($error_mensaje): ?>
                                    <div class="alert alert-danger" role="alert" style="margin-bottom:20px;"> 
                                        <?php echo $error_mensaje; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="url" id="website" name="website" class="form-control" placeholder="website">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="message" id="message" rows="4" class="form-control" placeholder="mensaje" required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            <button class="theme-btn" type="submit">enviar mensaje <i class="fas fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </section>
        <!--====== Contact Us End ======-->






              
     
              
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

              
        <!--====== Footer Section Start ======-->
        <footer class="footer-section footer-two bg-gray text-white rel z-1">
            <?php include "./assets/templates/mainfooter.php"; ?>
        </footer>
        <!--====== Footer Section End ======-->

    </div>
    <!--End pagewrapper-->


    <!-- Scroll Top Button -->
    <button class="scroll-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></button>

    <?php include 'assets/templates/codigo-amigo-modal.php'; ?>

 <?php include 'assets/templates/mainjs.php'; ?>

</body>

</html>