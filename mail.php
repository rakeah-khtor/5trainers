<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize inputs
    
    $email = htmlspecialchars($_POST['email']);


    // Email body
    $message = "
        <h2>Build your Future Today</h2>
        <p><strong>Email:</strong> $email</p>
    ";

    try {
        $mail = new PHPMailer(true);

        // SMTP Configuration (Hostinger)
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'no-reply@5trainers.com';   // your email
        $mail->Password   = 'Reset@101010!#';           // email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Sender & Receiver
        $mail->setFrom('no-reply@5trainers.com', '5Trainers');
        $mail->addAddress('info@5trainers.com');
        $mail->addAddress('5trainers.official@gmail.com');

        // Reply-to user
        if (!empty($email)) {
            $mail->addReplyTo($email,);
            
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
