<?php
include './db.connection/db_connection.php';

function redirectWithAlert($message, $location = 'appointment.php')
{
    echo "<script>alert(" . json_encode($message) . "); window.location=" . json_encode($location) . ";</script>";
    exit;
}

function loadMailer()
{
    if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
        return true;
    }

    $autoload = __DIR__ . '/vendor/autoload.php';
    if (file_exists($autoload)) {
        require_once $autoload;
    }

    if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
        return true;
    }

    $base = __DIR__ . '/PHPMailer/src/';
    $required = ['Exception.php', 'PHPMailer.php', 'SMTP.php'];
    foreach ($required as $file) {
        if (!file_exists($base . $file)) {
            error_log('Appointment mail skipped: missing PHPMailer file ' . $file);
            return false;
        }
    }

    require_once $base . 'Exception.php';
    require_once $base . 'PHPMailer.php';
    require_once $base . 'SMTP.php';

    return class_exists('PHPMailer\PHPMailer\PHPMailer');
}

function buildMailer()
{
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'manimalladi05@gmail.com';
    $mail->Password   = 'cvarqcchfjpawxvo';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    $mail->isHTML(true);

    return $mail;
}

function sendAppointmentEmails($name, $email, $phone, $date, $day, $slot, $msg)
{
    if (!loadMailer()) {
        return;
    }

    try {
        $mailDoctor = buildMailer();
        $mailDoctor->setFrom('manimalladi05@gmail.com', 'Clinic Appointment System');
        $mailDoctor->addAddress('manimalladi05@gmail.com');
        $mailDoctor->Subject = 'New Appointment Booked';
        $mailDoctor->Body = "
            <h2>New Appointment Details</h2>
            <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
            <p><strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>
            <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
            <p><strong>Date:</strong> " . htmlspecialchars($date . ' (' . $day . ')') . "</p>
            <p><strong>Time Slot:</strong> " . htmlspecialchars($slot) . "</p>
            <p><strong>Message:</strong> " . nl2br(htmlspecialchars($msg)) . "</p>
        ";
        $mailDoctor->send();
    } catch (Throwable $e) {
        error_log('Doctor appointment mail failed: ' . $e->getMessage());
    }

    try {
        $mailPatient = buildMailer();
        $mailPatient->setFrom('manimalladi05@gmail.com', 'Care n Concern Family Dental Clinic');
        $mailPatient->addAddress($email);
        $mailPatient->Subject = 'Appointment Confirmation';
        $mailPatient->Body = "
            <h2>Appointment Confirmed</h2>
            <p>Dear <strong>" . htmlspecialchars($name) . "</strong>,</p>
            <p>Your appointment has been successfully booked.</p>
            <table cellpadding='6'>
                <tr><td><strong>Date</strong></td><td>" . htmlspecialchars($date . ' (' . $day . ')') . "</td></tr>
                <tr><td><strong>Time</strong></td><td>" . htmlspecialchars($slot) . "</td></tr>
                <tr><td><strong>Phone</strong></td><td>" . htmlspecialchars($phone) . "</td></tr>
            </table>
            <p>Thank you for choosing<br><b>Care n Concern Family Dental Clinic</b>.</p>
        ";
        $mailPatient->send();
    } catch (Throwable $e) {
        error_log('Patient appointment mail failed: ' . $e->getMessage());
    }
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header('Location: appointment.php');
    exit;
}

$name  = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$date  = trim($_POST['appointment_date'] ?? '');
$slot  = trim($_POST['time_slot'] ?? '');
$msg   = trim($_POST['message'] ?? '');

$allowedSlots = [
    "9:00 AM - 10:00 AM",
    "10:00 AM - 11:00 AM",
    "11:00 AM - 12:00 PM",
    "12:00 PM - 01:00 PM",
    "01:00 PM - 02:00 PM",
    "02:00 PM - 03:00 PM",
    "03:00 PM - 04:00 PM",
    "04:00 PM - 05:00 PM",
    "05:00 PM - 06:00 PM",
    "06:00 PM - 07:00 PM",
    "07:00 PM - 08:30 PM"
];

$morningSlots = [
    "9:00 AM - 10:00 AM",
    "10:00 AM - 11:00 AM",
    "11:00 AM - 12:00 PM",
    "12:00 PM - 01:00 PM",
    "01:00 PM - 02:00 PM"
];

$afternoonSlots = [
    "02:00 PM - 03:00 PM",
    "03:00 PM - 04:00 PM",
    "04:00 PM - 05:00 PM",
    "05:00 PM - 06:00 PM",
    "06:00 PM - 07:00 PM",
    "07:00 PM - 08:30 PM"
];

if ($name === '' || $email === '' || $phone === '' || $date === '' || $slot === '') {
    redirectWithAlert('Please fill all required appointment fields.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirectWithAlert('Please enter a valid email address.');
}

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
    redirectWithAlert('Please select a valid appointment date.');
}

if ($date < date('Y-m-d')) {
    redirectWithAlert('Please select today or a future date.');
}

if (!in_array($slot, $allowedSlots, true)) {
    redirectWithAlert('Please select a valid time slot.');
}

$day = date('l', strtotime($date));

$stmt = $conn->prepare("SELECT holiday_type, reason FROM holidays WHERE holiday_date = ? LIMIT 1");
if (!$stmt) {
    error_log('Holiday check prepare failed: ' . $conn->error);
    redirectWithAlert('Unable to check appointment availability. Please try again.');
}

$stmt->bind_param("s", $date);
$stmt->execute();
$holiday = $stmt->get_result()->fetch_assoc();

if ($holiday) {
    $type = $holiday['holiday_type'];
    $isBlocked = $type === 'fullday'
        || ($type === 'morning' && in_array($slot, $morningSlots, true))
        || ($type === 'afternoon' && in_array($slot, $afternoonSlots, true));

    if ($isBlocked) {
        redirectWithAlert($holiday['reason'] ?: 'No appointments available for this time.');
    }
}

$stmt = $conn->prepare(
    "SELECT COUNT(*) AS total FROM appointments WHERE appointment_date = ? AND time_slot = ?"
);
if (!$stmt) {
    error_log('Slot count prepare failed: ' . $conn->error);
    redirectWithAlert('Unable to check slot availability. Please try again.');
}

$stmt->bind_param("ss", $date, $slot);
$stmt->execute();
$count = $stmt->get_result()->fetch_assoc();

if ((int) $count['total'] >= 3) {
    redirectWithAlert('This time slot is full. Please select another slot.');
}

$stmt = $conn->prepare(
    "INSERT INTO appointments (name, email, phone, appointment_date, time_slot, message)
     VALUES (?, ?, ?, ?, ?, ?)"
);
if (!$stmt) {
    error_log('Appointment insert prepare failed: ' . $conn->error);
    redirectWithAlert('Unable to book appointment. Please try again.');
}

$stmt->bind_param("ssssss", $name, $email, $phone, $date, $slot, $msg);
if (!$stmt->execute()) {
    error_log('Appointment insert failed: ' . $stmt->error);
    redirectWithAlert('Unable to book appointment. Please try again.');
}

sendAppointmentEmails($name, $email, $phone, $date, $day, $slot, $msg);

header('Location: thankyou.php');
exit;
