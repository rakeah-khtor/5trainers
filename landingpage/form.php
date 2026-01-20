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
    $rawPhone = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : '';
    $phone = htmlspecialchars($rawPhone);
    $course = isset($_POST['course']) ? htmlspecialchars(trim($_POST['course'])) : '';
    $batch = isset($_POST['batch']) ? htmlspecialchars(trim($_POST['batch'])) : '';
    $qualification = isset($_POST['qualification']) ? htmlspecialchars(trim($_POST['qualification'])) : '';

    $errors = [];

    $nameNoSpaces = preg_replace('/\s+/u', '', $rawName);
    if ($nameNoSpaces === '' || mb_strlen($nameNoSpaces, 'UTF-8') < 4) {
        $errors[] = 'Full Name must be at least 4 characters.';
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please provide a valid email address.';
    }

    if ($rawPhone === '' || !preg_match('/^[0-9]{10}$/', $rawPhone)) {
        $errors[] = 'Phone number must be a 10-digit number.';
    }

    if ($course === '') {
        $errors[] = 'Please select a course.';
    }

    if ($batch === '') {
        $errors[] = 'Please select a batch.';
    }

    if ($qualification === '') {
        $errors[] = 'Please enter your qualification.';
    }

    if (!empty($errors)) {
        http_response_code(400);
        exit;
    }

    $subject = "New Course Registration";
    if ($name !== '') {
        $subject .= " from $name";
    }

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
            $mail->addReplyTo($email, $name !== '' ? $name : 'Visitor');
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();

        include 'thanku-page.php';
    } catch (Exception $e) {
        echo "Mail sending failed: " . $mail->ErrorInfo;
    }
}
?>
