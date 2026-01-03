<?php include 'header.php'; ?>







<section id="appointment" class="appointment-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="appointment-form">
                    <h3>Book <span>Appointment</span></h3>
                    <p>Fill out the form below to schedule your dental appointment</p>



                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder=" Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="tel" class="form-control" placeholder="Phone Number" required>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <input type="date" class="form-control" placeholder="Select Date" required>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select form-control-uniform" name="service" required>
                                    <option value="">SELECT SERVICE </option>
                                    <option value="painless Root Canal">painless Root Canal</option>
                                    <option value="Teeth Cleaning">Teeth Cleaning</option>
                                    <option value="Crowns & Bridges">Crowns & Bridges</option>
                                    <option value="Painless Teeth Removal">Painless Teeth Removal</option>
                                    <option value="Tooth Colored Fillings">Tooth Colored Fillings</option>
                                    <option value="Fixing Jaw Fractures">Fixing Jaw Fractures</option>
                                    <option value="Basal Implants">Basal Implants</option>
                                    <option value="Laser Dentistry">Laser Dentistry</option>
                                    <option value="Teeth Whitening">Teeth Whitening</option>
                                    <option value="Clear Aligners">Clear Aligners</option>

                                </select>
                            </div>
                        </div>

                        <div class="row">


                        </div>



                        <textarea class="form-control" rows="4" placeholder="Meassage  "></textarea>

                        <button type="submit" class="btn-book submit_section w-100 justify-content-center">SUBMIT APPOINTMENT</button>
                    </form>

               
                </div>
            </div>
            <div class="col-lg-6">
                <div class="appointment-img-placeholder">
                    <!-- <i class="fas fa-tooth"></i> -->
                    <img src="./assets/images/contact-image.jpg" alt="" class="img-fluid contact_image">
                </div>
            </div>
        </div>
    </div>
</section>

<div class="map-container"
    style="border-radius: 15px; overflow: hidden; height: 100%; min-height: 450px; margin-top:50px ;">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.1794341972895!2d77.53775897454643!3d12.960367315125565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae3e0b271d0cf5%3A0x6777a67f630670a4!2sCare%20n%20Concern%20Family%20Dental%20Clinic!5e0!3m2!1sen!2sin!4v1763552838013!5m2!1sen!2sin"
        width="100%" height="450px" style="border:0;" allowfullscreen="" loading="lazy">
    </iframe>
</div>





<?php include 'footer.php'; ?>