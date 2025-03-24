<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Database connection details
//fetch_patient_by_id.php
$host = 'localhost';  // Your database host (usually 'localhost')
$dbname = 'esmile_db'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password (if any)

// Create a PDO instance (connection)
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Failed to connect to the database. Please try again later."]);
    exit;
}

// Get the patient ID from the URL
$patientId = isset($_GET['id']) ? (int)$_GET['id'] : 0; // Ensure the ID is an integer

// Debugging: Check if the ID exists
if ($patientId === 0) {
    echo json_encode(["error" => "ID parameter is missing or invalid in the URL."]);
    exit;
}

// Query to fetch patient data based on the ID
$query = "SELECT * FROM patient_details WHERE P_ID = :patientId";

try {
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':patientId', $patientId, PDO::PARAM_INT);
    $stmt->execute();
    
    // Fetch the patient data
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Check if patient data is found
    if ($patient) {
        echo json_encode([$patient]); // Return the patient data as JSON
    } else {
        echo json_encode(["error" => "Patient not found"]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
}
?>
