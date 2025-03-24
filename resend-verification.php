<?php
session_start();
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esmile_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if email exists in session
if (!isset($_SESSION['email'])) {
    $_SESSION['error'] = "No email found. Please create an account first.";
    header('Location: create-account.html');
    exit();
}

$email = $_SESSION['email'];
$verification_code = rand(100000, 999999); // Generate new 6-digit code

// Update verification code and timestamp
$update_sql = "UPDATE patient_details SET verification_code = ?, verification_expiry = NOW() WHERE Email = ?";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("si", $verification_code, $email);

if (!$update_stmt->execute()) {
    $_SESSION['error'] = "Error updating verification code. Please try again.";
    header('Location: verification.html');
    exit();
}
$update_stmt->close();

// Send verification email
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'miguel.carlosc27@gmail.com';
    $mail->Password = 'koos laff hvio oevy'; !
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom('miguel.carlosc27@gmail.com', 'E-Smile Dental');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Resend Verification Code - E-Smile Dental';
    $mail->Body = "
        <div style='border: 2px solid #007BFF; padding: 20px; border-radius: 10px; background-color: #f4f8ff; font-family: Arial, sans-serif;'>
            <div style='text-align: center; margin-bottom: 15px;'>
                <h2 style='color: #007BFF; margin: 0;'>Mariano Dental Clinic</h2>
                <p style='margin: 5px 0; font-size: 14px; color: #555;'>Your Trusted Partner in Dental Care</p>
            </div>

            <p>Dear Mr./Ms. {$last_name},</p>

            <p>Your verification code is:</p>

            <h1 style='color: #4CAF50; font-size: 32px; letter-spacing: 5px; text-align: center;'>{$verification_code}</h1>

            <p>This code will expire in 30 seconds.</p>

            <p>If you didn't request this, please ignore this email.</p>

            <p><strong>Contact Us:</strong><br>
            📧 Email: <a href='mailto:support@esmiledental.com' style='color: #007BFF;'>support@esmiledental.com</a><br>
            📞 Phone: +63 912 345 6789</p>

            <p>Best regards,<br>
            <strong>Mariano Dental Clinic</strong></p>

            <hr style='border: 0; height: 1px; background-color: #ccc; margin: 20px 0;'>

            <p style='text-align: center; font-size: 12px; color: #777;'>
                This is a system-generated email. Please do not reply.
            </p>
        </div>
    ";

    $mail->AltBody = "Your verification code is: $verification_code. It will expire in 20 seconds.";

    $mail->send();
    $_SESSION['success'] = "A new verification code has been sent to your email.";
    header('Location: verification.html');
    exit();
} catch (Exception $e) {
    $_SESSION['error'] = "Email sending failed: " . $mail->ErrorInfo;
    header('Location: verification.html');
    exit();
}

?>
