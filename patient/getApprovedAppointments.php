<?php
// getApprovedAppointments.php

include '../db_connection.php';

// Get user_id from the request
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;

if (!$user_id) {
    echo json_encode(['error' => 'User ID is required']);
    exit;
}

// Fetch approved appointments for the given user_id
$sql = "SELECT appointment_id, user_id, title, appointment_date, appointment_time 
        FROM appointments 
        WHERE status = 'Approved' AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = [
            'appointment_id' => $row['appointment_id'],
            'user_id' => $row['user_id'],
            'title' => $row['title'],
            'appointment_date' => $row['appointment_date'],
            'appointment_time' => $row['appointment_time'],
        ];
    }

    // Return appointments as JSON
    echo json_encode($appointments);
} else {
    // Return an empty array if no approved appointments are found
    echo json_encode([]);
}

$conn->close();
?>
