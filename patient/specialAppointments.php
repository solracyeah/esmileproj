<?php
session_start();
require_once '../db_connection.php'; // Database connection

// Validate and sanitize input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = isset($_POST['user_id']) ? filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT) : null;
    $appointment_date = isset($_POST['appointment_date']) ? filter_var($_POST['appointment_date'], FILTER_SANITIZE_STRING) : null;
    $appointment_time = isset($_POST['appointment_time']) ? filter_var($_POST['appointment_time'], FILTER_SANITIZE_STRING) : null;
    $services = isset($_POST['appointment_title']) ? $_POST['appointment_title'] : [];

    // Ensure required fields are not empty
    if (!$user_id || !$appointment_date || !$appointment_time || empty($services)) {
        $_SESSION['error_message'] = "All fields are required.";
        header("Location: setAppointment.php");
        exit();
    }

    // Escape values to prevent SQL injection
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $appointment_date = mysqli_real_escape_string($conn, $appointment_date);
    $appointment_time = mysqli_real_escape_string($conn, $appointment_time);

    // Ensure services are properly formatted
    $services_string = implode(", ", array_map('htmlspecialchars', $services));

    // Define price map
    $price_map = [
        "Check-up" => 250,
        "Cleaning" => 1000,
        "Extraction" => 2000,
        "Root Canal Therapy" => 3000,
        "Removal of Impacted Tooth" => 3000,
        "Toothache" => 500,
        "Cavity Filling" => 1500,
        "Whitening" => 800,
        "Orthodontics Consultation" => 250
    ];

    // Calculate total price
    $total_price = array_reduce($services, function ($sum, $service) use ($price_map) {
        return $sum + ($price_map[$service] ?? 0);
    }, 0);

    try {
        // Prepare SQL statement
        $sql = "INSERT INTO special_appointments (user_id, services, appointment_date, appointment_time, total_price, status) 
                VALUES (?, ?, ?, ?, ?, 'Pending')";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssi", $user_id, $services_string, $appointment_date, $appointment_time, $total_price);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Special appointment request submitted successfully!";
            header("Location: patient-dashboard.php");
            exit();
        } else {
            throw new Exception("Error processing appointment");
        }
        
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Error: " . $e->getMessage();
        header("Location: setAppointment.php");
        exit();
    }

    // Close resources
    $stmt->close();
    $conn->close();
} else {
    header("Location: setAppointment.php");
    exit();
}
?>
