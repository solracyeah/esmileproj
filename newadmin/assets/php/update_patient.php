<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Set the content type to JSON
header('Content-Type: application/json');

// Database connection details
$host = 'localhost';
$dbname = 'esmile_db';
$username = 'root';
$password = '';

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Database connection failed: " . $e->getMessage()]);
    exit;
}

// Parse incoming data for update (when the profile is being updated)
$data = json_decode(file_get_contents("php://input"), true);

// Get the 'id' parameter from the URL for fetching data
$patientId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($patientId <= 0) {
    echo json_encode(["error" => "Invalid or missing ID parameter."]);
    exit;
}

// Fetch the patient data from the database
try {
    $stmt = $pdo->prepare("SELECT * FROM patient_details WHERE P_ID = :patientId");
    $stmt->bindParam(':patientId', $patientId, PDO::PARAM_INT);
    $stmt->execute();

    $patient = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$patient) {
        echo json_encode(["error" => "Patient not found."]);
        exit;
    }

    // If data is being fetched (GET request)
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Return the patient data as a JSON response
        echo json_encode($patient);
        exit;
    }

    // If the data is for updating the profile (POST request)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate incoming data for updating profile
        $firstName = isset($data['first_name']) ? trim($data['first_name']) : null;
        $middleName = isset($data['middle_name']) ? trim($data['middle_name']) : null;
        $lastName = isset($data['last_name']) ? trim($data['last_name']) : null;
        $email = isset($data['email']) ? trim($data['email']) : null;
        $mobileNo = isset($data['mobile_no']) ? trim($data['mobile_no']) : null;
        $sex = isset($data['sex']) ? trim($data['sex']) : null;
        $dob = isset($data['dob']) ? trim($data['dob']) : null;
        $height = isset($data['height']) ? trim($data['height']) : null;
        $weight = isset($data['weight']) ? trim($data['weight']) : null;
        $bloodType = isset($data['blood_type']) ? trim($data['blood_type']) : null;

        // Ensure required fields are present
        if (empty($firstName) || empty($lastName) || empty($email)) {
            echo json_encode(["error" => "Required fields are missing."]);
            exit;
        }

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["error" => "Invalid email format."]);
            exit;
        }

        try {
            // Update patient profile in the database
            $query = "
                UPDATE patient_details p
                LEFT JOIN users u ON p.user_id = u.user_id
                SET 
                    p.First_Name = :firstName, 
                    p.Middle_Name = :middleName, 
                    p.Last_Name = :lastName, 
                    u.Email = :email, 
                    p.Mobile_no = :mobileNo, 
                    p.Sex = :sex, 
                    p.DOB = :dob, 
                    p.height = :height, 
                    p.weight = :weight, 
                    p.blood_type = :bloodType
                WHERE p.P_ID = :patientId
            ";

            $updateStmt = $pdo->prepare($query);
            $updateStmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
            $updateStmt->bindParam(':middleName', $middleName, PDO::PARAM_STR);
            $updateStmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
            $updateStmt->bindParam(':email', $email, PDO::PARAM_STR);
            $updateStmt->bindParam(':mobileNo', $mobileNo, PDO::PARAM_STR);
            $updateStmt->bindParam(':sex', $sex, PDO::PARAM_STR);
            $updateStmt->bindParam(':dob', $dob, PDO::PARAM_STR);
            $updateStmt->bindParam(':height', $height, PDO::PARAM_STR);
            $updateStmt->bindParam(':weight', $weight, PDO::PARAM_STR);
            $updateStmt->bindParam(':bloodType', $bloodType, PDO::PARAM_STR);
            $updateStmt->bindParam(':patientId', $patientId, PDO::PARAM_INT);

            if ($updateStmt->execute()) {
                echo json_encode(["success" => "Patient profile updated successfully!"]);
            } else {
                echo json_encode(["error" => "No changes were made to the profile."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["error" => "Profile update failed: " . $e->getMessage()]);
        }
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Error fetching patient data: " . $e->getMessage()]);
}

exit;
?>
