<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Database connection details
$host = 'localhost'; // Database host
$dbname = 'esmile_db';  // Database name
$username = 'root';  // Database username (change if necessary)
$password = '';      // Database password (change if necessary)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
    exit;
}

// Query to fetch appointments data with only the required columns
$query = "SELECT title, appointment_date, appointment_time, created_at, status 
          FROM esmile_db.appointments";

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    // Fetch all rows
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Check if data is available
    if ($appointments) {
        echo json_encode($appointments); // Return the data as JSON
    } else {
        echo json_encode(["error" => "No appointments found"]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
}