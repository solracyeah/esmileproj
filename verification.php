<?php
session_start();
require 'vendor/autoload.php';

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_verification_code = trim($_POST['verification_code']);

    if (empty($entered_verification_code)) {
        $_SESSION['error'] = "Verification code is required.";
        header('Location: verification.html');
        exit();
    }

    // Fetch verification details from database
    $sql = "SELECT verification_code, UNIX_TIMESTAMP(verification_expiry) AS verification_timestamp, is_verified 
            FROM patient_details WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $_SESSION['error'] = "No account found with this email.";
        header('Location: create-account.html');
        exit();
    }

    $user = $result->fetch_assoc();
    $stored_verification_code = trim($user['verification_code']);
    
    // Get current time as a Unix timestamp
    $current_timestamp = time();
    $verification_expires = $user['verification_timestamp'] + 30; // Code expires after 30 seconds

    // Check if already verified
    if ($user['is_verified'] == 1) {
        $_SESSION['success'] = "Your email is already verified.";
        header('Location: pages-login.html');  
        exit();
    }

    // Check if the verification code has expired
    if ($current_timestamp > $verification_expires) {
        $_SESSION['error'] = "Verification code has expired. Please request a new one.";
        header('Location: resend-verification.php');
        exit();
    }

    // Verify the entered code
    if ($entered_verification_code === $stored_verification_code) {
        $update_sql = "UPDATE patient_details SET is_verified = 1 WHERE Email = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("s", $email);
        
        if ($update_stmt->execute()) {
            $_SESSION['success'] = "Your email has been successfully verified.";
            header('Location: pages-login.html?success=true');  
            exit();
        } else {
            $_SESSION['error'] = "Failed to verify the email. Please try again.";
            header('Location: verification.html');
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid verification code.";
        header('Location: verification.html');
        exit();
    }
}
?>
