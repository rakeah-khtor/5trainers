<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rawName = isset($_POST['name']) ? trim($_POST['name']) : '';
    $name = htmlspecialchars($rawName);
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $rawPhone = '';
    if (isset($_POST['phone_number'])) {
        $rawPhone = trim($_POST['phone_number']);
    } elseif (isset($_POST['phone'])) {
        $rawPhone = trim($_POST['phone']);
    }
    $phone = htmlspecialchars($rawPhone);

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

    // Basic server-side validation
    $errors = [];

    $nameNoSpaces = preg_replace('/\s+/u', '', $rawName);
    if ($nameNoSpaces === '' || mb_strlen($nameNoSpaces, 'UTF-8') < 4) {
        $errors[] = 'Name must be at least 4 characters.';
    }

    if ($email === '' && $rawPhone === '') {
        $errors[] = 'Please provide at least an email or phone number.';
    }

    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please provide a valid email address.';
    }

    if ($rawPhone !== '' && !preg_match('/^[0-9]{10}$/', $rawPhone)) {
        $errors[] = 'Phone number must be a 10-digit number.';
    }

    if (!empty($errors)) {
        http_response_code(400);
        exit;
    }

    $safeName = $name !== '' ? $name : 'Visitor';
    $safeEmail = $email !== '' ? $email : 'Not provided';
    $safePhone = $phone !== '' ? $phone : 'Not provided';

    $subject = 'New Enquiry';
    if ($course === 'on') {
        $course = 'Not Selected';
    }

    if ($course !== 'Not Selected') {
        $subject .= ' - ' . $course;
    }

    $message = "
        <h2>New Enquiry Details</h2>
        <p><strong>Name:</strong> $safeName</p>
        <p><strong>Email:</strong> $safeEmail</p>
        <p><strong>Phone Number:</strong> $safePhone</p>
        <p><strong>Course/Type:</strong> $course</p>
    ";

    try {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'no-reply@5trainers.com';
        $mail->Password   = 'Reset@1010!#';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('no-reply@5trainers.com', '5Trainers');
        $mail->addAddress('info@5trainers.com');
        $mail->addAddress('5trainers.official@gmail.com');

        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mail->addReplyTo($email, $safeName);
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();

        header("Location: thanku-page.php");
        exit();
    } catch (Exception $e) {
        echo "Mail sending failed: " . $mail->ErrorInfo;
    }
}
?>
