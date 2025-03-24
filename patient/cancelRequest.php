<?php
// cancelRequest.php

// Retrieve JSON input from the request
$data = json_decode(file_get_contents('php://input'), true);

$appointmentId = $data['appointment_id'];
$userId = $data['user_id'];
$reason = $data['reason'];

// Ensure the data is valid
if (empty($appointmentId) || empty($userId) || empty($reason)) {
    echo json_encode(["status" => "error", "message" => "Missing required fields"]);
    exit;
}

// Connect to your database (replace with your actual database connection)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esmile_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the appointment exists in the appointments table
$checkAppointmentQuery = "SELECT COUNT(*) FROM appointments WHERE appointment_id = ? AND user_id = ?";
$stmt = $conn->prepare($checkAppointmentQuery);
$stmt->bind_param("ii", $appointmentId, $userId);
$stmt->execute();
$stmt->bind_result($appointmentExists);
$stmt->fetch();
$stmt->close();

if ($appointmentExists == 0) {
    echo json_encode(["status" => "error", "message" => "Appointment not found"]);
    exit;
}

// Start a transaction to ensure data integrity
$conn->begin_transaction();

try {
    // Update the appointment status to 'Cancel Requested' and store the cancellation reason
    $updateStatusQuery = "UPDATE appointments SET status = 'Cancel Requested', cancel_reason = ? WHERE appointment_id = ?";
    $stmt = $conn->prepare($updateStatusQuery);
    $stmt->bind_param("si", $reason, $appointmentId);

    if (!$stmt->execute()) {
        throw new Exception("Failed to update appointment status");
    }

    // Commit the transaction
    $conn->commit();

    // Return success response
    echo json_encode(["status" => "success", "message" => "Cancellation request sent successfully"]);

} catch (Exception $e) {
    // Rollback the transaction in case of an error
    $conn->rollback();

    // Return error response
    echo json_encode(["status" => "error", "message" => "Failed to process the cancellation request: " . $e->getMessage()]);
}

// Close the database connection
$stmt->close();
$conn->close();
?>
