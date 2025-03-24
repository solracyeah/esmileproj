<?php
// getAppointments.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esmile_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]);
    exit();
}

// Fetch all appointments with usernames
$query = "SELECT a.appointment_id, a.title, a.appointment_date, a.appointment_time, 
                 a.status, a.cancel_reason, u.username 
          FROM appointments a
          JOIN users u ON a.user_id = u.user_id";

$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($appointmentId, $title, $appointmentDate, $appointmentTime, $status, $cancelReason, $username);

$appointments = [];
while ($stmt->fetch()) {
    $appointments[] = [
        'appointment_id' => $appointmentId,
        'title' => $title,
        'appointment_date' => $appointmentDate,
        'appointment_time' => $appointmentTime,
        'status' => $status,
        'cancel_reason' => $cancelReason,
        'username' => $username  // Include username
    ];
}

// Return JSON response
echo json_encode([
    "status" => "success",
    "appointments" => $appointments
]);

// Close the database connection
$stmt->close();
$conn->close();
?>
