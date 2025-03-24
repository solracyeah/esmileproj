<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Database connection details
$host = 'localhost'; // Database host
$dbname = 'esmile_db';  // Database name
$username = 'root';  // Database username (change if necessary)
$password = '';      // Database password (change if necessary)

try {
    // Database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
    exit;
}

// Fetch appointments data with user names
$query = "SELECT pd.First_Name, pd.Middle_Name, pd.Last_Name, 
                 a.title AS Description, a.notes AS Notes, 
                 a.appointment_date AS Date, a.appointment_time AS Time
          FROM patient_details pd
          INNER JOIN appointments a
          ON pd.user_id = a.user_id
          WHERE a.status = 'Approved'";

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    // Fetch all rows
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Return JSON
    if ($appointments) {
        echo json_encode($appointments); // Success
    } else {
        echo json_encode(["error" => "No appointments found"]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
}
?>