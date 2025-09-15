 <!--====== Jquery ======-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <!--====== Bootstrap ======-->
    <script src="assets/js/bootstrap.4.5.3.min.js"></script>
    <!--====== Appear js ======-->
    <script src="assets/js/appear.js"></script>
    <!--====== WOW js ======-->
    <script src="assets/js/wow.min.js"></script>
    <!--====== Isotope ======-->
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <!--====== Circle Progress ======-->
    <script src="assets/js/circle-progress.min.js"></script>
    <!--====== Image loaded ======-->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <!--====== Nice Select ======-->
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <!--====== Magnific ======-->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!--====== Slick Slider ======-->
    <script src="assets/js/slick.min.js"></script>
    <!--====== Main JS ======-->
    <script src="assets/js/script.js"></script>
    <!--====== Cookie Banner ======-->
    <script src="assets/js/cookies.js"></script>


          
    <script>
        // JavaScript para el slider de proyectos
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.querySelector('.project-slider');
            const slides = document.querySelectorAll('.project-slide');
            const prevBtn = document.querySelector('.prev-btn');
            const nextBtn = document.querySelector('.next-btn');
            const dots = document.querySelectorAll('.dot');
            
            let currentSlide = 0;
            const totalSlides = slides.length;
            
            // Función para ir a una diapositiva específica
            function goToSlide(slideIndex) {
                currentSlide = slideIndex;
                slider.style.transform = `translateX(-${currentSlide * 100}%)`;
                
                // Actualizar dots
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentSlide);
                });
            }
            
            // Función para ir a la siguiente diapositiva
            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                goToSlide(currentSlide);
            }
            
            // Función para ir a la diapositiva anterior
            function prevSlide() {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                goToSlide(currentSlide);
            }
            
            // Event listeners para los botones
            nextBtn.addEventListener('click', nextSlide);
            prevBtn.addEventListener('click', prevSlide);
            
            // Event listeners para los dots
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => goToSlide(index));
            });
            
            // Auto-play del slider (opcional)
            setInterval(nextSlide, 5000); // Cambia cada 5 segundos
            
            // Pausar auto-play cuando el usuario interactúa
            const sliderWrap = document.querySelector('.project-slider-wrap');
            sliderWrap.addEventListener('mouseenter', () => {
                clearInterval(autoPlay);
            });
            
            // Soporte para gestos táctiles (móviles)
            let startX = 0;
            let isDragging = false;
            
            sliderWrap.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                isDragging = true;
            });
            
            sliderWrap.addEventListener('touchmove', (e) => {
                if (!isDragging) return;
                e.preventDefault();
            });
            
            sliderWrap.addEventListener('touchend', (e) => {
                if (!isDragging) return;
                isDragging = false;
                
                const endX = e.changedTouches[0].clientX;
                const diff = startX - endX;
                
                if (Math.abs(diff) > 50) { // Mínimo movimiento para activar
                    if (diff > 0) {
                        nextSlide();
                    } else {
                        prevSlide();
                    }
                }
            });
        });
    </script>
