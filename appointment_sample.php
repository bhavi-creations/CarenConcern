<?php
include './db.connection/db_connection.php';

date_default_timezone_set("Asia/Kolkata");

$msg = "";

/* ---------- INSERT ---------- */
if (isset($_POST['submit'])) {

    $patient_name = $_POST['patient_name'];
    $mobile = $_POST['mobile'];
    $appointment_date = $_POST['appointment_date'];
    $slot_time = $_POST['slot_time'];

    // Holiday check
    $day = date('l', strtotime($appointment_date));
    if ($day == 'Thursday' || $day == 'Sunday') {
        $msg = "Clinic Holiday";
    } else {

        // Slot count check (Max 3)
        $check = mysqli_query($conn, "SELECT COUNT(*) as total FROM appointments 
            WHERE appointment_date='$appointment_date' AND slot_time='$slot_time'");
        $row = mysqli_fetch_assoc($check);

        if ($row['total'] >= 3) {
            $msg = "This slot is full. Please select another slot.";
        } else {

            // Insert
            $insert = "INSERT INTO appointments 
            (patient_name, mobile, appointment_date, slot_time) 
            VALUES 
            ('$patient_name','$mobile','$appointment_date','$slot_time')";

            if (mysqli_query($conn, $insert)) {

                // EMAIL
                $to = "yourmail@gmail.com";   // change this
                $subject = "New Appointment Booked";
                $message = "
Patient Name: $patient_name
Mobile: $mobile
Date: $appointment_date
Slot: $slot_time
";
                $headers = "From: clinic@gmail.com";

                mail($to, $subject, $message, $headers);

                $msg = "Appointment Booked Successfully";
            }
        }
    }
}
?>



<?php
include './db.connection/db_connection.php';

/* ---------- INSERT DATA ---------- */
if (isset($_POST['submit'])) {

    $patient_name = $_POST['patient_name'];
    $mobile = $_POST['mobile'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    $insert = "INSERT INTO appointments 
        (patient_name, mobile, appointment_date, appointment_time) 
        VALUES 
        ('$patient_name', '$mobile', '$appointment_date', '$appointment_time')";

    if (mysqli_query($conn, $insert)) {
        $msg = "Appointment Booked Successfully";
    } else {
        $msg = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Appointment Booking</title>
    <style>
        body { font-family: Arial; background:#f5f5f5; }
        .container { width: 900px; margin: auto; background:#fff; padding:20px; }
        input, button { padding:10px; width:100%; margin:5px 0; }
        table { width:100%; border-collapse:collapse; margin-top:20px; }
        table, th, td { border:1px solid #ccc; }
        th, td { padding:10px; text-align:center; }
        .success { color:green; }
    </style>
</head>
<body>

<div class="container">

    <h2>📅 Appointment Slot Booking</h2>

    <?php if (!empty($msg)) { ?>
        <p class="success"><?= $msg ?></p>
    <?php } ?>

    <!-- APPOINTMENT FORM -->
    <form method="POST">
        <label>Patient Name</label>
        <input type="text" name="patient_name" required>

        <label>Mobile Number</label>
        <input type="text" name="mobile" required>

        <label>Appointment Date</label>
        <input type="date" name="appointment_date" required>

        <label>Appointment Time</label>
        <input type="time" name="appointment_time" required>

        <button type="submit" name="submit">Book Appointment</button>
    </form>

    <!-- DISPLAY DATA -->
    <h3>📋 Booked Appointments</h3>

    <table>
        <tr>
            <th>S.No</th>
            <th>Patient Name</th>
            <th>Mobile</th>
            <th>Date</th>
            <th>Time</th>
        </tr>

        <?php
        $i = 1;
        $select = mysqli_query($conn, "SELECT * FROM appointments ORDER BY id DESC");
        while ($row = mysqli_fetch_assoc($select)) {
        ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $row['patient_name'] ?></td>
            <td><?= $row['mobile'] ?></td>
            <td><?= $row['appointment_date'] ?></td>
            <td><?= $row['appointment_time'] ?></td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>
