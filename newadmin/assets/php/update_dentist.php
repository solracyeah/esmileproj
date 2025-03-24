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
$dentistId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($dentistId <= 0) {
    echo json_encode(["error" => "Invalid or missing ID parameter."]);
    exit;
}

// Fetch the dentist data from the database
try {
    $stmt = $pdo->prepare("SELECT * FROM dentist_details WHERE dentist_id = :dentistId");
    $stmt->bindParam(':dentistId', $dentistId, PDO::PARAM_INT);
    $stmt->execute();

    $dentist = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$dentist) {
        echo json_encode(["error" => "Dentist not found."]);
        exit;
    }

    // If data is being fetched (GET request)
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Return the dentist data as a JSON response
        echo json_encode($dentist);
        exit;
    }

    // If the data is for updating the profile (POST request)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate incoming data for updating profile
        $firstName = isset($data['first_name']) ? trim($data['first_name']) : null;
        $middleName = isset($data['middle_name']) ? trim($data['middle_name']) : null;
        $lastName = isset($data['last_name']) ? trim($data['last_name']) : null;
        $email = isset($data['email']) ? trim($data['email']) : null;
        $specialization = isset($data['specialization']) ? trim($data['specialization']) : null;
        $mobileNo = isset($data['mobile_no']) ? trim($data['mobile_no']) : null;
        $sex = isset($data['sex']) ? trim($data['sex']) : null;
        $dob = isset($data['dob']) ? trim($data['dob']) : null;
        $licenseNumber = isset($data['license_number']) ? trim($data['license_number']) : null;

        // Ensure required fields are present
        if (empty($firstName) || empty($lastName) || empty($email) || empty($specialization)) {
            echo json_encode(["error" => "Required fields are missing."]);
            exit;
        }

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["error" => "Invalid email format."]);
            exit;
        }

        try {
            // Update dentist profile in the database
            $query = "
                UPDATE dentist_details d
                LEFT JOIN users u ON d.user_id = u.user_id
                SET 
                    d.First_Name = :firstName, 
                    d.Middle_Name = :middleName, 
                    d.Last_Name = :lastName, 
                    u.Email = :email, 
                    d.Specialization = :specialization, 
                    d.Mobile_no = :mobileNo, 
                    d.Sex = :sex, 
                    d.DOB = :dob, 
                    d.license_number = :licenseNumber, 
                    d.Email = :email  -- This line updates the email in dentist_details as well
                WHERE d.dentist_id = :dentistId
            ";

            $updateStmt = $pdo->prepare($query);
            $updateStmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
            $updateStmt->bindParam(':middleName', $middleName, PDO::PARAM_STR);
            $updateStmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
            $updateStmt->bindParam(':email', $email, PDO::PARAM_STR);
            $updateStmt->bindParam(':specialization', $specialization, PDO::PARAM_STR);
            $updateStmt->bindParam(':mobileNo', $mobileNo, PDO::PARAM_STR);
            $updateStmt->bindParam(':sex', $sex, PDO::PARAM_STR);
            $updateStmt->bindParam(':dob', $dob, PDO::PARAM_STR);
            $updateStmt->bindParam(':licenseNumber', $licenseNumber, PDO::PARAM_STR);
            $updateStmt->bindParam(':dentistId', $dentistId, PDO::PARAM_INT);

            if ($updateStmt->execute()) {
                echo json_encode(["success" => "Dentist profile updated successfully!"]);
            } else {
                echo json_encode(["error" => "No changes were made to the profile."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["error" => "Profile update failed: " . $e->getMessage()]);
        }
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Error fetching dentist data: " . $e->getMessage()]);
}

exit;
?>
