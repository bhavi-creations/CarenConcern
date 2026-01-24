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
    "07:00 PM - 08:00 PM"
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

<!DOCTYPE html>
<html>
<head>
    <title>Appointment Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<h3 class="text-center mb-4">Book Appointment</h3>

<form id="appointmentForm" method="POST" action="save_appointment.php">

    <!-- Name -->
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <!-- Contact -->
    <div class="mb-3">
        <label>Contact Number</label>
        <input type="text" name="phone" class="form-control" required>
    </div>

    <!-- Select Date -->
    <div class="mb-3">
        <label>Select Date</label>
        <input type="date" name="appointment_date" 
               value="<?= $selected_date ?>" 
               min="<?= date('Y-m-d') ?>" 
               class="form-control"
               required>
    </div>

    <?php if ($selected_date != ''): ?>
        <?php if ($isHoliday): ?>
            <div class="alert alert-danger text-center">
                <strong><?= $day ?></strong> is a holiday. Appointments not available.
            </div>
        <?php else: ?>
            <!-- Slot -->
            <div class="mb-3">
                <label>Select Time Slot</label>
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
        <label>Message</label>
        <textarea name="message" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary w-100">Book Appointment</button>
</form>
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

</body>
</html>
