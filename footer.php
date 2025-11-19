<!-- Footer -->
<footer class="footer">
    <div class="container">

        <div class="footer-content">
            <div class="footer-info">
                <h4><span class="denta">DENTA</span> <span class="care">CARE</span></h4>
                <p><strong>Denta Care Health Ventures LLP</strong></p>
                <p>2462/37, 7th B Main Road, Hampinagar, RPC Layout, Vijayanagar, Bengaluru, Karnataka 560104</p>
                <br>
                <p><strong>Call us:</strong> 63638 00266 | +91 98458 02787</p>
                <br>
                <p><strong>Email us:</strong> mail@hontistry.com</p>
                <br>
                <p><strong>Clinic Hours:</strong> 10.00 AM - 7.00 PM (Everyday)</p>
            </div>

            <div class="footer-links">
                <h5>Available Treatments</h5>
                <ul>
                    <li><a href="#dentures">Teeth Cleaning</a></li>
                    <li><a href="#braces">Crowns & Bridges</a></li>
                    <li><a href="#invisalign">Painless Teeth Removal ​</a></li>
                    <li><a href="#teeth-cleaning">Tooth Colored Fillings</a></li>
                    <li><a href="#teeth-whitening">Basal Implants</a></li>
                    <li><a href="#root-canals">Teeth Whitening</a></li>
                    <li><a href="#implants">Laser Dentistry</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="index.php">Home</a></li>

                    <li><a href="about.php">About us</a></li>

                    <li><a href="service.php">Our Treatments</a></li>
                    <li><a href="clinic.php">Our Clinics</a></li>
                    <li><a href="contact.php">Contact us</a></li>
                    <li><a href="appointment.php">Book Appointment</a></li>
                    <!-- <li><a href="#privacy">Privacy Policy</a></li> -->
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p style="color: #666; margin: 0;">© 2024 Denta Care Health Ventures LLP. ALL RIGHTS RESERVED</p>
            <div class="social-links">
                <a href="https://www.facebook.com/hontistry"><i class="fab fa-facebook"></i> Facebook</a>
                <a href="https://www.youtube.com/channel/UCmE0BrRzE5dzfljOoCx_PuQ"><i class="fab fa-twitter"></i> Youtube</a>
                <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="https://www.linkedin.com/company/hontistry/"><i class="fab fa-linkedin"></i> LinkedIn</a>
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