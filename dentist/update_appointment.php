<?php
// update_appointment.php

// Set JSON response header
header('Content-Type: application/json');

// Database connection details
$host = 'localhost';
$dbname = 'esmile_db';
$username = 'root';
$password = '';

try {
    // Create a secure PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);

    // Get the input data from the request
    $input = json_decode(file_get_contents('php://input'), true);

    // Validate input data
    if (!isset($input['id'], $input['treatment_fee'], $input['note'])) {
        http_response_code(400); // Bad Request
        echo json_encode(["status" => "error", "message" => "Missing required fields."]);
        exit;
    }

    // Sanitize and validate input
    $appointmentId = filter_var($input['id'], FILTER_VALIDATE_INT);
    $treatmentFee = filter_var($input['treatment_fee'], FILTER_VALIDATE_FLOAT);
    $note = trim($input['note']);

    if (!$appointmentId || !$treatmentFee || empty($note)) {
        http_response_code(400); // Bad Request
        echo json_encode(["status" => "error", "message" => "Invalid input data."]);
        exit;
    }

    // Prepare and execute the SQL query securely
    $stmt = $conn->prepare("UPDATE appointments SET treatment_fee = :treatment_fee, note = :note WHERE appointment_id = :id");
    $stmt->bindParam(':treatment_fee', $treatmentFee, PDO::PARAM_STR);
    $stmt->bindParam(':note', $note, PDO::PARAM_STR);
    $stmt->bindParam(':id', $appointmentId, PDO::PARAM_INT);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->rowCount() > 0) {
        echo json_encode(["status" => "success", "message" => "Appointment updated successfully."]);
    } else {
        http_response_code(404); // Not Found
        echo json_encode(["status" => "error", "message" => "No changes made or appointment not found."]);
    }
} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
exit;
?>
