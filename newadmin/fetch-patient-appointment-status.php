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
    echo json_encode(["status" => "error", "message" => "Connection failed: " . $e->getMessage()]);
    exit;
}

// Query to fetch appointments with patient full name
$query = "SELECT p.First_Name, p.Middle_Name, p.Last_Name, 
                 a.title, a.appointment_date, a.appointment_time, a.status 
          FROM esmile_db.appointments AS a
          JOIN esmile_db.patient_details AS p ON a.user_id = p.user_id
          WHERE a.status IN ('Cancelled', 'Approved', 'Disapproved')";

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($appointments)) {
        // Format full name correctly
        foreach ($appointments as &$appt) {
            $appt['patient_name'] = trim($appt['First_Name'] . ' ' . $appt['Middle_Name'] . ' ' . $appt['Last_Name']);
            unset($appt['First_Name'], $appt['Middle_Name'], $appt['Last_Name']); // Remove separate name fields
        }
        
        echo json_encode(["status" => "success", "appointments" => $appointments]);
    } else {
        echo json_encode(["status" => "error", "message" => "No matching appointments found"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Query failed: " . $e->getMessage()]);
}
?>
