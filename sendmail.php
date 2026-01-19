<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize inputs with safe defaults
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $phone = isset($_POST['phone_number']) ? htmlspecialchars(trim($_POST['phone_number'])) : '';
    if ($phone === '' && isset($_POST['phone'])) {
        $phone = htmlspecialchars(trim($_POST['phone']));
    }

    $profession = isset($_POST['profession']) ? htmlspecialchars(trim($_POST['profession'])) : '';
    $query = isset($_POST['query']) ? htmlspecialchars(trim($_POST['query'])) : '';
    $course = '';
    if (!empty($_POST['basic'])) {
        $course = htmlspecialchars(trim($_POST['basic']));
    } elseif (!empty($_POST['course'])) {
        $course = htmlspecialchars(trim($_POST['course']));
    } elseif (!empty($_POST['form_type'])) {
        $course = htmlspecialchars(trim($_POST['form_type']));
    } else {
        $course = 'Not Selected';
    }

    $safeName = $name !== '' ? $name : 'Visitor';
    $safeEmail = $email !== '' ? $email : 'Not provided';
    $safePhone = $phone !== '' ? $phone : 'Not provided';

    // Email subject
    $subject = 'New Enquiry';
    if ($course === 'on') {
        $course = 'Not Selected';
    }

    if ($course !== 'Not Selected') {
        $subject .= ' - ' . $course;
    }

    // Email body
    $message = "
        <h2>New Enquiry Details</h2>
        <p><strong>Name:</strong> $safeName</p>
        <p><strong>Email:</strong> $safeEmail</p>
        <p><strong>Phone Number:</strong> $safePhone</p>
        <p><strong>Course/Type:</strong> $course</p>
    ";
    if ($profession !== '') {
        $message .= "<p><strong>Profession:</strong> {$profession}</p>";
    }
    if ($query !== '') {
        $message .= "<p><strong>Query:</strong> {$query}</p>";
    }

    try {
        $mail = new PHPMailer(true);

        // SMTP Configuration (Hostinger)
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'no-reply@5trainers.com';   // your email
        $mail->Password   = 'Reset@1010!#';           // email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Sender & Receiver
        $mail->setFrom('no-reply@5trainers.com', '5Trainers');
        $mail->addAddress('info@5trainers.com');
        $mail->addAddress('5trainers.official@gmail.com');

        // Reply-to user when a valid email is provided
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mail->addReplyTo($email, $safeName);
        }

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();

        // Redirect after success
        header("Location: thanku-page.php");
        exit();

    } catch (Exception $e) {
        echo "Mail sending failed: " . $mail->ErrorInfo;
    }
}
?>
