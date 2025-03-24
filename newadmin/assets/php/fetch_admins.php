<?php
header('Content-Type: application/json');

// Database connection
$host = 'localhost';
$dbname = 'esmile_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Database connection failed."]);
    exit;
}

// Fetch admin data with role from users table
$query = "
    SELECT 
        a.user_id,  
        a.First_Name, 
        a.Middle_Name, 
        a.Last_Name, 
        u.role, 
        a.Email
    FROM admin_details a
    INNER JOIN users u ON a.user_id = u.user_id
";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Fetch all data
$admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return data as JSON
if ($admins) {
    echo json_encode($admins);
} else {
    echo json_encode(["error" => "No admins found"]);
}
?>
