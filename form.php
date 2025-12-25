<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name          = htmlspecialchars($_POST['name']);
    $email         = htmlspecialchars($_POST['email']);
    $phone         = htmlspecialchars($_POST['phone_number']);
    $course        = htmlspecialchars($_POST['course']);
    $batch         = htmlspecialchars($_POST['batch']);
    $qualification = htmlspecialchars($_POST['qualification']);

    // Email subject
    $subject = "New Course Registration from $name";

    // Email body
    $message = "
    <h2>New Registration Details</h2>
    <p><strong>Full Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Phone Number:</strong> $phone</p>
    <p><strong>Course:</strong> $course</p>
    <p><strong>Batch:</strong> $batch</p>
    <p><strong>Qualification:</strong> $qualification</p>
    ";

    try {
        $mail = new PHPMailer(true);

        // Server settings (Hostinger SMTP)
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'no-reply@5trainers.com';   // your Hostinger email
        $mail->Password   = 'Reset@101010!#'; // that email's password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('no-reply@5trainers.com', '5Trainers');
        $mail->addAddress('info@5trainers.com');
        $mail->addAddress('5trainers.official@gmail.com');

        // Allow direct reply to the user
        if (!empty($email)) {
            $mail->addReplyTo($email, $name);
        }

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        echo 'Mail Sent Successfully!';
    } catch (Exception $e) {
        echo 'Mail Sending Failed! Error: ' . $mail->ErrorInfo;
    }
}
