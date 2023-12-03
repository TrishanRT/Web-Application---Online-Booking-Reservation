<?php
// Include the PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // SMTP server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com'; // Your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = ''; // Your SMTP username
    $mail->Password = ''; // Your SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Sender and recipient
    $mail->setFrom('your@email.com', 'Your Name'); // Sender's email and name
    $mail->addAddress('recipient@email.com', 'Recipient Name'); // Recipient's email and name

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Subject Here'; // Email subject
    $mail->Body = 'This is the HTML message body'; // HTML message body
    $mail->AltBody = 'This is the plain text message body'; // Plain text message body

    // Send the email
    $mail->send();
    echo 'Email sent successfully.';
} catch (Exception $e) {
    echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
}
?>
