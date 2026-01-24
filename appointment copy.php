<?php
include './db.connection/db_connection.php';

// Selected date
$selected_date = isset($_POST['appointment_date']) ? $_POST['appointment_date'] : date('Y-m-d');

// Day check
$day = date('l', strtotime($selected_date));
$isHoliday = ($day == 'Thursday' || $day == 'Sunday');

// Slots list
$slots = [
    "10:30 AM - 11:30 AM",
    "11:30 AM - 12:30 PM",
    "12:30 PM - 01:30 PM",
    "01:30 PM - 02:30 PM",
    "04:00 PM - 05:00 PM",
    "05:00 PM - 06:00 PM",
    "06:00 PM - 07:00 PM",
    "07:00 PM - 08:00 PM",
    "09:00 PM - 10:00 PM"
];

// Check remaining slots
$slotStatus = [];
if ($selected_date != '') {
    foreach ($slots as $slot) {
        $q = $conn->query("SELECT COUNT(*) AS total FROM appointments WHERE appointment_date='$selected_date' AND time_slot='$slot'");
        $row = $q->fetch_assoc();
        $slotStatus[$slot] = 3 - $row['total']; // max 3 per slot
    }
}
?>


<?php include 'header.php'; ?>







<section id="appointment" class="appointment-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="appointment-form">
                    <h3>Book <span>Appointment</span></h3>
                    <p>Fill out the form below to schedule your dental appointment</p>






                    <form id="appointmentForm" method="POST" action="save_appointment.php" class="row" >

                        <!-- Name -->
                        <div class="mb-3 col-md-6">
                            <label style="padding-left: 80px;">Name</label>
                            <input type="text" name="name" class="form-control" required placeholder="Enter Your Name">
                        </div>

                        <!-- Email -->
                        <div class="mb-3 col-md-6">
                            <label style="padding-left: 80px;">Email</label>
                            <input type="email" name="email" class="form-control" required  placeholder="Email">
                        </div>

                        <!-- Contact -->
                        <div class="mb-3 col-md-6" >
                            <label style="padding-left: 80px;">Contact Number</label>
                            <input type="text" name="phone" class="form-control" required  placeholder="Number">
                        </div>

                        <!-- Select Date -->
                        <div class="mb-3 col-md-6">
                            <label style="padding-left: 80px;">Select Date</label>
                            <input type="date" name="appointment_date"
                                
                                min="<?= date('Y-m-d') ?>"
                                class="form-control"
                                required placeholder="Select Date">
                        </div>

                        <?php if ($selected_date != ''): ?>
                            <?php if ($isHoliday): ?>
                                <div class="alert alert-danger text-center">
                                    <strong><?= $day ?></strong> is a holiday. Appointments not available.
                                </div>
                            <?php else: ?>
                                <!-- Slot -->
                                <div class="mb-3">
                                    <label >Select Time Slot</label>
                                    <select id="time_slot" name="time_slot" class="form-control" required>
                                        <option value="">-- Select Slot --</option>
                                        <?php foreach ($slots as $slot): ?>
                                            <option value="<?= $slot ?>" data-slots="<?= $slotStatus[$slot] ?>">
                                                <?= $slot ?> (<?= $slotStatus[$slot] ?> slots available)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <!-- Message -->
                        <div class="mb-3">
                            <label >Message</label>
                            <textarea name="message" class="form-control " placeholder="Meassage"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Book Appointment</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="appointment-img-placeholder">
                    <!-- <i class="fas fa-tooth"></i> -->
                    <img src="./assets/images/contact_us.png" alt="" class="img-fluid contact_image">
                    <!-- <img src="./assets/images/contact-image.jpg" alt="" class="img-fluid contact_image"> -->
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


<script>
// When the user selects a slot
document.getElementById('time_slot').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const available = parseInt(selectedOption.getAttribute('data-slots'));

    if (available <= 0) {
        alert('This slot is FULL. Please select another slot.');
        this.value = ''; // reset selection
    }
});

// Also check before submitting
document.getElementById('appointmentForm').addEventListener('submit', function(e) {
    const slotSelect = document.getElementById('time_slot');
    const selectedOption = slotSelect.options[slotSelect.selectedIndex];
    const available = parseInt(selectedOption.getAttribute('data-slots'));

    if (available <= 0) {
        e.preventDefault();
        alert('This slot is FULL. Please select another slot.');
        slotSelect.value = '';
        return false;
    }
});
</script>


<?php include 'footer.php'; ?>