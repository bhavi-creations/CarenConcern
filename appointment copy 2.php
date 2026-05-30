<?php
include './db.connection/db_connection.php';


$selected_date = date('Y-m-d');
$slots = [
    "10:30 AM - 11:30 AM",
    "11:30 AM - 12:30 PM",
    "12:30 PM - 01:30 PM",
    "01:30 PM - 02:30 PM",
    "04:00 PM - 05:00 PM",
    "05:00 PM - 06:00 PM",
    "06:00 PM - 07:00 PM",
    "07:00 PM - 08:00 PM",
    "08:00 PM - 8:30 PM"
];
?>

<?php include 'header.php' ?>

<section id="appointment" class="appointment-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="appointment-form">
                    <h3>Book <span>Appointment</span></h3>
                    <form id="appointmentForm" method="POST" action="save_appointment.php" class="row">
                        <div class="mb-3 col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required placeholder="Enter Your Name">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="Email">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label>Contact Number</label>
                            <input type="text" name="phone" class="form-control" required placeholder="Number">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label>Select Date</label>
                            <input type="date" id="appointment_date" name="appointment_date"
                                min="<?= date('Y-m-d') ?>" class="form-control" required>
                        </div>

                        <div id="slotContainer" class="col-md-12 mb-3">
                            <label>Select Time Slot</label>
                            <select id="time_slot" name="time_slot" class="form-control" required>
                                <option value="">-- First Select Date --</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-12">
                            <label>Message</label>
                            <textarea name="message" class="form-control" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Book Appointment</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="./assets/images/contact_us.png" class="img-fluid contact_image">
            </div>
        </div>
    </div>
</section>

<div class="map-container"
    style="border-radius: 15px; overflow: hidden; height: 100%; min-height: 450px;">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.1794341972895!2d77.53775897454643!3d12.960367315125565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae3e0b271d0cf5%3A0x6777a67f630670a4!2sCare%20n%20Concern%20Family%20Dental%20Clinic!5e0!3m2!1sen!2sin!4v1763552838013!5m2!1sen!2sin"
        width="100%" height="450px" style="border:0;" allowfullscreen="" loading="lazy">
    </iframe>
</div>


<script>
    document.getElementById('appointment_date').addEventListener('change', function() {
        const date = this.value;
        const slotSelect = document.getElementById('time_slot');
        slotSelect.innerHTML = '<option>Loading...</option>';

        fetch('get_slots.php?date=' + encodeURIComponent(date))
            .then(r => r.json())
            .then(data => {
                if (data.error) {
                    slotSelect.innerHTML = '<option value="">Unable to load slots</option>';
                    return;
                }

                if (data.isHoliday && data.type == 'fullday') {
                    alert("Holiday: " + data.reason);
                    slotSelect.innerHTML = '<option value="">No Slots Available</option>';
                    return;
                }

                if (data.isHoliday) {
                    alert("Note: " + data.reason);
                }

                let html = '<option value="">--Select Slot--</option>';

                if (!data.slots || data.slots.length === 0) {
                    slotSelect.innerHTML = '<option value="">No Slots Available</option>';
                    return;
                }

                data.slots.forEach(s => {
                    let dis = s.available <= 0 ? 'disabled' : '';
                    let text = s.available <= 0 ?
                        `${s.time} (FULL)` :
                        `${s.time} (${s.available} Slots Available)`;

                    html += `<option ${dis} value="${s.time}">${text}</option>`;
                });

                slotSelect.innerHTML = html;
            })
            .catch(() => {
                slotSelect.innerHTML = '<option value="">Error loading slots</option>';
            });
    });
</script>


<?php include 'footer.php'; ?>
