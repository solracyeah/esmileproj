<?php
session_start(); // Start the session

// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "esmile_db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Database connection failure
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and sanitize
    $First_name = trim($_POST['first_name']);
    $Middle_name = trim($_POST['middle_name']);
    $Last_name = trim($_POST['last_name']);
    $username = trim($_POST['username']);
    $Email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $Password = $_POST['password'];
    $region = trim($_POST['region']);
    $province = trim($_POST['province']);
    $city_municipality = trim($_POST['city_municipality']);
    $barangay = trim($_POST['barangay']);
    $DOB = $_POST['dob'];
    $Mobile_no = trim($_POST['mobile_no']);
    $Sex = trim($_POST['sex']);
    $Telephone_no = trim($_POST['telephone_no']);
    $Height_feet = (int)$_POST['height_feet'];
    $Height_inches = (int)$_POST['height_inches'];
    $Weight = floatval($_POST['weight_kg']);
    $Blood_type = trim($_POST['blood_type']);

    // Combine height into a single float value (e.g., 5'10" = 5.10)
    $Height = $Height_feet + ($Height_inches / 12);

    // Handle optional Middle Name
    if (empty($Middle_name)) {
        $Middle_name = null;
    }

    // Validate inputs
    if (empty($First_name) || empty($Last_name) || empty($username) || empty($Email) || empty($Password) ||
        empty($region) || empty($province) || empty($city_municipality) || empty($barangay) || 
        empty($DOB) || empty($Mobile_no) || empty($Sex) || empty($Telephone_no) || 
        empty($Height) || empty($Weight) || empty($Blood_type)) {
        $_SESSION['error'] = "All fields are required!";
        header('Location: ../../addpatient.html');
        exit();
    }

    // Validate email format
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header('Location: ../../addpatient.html');
        exit();
    }

    // Validate mobile number (11 digits)
    if (!preg_match("/^[0-9]{11}$/", $Mobile_no)) {
        $_SESSION['error'] = "Please enter a valid 11-digit mobile number.";
        header('Location: ../../addpatient.html');
        exit();
    }

    // Hash the password for security
    $hashed_password = password_hash($Password, PASSWORD_DEFAULT);

    // Prepare SQL query to insert user data
    $stmt = $conn->prepare(
        "INSERT INTO patient_details (
            First_name, Middle_name, Last_name, username, password, Email, region, province, 
            city_municipality, barangay, DOB, Mobile_no, Sex, Telephone_no, 
            height, weight, blood_type
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    if ($stmt === false) {
        die('Prepare Error: ' . $conn->error); // Check for errors in preparation
    }

    // Bind parameters (ensure the types match the database columns)
    $stmt->bind_param(
        "sssssssssssssdsss", 
        $First_name, $Middle_name, $Last_name, $username, $hashed_password, $Email, 
        $region, $province, $city_municipality, $barangay, $DOB, $Mobile_no, $Sex, 
        $Telephone_no, $Height, $Weight, $Blood_type
    );

    // Execute the query
    if ($stmt->execute()) {
        $_SESSION['success'] = "Patient account created successfully!";
        header("Location: ../../success.php");
        exit();
    } else {
        $_SESSION['error'] = "Error creating account: " . $stmt->error;
        header("Location: ../../patientlist.html");
        exit();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
