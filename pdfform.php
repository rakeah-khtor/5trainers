<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Initialize an empty error message
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from form  
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    // $website = $_POST['website'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format";
    }

    // If there's no error, proceed with sending the email
    if (empty($errorMessage)) {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'needleadsagency@gmail.com'; // SMTP username
            $mail->Password = 'ceovzkarzpcbguys'; // SMTP app-specific password 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('needleadsagency@gmail.com', 'Brochure');
            $mail->addAddress('needleadsagency@gmail.com');
            $mail->addCC('needleadsagency@gmail.com');

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Hi New Enquiry on Brochure | NeedleAds India';
            $mail->Body = "Name: $name<br>Email: $email<br>Phone Number: $number";
            $mail->AltBody = "Name: $name\nEmail: $email\nPhone Number: $number";

            // Send the email
            $mail->send();

            // Log data to a log file
            $logFile = 'form-submissions.log';
            $logData = date("Y-m-d H:i:s") . " | Name: $name, Email: $email, Phone Number: $number" . PHP_EOL;
            file_put_contents($logFile, $logData, FILE_APPEND);

            // For header brochure modal: stay on the same page.
            // Front-end JS will handle showing a message / triggering the PDF download.
            http_response_code(200);
            echo 'OK';
            exit();

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>
