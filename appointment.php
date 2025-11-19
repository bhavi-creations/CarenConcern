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
                                <input type="text" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Last Name" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Email Address" required>
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
                                <input type="time" class="form-control" placeholder="Select Time" required>
                            </div>
                        </div>

                        <select class="form-control">
                            <option value="">Select Treatment</option>
                            <option value="checkup">General Checkup</option>
                            <option value="cleaning">Teeth Cleaning</option>
                            <option value="whitening">Teeth Whitening</option>
                            <option value="braces">Braces</option>
                            <option value="implants">Dental Implants</option>
                            <option value="dentures">Dentures</option>
                            <option value="root-canal">Root Canal</option>
                            <option value="cosmetic">Cosmetic Dentistry</option>
                        </select>

                        <textarea class="form-control" rows="4" placeholder="Additional Notes (Optional)"></textarea>

                        <button type="submit" class="btn-book w-100 justify-content-center">SUBMIT APPOINTMENT</button>
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