<?php
// fetch_appointment_by_id.php
header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$dbname = 'esmile_db';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
    
    $appointmentId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    
    if (!$appointmentId) {
        throw new Exception("Invalid appointment ID");
    }
    
    $stmt = $conn->prepare("
        SELECT 
            a.appointment_id,
            a.appointment_date,
            a.appointment_time,
            a.treatment_fee,
            a.title,
            a.notes,
            CONCAT(pd.first_name, ' ', COALESCE(pd.middle_name, ''), ' ', pd.last_name) AS patient_name
        FROM appointments a
        LEFT JOIN patient_details pd ON a.user_id = pd.user_id
        WHERE a.appointment_id = ?
    ");
    
    $stmt->execute([$appointmentId]);
    $appointment = $stmt->fetch();
    
    if ($appointment) {
        echo json_encode([
            "status" => "success",
            "data" => $appointment
        ]);
    } else {
        throw new Exception("Appointment not found");
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}

    // Ensure treatment_fee is properly formatted
    if ($appointment['treatment_fee'] !== null) {
        $appointment['treatment_fee'] = floatval($appointment['treatment_fee']);
    }
?>