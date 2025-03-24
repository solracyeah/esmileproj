<?php
session_start(); // Start the session

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esmile_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $First_name = trim($_POST['first_name']);
    $Middle_name = trim($_POST['middle_name']);
    $Last_name = trim($_POST['last_name']);
    $username = trim($_POST['username']);
    $Email = trim($_POST['email']);
    $Password = $_POST['password'];
    $Confirm_password = $_POST['confirm_password'] ?? '';
    $region = trim($_POST['region']);
    $province = trim($_POST['province']);
    $city_municipality = trim($_POST['city_municipality']);
    $barangay = trim($_POST['barangay']);
    $DOB = $_POST['dob'];
    $Mobile_no = trim($_POST['mobile_no']);
    $Sex = trim($_POST['sex']);
    $Telephone_no = trim($_POST['telephone_no']);
    $Height_feet = (int)$_POST['height_feet'];
    $Height_inches = (int)$_POST['height_inches'];
    $Weight = floatval($_POST['weight_kg']);
    $Blood_type = trim($_POST['blood_type']);

    $Height = $Height_feet + ($Height_inches / 12);

    if (empty($First_name) || empty($Last_name) || empty($username) || empty($Email) || empty($Password) ||
        empty($Confirm_password) || empty($region) || empty($province) || empty($city_municipality) || empty($barangay) || 
        empty($DOB) || empty($Mobile_no) || empty($Sex) || empty($Height) || empty($Weight) || empty($Blood_type)) {
        $_SESSION['error'] = "All fields are required.";
        header('Location: create-account.html');
        exit();
    }

    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header('Location: create-account.html');
        exit();
    }

    if ($Password !== $Confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header('Location: create-account.html');
        exit();
    }

    $check_username_sql = "SELECT username FROM patient_details WHERE username = ?";
    $check_stmt = $conn->prepare($check_username_sql);
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $_SESSION['error'] = "Username already exists.";
        header('Location: create-account.html');
        exit();
    }
    $check_stmt->close();

    $check_email_sql = "SELECT Email FROM patient_details WHERE Email = ?";
    $check_email_stmt = $conn->prepare($check_email_sql);
    $check_email_stmt->bind_param("s", $Email);
    $check_email_stmt->execute();
    $check_email_stmt->store_result();

    if ($check_email_stmt->num_rows > 0) {
        $_SESSION['error'] = "Email already exists.";
        header('Location: create-account.html');
        exit();
    }
    $check_email_stmt->close();

    $hashed_password = password_hash($Password, PASSWORD_DEFAULT);
    $verification_code = rand(100000, 999999);

    $insert_sql = "
    INSERT INTO patient_details (
        First_name, Middle_name, Last_name, username, password, Email, region, province, 
        city_municipality, barangay, DOB, Mobile_no, Sex, Telephone_no, 
        height, weight, blood_type, verification_code, verification_expiry
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
    ";
    
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param(
        "sssssssssssssddsis",  // Corrected type string (19 characters for 19 variables)
        $First_name, $Middle_name, $Last_name, $username, $hashed_password, $Email, 
        $region, $province, $city_municipality, $barangay, $DOB, $Mobile_no, $Sex, 
        $Telephone_no, $Height, $Weight, $Blood_type, $verification_code
    );
    
    if (!$insert_stmt->execute()) {
        $_SESSION['error'] = "Error creating account: " . $insert_stmt->error;
        header('Location: create-account.html');
        exit();
    }
    $insert_stmt->close();

    // Update user_id in patient_details after insertion
    $update_sql = "
    UPDATE patient_details pd
    JOIN users u ON pd.username = u.username
    SET pd.user_id = u.user_id
    WHERE pd.user_id IS NULL;
    ";
    $conn->query($update_sql);

    $_SESSION['email'] = $Email;

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'miguel.carlosc27@gmail.com';
        $mail->Password   = 'koos laff hvio oevy'; // Use an app password instead of your actual password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('miguel.carlosc27@gmail.com', 'E-Smile Dental');
        $mail->addAddress($Email);

        $mail->isHTML(true);
        $mail->Subject = 'Email Verification - E-Smile Dental';
        $mail->Body = "
            <div style='border: 2px solid #007BFF; padding: 20px; border-radius: 10px; background-color: #f4f8ff; font-family: Arial, sans-serif;'>
                <div style='text-align: center; margin-bottom: 15px;'>
                    <h2 style='color: #007BFF; margin: 0;'>Mariano Dental Clinic</h2>
                    <p style='margin: 5px 0; font-size: 14px; color: #555;'>Your Trusted Partner in Dental Care</p>
                </div>

                <p>Welcome to E-Smile Dental!</p>

                <p>Use this verification code within the next 30 seconds to complete your registration:</p>

                <h1 style='color: #4CAF50; font-size: 32px; letter-spacing: 5px; text-align: center;'>{$verification_code}</h1>

                <p>If you didn't create an account, ignore this email.</p>

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

        $mail->AltBody = "Your verification code is: $verification_code. It expires in 2 minutes.";

        $mail->send();

        $_SESSION['success'] = "Account created successfully. Please check your email for the verification code.";
        header('Location: verification.html');
        exit();

    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        echo "<script>
            alert('Email sending failed. Please check your email settings.');
            window.history.back();
        </script>";
        exit();
    }
}
?>

