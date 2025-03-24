<?php
// Start the session
session_start();

// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "esmile_db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $first_name = trim($_POST['first_name']);
    $middle_name = trim($_POST['middle_name']);
    $last_name = trim($_POST['last_name']);
    $dob = $_POST['dob'];
    $mobile_no = trim($_POST['mobile_no']);
    $sex = trim($_POST['sex']);
    $height_feet = (int)$_POST['height_feet'];
    $height_inches = (int)$_POST['height_inches'];
    $weight_kg = floatval($_POST['weight_kg']);
    $blood_type = trim($_POST['blood_type']);
    $email = trim($_POST['email']);
    
    // Address fields
    $region = trim($_POST['region']);
    $province = trim($_POST['province']);
    $city_municipality = trim($_POST['city_municipality']);
    $barangay = trim($_POST['barangay']);
    $telephone_no = trim($_POST['telephone_no']);
    
    // Account details
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Combine height in feet and inches into a single float
    $height = $height_feet + ($height_inches / 12);

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Validate required fields
    if (
        empty($first_name) || empty($middle_name) || empty($last_name) || empty($dob) || 
        empty($mobile_no) || empty($sex) || empty($height_feet) || 
        empty($height_inches) || empty($weight_kg) || empty($blood_type) || 
        empty($email) || empty($region) || empty($province) || 
        empty($city_municipality) || empty($barangay) || 
        empty($username) || empty($password)
    ) {
        $_SESSION['error'] = "All required fields must be filled!";
        header("Location: walkin-patient.php");
        exit();
    }

    // Prepare SQL statement for insertion
    $sql = "INSERT INTO patient_details (
                first_name,middle_name, last_name, dob, mobile_no, sex, height, 
                Weight, blood_type, email, region, province, 
                city_municipality, barangay, telephone_no, 
                username, password
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // Check if statement preparation was successful
    if ($stmt === false) {
        die("MySQL error: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param(
        "ssssssddsssssssss", 
        $first_name, $middle_name, $last_name, $dob, $mobile_no, $sex, 
        $height, $weight_kg, $blood_type, $email, $region, 
        $province, $city_municipality, $barangay, $telephone_no, 
        $username, $hashed_password
    );

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['success'] = "Patient account created successfully!";
        header("Location: success.php");
        exit();
    } else {
        $_SESSION['error'] = "Error creating account: " . $stmt->error;
        header("Location: walkin-patient.php");
        exit();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect if accessed without POST request
    header("Location: walkin-patient.php");
    exit();
}
?>