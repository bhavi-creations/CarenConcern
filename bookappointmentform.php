

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name  = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $appointment_date = htmlspecialchars(trim($_POST['appointment_date'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'manimalladi05@gmail.com';
        $mail->Password   = 'cvarqcchfjpawxvo';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //  $mail->Username   = 'drsunilsathyanarayana@gmail.com';
        // $mail->Password   = 'qrlcwwkjajkixujh';

        $mail->setFrom('manimalladi05@gmail.com', "Care n Concern Family Dental Clinic");
        $mail->addAddress('manimalladi05@gmail.com', "Care n Concern Family Dental Clinic");

        $mail->isHTML(true);
        $mail->Subject = 'New Appointment Booking';

        $mail->Body = "
            <h2>New Appointment Details</h2>
            <table border='1' cellpadding='8' cellspacing='0'>
                <tr>
                    <td><strong>Name</strong></td>
                    <td>{$name}</td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>{$email}</td>
                </tr>
                <tr>
                    <td><strong>Contact Number</strong></td>
                    <td>{$phone}</td>
                </tr>
                <tr>
                    <td><strong>Appointment Date</strong></td>
                    <td>{$appointment_date}</td>
                </tr>
                <tr>
                    <td><strong>Message</strong></td>
                    <td>{$message}</td>
                </tr>
            </table>
        ";

        $mail->AltBody = "
New Appointment Details

Name: $name
Email: $email
Phone: $phone
Appointment Date: $appointment_date
Message: $message
";

        $mail->send();

        echo "<script>
         
            window.location.href='thankyou.php';
        </script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
    }
} else {
    echo "Access Denied";
}
