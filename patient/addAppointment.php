<?php

include '../db_connection.php';  // Include the database connection file

$data = json_decode(file_get_contents('php://input'), true);  // Get JSON data from the client-side

$user_id = $conn->real_escape_string($data['user_id']);  // User ID
$title = $conn->real_escape_string($data['title']);      // Appointment Title
$appointment_date = $conn->real_escape_string($data['appointment_date']);  // Appointment Date
$appointment_time = $conn->real_escape_string($data['appointment_time']);  // Appointment Time

// Insert the appointment data into the appointments table
$sql = "INSERT INTO appointments (user_id, title, appointment_date, appointment_time)
        VALUES ('$user_id', '$title', '$appointment_date', '$appointment_time')";

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Appointment added successfully',
        'appointment_id' => $conn->insert_id,
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to add appointment']);
}

$conn->close();

?>