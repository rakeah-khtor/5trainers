<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $rawName = isset($_POST['name']) ? trim($_POST['name']) : '';
    $name = htmlspecialchars($rawName);
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $rawPhone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $phone = htmlspecialchars($rawPhone);
    $country = isset($_POST['country']) ? htmlspecialchars(trim($_POST['country'])) : '';
    $service = isset($_POST['service']) ? htmlspecialchars(trim($_POST['service'])) : '';
    $interest = isset($_POST['interest']) ? htmlspecialchars(trim($_POST['interest'])) : '';
    $city = isset($_POST['city']) ? htmlspecialchars(trim($_POST['city'])) : '';
    $messageText = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

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

    if (!empty($errors)) {
        http_response_code(400);
        exit;
    }

    $subject = "New Callback Request from $name";

    $interestValue = trim($service);
    if ($interest !== '') {
        $interestValue = $interestValue !== '' ? $interestValue . ' / ' . $interest : $interest;
    }

    $body = "
        <html>
        <body>
            <h2>New Callback Request</h2>
            <p><strong>Full Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone Number:</strong> {$phone}</p>
            <p><strong>City:</strong> {$city}</p>
            <p><strong>Country:</strong> {$country}</p>
            <p><strong>Interested:</strong> {$interestValue}</p>
            <p><strong>Message:</strong> {$messageText}</p>
        </body>
        </html>
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

        $mail->setFrom('no-reply@5trainers.com', '5Trainers Visa');
        $mail->addAddress('contact.visa@5trainers.com');

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mail->addReplyTo($email, $name);
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();

        include 'thanku-page.php';
    } catch (Exception $e) {
        echo "Mail sending failed: " . $mail->ErrorInfo;
    }
}
?>
