<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dentistry_db"; // Update this to your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$toothNumber = $_POST['tooth_number'];
$toothStatus = $_POST['status'];
$patientName = $_POST['patient_name'];
$patientAge = $_POST['patient_age'];
$patientContact = $_POST['patient_contact'];

// Update tooth status and patient details in the database
$sql = "UPDATE teeth SET status = ?, patient_name = ?, patient_age = ?, patient_contact = ? WHERE tooth_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $toothStatus, $patientName, $patientAge, $patientContact, $toothNumber);

if ($stmt->execute()) {
  echo json_encode(['message' => 'Tooth status updated successfully.']);
} else {
  echo json_encode(['message' => 'Error updating tooth status.']);
}

$stmt->close();
$conn->close();
?>
