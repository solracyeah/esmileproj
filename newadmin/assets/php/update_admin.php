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

// Parse incoming data
$data = json_decode(file_get_contents("php://input"), true);

// Validate incoming user ID
$userId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($userId <= 0) {
    echo json_encode(["error" => "Invalid or missing ID parameter."]);
    exit;
}

// Define fields for profile update and password change
$firstName = isset($data['first_name']) ? trim($data['first_name']) : null;
$middleName= isset($data['middle_name']) ? trim($data['middle_name']) : null;
$lastName = isset($data['last_name']) ? trim($data['last_name']) : null;
$email = isset($data['email']) ? trim($data['email']) : null;
$permissions = isset($data['permissions']) ? trim($data['permissions']) : null;

$oldPassword = isset($data['old_password']) ? trim($data['old_password']) : null;
$newPassword = isset($data['new_password']) ? trim($data['new_password']) : null;
$confirmPassword = isset($data['confirm_password']) ? trim($data['confirm_password']) : null;

// Ensure required fields are present for profile update
if (empty($firstName) || empty($lastName) || empty($email) || empty($permissions)) {
    echo json_encode(["error" => "Required fields are missing."]);
    exit;
}

// Profile Update Logic
if (!$oldPassword) {  // No password change
    try {
        // Update both admin_details and users tables
        $query = "
            UPDATE admin_details ad
            LEFT JOIN users u ON ad.user_id = u.user_id
            SET ad.First_Name = :firstName, ad.Middle_Name = :middleName, ad.Last_Name = :lastName, 
                u.Email = :email, ad.Email = :email, ad.permissions = :permissions
            WHERE u.user_id = :userId
        ";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':middleName', $middleName, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':permissions', $permissions, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Profile updated successfully!"]);
        } else {
            echo json_encode(["error" => "No changes were made to the profile."]);
        }
    } catch (PDOException $e) {
        error_log("SQL Error: " . $e->getMessage());
        echo json_encode(["error" => "Profile update failed."]);
    }
} 
// Password Change Logic
elseif ($oldPassword && $newPassword && $confirmPassword) {
    if ($newPassword !== $confirmPassword) {
        echo json_encode(["error" => "New password and confirmation do not match."]);
        exit;
    }

    if (strlen($newPassword) < 6) {
        echo json_encode(["error" => "New password must be at least 6 characters long."]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT password FROM users WHERE user_id = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($oldPassword, $user['password'])) {
            $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);

            $updateStmt = $pdo->prepare("UPDATE users SET password = :newPassword WHERE user_id = :userId");
            $updateStmt->bindParam(':newPassword', $hashedNewPassword, PDO::PARAM_STR);
            $updateStmt->bindParam(':userId', $userId, PDO::PARAM_INT);

            if ($updateStmt->execute()) {
                echo json_encode(["success" => "Password updated successfully!"]);
            } else {
                echo json_encode(["error" => "Failed to update password."]);
            }
        } else {
            echo json_encode(["error" => "Old password is incorrect."]);
        }
    } catch (PDOException $e) {
        error_log("SQL Error: " . $e->getMessage());
        echo json_encode(["error" => "Password change failed."]);
    }
} else {
    echo json_encode(["error" => "Invalid or missing data for update."]);
}

exit;
?>
