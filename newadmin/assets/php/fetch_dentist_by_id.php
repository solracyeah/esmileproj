<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Database connection details
$host = 'localhost';
$dbname = 'esmile_db';
$username = 'root';
$password = '';

try {
    // Create a PDO instance (connection)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Failed to connect to the database. Please try again later."]);
    exit;
}

// Get the dentist ID from the URL
$dentistId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Check if the ID exists
if ($dentistId === 0) {
    echo json_encode(["error" => "ID parameter is missing or invalid in the URL."]);
    exit;
}

// Query to fetch dentist data based on the ID
$query = "SELECT dentist_id, First_Name, Last_Name, Middle_Name, Mobile_no, Email, DOB, Sex, license_number, specialization, contact_info FROM dentist_details WHERE dentist_id = :dentistId";

try {
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':dentistId', $dentistId, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the dentist data
    $dentist = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dentist) {
        echo json_encode([$dentist]); // Return the dentist data as JSON
    } else {
        echo json_encode(["error" => "Dentist not found"]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
}
?>
