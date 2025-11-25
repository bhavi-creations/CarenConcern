<?php include 'header.php'; ?>





<section id="contact" class="section contact-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Reach Us</h2>
            <p class="section-subtitle">Contact with our team </p>
            <!-- <p class="section-subtitle">Get in touch with our expert to explore tailored MRO solutions designed for your fleet's success.</p> -->
        </div>

        <div class="row justify-content-center align-items-start">

            <!-- ⭐ LEFT SIDE – CONTACT FORM -->
            <div class="col-lg-6 mb-4">
                <div class="contact-card p-4">
                    <h1>Contact Form</h1>
                    <!-- <div class="contact-icon text-center">
                        <i class="bi bi-envelope"></i>
                    </div> -->

                    <!-- <h3 class="text-center" style="color: var(--primary-color); margin-bottom: 1rem;">Get in Touch
                        </h3>
                        <p class="text-center" style="color: var(--medium-text); margin-bottom: 2rem;">
                            Connect with our experts to explore tailored MRO solutions designed for your fleet's
                            success.
                        </p>

                        <a href="mailto:info@bthaviation.com" class="btn btn-custom mb-4 w-100 text-center">
                            <i class="bi bi-envelope me-2"></i>info@bthaviation.com
                        </a> -->

                    <!-- Contact Form -->
                    <form action="contactform.php" method="post" role="form" class="php-email-form" data-aos-delay="100">
                        <div class="row g-3">

                            <div class="col-12 col-md-6">
                                <input type="text" name="name" class="form-control form-control-uniform" placeholder="Your Name">
                            </div>

                            <div class="col-12 col-md-6">
                                <input type="email" name="Company" class="form-control form-control-uniform" placeholder="Company Name">
                            </div>

                            <div class="col-12 col-md-6">
                                <input type="email" name="Email" class="form-control form-control-uniform" placeholder="Enter Your Email">
                            </div>

                            <div class="col-12 col-md-6">
                                <input type="text" name="title" class="form-control form-control-uniform" placeholder="Title">
                            </div>

                            <div class="col-12 col-md-6">
                                <select class="form-select form-control-uniform" name="service">
                                    <option selected>Primary Interest</option>
                                    <option value="Base Maintenance">Base Maintenance</option>
                                    <option value="Component Overhaul">Component Overhaul</option>
                                    <option value="Partnership">Partnership</option>
                                    <!-- <option value="Invisible aligners">Invisible aligners</option>
                                    <option value="Teeth whitening">Teeth whitening</option>
                                    <option value="Teeth cleaning">Teeth cleaning</option>
                                    <option value="Teeth jewellery">Teeth jewellery</option>
                                    <option value="root canal">Root canal</option> -->
                                </select>
                            </div>

                            <div class="mb-3 col-12 col-md-6 ">
                                <!-- <label class="form-label">Message</label> -->
                                <textarea class="form-control" name="meassage" rows="1" placeholder="Write your message"
                                    required></textarea>
                            </div>

                            <button type="submit" class="btn-book w-100 justify-content-center">
                                Send Message
                            </button>
                            
                        </div>
                    </form>

                </div>
            </div>

            <!-- ⭐ RIGHT SIDE – GOOGLE MAP -->
            <div class="col-lg-6 mb-4">
                <div class="map-container"
                    style="border-radius: 15px; overflow: hidden; height: 100%; min-height: 450px;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.1794341972895!2d77.53775897454643!3d12.960367315125565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae3e0b271d0cf5%3A0x6777a67f630670a4!2sCare%20n%20Concern%20Family%20Dental%20Clinic!5e0!3m2!1sen!2sin!4v1763552838013!5m2!1sen!2sin"
                        width="100%" height="450px" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>




        </div>
    </div>
</section>

<?php include 'footer.php'; ?>