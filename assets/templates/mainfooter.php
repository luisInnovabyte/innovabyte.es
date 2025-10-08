        <div class="container">
              
               <div class="call-to-action bg-blue bgs-cover text-white rel z-1">
                    <div class="row align-items-center">
                        <div class="col-xl-7 col-lg-6">
                            <div class="section-title mb-20">
                                <h2>¿Necesitas una solución inmediata?</h2>
                                <p>Tenemos productos ya desarrollados y probados, listos para implementar en tu empresa</p>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6">
                            <div class="call-to-action-btns text-xl-right mb-20">
                                <!-- <a href="edulink360.php" class="theme-btn style-three rmb-15" title="Gestión centros educativos" data-tooltip="Gestión centros educativos">Edulink 360 <i class="fas fa-arrow-right"></i></a> -->
                                <a href="edulink360.php" class="theme-btn style-three rmb-15" data-tooltip="Gestión centros educativos">Edulink 360 <i class="fas fa-arrow-right"></i></a>
                                <a href="routeline.php" class="theme-btn style-three rmb-15" data-tooltip="Gestión comercial">Routline + <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <img class="white-circle" src="assets/images/shapes/white-circle.png" alt="White Circle">
                    <img class="white-dots slideUpRight" src="assets/images/shapes/white-dots.png" alt="shape">
                    <img class="white-dots-circle slideLeftRight" src="assets/images/shapes/white-dots-circle.png" alt="shape">
                </div>
                
                <div class="row justify-content-between">
                    <div class="col-xl-3 col-sm-6 col-7 col-small">
                        <div class="footer-widget about-widget">
                            <div class="footer-logo mb-20">
                                <a href="index.html"><img src="assets/images/logos/logo-white.png" alt="Logo"></a>
                            </div>
                            <p><span>No solo desarrollamos e implementamos software, nos convertimos en </span>
                                <b>tu partner tecnológico</b> <span>para acompañarte en cada etapa de tu crecimiento.</span>
                            </p>
                            <a href="about.php" class="read-more">Saber más <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-4 col-5 col-small">
                        <div class="footer-widget link-widget">
                            <h4 class="footer-title">Legal</h4>
                            <ul class="list-style-two">
                                <li><a href="avisoLegal.php">Aviso Legal</a></li>
                                <li><a href="privacidad.php">Politica de privacidad</a></li>
                                <li><a href="cookies.php">Politica de cookies</a></li>
                                <!-- <li><a href="contact.html">Need a Career?</a></li>
                                <li><a href="single-service.html">Popular Service</a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-8">
                        <div class="footer-widget link-widget">
                            <h4 class="footer-title">Accesos rápidos</h4>
                            <ul class="list-style-two two-column">
                                <li><a href="programacion_medida.php">Desarrollo a medida</a></li>
                                <li><a href="ecommerce.php">Tiendas on-line</a></li>
                                <li><a href="edulink360.php">Edulink 360</a></li>
                                <li><a href="routeline.php">Routline + </a></li>
                                <li><a href="#" data-toggle="modal" data-target="#codigoAmigoModal">Código Amigo</a></li>
                                
                                <!-- <li><a href="single-service.html">Graphics Design</a></li>
                                <li><a href="single-service.html">Consultations</a></li>
                                <li><a href="single-service.html">Application Design</a></li>
                                <li><a href="single-service.html">Success Rate</a></li>
                                <li><a href="single-service.html">SEO Optimization</a></li>
                                <li><a href="single-service.html">User Research</a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-4">
                        <div class="footer-widget contact-widget">
                            <h4 class="footer-title">Contacto</h4>
                            <ul class="list-style-three">
                                <!-- <li><i class="fas fa-map-marker-alt"></i> <span>Calle Pr</span></li> -->
                                <li><i class="fas fa-envelope-open"></i> <span><a href="mailto:info@innovabyte.es">info@innovabyte.es</a></span></li>
                                <li><i class="fas fa-phone"></i> <span><a href="callto:+034 647124790">+034 647 124 790</a></span></li>
                            </ul>
                            <div class="social-style-one mt-25">
                                <a href="https://www.facebook.com/innovabyte.es"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.instagram.com/innovabyte.es/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Botón de gestión de cookies -->
                <div class="cookie-settings-btn">
                    <button onclick="manageCookies()" class="cookie-manage-btn" title="Gestionar cookies">
                        <i class="fas fa-cookie-bite"></i> Cookies
                    </button>
                </div>
                
                <div class="copyright-area text-center pt-30 pb-15">
                    &copy; <?php echo date('Y'); ?> InnovaByte. All rights reserved</p>
                </div>

                <style>
                .cookie-settings-btn {
                    position: fixed;
                    bottom: 20px;
                    left: 20px;
                    z-index: 1000;
                }

                .cookie-manage-btn {
                    background: #CC7700;
                    color: white;
                    border: none;
                    padding: 12px 16px;
                    border-radius: 25px;
                    font-size: 12px;
                    font-weight: 600;
                    cursor: pointer;
                    box-shadow: 0 4px 12px rgba(204, 119, 0, 0.3);
                    transition: all 0.3s ease;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                }

                .cookie-manage-btn:hover {
                    background: #ff9500;
                    transform: translateY(-2px);
                    box-shadow: 0 6px 16px rgba(204, 119, 0, 0.4);
                    color: white;
                    text-decoration: none;
                }

                .cookie-manage-btn i {
                    font-size: 14px;
                }

                /* Estilos para tooltip personalizado */
                [data-tooltip] {
                    position: relative;
                }

                [data-tooltip]:before {
                    content: attr(data-tooltip);
                    position: absolute;
                    bottom: 120%;
                    left: 50%;
                    transform: translateX(-50%);
                    background: rgba(0, 0, 0, 0.9);
                    color: white;
                    padding: 8px 12px;
                    border-radius: 6px;
                    font-size: 12px;
                    font-weight: 500;
                    white-space: nowrap;
                    opacity: 0;
                    visibility: hidden;
                    transition: all 0.3s ease;
                    z-index: 1000;
                    backdrop-filter: blur(10px);
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
                }

                [data-tooltip]:after {
                    content: '';
                    position: absolute;
                    bottom: 110%;
                    left: 50%;
                    transform: translateX(-50%);
                    border: 5px solid transparent;
                    border-top-color: rgba(0, 0, 0, 0.9);
                    opacity: 0;
                    visibility: hidden;
                    transition: all 0.3s ease;
                    z-index: 1000;
                }

                [data-tooltip]:hover:before,
                [data-tooltip]:hover:after {
                    opacity: 1;
                    visibility: visible;
                }

                @media (max-width: 768px) {
                    .cookie-settings-btn {
                        bottom: 80px;
                        left: 15px;
                    }
                    
                    .cookie-manage-btn {
                        padding: 10px 14px;
                        font-size: 11px;
                    }

                    /* Tooltip responsive */
                    [data-tooltip]:before {
                        font-size: 11px;
                        padding: 6px 10px;
                    }
                }
                </style>

                <script>
                function manageCookies() {
                    // Redirigir a la página de cookies
                    window.location.href = 'cookies.php';
                }
                </script>
            </div>

            <img class="dots-shape" src="assets/images/shapes/dots.png" alt="Shape">
            <img class="tringle-shape" src="assets/images/shapes/tringle.png" alt="Shape">
            <img class="close-shape" src="assets/images/shapes/close.png" alt="Shape">
            <img class="circle-shape" src="assets/images/shapes/circle.png" alt="Shape">