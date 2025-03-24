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

// Query to fetch appointments and patient's full name
$query = "
    SELECT 
        a.appointment_id, 
        a.title, 
        a.appointment_date, 
        a.appointment_time, 
        a.status, 
        a.cancel_reason,
        a.payment_screenshot,
        CONCAT(
            COALESCE(pd.First_Name, ''), 
            ' ', 
            COALESCE(pd.Middle_Name, ''), 
            ' ', 
            COALESCE(pd.Last_Name, '')
        ) AS patient_name,
        pd.Mobile_no, 
        pd.Email, 
        pd.username
    FROM esmile_db.appointments a
    JOIN esmile_db.patient_details pd ON a.user_id = pd.user_id
    WHERE a.status IN ('Set Request', 'Cancel Requested')
";



try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    // Fetch all rows
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Check if data is available
    if ($appointments) {
        echo json_encode(["status" => "success", "appointments" => $appointments]); // Return the data as JSON
    } else {
        echo json_encode(["status" => "error", "message" => "No appointments found"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Query failed: " . $e->getMessage()]);
}
?>
