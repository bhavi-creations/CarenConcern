<!-- Footer -->
<footer class="footer bg-light pt-5">
    <div class="container">

        <!-- Footer Content -->
        <div class="row footer-content">

            <!-- Footer Info -->
            <div class="col-lg-3 mb-4 footer-info">
                <h4><span class="denta ">Care</span> &nbsp; N  &nbsp;<span class="care">Consurn</span></h4>
                <!-- <p><strong>Denta Care Health Ventures LLP</strong></p> -->
                <p class="mt-5">2462/37, 7th B Main Road, Hampinagar, RPC Layout, Vijayanagar, Bengaluru, Karnataka 560104</p>
                <p class="mt-3"><strong>Call us:</strong> 63638 00266 | +91 98458 02787</p>
                <p class="mt-2"><strong>Email us:</strong> mail@hontistry.com</p>
                <p class="mt-2"><strong>Clinic Hours:</strong> 10.00 AM - 7.00 PM (Everyday)</p>
            </div>

            <!-- Available Treatments -->
            <div class="col-lg-3 mb-4 d-none d-md-block col-md-6 footer-links">
                <h5>General Dentistry</h5>
                <ul class="list-unstyled mt-5">
                    <li><a href="root_canal.php" class="text-decoration-none">Root Canal</a></li>
                    <li><a href="teeth_cleaning.php" class="text-decoration-none">Teeth Cleaning</a></li>
                    <li><a href="crowns&bridges.php" class="text-decoration-none">Crowns & Bridges</a></li>
                    <li><a href="teeth_removal.php" class="text-decoration-none">Painless Teeth Removal</a></li>
                    <li><a href="tooth_colored_fillings.php" class="text-decoration-none">Tooth Colored Fillings</a></li>
                    <li><a href="jaw_fractures.php" class="text-decoration-none">Fixing Jaw Fractures</a></li>

                    
                </ul>
            </div>


            <div class="col-lg-3 mb-4 d-none d-md-block col-md-6 footer-links">
                <h5>specialised Treatments</h5>
                <ul class="list-unstyled mt-5">
                <li><a href="#teeth-whitening" class="text-decoration-none">Basal Implants</a></li>
                    <li><a href="teeth_whitening.php" class="text-decoration-none">Teeth Whitening</a></li>
                    <li><a href="laser_dentistry.php" class="text-decoration-none">Laser Dentistry</a></li>
                   
                    <li><a href="clear_aligners.php" class="text-decoration-none">Clear Aligners</a></li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-3 mb-4  d-none d-md-block col-md-6 footer-links">
                <h5>Quick Links</h5>
                <ul class="list-unstyled mt-5">
                    <li><a href="index.php" class="text-decoration-none">Home</a></li>
                    <li><a href="about.php" class="text-decoration-none">About us</a></li>
                    <li><a href="service.php" class="text-decoration-none">Our Treatments</a></li>
                    <li><a href="clinic.php" class="text-decoration-none">Our Clinics</a></li>
                    <li><a href="blog.php" class="text-decoration-none">Blogs</a></li>
                    <li><a href="contact.php" class="text-decoration-none">Contact us</a></li>
                    <li><a href="appointment.php" class="text-decoration-none">Book Appointment</a></li>
                </ul>
            </div>

        </div>

        <hr>

        <!-- Footer Bottom -->
        <div class="row footer-bottom align-items-center">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                <p class="mb-0 text-muted">© 2025 Care n concern dental hospital. ALL RIGHTS RESERVED
                    <a href="https://bhavicreations.com/" target="_blank" class="text-decoration-none">bhavicreations</a>
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="https://www.facebook.com/hontistry" class="text-decoration-none social_media me-2"><i class="fab fa-facebook"></i> Facebook</a>
                <a href="https://www.youtube.com/channel/UCmE0BrRzE5dzfljOoCx_PuQ" class="text-decoration-none  social_media me-2"><i class="fab fa-youtube"></i> Youtube</a>
                <a href="#" class="text-decoration-none social_media me-2"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="https://www.linkedin.com/company/hontistry/" class="text-decoration-none social_media"><i class="fab fa-linkedin"></i> LinkedIn</a>
            </div>
        </div>

    </div>
</footer>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Active navigation based on scroll
    window.addEventListener('scroll', function() {
        let current = '';
        const sections = document.querySelectorAll('section[id]');

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= (sectionTop - 200)) {
                current = section.getAttribute('id');
            }
        });

        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    });
</script>
<!-- img slider code   -->
<script>
    var swiper = new Swiper(".custom-slide-content", {
        slidesPerView: 3,
        spaceBetween: 25,
        loop: true,
        centerslide: 'true',
        fade: 'true',
        grabCursor: 'true',
        pagination: {
            el: ".custom-swiper-pagination",
            clickable: true,
            dynamicBullets: true,
        },
        autoplay: {
            delay: 3000, // Time in milliseconds between automatic slides (3 seconds here)
            disableOnInteraction: false, // Keeps autoplay active even after manual swiping
        },
        navigation: {
            nextEl: ".swiper-button-next.custom-swiper-navBtn",
            prevEl: ".swiper-button-prev.custom-swiper-navBtn",
        },

        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            520: {
                slidesPerView: 2,
            },
            950: {
                slidesPerView: 3,
            },
        },
    });
</script>


<!-- slider code  for doctor  -->

<script>
    let currentIndex = 0;
    const track = document.getElementById('carouselTrack');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const cards = document.querySelectorAll('.doctor-card-container');
    const totalCards = cards.length;

    // Determine cards per view based on screen size
    function getCardsPerView() {
        if (window.innerWidth >= 992) return 3;
        if (window.innerWidth >= 768) return 2;
        return 1;
    }

    function updateCarousel() {
        const cardsPerView = getCardsPerView();
        const cardWidth = 100 / cardsPerView;
        const offset = -currentIndex * cardWidth;
        track.style.transform = `translateX(${offset}%)`;

        // Update button states
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex >= totalCards - cardsPerView;
    }

    function nextSlide() {
        const cardsPerView = getCardsPerView();
        if (currentIndex < totalCards - cardsPerView) {
            currentIndex++;
            updateCarousel();
        }
    }

    function prevSlide() {
        if (currentIndex > 0) {
            currentIndex--;
            updateCarousel();
        }
    }

    prevBtn.addEventListener('click', prevSlide);
    nextBtn.addEventListener('click', nextSlide);

    // Handle window resize
    window.addEventListener('resize', () => {
        const cardsPerView = getCardsPerView();
        if (currentIndex > totalCards - cardsPerView) {
            currentIndex = Math.max(0, totalCards - cardsPerView);
        }
        updateCarousel();
    });

    // Initialize
    updateCarousel();
</script>
</body>

</html>