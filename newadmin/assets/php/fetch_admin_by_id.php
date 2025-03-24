<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Database connection details
$host = 'localhost';  // Database host
$dbname = 'esmile_db'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Database connection failed: " . $e->getMessage()]);
    exit;
}

// Get the user_id from the URL
$userId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($userId <= 0) {
    echo json_encode(["error" => "Invalid or missing ID parameter."]);
    exit;
}

try {
    // Query to fetch user data along with admin-specific details
    $query = "
        SELECT u.user_id, u.username, u.Email, u.role, u.created_at, 
               ad.First_Name, ad.Middle_Name, ad.Last_Name, ad.permissions
        FROM users u
        LEFT JOIN admin_details ad ON u.user_id = ad.user_id
        WHERE u.user_id = :userId AND u.role = 'admin'
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Return the user data as JSON
        echo json_encode(["status" => "success", "data" => $user]);
    } else {
        echo json_encode(["error" => "Admin not found."]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
}
exit;
?>
